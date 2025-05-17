<?php

namespace App\Http\Controllers;
use App\Models\Medicine;
use App\Models\Country;
use App\Models\Exchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/*
# 薬情報コントローラー (MedicineController.php)

## 主な機能
- 薬の検索・一覧・詳細・カテゴリ別表示
- 国・カテゴリ・キーワードによる多段フィルタ
- お気に入り機能の連携
- 検索条件の復元・UI反映

## 関連ファイル
- resources/views/user/medicines/index.blade.php: 検索結果表示
- resources/views/user/medicines/category.blade.php: カテゴリ検索
- resources/views/user/medicines/search.blade.php: 商品名検索
- dashboard.blade.php: 国選択・検索UI
- Country, Medicine, Favoriteモデル

## 実装メモ
- 検索条件はリクエスト・localStorage・URLパラメータから取得
- 国・カテゴリ・キーワードでの多段フィルタに対応
- お気に入りはAjaxで即時反映
*/
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
        try {
            // リクエストから検索クエリ、カテゴリ、国コードを取得
            $rawQuery = $request->input('query');

            // 二重デコードを避けるため、URIデコードが必要な場合のみ適用
            $query = $rawQuery;
            if ($rawQuery && strpos($rawQuery, '%') !== false) {
                $query = urldecode($rawQuery);
            }

            // 他のパラメータを取得
            $category = $request->input('category');
            $countryId = $request->input('country_code');

            // ログに検索情報を記録
            \Log::info('検索実行（修正版）', [
                'query' => $query,               // 検索キーワード
                'raw_query' => $rawQuery, // 生の検索キーワード
                'category' => $category,         // カテゴリ
                'country_id' => $countryId,      // 国ID
                'full_url' => $request->fullUrl(), // 完全なURL（デバッグ用）
                'method' => $request->method(), // リクエストメソッド
                'all_params' => $request->all(), // すべてのパラメータ
                'server_query_string' => isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null,
                'request_uri' => isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null
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
        } catch (\Exception $e) {
            \Log::error('検索処理エラー', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'url' => $request->fullUrl()
            ]);

            return redirect()->route('dashboard')->with('error', '検索処理中にエラーが発生しました。もう一度お試しください。');
        }
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

        // countryIdが'all'または空の場合は全ての国を対象にする
        if (!$countryId || $countryId === 'all') {
            $countryId = null;
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

        // country_codeが'all'または空の場合は国フィルタをかけない
        if (!$countryId || $countryId === 'all') {
            $countryId = null;
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

    /**
     * POST検索を直接表示する（GETでなくPOSTリクエストで直接結果表示）
     * これによりURLのエンコーディング問題を回避する
     */
    public function showResults(Request $request)
    {
        try {
            // リクエストから検索クエリ、カテゴリ、国コードを取得
            $query = $request->input('query');  // POSTリクエストのため、エンコーディング問題なし
            $category = $request->input('category');
            $countryId = $request->input('country_code');

            // ログに検索情報を記録
            \Log::info('POST検索結果表示', [
                'query' => $query,               // 検索キーワード
                'category' => $category,         // カテゴリ
                'country_id' => $countryId,      // 国ID
                'method' => $request->method(), // リクエストメソッド
                'all_params' => $request->all() // すべてのパラメータ
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

            // 検索結果ビューを表示
            return view('user.medicines.index', compact('medicines', 'query', 'category', 'countries', 'exchanges', 'countryId'));
        } catch (\Exception $e) {
            \Log::error('検索処理エラー', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('dashboard')->with('error', '検索処理中にエラーが発生しました。もう一度お試しください。');
        }
    }

    /**
     * API用の検索メソッド - JSON形式で検索結果を返す
     */
    public function apiSearch(Request $request)
    {
        $rawQuery = $request->input('query');
        $query = $rawQuery ? urldecode($rawQuery) : null;
        $category = $request->input('category');
        $countryId = $request->input('country_code');

        // ログに検索情報を記録
        \Log::info('API検索実行', [
            'query' => $query,
            'raw_query' => $rawQuery,
            'category' => $category,
            'country_id' => $countryId,
            'full_url' => $request->fullUrl()
        ]);

        // 検索条件がない場合
        if (!$query && !$category) {
            return response()->json(['medicines' => []]);
        }

        // 検索条件がある場合、データベースクエリの作成
        $baseQuery = Medicine::query();

        // 検索キーワードがある場合
        if ($query) {
            $baseQuery->where('name', 'like', "%{$query}%");
        }

        // カテゴリが指定されている場合
        if ($category) {
            $baseQuery->where('category', $category);
        }

        // 選択された国のフィルタリング
        if ($countryId) {
            $baseQuery->inCountry($countryId);
        }

        // 結果を取得
        $medicines = $baseQuery->with(['countries' => function($q) {
            $q->where('medicines_country.price', '>', 0);
        }])->get();

        return response()->json(['medicines' => $medicines]);
    }
}
