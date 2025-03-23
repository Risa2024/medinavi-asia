<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
