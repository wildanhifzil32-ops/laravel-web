```php
<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index']);

Route::resource('pelanggan', PelangganController::class);

Route::resource('portfolio', PortfolioController::class);

Route::resource('user', UserController::class)
    ->except(['show']);