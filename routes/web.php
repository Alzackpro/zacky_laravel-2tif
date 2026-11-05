<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/* ===== PERTEMUAN 2 : Route ===== */
// 1. Basic Route
Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

// 3. Named Route (route /mahasiswa dari langkah 1, sudah diberi nama)
Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
})->name('mahasiswa.show');

// 2. Route Parameter (wajib)
Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya: ' . $param1;
});

// 2. Route Parameter (opsional)
Route::get('/nim/{param1?}', function ($param1 = '') {
    return 'NIM saya: ' . $param1;
});

// Route -> Controller (+ View): /mahasiswa/detail, /mahasiswa/profil, /mahasiswa/HAHA
Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

// Route -> View
Route::get('/about', function () {
    return view('halaman-about');
});

// Latihan Controller
Route::get('/matakuliah', [MatakuliahController::class, 'index']);
Route::get('/matakuliah/show/{kode?}', [MatakuliahController::class, 'show']);

/* ===== PERTEMUAN 3 : Passing Data ===== */
Route::get('/home', [HomeController::class, 'index']);
