<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiantarGoController;

// Jalur Beranda Utama (Landing Page)
Route::get('/', function () {
    return view('welcome'); // Membuka halaman awal welcome.blade.php
})->name('beranda');

// Jalur Publik Driver (Form & Proses)
Route::get('/daftar', [SiantarGoController::class, 'formRegistrasi'])->name('driver.form');
Route::post('/register', [SiantarGoController::class, 'simpanRegistrasi'])->name('driver.simpan');
Route::post('/cek-status', [SiantarGoController::class, 'cekStatus'])->name('driver.cek-status');

// Jalur Autentikasi Admin (Sebelum Login)
Route::get('/admin/login', [SiantarGoController::class, 'formLogin'])->name('login');
Route::post('/admin/login', [SiantarGoController::class, 'prosesLogin'])->name('admin.login-proses');
Route::post('/admin/logout', [SiantarGoController::class, 'logout'])->name('admin.logout');

// Jalur Proteksi Admin (Hanya Bisa Diakses Setelah Login)
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [SiantarGoController::class, 'dashboardAdmin'])->name('admin.dashboard');
    Route::post('/admin/driver/{id}/verifikasi', [SiantarGoController::class, 'verifikasiDriver'])->name('admin.verifikasi');
});
