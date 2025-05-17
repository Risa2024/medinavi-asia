<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GeoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 認証なしでアクセス可能なルート
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// 薬の検索関連ルート - 認証なしでアクセス可能
// 注意: 日本語クエリパラメータを正しく処理するため、モデルバインディングやパラメータ制約は使用せず
// ルートリゾルバがURLデコードを行う前にパラメータを処理できるようにする
Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
Route::get('/medicines/search', [MedicineController::class, 'search'])->name('medicines.search');

// 検索処理は直接indexを表示する新しいルートを使用
Route::post('/medicines/results', [MedicineController::class, 'showResults'])->name('medicines.results');

Route::get('/medicines/category', [MedicineController::class, 'category'])->name('medicines.category');
Route::get('/medicines/category/{category}', [MedicineController::class, 'categoryShow'])->name('medicines.category.show')->where('category', '.*');
Route::get('/medicines/{medicine}', [MedicineController::class, 'show'])->name('medicines.show');

// APIエンドポイント - 認証不要
Route::get('/api/medicines/search', [MedicineController::class, 'apiSearch']);
Route::get('/api/get-country', [GeoController::class, 'getCountry']);

// ダッシュボード
Route::get('/dashboard', [MedicineController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 認証済みユーザーのみアクセス可能なグループ
Route::middleware('auth')->group(function () {
    // お気に入り機能のルート
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
        Route::post('/favorites/{medicine}', [FavoriteController::class, 'store'])->name('favorites.store');
        Route::delete('/favorites/{medicine}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    });

    // プロフィール編集関連ルート
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 管理画面のルート設定
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/medicines/create', [AdminController::class, 'create'])->name('admin.medicines.create');
    Route::post('/medicines', [AdminController::class, 'store'])->name('admin.medicines.store');
    Route::get('/medicines/{medicine}/edit', [AdminController::class, 'edit'])->name('admin.medicines.edit');
    Route::put('/medicines/{medicine}', [AdminController::class, 'update'])->name('admin.medicines.update');
    Route::delete('/medicines/{medicine}', [AdminController::class, 'destroy'])->name('admin.medicines.destroy');
    Route::post('/countries', [AdminController::class, 'storeCountry'])->name('admin.countries.store');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('/countries/{country}', [AdminController::class, 'destroyCountry'])->name('admin.countries.destroy');
    Route::delete('/categories', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');
});

require __DIR__.'/auth.php';
