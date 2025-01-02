<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Stock\NasdaqController;
use App\Http\Controllers\WatchlistController;
use App\Models\WatchlistStock;
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

Route::get('/api/nasdaq', [NasdaqController::class, 'getNasdaqData'])->name('api.nasdaq');
Route::get('/api/nasdaq-stocks', [NasdaqController::class, 'getAllNasdaqStocks']);
Route::get('/portfolio/summary', [PortfolioController::class, 'index'])->name('portfolio');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/watchlist', [WatchlistController::class, 'index'])->name('watchlist');
    Route::post('/watchlist', [WatchlistController::class, 'store'])->name('watchlist.store');
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::put('/portfolio/{id}', [PortfolioController::class, 'portfolio.update']);
    Route::delete('/portfolio/{id}', [PortfolioController::class, 'portfolio.destroy']);
    Route::delete('/watchlist/{id}', [WatchlistController::class, 'destroy'])->name('watchlist.destory');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
