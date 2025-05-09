<?php

namespace App\Http\Controllers;
use App\Models\Medicine;
use App\Models\Country;
use App\Models\Exchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//薬の検索・カテゴリ別表示・検索フォームの画面を管理してるコントローラー
//検索ページの動きを全部仕切ってる責任者みたいなページ

class MedicineController extends Controller
{
    /**
     * 検索結果を表示するページ
     * 商品名検索とカテゴリ検索の両方の結果を表示
     */
    public function index(Request $request)
    {
        // リクエストから検索クエリ、カテゴリ、国コードを取得
        $query = $request->input('query');     // URLパラメータ「query」から検索キーワードを取得
        $category = $request->input('category'); // URLパラメータ「category」からカテゴリを取得
        $countryId = $request->input('country_code'); // URLパラメータ「country_code」から国IDを取得

        // ログに検索情報を記録
        \Log::info('検索実行', [
            'query' => $query,               // 検索キーワード
            'category' => $category,         // カテゴリ
            'country_id' => $countryId,      // 国ID
            'full_url' => $request->fullUrl() // 完全なURL（デバッグ用）
        ]);

        // 検索条件がない場合（検索キーワードもカテゴリも指定がない場合）
        if (!$query && !$category) {
            $medicines = collect([]);  // 空のコレクションを返す（何も表示しない）
        } else {
            // 検索条件がある場合、データベースクエリの作成を開始
            $baseQuery = Medicine::query();  // 薬のモデルに対するクエリビルダーを初期化

            // 検索キーワードがある場合
            if ($query) {
                // 薬の名前に検索キーワードが含まれるものを検索（部分一致）
                $baseQuery->where('name', 'like', "%{$query}%");
            }

            // カテゴリが指定されている場合
            if ($category) {
                // 指定されたカテゴリの薬だけを検索
                $baseQuery->where('category', $category);
            }

            // 選択された国のフィルタリング
            if ($countryId) {
                $baseQuery->inCountry($countryId);//指定された国で販売されている薬だけをデータベースから取得。inCountry は Medicine モデルで定義されているメソッド
                \Log::info('国別フィルタリング適用', [
                    'country_id' => $countryId,
                    'query_sql' => $baseQuery->toSql(),
                    'query_bindings' => $baseQuery->getBindings()
                ]);
            }

            // 最終的な結果を取得
            $medicines = $baseQuery->with(['countries' => function($q) {
                // リレーションをロードする際も価格が0より大きいもののみに制限
                $q->where('medicines_country.price', '>', 0);
            }])->get();

            \Log::info('検索結果', [
                'count' => $medicines->count(),
                'ids' => $medicines->pluck('id')->toArray()
            ]);
        }

        // 国と通貨情報の取得
        $countries = Country::all()->keyBy('id');
        $exchanges = Exchange::all()->keyBy('currency_code');

        return view('user.medicines.index', compact('medicines', 'query', 'category', 'countries', 'exchanges', 'countryId'));
    }

    /**
     * 商品名で薬を検索するページを表示
     * 検索フォームだけを表示し、検索結果はindexページに表示する
     */
    public function search(Request $request)
    {
        $countryId = $request->input('country_code');
        return view('user.medicines.search', compact('countryId'));
    }

    /**
     * 種類から薬を検索するページを表示
     */
    public function category(Request $request)
    {
        $countryId = $request->input('country_code');

        \Log::info('カテゴリページ表示', [
            'country_id' => $countryId,
            'url' => $request->fullUrl(),
            'has_country_code' => $request->has('country_code'),
            'all_query_params' => $request->query(),
            'raw_query_string' => $request->getQueryString(),
            'method' => $request->method(),
            'all_params' => $request->all()
        ]);

        // カテゴリーの表示順序を指定
        $categoryOrder = [
            '解熱鎮痛薬',
            '胃腸薬',
            '風邪薬',
            '目薬',
            '皮膚薬',
            '下痢止め',
            '防虫剤'
        ];

        // データベースから全てのカテゴリーを取得
        $categories = Medicine::distinct()
            ->pluck('category')
            ->filter()
            ->values();

        // カテゴリーを指定した順序で
        $sortedCategories = collect($categoryOrder)
            ->filter(function ($category) use ($categories) {
                return $categories->contains($category);
            })
            ->merge($categories->diff($categoryOrder));

        // countryIdが存在するかどうかを確認
        if (!$countryId) {
            // フラッシュメッセージを追加
            return redirect()->route('dashboard')
                ->with('error_message', 'カテゴリ表示には国選択が必要です。ダッシュボードで国を選択してください。');
        }

        return view('user.medicines.category', compact('sortedCategories', 'countryId'));
    }

    /**
     * 特定のカテゴリの薬一覧を表示
     */
    public function categoryShow(Request $request, $category)
    {
        $countryId = $request->input('country_code');
        $query = null; // 検索クエリ用に空の変数を定義

        \Log::info('カテゴリー詳細表示リクエスト', [
            'category' => $category,
            'country_id' => $countryId,
            'url' => $request->fullUrl(),
            'has_country_code' => $request->has('country_code'),
            'all_query_params' => $request->query(),
            'raw_query_string' => $request->getQueryString(),
            'method' => $request->method(),
            'all_params' => $request->all(),
            'route_params' => $request->route()->parameters()
        ]);

        // country_codeパラメータが存在しない場合はダッシュボードにリダイレクト
        if (!$countryId && $request->query('no_redirect') !== 'true') {
            \Log::info('国コードがないため、ダッシュボードにリダイレクト', [
                'category' => $category
            ]);
            // フラッシュメッセージを追加
            return redirect()->route('dashboard')->with('error_message', 'カテゴリ表示には国選択が必要です');
        }

        // クエリビルダーを作成
        $query_builder = Medicine::where('category', $category);

        // 国が選択されている場合、スコープを使用してフィルタリング
        if ($countryId) {
            $query_builder->inCountry($countryId);
            \Log::info('国別フィルタリング適用', [
                'country_id' => $countryId,
                'query_sql' => $query_builder->toSql(),
                'query_bindings' => $query_builder->getBindings()
            ]);
        }

        // 結果を取得
        $medicines = $query_builder->with(['countries' => function($q) {
            $q->where('medicines_country.price', '>', 0);
        }])->get();

        \Log::info('フィルタリング後の薬', [
            'count' => $medicines->count(),
            'ids' => $medicines->pluck('id')->toArray(),
            'names' => $medicines->pluck('name')->toArray()
        ]);

        // 国と通貨情報の取得
        $countries = Country::all()->keyBy('id');
        $exchanges = Exchange::all()->keyBy('currency_code');

        return view('user.medicines.index', compact('medicines', 'category', 'countries', 'exchanges', 'countryId', 'query'));
    }

    public function dashboard()
    {
        // 国一覧を取得
        $countries = Country::all();

        // デフォルト国は設定せず、未選択時は全データを表示
        return view('dashboard', compact('countries'));
    }
}
