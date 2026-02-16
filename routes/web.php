<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('pageHome');
Route::get('/layanan', [LayananController::class, 'index'])->name('pageLayanan');
Route::get('/tentang', [TentangController::class, 'index'])->name('pageTentang');
Route::get('/booking', [BookingController::class, 'index'])->name('pageBooking');
