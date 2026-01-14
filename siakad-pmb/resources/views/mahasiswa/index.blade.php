<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="fw-bold mb-0">Data Mahasiswa</h5>
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm">Tambah Baru</a>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Mahasiswa</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswa as $mhs)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($mhs->foto)
                                        <img src="{{ asset('storage/' . $mhs->foto) }}" class="rounded-circle me-3" style="width: 45px; height: 45px; object-fit: cover;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($mhs->nama) }}" class="rounded-circle me-3" style="width: 45px;">
                                    @endif
                                    <div>
                                        <div class="fw-bold">{{ $mhs->nama }}</div>
                                        <small class="text-muted">{{ $mhs->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->jurusan->nama_jurusan ?? '-' }}</td>
                            <td class="text-center">
                                <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>