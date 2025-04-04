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
            $medicines = $medicines->with('countries')->get();
        }

        // 国と通貨情報の取得
        $countries = Country::all()->keyBy('code');
        $exchanges = Exchange::all()->keyBy('currency_code');

        return view('user.medicines.index', compact('medicines', 'query', 'countries', 'exchanges'));
    }

    /**
     * 商品名で薬を検索するページを表示
     * 検索フォームだけを表示し、検索結果はindexページに表示する
     */
    public function search()
    {
        return view('user.medicines.search');
    }

    /**
     * 種類から薬を検索するページを表示
     */
    public function category()
    {
        // 薬のカテゴリ一覧を取得
        $categories = Medicine::select('category')->distinct()->get()->pluck('category');
        
        return view('user.medicines.category', compact('categories'));
    }

    /**
     * 特定のカテゴリの薬一覧を表示
     */
    public function categoryShow(Request $request, $category)
    {
        $medicines = Medicine::where('category', $category)->with('countries')->get();
        
        // 国と通貨情報の取得
        $countries = Country::all()->keyBy('code');
        $exchanges = Exchange::all()->keyBy('currency_code');
        
        return view('user.medicines.index', compact('medicines', 'category', 'countries', 'exchanges'));
    }
}
