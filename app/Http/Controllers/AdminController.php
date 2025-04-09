<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // N+1問題を避けるために、eagerロードを使用
        // with('countries')によって、薬に関連する国の情報を事前に一括取得
        // これにより、各薬ごとに別クエリを発行せず、パフォーマンスが向上する
        $medicines = Medicine::with('countries')->get();
        // 取得したデータをビューに渡す
        // compact関数で変数名と同じキーの配列を生成
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
        return view('admin.medicines.create');
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
        // 送信されたデータのバリデーション
        // name: 必須、最大255文字
        // category: 必須
        // country: 必須、配列形式
        // image: 必須、画像ファイル、jpeg/png/jpg形式、最大2048KB
        // description: 必須
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required',
            'country' => 'required|array',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
        ]);

        // 画像ファイルがアップロードされた場合の処理
        if ($request->hasFile('image')) {
            // 'public'ディスク（storage/app/public/）の'medicines'フォルダに画像を保存
            // 返り値としてファイルパスを取得
            $path = $request->file('image')->store('medicines', 'public');
            // バリデーション済みデータに画像パスを追加
            $validated['image_path'] = $path;
        }

        // 薬の基本情報のみをデータベースに保存
        // 中間テーブルに保存するデータ（国・価格・通貨）は含めない
        $medicine = Medicine::create([
            'name' => $validated['name'],
            'image_path' => $validated['image_path'] ?? null,
            'description' => $validated['description'],
            'category' => $validated['category']
        ]);

        // 国名から対応する通貨コードへのマッピング
        // 各国に対して固定の通貨コードを設定
        $currencyCodes = [
            'インドネシア' => 'IDR',
            'マレーシア' => 'MYR',
            'タイ' => 'THB',
            'ベトナム' => 'VND',
        ];

        // 国名からフォームの価格入力フィールド名へのマッピング
        // 例: 'インドネシア' → 'price_id'（フォームのname属性）
        $priceFields = [
            'インドネシア' => 'price_id',
            'マレーシア' => 'price_my',
            'タイ' => 'price_th',
            'ベトナム' => 'price_vn',
        ];

        // 選択された各国について、中間テーブルにデータを保存
        foreach ($validated['country'] as $countryName) {
            // 国名からCountryモデルのインスタンスを取得
            $country = \App\Models\Country::where('name', $countryName)->first();

            // 条件チェック：
            // 1. $countryが存在する（データベースに国が登録されている）
            // 2. $priceFieldsに国名のキーが存在する
            // 3. リクエストに対応する価格フィールドが入力されている
            if ($country && isset($priceFields[$countryName]) && $request->filled($priceFields[$countryName])) {
                // 中間テーブル（medicines_country）にデータを追加
                // attach: 多対多リレーションで関連付けを作成するメソッド
                $medicine->countries()->attach($country->id, [
                    'price' => $request->input($priceFields[$countryName]),
                    'currency_code' => $currencyCodes[$countryName]
                ]);
            }
        }

        // 管理画面のトップページにリダイレクト
        // with('success', ...): フラッシュメッセージを設定
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
        return view('admin.medicines.edit', compact('medicine'));
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
        // 送信されたデータのバリデーション
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required',
            'country' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
        ]);

        // 画像ファイルが新しくアップロードされた場合の処理
        if ($request->hasFile('image')) {
            // 古い画像を削除
            if ($medicine->image_path) {
                Storage::disk('public')->delete($medicine->image_path);
            }
            // 新しい画像を保存
            $validated['image_path'] = $request->file('image')->store('medicines', 'public');
        }

        // 薬の基本情報を更新
        $medicine->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'image_path' => $validated['image_path'] ?? $medicine->image_path,
        ]);
// 関連する国・価格情報の更新
        // 既存の関連をすべて削除
        $medicine->countries()->detach();

        // 国名から対応する通貨コードへのマッピング
        $currencyCodes = [
            'インドネシア' => 'IDR',
            'マレーシア' => 'MYR',
            'タイ' => 'THB',
            'ベトナム' => 'VND',
        ];

        // 国名からフォームの価格入力フィールド名へのマッピング
        $priceFields = [
            'インドネシア' => 'price_id',
            'マレーシア' => 'price_my',
            'タイ' => 'price_th',
            'ベトナム' => 'price_vn',
        ];

        // 選択された各国について、中間テーブルにデータを保存
        foreach ($validated['country'] as $countryName) {
            // 国名からCountryモデルのインスタンスを取得
            $country = \App\Models\Country::where('name', $countryName)->first();

            // 国が存在する場合、チェックがついている国の情報を保存する
            if ($country) {
                // 価格が入力されている場合はその値を使用し、なければnullを設定
                $price = null;
                if (isset($priceFields[$countryName]) && $request->filled($priceFields[$countryName])) {
                    $price = $request->input($priceFields[$countryName]);
                }

                // 中間テーブル（medicines_country）にデータを追加
                $medicine->countries()->attach($country->id, [
                    'price' => $price,
                    'currency_code' => $currencyCodes[$countryName]
                ]);
            }
        }

        // 管理画面のトップページにリダイレクト
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
}

/*LaravelのRESTfulなコントローラ設計：
Laravelでは、リソース（データベースの内容）を操作するための標準的な7つのメソッドがある。
index - 一覧表示
create - 作成フォーム表示
store - 新規作成処理
show - 詳細表示
edit - 編集フォーム表示
update - 更新処理
destroy - 削除処理*/