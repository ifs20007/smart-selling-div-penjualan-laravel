<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DashboardController;

// ==========================================
// AREA PUBLIK (Bisa diakses tanpa login)
// ==========================================
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/api/wilayah/{provinsi_id}', [FrontController::class, 'getWilayah']);


// ==========================================
// AREA ADMIN (Wajib Login)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. Kerangka Dashboard (Sidebar & Navbar)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // 2. Isi Default Iframe Dashboard
    Route::get('/dashboard/main', function () {
        return "<h3 style='font-family:sans-serif; text-align:center; margin-top:20%; color:#003B73;'>Selamat datang! Kita akan memigrasikan isi file dashboard.php Anda ke kotak ini pada tahap selanjutnya.</h3>";
    })->name('dashboard.main');

    // -----------------------------------------------------------
    // NANTI LETAKKAN ROUTE BARU LAINNYA DI SINI
    // Contoh: 
    // Route::get('/kompetitor/peta', [KompetitorController::class, 'peta']);
    // Route::get('/ongkir/data', [OngkirController::class, 'index']);
    // -----------------------------------------------------------

    // Rute Profile bawaan Laravel Breeze (Biarkan saja)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';