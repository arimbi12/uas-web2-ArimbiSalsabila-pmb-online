<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Baris ini yang akan mengisi pilihan di dropdown kamu
        Jurusan::create(['nama_jurusan' => 'Informatika', 'kode_jurusan' => 'IF']);
        Jurusan::create(['nama_jurusan' => 'Sistem Informasi', 'kode_jurusan' => 'SI']);
        Jurusan::create(['nama_jurusan' => 'Teknik Komputer', 'kode_jurusan' => 'TK']);
    }
}