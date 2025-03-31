<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * 管理者用コントローラー
 *
 * 薬情報の管理（一覧表示、登録、削除）を行うコントローラーです。
 * コントローラーはブラウザからのリクエストを受け取り、
 * 結果（ビューやリダイレクト）をユーザーに返す役割を持ちます。
 */
class AdminController extends Controller
{
    /**
     * 薬一覧表示メソッド
     *「データベースから薬のデータをすべて新しい順に取得して、それを表示用のビューに渡す」という処理。
     *これが管理画面のトップページを表示するための処理になる。*/
    public function index()
    {
        $medicines = Medicine::latest()->get();
        /*Medicine:: - Medicineモデル（medicinesテーブルに対応）にアクセスします
        latest() - 最新のデータが最初に来るように並べ替えます（created_at降順）
        これで取得したデータは $medicines 変数に格納されます*/
        return view('admin.index', compact('medicines'));
        /*compact関数 - PHP変数 $medicines をビューに渡します
        ビューファイル内で $medicines 変数が使えるようになる*/
    }

    /**
     * 薬登録フォーム表示メソッド
     * 
     * 1. 'admin.medicines.create'ビューを表示
     * 
     * 管理者が「新規登録」ボタンをクリックすると、このメソッドが実行されます。
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
     * 管理者が登録フォームを送信すると、このメソッドが実行されます。
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required',
            'country' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
            'currency_code' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('medicines', 'public');
            $validated['image_path'] = $path;
        }

        Medicine::create($validated);

        return redirect()->route('admin.index')
            ->with('success', '薬の情報が正常に登録されました。');
    }

    /**
     * 薬情報削除メソッド
     * 
     * 1. 画像ファイルが存在すれば'storage/app/public/'から削除
     * 2. データベースからレコードを削除
     * 3. 管理画面トップへリダイレクト
     * 
     * 管理者が「削除」ボタンをクリックすると、このメソッドが実行されます。
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