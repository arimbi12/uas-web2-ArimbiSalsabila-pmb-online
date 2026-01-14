<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        Jurusan::create(['nama_jurusan' => 'Informatika', 'kode_jurusan' => 'IF']);
        Jurusan::create(['nama_jurusan' => 'Sistem Informasi', 'kode_jurusan' => 'SI']);
        Jurusan::create(['nama_jurusan' => 'Teknik Komputer', 'kode_jurusan' => 'TK']);
    }
}