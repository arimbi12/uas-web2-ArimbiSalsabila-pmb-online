<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah data asli dari database
        $totalMahasiswa = Mahasiswa::count();
        $totalJurusan = Jurusan::count();
        $recentMahasiswa = Mahasiswa::with('jurusan')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalMahasiswa', 'totalJurusan', 'recentMahasiswa'));
    }
}