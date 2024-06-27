<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\RequestRuangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/ruang', [RuangController::class, 'index'])->name('ruang');
    Route::get('/request_ruang', [RequestRuangController::class, 'index'])->name('request.ruang');
    Route::post('/verifikasi', [RequestRuangController::class, 'edit'])->name('request.verifikasi');
    Route::post('/add/request', [RequestRuangController::class, 'store'])->name('request.add');
});

Route::get('/bintang', function () {
    return view('bintang');
});

require __DIR__.'/auth.php';
