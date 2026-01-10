<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/booking', function () {
    return view('booking');
})->name('pageBooking');
Route::get('/booking-success', function () {
    return view('booking-success');
})->name('pageBookingSuccess');
Route::get('/booking-detil', function () {
    return view('booking-detil');
})->name('pageBookingDetil');

Route::get('/layanan', function () {
    return view('layanan');
})->name('pageLayanan');

Route::get('/tentang', function () {
    return view('about');
})->name('pageAbout');

Route::get('/auth', function () {
    return view('register');
})->name('pageRegister');

Route::get('/riwayat', function () {
    return view('riwayat');
})->name('pageRiwayat');


// Route Login Admin
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('pageAdminLogin');

// Group Route Dashboard (Nanti bisa ditambah Middleware Auth)
Route::prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('pageAdminDashboard');

    Route::get('/bookings', function () {
        return view('admin.bookings');
    })->name('pageAdminBookings');

    Route::get('/services', function () {
        return view('admin.services');
    })->name('pageAdminServices');

    Route::get('/members', function () {
        return view('admin.member');
    })->name('pageAdminMembers');

    Route::get('/terapis', function () {
        return view('admin.terapis');
    })->name('pageAdminTerapis');

    Route::get('/laporan', function () {
        return view('admin.laporan');
    })->name('pageAdminLaporan');
});
