<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
# 管理者用コントローラー (AdminController.php)

## 主な機能
- 薬・国・カテゴリのCRUD（作成・編集・削除）
- 管理画面の表示・操作
- 国・カテゴリのバリデーション・重複チェック
- 国削除時の依存チェック

## 関連ファイル
- resources/views/admin/medicines/create.blade.php: 薬新規作成
- resources/views/admin/medicines/edit.blade.php: 薬編集
- Country, Medicineモデル
- CountrySeeder.php: 国情報の初期データ

## 実装メモ
- 国・カテゴリの追加・削除はバリデーション付き
- 国削除時は薬との関連をチェック
- 管理画面は認証済みユーザーのみアクセス可
*/

/**
 * 管理者用コントローラー
 *
 * 薬情報の管理（一覧表示、登録、削除）を行うコントローラー。
 * コントローラーはブラウザからのリクエストを受け取り、
 * 結果（ビューやリダイレクト）をユーザーに返す役割を持つ。
 */
class AdminController extends Controller
{
    /**
     * 薬一覧表示メソッド
     *「データベースから薬のデータをすべて新しい順に取得して、それを表示用のビューに渡す」という処理。
     *これが管理画面のトップページを表示するための処理になる。*/
    public function index()
    {
        // 検索クエリがある場合は処理する
        $query = request('search');

        // ベースとなるクエリビルダーを作成
        $medicinesQuery = Medicine::with('countries');

        // 検索クエリがある場合、薬品名で部分一致検索を行う
        if ($query) {
            $medicinesQuery->where('name', 'like', '%' . $query . '%');
        }

        // 結果を取得
        $medicines = $medicinesQuery->get();

        return view('admin.index', compact('medicines'));
    }

    /**
     * 薬登録フォーム表示メソッド
     *
     * 1. 'admin.medicines.create'ビューを表示
     *
     * 管理者が「新規登録」ボタンをクリックすると、このメソッドが実行される。
     */
    public function create()
    {
        $categories = Medicine::distinct()->pluck('category')->filter()->values();
        $countries = Country::orderBy('name')->get();
        return view('admin.medicines.create', compact('categories', 'countries'));
    }

    /**
     * 薬情報保存メソッド
     *
     * 1. フォームから送信されたデータをバリデーション（検証）
     * 2. 画像ファイルを'storage/app/public/medicines/'に保存
     * 3. 検証済みデータをデータベースに保存
     * 4. 管理画面トップへリダイレクト
     *
     * 管理者が登録フォームを送信すると、このメソッドが実行されるようになっている。
     */
    public function store(Request $request)
    {
        // バリデーションルールを修正
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required',
            'countries' => 'required|array',
            'prices' => 'required|array',
            'prices.*' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
        ]);

        // 画像ファイルがアップロードされた場合の処理
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('medicines', 'public');
            $validated['image_path'] = $path;
        }

        // 薬の基本情報を保存
        $medicine = Medicine::create([
            'name' => $validated['name'],
            'image_path' => $validated['image_path'] ?? null,
            'description' => $validated['description'],
            'category' => $validated['category']
        ]);

        // 選択された国と価格の情報を保存
        foreach ($validated['countries'] as $countryId) {
            $country = Country::find($countryId);
            if ($country) {
                $price = $validated['prices'][$countryId] ?? null;
                $medicine->countries()->attach($countryId, [
                    'price' => $price,
                    'currency_code' => $country->currency_code
                ]);
            }
        }

        return redirect()->route('admin.index')
            ->with('success', '薬の情報が正常に登録されました。');
    }


    /**
     * 薬情報編集フォーム表示メソッド
     *
     * 1. 'admin.medicines.edit'ビューを表示
     *
     * 管理者が「編集」ボタンをクリックすると、このメソッドが実行される。
     */
    public function edit(Medicine $medicine)
    {
        // 既存のカテゴリーを取得
        $categories = Medicine::distinct()->pluck('category')->filter()->values();
        $countries = Country::orderBy('name')->get();
        return view('admin.medicines.edit', compact('medicine', 'categories', 'countries'));
    }

    /**
     * 薬情報更新メソッド
     *
     * 1. フォームから送信されたデータをバリデーション（検証）
     * 2. 画像ファイルが新しくアップロードされた場合、古い画像を削除して新しい画像を保存
     * 3. 検証済みデータをデータベースで更新
     * 4. 国と価格情報の関連を更新
     * 5. 管理画面トップへリダイレクト
     */
    public function update(Request $request, Medicine $medicine)
    {
        // バリデーションルールを修正
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required',
            'countries' => 'required|array',
            'prices' => 'required|array',
            'prices.*' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
        ]);

        // 画像ファイルが新しくアップロードされた場合の処理
        if ($request->hasFile('image')) {
            if ($medicine->image_path) {
                Storage::disk('public')->delete($medicine->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('medicines', 'public');
        }

        // 薬の基本情報を更新
        $medicine->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'image_path' => $validated['image_path'] ?? $medicine->image_path,
        ]);

        // 既存の関連をすべて削除
        $medicine->countries()->detach();

        // 選択された国と価格の情報を保存
        foreach ($validated['countries'] as $countryId) {
            $country = Country::find($countryId);
            if ($country) {
                $price = $validated['prices'][$countryId] ?? null;
                $medicine->countries()->attach($countryId, [
                    'price' => $price,
                    'currency_code' => $country->currency_code
                ]);
            }
        }

        return redirect()->route('admin.index')
            ->with('success', '薬の情報が正常に更新されました。');
    }
    /**
     * 薬情報削除メソッド
     *
     * 1. 画像ファイルが存在すれば'storage/app/public/'から削除
     * 2. データベースからレコードを削除
     * 3. 管理画面トップへリダイレクト
     *
     * 管理者が「削除」ボタンをクリックすると、このメソッドが実行される。
     */
    public function destroy(Medicine $medicine)
    {
        if ($medicine->image_path) {
            Storage::disk('public')->delete($medicine->image_path);
        }
        $medicine->delete();

        return redirect()->route('admin.index')
            ->with('success', '薬の情報が削除されました。');
    }

    /**
     * 新しい国を追加するメソッド
     */
    public function storeCountry(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:countries',
            'emoji' => 'required|string|max:10',
            'currency_code' => 'required|string|max:3|unique:countries',
        ]);

        // 国を作成
        $country = Country::create($validated);

        // レスポンス
        return response()->json([
            'success' => true,
            'message' => '国が追加されました。',
            'country' => $country
        ]);
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // 既存のカテゴリーを取得
        $existingCategories = Medicine::select('category')->distinct()->pluck('category')->toArray();

        // 新しいカテゴリーが既に存在しないことを確認
        if (!in_array($validated['category_name'], $existingCategories)) {
            return response()->json([
                'success' => true,
                'category_name' => $validated['category_name'],
                'message' => 'カテゴリーが追加されました。'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'このカテゴリーは既に存在します。'
        ], 422);
    }

    /**
     * 国を削除するメソッド
     */
    public function destroyCountry(Country $country)
    {
        // この国を使用している薬があるか確認
        $medicinesWithCountry = $country->medicines()->exists();

        if ($medicinesWithCountry) {
            return response()->json([
                'success' => false,
                'message' => 'この国は薬の情報で使用されているため削除できません。'
            ], 422);
        }

        // 国を削除
        $country->delete();

        return response()->json([
            'success' => true,
            'message' => '国が削除されました。'
        ]);
    }
}

/*LaravelのRESTfulなコントローラ設計：
Laravelでは、リソース（データベースの内容）を操作するための標準的な7つのメソッドがある。
index - 一覧表示
create - 作成フォーム表示
store - 新規作成処理
show - 詳細表示
edit - 編集フォーム表示
update - 更新処理
destroy - 削除処理

index   → 薬の一覧を表示
create  → 新規登録フォームを表示（国の情報も含む）
store   → 新規登録の保存処理
edit    → 編集フォームを表示（国の情報と選択状態も含む）
update  → 編集内容の保存処理
destroy → 薬の削除処理*/