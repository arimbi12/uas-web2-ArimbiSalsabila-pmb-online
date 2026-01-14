<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    // 1. Menampilkan Semua Data (Sudah ditambah $jurusans agar tidak error)
    public function index()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();
        $jurusans = Jurusan::all(); // Tambahkan ini agar Modal Tambah/Edit tidak error
        return view('mahasiswa.index', compact('mahasiswa', 'jurusans'));
    }

    // 2. Menampilkan Data Tunggal untuk AJAX Edit (PENTING untuk fitur Upgrade)
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return response()->json($mahasiswa);
    }

    // 3. Menampilkan Form Tambah (Tetap ada buat jaga-jaga)
    public function create()
    {
        $jurusans = Jurusan::all();
        return view('mahasiswa.create', compact('jurusans'));
    }

    // 4. Menyimpan Data Baru (Bisa untuk Form Biasa maupun AJAX)
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'nama' => 'required',
            'email' => 'required|email',
            'jurusan_id' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-mahasiswa', 'public');
        }

        Mahasiswa::create($data);

        // Jika request dari AJAX, kirim respon JSON
        if ($request->ajax()) {
            return response()->json(['success' => 'Data berhasil disimpan']);
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    // 5. Update Data (PENTING untuk fitur Edit AJAX)
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,' . $id,
            'nama' => 'required',
            'email' => 'required|email',
            'jurusan_id' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($mahasiswa->foto) {
                Storage::disk('public')->delete($mahasiswa->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-mahasiswa', 'public');
        }

        $mahasiswa->update($data);

        return response()->json(['success' => 'Data berhasil diupdate']);
    }

    // 6. MENGHAPUS DATA
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        if ($mahasiswa->foto) {
            Storage::disk('public')->delete($mahasiswa->foto);
        }

        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}