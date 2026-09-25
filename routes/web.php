<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KategoriKompetitorController;
use App\Http\Controllers\KompetitorController;

// ==========================================
// AREA PUBLIK (Bisa diakses tanpa login)
// ==========================================
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/api/wilayah/{provinsi_id}', [FrontController::class, 'getWilayah']);

// ==========================================
// AREA ADMIN (Wajib Login)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Kerangka Dashboard Admin (Sidebar & Navbar)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Isi Default Iframe Dashboard di tengah layar
    Route::get('/dashboard/main', function () {
        return "<h3 style='font-family:sans-serif; text-align:center; margin-top:20%; color:#003B73;'>Selamat datang! Kita akan memigrasikan isi file dashboard.php Anda ke kotak ini pada tahap selanjutnya.</h3>";
    })->name('dashboard.main');

    // -----------------------------------------------------------
    // ROUTE UNTUK PEGAWAI / ADMIN
    // -----------------------------------------------------------
    // Route resource otomatis menangani index, create, store, edit, update, destroy
    Route::resource('pegawai', PegawaiController::class)->except(['show']);
    
    // Route khusus Admin untuk mereset paksa password pegawai (Bypass Email)
    Route::post('/pegawai/{id}/reset-password', [PegawaiController::class, 'forceResetPassword'])->name('pegawai.force-reset');


    // Rute Profile bawaan Laravel Breeze (Biarkan saja)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk Daftar Kompetitor
    Route::resource('kategori-kompetitor', KategoriKompetitorController::class);

    // Rute untuk Daftar Cabang/Agen Resmi Kompetitor
    Route::resource('kompetitor', KompetitorController::class);
});

require __DIR__.'/auth.php';