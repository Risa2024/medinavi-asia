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
        $query = $request->input('query');
        $category = $request->input('category');
        $countryCode = $request->input('country_code');

        // 検索条件がない場合は、空のコレクションを返す
        if (!$query && !$category) {
            $medicines = collect([]);
        } else {
            // 基本的なクエリビルダー
            $baseQuery = Medicine::query();

            // 商品名検索
            if ($query) {
                $baseQuery->where('name', 'like', "%{$query}%");
            }

            // カテゴリ検索
            if ($category) {
                $baseQuery->where('category', $category);
            }

            // 選択された国のフィルタリング
            if ($countryCode) {
                // まずは薬のIDのみを取得するサブクエリを作成
                $medicineIds = DB::table('medicines_country')
                    ->join('countries', 'medicines_country.country_id', '=', 'countries.id')
                    ->where('countries.currency_code', '=', $countryCode)
                    ->select('medicines_country.medicine_id')
                    ->pluck('medicine_id')
                    ->toArray();

                // 取得したIDでメインクエリをフィルタリング
                $baseQuery->whereIn('id', $medicineIds);
            }

            // 最終的な結果を取得
            $medicines = $baseQuery->with('countries')->get();
        }

        // 国と通貨情報の取得
        $countries = Country::all()->keyBy('code');
        $exchanges = Exchange::all()->keyBy('currency_code');

        return view('user.medicines.index', compact('medicines', 'query', 'countries', 'exchanges', 'countryCode'));
    }

    /**
     * 商品名で薬を検索するページを表示
     * 検索フォームだけを表示し、検索結果はindexページに表示する
     */
    public function search(Request $request)
    {
        $countryCode = $request->input('country_code');
        return view('user.medicines.search', compact('countryCode'));
    }

    /**
     * 種類から薬を検索するページを表示
     */
    public function category(Request $request)
    {
        $countryCode = $request->input('country_code');

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

        return view('user.medicines.category', compact('sortedCategories', 'countryCode'));
    }

    /**
     * 特定のカテゴリの薬一覧を表示
     */
    public function categoryShow(Request $request, $category)
    {
        $countryCode = $request->input('country_code');

        // 最もシンプルな実装 - まず全ての薬を取得
        $allMedicines = Medicine::where('category', $category)->with('countries')->get();

        // 国が選択されている場合、手動でフィルタリング
        if ($countryCode) {
            $medicines = collect();

            foreach ($allMedicines as $medicine) {
                $hasCountry = false;

                // 販売国をチェック
                foreach ($medicine->countries as $country) {
                    if ($country->currency_code === $countryCode) {
                        $hasCountry = true;
                        break;
                    }
                }

                // 選択された国で販売されている場合のみ追加
                if ($hasCountry) {
                    $medicines->push($medicine);
                }
            }
        } else {
            // 国が選択されていない場合は全ての薬
            $medicines = $allMedicines;
        }

        // 国と通貨情報の取得
        $countries = Country::all()->keyBy('code');
        $exchanges = Exchange::all()->keyBy('currency_code');

        return view('user.medicines.index', compact('medicines', 'category', 'countries', 'exchanges', 'countryCode'));
    }

    public function dashboard()
    {
        // 国一覧を取得
        $countries = Country::all();

        // デフォルト国は設定せず、未選択時は全データを表示
        return view('dashboard', compact('countries'));
    }
}
