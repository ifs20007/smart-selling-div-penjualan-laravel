<?php

use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\KategoriKompetitorController;
use App\Http\Controllers\KategoriTokoController;
use App\Http\Controllers\KompetitorController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RajaOngkirTestController;
use Illuminate\Support\Facades\Route;

// AREA PUBLIK (Bisa diakses tanpa login)
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/api/wilayah/{provinsi_id}', [FrontController::class, 'getWilayah']);

// AREA ADMIN (Wajib Login)
Route::middleware(['auth', 'verified'])->group(function () {

    // Kerangka Dashboard Admin (Sidebar & Navbar)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/main', function () {
        return "<h3 style='font-family:sans-serif; text-align:center; margin-top:20%; color:#003B73;'>Selamat datang! Kita akan memigrasikan isi file dashboard.php Anda ke kotak ini pada tahap selanjutnya.</h3>";
    })->name('dashboard.main');

    // -----------------------------------------------------------
    // ROUTE UNTUK PEGAWAI / ADMIN
    // -----------------------------------------------------------
    // Route resource otomatis menangani index, create, store, edit, update, destroy
    Route::resource('pegawai', PegawaiController::class)->except(['show']);

    Route::put('/pegawai/{id}/reset-password', [PegawaiController::class, 'forceResetPassword'])->name('pegawai.reset-password');

    // Route khusus Admin untuk mereset paksa password pegawai (Bypass Email)
    Route::post('/pegawai/{id}/reset-password', [PegawaiController::class, 'forceResetPassword'])->name('pegawai.force-reset');

    // Rute Profile bawaan Laravel Breeze (Biarkan saja)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk Daftar Kompetitor
    Route::resource('kategori-kompetitor', KategoriKompetitorController::class);
    Route::resource('kompetitor', KompetitorController::class);

    // Rute untuk CRM & Mitra
    Route::resource('kategori-toko', KategoriTokoController::class);
    Route::get('/daftar-toko/export', [CustomerController::class, 'export'])->name('daftar-toko.export');
    Route::post('/daftar-toko/import', [CustomerController::class, 'import'])->name('daftar-toko.import');
    Route::resource('daftar-toko', CustomerController::class);

    // Rute untuk Cek Ongkir
    // Rute untuk Master Data Ongkir (Admin)
    Route::get('/data-ongkir/export', [OngkirController::class, 'export'])->name('data-ongkir.export');
    Route::resource('data-ongkir', OngkirController::class);

    // Rute untuk Komparasi Cek Ongkir (Pegawai & Admin)
    Route::get('/cek-ongkir', [OngkirController::class, 'komparasi'])->name('cek-ongkir.komparasi');
    Route::post('/cek-ongkir', [OngkirController::class, 'hitungKomparasi'])->name('cek-ongkir.hitung');

    // Rute untuk Forum Aktivitas Pegawai
    Route::resource('forum', ForumController::class);
    Route::post('forum/{forum}/komentar', [ForumController::class, 'storeKomentar'])->name('forum.komentar.store');

    // Rute untuk Broadcast SMS/WA
    Route::resource('broadcast', BroadcastController::class)->only(['index', 'create', 'store']);
});

Route::post('/api/webhook/whatsapp', [BroadcastController::class, 'webhook'])->name('webhook.whatsapp');

// [SANDBOX] RajaOngkir Test - Hapus blok ini jika tidak digunakan
Route::prefix('rajaongkir-sandbox')->name('rajaongkir.sandbox.')->group(function () {
    Route::get('/', [RajaOngkirTestController::class, 'index'])->name('index');
    Route::get('/search', [RajaOngkirTestController::class, 'search'])->name('search');
    Route::post('/calculate', [RajaOngkirTestController::class, 'calculate'])->name('calculate');
});

require __DIR__.'/auth.php';
