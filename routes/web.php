<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BankInfoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('bank-info')->group(function(){
        Route::get('/', [BankInfoController::class, 'index'])->name('bank-info');
    });

    Route::prefix('tagihan')->group(function(){
        Route::get('/', [App\Http\Controllers\Tagihan\TagihanController::class, 'index'])->name('tagihan');
    });
});

require __DIR__.'/auth.php';
