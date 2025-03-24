<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;

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

require __DIR__.'/auth.php';
