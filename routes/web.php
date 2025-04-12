<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CountryController;

Route::get('/', function () {
    return view('welcome');
});
//dashboardにアクセスすると、dashboard.blade.phpビューを表示
//middleware(['auth', 'verified']): 認証済み（ログイン済み）かつメール認証済みのユーザーのみアクセス可能
//name('dashboard'): このルートに「dashboard」という名前をつけて、他の場所から参照できるようにする
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//認証済みユーザーのみアクセス可能なグループ
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 薬の検索関連ルート
    Route::get('/medicines/search', [App\Http\Controllers\MedicineController::class, 'search'])->name('medicines.search');
    Route::get('/medicines/category', [App\Http\Controllers\MedicineController::class, 'category'])->name('medicines.category');
    Route::get('/medicines', [App\Http\Controllers\MedicineController::class, 'index'])->name('medicines.index');

    // categoryShowはmedicines.index用に更新
    //カテゴリー別表示のリダイレクト設定
    Route::get('/medicines/category/{category}', function ($category) {
        return redirect()->route('medicines.index', ['category' => $category]);
    })->name('medicines.category.show');

    // お気に入り機能のルート
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{medicine}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{medicine}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    //プロフィール編集関連ルート
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//管理画面のルート設定
Route::prefix('admin')->middleware(['auth'])->group(function () {//prefix('admin')：すべてのURLの前に/adminをつける
    //middleware(['auth'])：認証済みユーザーのみアクセス可能。
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/medicines/create', [AdminController::class, 'create'])->name('admin.medicines.create');
    Route::post('/medicines', [AdminController::class, 'store'])->name('admin.medicines.store');
    Route::get('/medicines/{medicine}/edit', [AdminController::class, 'edit'])->name('admin.medicines.edit');
    Route::put('/medicines/{medicine}', [AdminController::class, 'update'])->name('admin.medicines.update');
    Route::delete('/medicines/{medicine}', [AdminController::class, 'destroy'])->name('admin.medicines.destroy');
    Route::post('/countries', [AdminController::class, 'storeCountry'])->name('admin.countries.store');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    
    // 国の削除のためのルート
    Route::delete('/countries/{country}', [AdminController::class, 'destroyCountry'])->name('admin.countries.destroy');
    
    // カテゴリーの削除のためのルート
    Route::delete('/categories', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');
});

require __DIR__.'/auth.php';
