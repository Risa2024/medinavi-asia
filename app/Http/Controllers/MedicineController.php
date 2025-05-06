<?php

namespace App\Http\Controllers;
use App\Models\Medicine;
use App\Models\Country;
use App\Models\Exchange;
use Illuminate\Http\Request;
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

        $medicines = Medicine::query();

        // 商品名検索
        if ($query) {
            $medicines->where('name', 'like', "%{$query}%");
        }

        // カテゴリ検索
        if ($category) {
            $medicines->where('category', $category);
        }

        // 検索条件がない場合は、空のコレクションを返す
        if (!$query && !$category) {
            $medicines = collect([]);
        } else {
            // 選択された国でフィルタリング
            if ($countryCode) {
                // 選択された国の薬だけを取得（クエリレベルでフィルタリング）
                $medicineIds = \DB::table('medicines_country')
                    ->where('currency_code', $countryCode)
                    ->pluck('medicine_id');

                $medicines = $medicines->whereIn('id', $medicineIds)->with('countries')->get();
            } else {
                // 国選択なしの場合は全ての薬を表示
                $medicines = $medicines->with('countries')->get();
            }
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
        $medicines = Medicine::where('category', $category);

        // 選択された国でフィルタリング
        if ($countryCode) {
            // 選択された国の薬だけを取得（クエリレベルでフィルタリング）
            $medicineIds = \DB::table('medicines_country')
                ->where('currency_code', $countryCode)
                ->pluck('medicine_id');

            $medicines = $medicines->whereIn('id', $medicineIds)->with('countries')->get();
        } else {
            // 国選択なしの場合は全ての薬を表示
            $medicines = $medicines->with('countries')->get();
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
