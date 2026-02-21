<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\AnakController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BidanController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\SetPasswordController;
use App\Http\Controllers\Admin\SlideController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('pageHome');
Route::get('/layanan', [LayananController::class, 'index'])->name('pageLayanan');
Route::get('/tentang', [TentangController::class, 'index'])->name('pageTentang');
Route::get('/booking', [BookingController::class, 'index'])->name('pageBooking');

// Frontend auth routes (untuk pelanggan)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Email verification routes (untuk pelanggan)
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::post('/email/verify', [EmailVerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/resend', [EmailVerificationController::class, 'resend'])->name('verification.resend');
});

// Profil routes
Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profil.password');
});

// Data anak routes
Route::middleware('auth')->group(function () {
    Route::get('/data-anak', [AnakController::class, 'index'])->name('anak.index');
    Route::get('/data-anak/setup', [AnakController::class, 'setup'])->name('anak.setup');
    Route::get('/data-anak/tambah', [AnakController::class, 'create'])->name('anak.create');
    Route::post('/data-anak', [AnakController::class, 'store'])->name('anak.store');
    Route::get('/data-anak/{anak}/edit', [AnakController::class, 'edit'])->name('anak.edit');
    Route::put('/data-anak/{anak}', [AnakController::class, 'update'])->name('anak.update');
    Route::delete('/data-anak/{anak}', [AnakController::class, 'destroy'])->name('anak.destroy');
    Route::post('/data-anak/complete', [AnakController::class, 'complete'])->name('anak.complete');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset');

// Admin auth routes (terpisah dari frontend, guard: admin)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:admin');
    Route::get('/set-password/{token}', [SetPasswordController::class, 'showForm'])->name('set-password');
    Route::post('/set-password', [SetPasswordController::class, 'setPassword'])->name('set-password.submit');
});

// Admin panel routes (butuh auth guard admin)
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // User management - view
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware('role:super_admin,admin,owner');

    // User management - create, edit, delete
    Route::middleware('role:super_admin,owner')->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
        Route::post('/users/{user}/resend-invitation', [UserController::class, 'resendInvitation'])->name('users.resendInvitation');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Pelanggan - view
    Route::get('/pelanggan', [PelangganController::class, 'index'])
        ->name('pelanggan.index')
        ->middleware('role:super_admin,admin,owner');
    Route::get('/pelanggan/{pelanggan}', [PelangganController::class, 'show'])
        ->name('pelanggan.show')
        ->middleware('role:super_admin,admin,owner');

    // Bidan/Terapis management - create, edit, delete (harus sebelum show route)
    Route::middleware('role:super_admin,owner')->group(function () {
        Route::get('/bidans/create', [BidanController::class, 'create'])->name('bidans.create');
        Route::post('/bidans', [BidanController::class, 'store'])->name('bidans.store');
        Route::get('/bidans/{bidan}/edit', [BidanController::class, 'edit'])->name('bidans.edit');
        Route::put('/bidans/{bidan}', [BidanController::class, 'update'])->name('bidans.update');
        Route::delete('/bidans/{bidan}', [BidanController::class, 'destroy'])->name('bidans.destroy');
    });

    // Bidan/Terapis management - view
    Route::middleware('role:super_admin,admin,owner,bidan_terapis')->group(function () {
        Route::get('/bidans', [BidanController::class, 'index'])->name('bidans.index');
        Route::get('/bidans/{bidan}', [BidanController::class, 'show'])->name('bidans.show');
    });

    // Slide/Banner management - view
    Route::get('/slides', [SlideController::class, 'index'])
        ->name('slides.index')
        ->middleware('role:super_admin,admin,owner');

    // Slide/Banner management - create, edit, delete
    Route::middleware('role:super_admin,owner')->group(function () {
        Route::get('/slides/create', [SlideController::class, 'create'])->name('slides.create');
        Route::post('/slides', [SlideController::class, 'store'])->name('slides.store');
        Route::get('/slides/{slide}/edit', [SlideController::class, 'edit'])->name('slides.edit');
        Route::put('/slides/{slide}', [SlideController::class, 'update'])->name('slides.update');
        Route::delete('/slides/{slide}', [SlideController::class, 'destroy'])->name('slides.destroy');
    });
});
