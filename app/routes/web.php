<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Stock\NasdaqController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/portfolio', function () {
    return view('portfolio');
})->middleware(['auth', 'verified'])->name('portfolio');

Route::get('/watchlist', function () {
    return view('watchlist');
})->middleware(['auth', 'verified'])->name('watchlist');

Route::get('/api/nasdaq', [NasdaqController::class, 'getNasdaqData'])->name('api.nasdaq');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
