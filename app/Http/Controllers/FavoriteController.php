<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Favorite;
use App\Models\Exchange;
use Illuminate\Http\Request;

/*
# お気に入り管理コントローラー (FavoriteController.php)

## 主な機能
- 薬のお気に入り登録・解除
- ユーザーごとのお気に入り一覧取得
- Ajax対応のレスポンス返却

## 関連ファイル
- resources/views/user/medicines/index.blade.php: お気に入りボタン
- Medicine, Favorite, Userモデル

## 実装メモ
- 認証（Auth）機能と連携
- Ajaxリクエストに対応したレスポンス返却
- 外部APIは利用していない（全て自サービス内処理）
*/

class FavoriteController extends Controller
{
    /**
     * お気に入り一覧を表示
     */
    public function index()
    {
        $favorites = auth()->user()->favoriteMedicines()->paginate(12);

        // 為替レート情報を取得
        $exchanges = Exchange::get()->keyBy('currency_code');

        return view('user.favorites.index', compact('favorites', 'exchanges'));
    }

    /**
     * お気に入りに追加
     */
    public function store(Medicine $medicine)
    {
        // 既にお気に入りに追加されていないか確認
        $exists = Favorite::where('user_id', auth()->id())
                        ->where('medicine_id', $medicine->id)
                        ->exists();

        if (!$exists) {
            Favorite::create([
                'user_id' => auth()->id(),
                'medicine_id' => $medicine->id
            ]);
        }

        // Ajaxリクエストの場合はJSONレスポンスを返す
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'お気に入りに追加しました'
            ]);
        }

        // 通常のリクエストの場合は元のページにリダイレクト
        return back()->with('success', 'お気に入りに追加しました');
    }

    /**
     * お気に入りから削除
     */
    public function destroy(Medicine $medicine)
    {
        Favorite::where('user_id', auth()->id())
              ->where('medicine_id', $medicine->id)
              ->delete();

        // Ajaxリクエストの場合はJSONレスポンスを返す
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'お気に入りから削除しました'
            ]);
        }

        // 通常のリクエストの場合は元のページにリダイレクト
        return back()->with('success', 'お気に入りから削除しました');
    }
}
