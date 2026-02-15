<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('pageHome');
Route::get('/layanan', [LayananController::class, 'index'])->name('pageLayanan');
