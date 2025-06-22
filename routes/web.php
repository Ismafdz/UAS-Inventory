<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <-- Pastikan ini ada
use App\Livewire\Kategori;
use App\Livewire\Lokasi;
use App\Livewire\Barang;
use App\Livewire\Mutasi;
use App\Livewire\Penghapusan;
use App\Livewire\Laporan;
use App\Livewire\Profile;
use App\Livewire\Dashboard; // <-- 1. Tambahkan ini untuk mengimpor class Dashboard

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome');

// 2. Baris ini kita nonaktifkan/hapus
// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// 3. Ini adalah rute baru yang memanggil komponen Livewire Dashboard
Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    // Route profile yang sudah ada sebelumnya (jika ada) bisa diletakkan di sini
    // Contoh: Route::get('/profile', Profile::class)->name('profile.edit');

    // Route logout Anda sudah benar
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    // Rute aplikasi inventaris Anda (tidak ada perubahan di sini)
    Route::get('/kategori', Kategori\Index::class)->name('kategori.index');
    Route::get('/lokasi', Lokasi\Index::class)->name('lokasi.index');
    Route::get('/barang', Barang\Index::class)->name('barang.index');
    Route::get('/mutasi', Mutasi\Index::class)->name('mutasi.index');
    Route::get('/penghapusan', Penghapusan\Index::class)->name('penghapusan.index');
    Route::get('/laporan', Laporan\Index::class)->name('laporan.index');
});

// File ini menangani rute login, register, dll.
require __DIR__.'/auth.php';