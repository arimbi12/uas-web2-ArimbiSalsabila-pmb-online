<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | SIAKAD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .sidebar { width: 250px; height: 100vh; position: fixed; background: #2c3e50; color: white; padding-top: 20px; }
        .sidebar a { color: #bdc3c7; text-decoration: none; padding: 15px 25px; display: block; }
        .sidebar a:hover, .sidebar a.active { background: #34495e; color: white; border-left: 4px solid #3498db; }
        .main-content { margin-left: 250px; padding: 30px; }
        .card-box { border: none; border-radius: 10px; color: white; transition: 0.3s; }
        .card-box:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4 class="text-center mb-4 fw-bold text-white">SIAKAD ADMIN</h4>
        <a href="{{ route('dashboard') }}" class="active"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="{{ route('mahasiswa.index') }}"><i class="fas fa-user-graduate me-2"></i> Data Mahasiswa</a>
        <a href="#"><i class="fas fa-university me-2"></i> Data Jurusan</a>
        
        <div style="position: absolute; bottom: 20px; width: 100%;">
            <hr class="bg-secondary mx-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item px-4 text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout ({{ Auth::user()->name }})
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-dark">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus me-2"></i> Tambah Mahasiswa Baru
                </a>
            </div>
            
            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="card card-box bg-primary p-4 shadow">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase opacity-75">Total Mahasiswa</h6>
                                <h2 class="fw-bold mb-0">{{ $totalMahasiswa }}</h2>
                            </div>
                            <i class="fas fa-users fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-box bg-success p-4 shadow">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase opacity-75">Total Jurusan</h6>
                                <h2 class="fw-bold mb-0">{{ $totalJurusan }}</h2>
                            </div>
                            <i class="fas fa-graduation-cap fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-primary">Pendaftar Terbaru</h5>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-sm btn-outline-primary border-0">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Mahasiswa</th>
                                <th>Jurusan</th>
                                <th>Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentMahasiswa as $m)
                            <tr>
                                <td>
                                    <img src="{{ $m->foto ? asset('storage/'.$m->foto) : 'https://ui-avatars.com/api/?name='.$m->nama }}" 
                                         class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                </td>
                                <td class="fw-semibold">{{ $m->nama }}</td>
                                <td>{{ $m->jurusan->nama_jurusan ?? '-' }}</td>
                                <td>{{ $m->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>