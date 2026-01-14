<?php


use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/buat-admin', function () {
    User::truncate(); // Hapus semua user lama
    User::create([
        'name' => 'Admin Siakad',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('admin123'),
    ]);
    return "User Admin Berhasil Dibuat! Email: admin@gmail.com | Password: admin123";
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

// Halaman depan ke login
Route::get('/', function () {
    return view('auth.login');
});

// Semua yang di dalam ini wajib LOGIN
Route::middleware(['auth'])->group(function () {
    
    // Ini rute ke dashboard admin kamu
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Ini rute untuk mahasiswa
    Route::resource('mahasiswa', MahasiswaController::class);
    
});

require __DIR__.'/auth.php';