<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Favorite;
use App\Models\Exchange;
use Illuminate\Http\Request;

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

        return back()->with('success', 'お気に入りから削除しました');
    }
}