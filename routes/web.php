<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 薬の検索関連ルート
    Route::get('/medicines/search', [App\Http\Controllers\MedicineController::class, 'search'])->name('medicines.search');
    Route::get('/medicines/category', [App\Http\Controllers\MedicineController::class, 'category'])->name('medicines.category');
    Route::get('/medicines', [App\Http\Controllers\MedicineController::class, 'index'])->name('medicines.index');
    
    // categoryShowはmedicines.index用に更新
    Route::get('/medicines/category/{category}', function ($category) {
        return redirect()->route('medicines.index', ['category' => $category]);
    })->name('medicines.category.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//管理画面のルート設定
    Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/medicines/create', [AdminController::class, 'create'])->name('admin.medicines.create');
    Route::post('/medicines', [AdminController::class, 'store'])->name('admin.medicines.store');
    Route::delete('/medicines/{medicine}', [AdminController::class, 'destroy'])->name('admin.medicines.destroy');
});

require __DIR__.'/auth.php';
