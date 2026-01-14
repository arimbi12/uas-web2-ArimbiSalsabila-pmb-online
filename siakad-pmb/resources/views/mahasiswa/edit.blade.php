<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa - SIAKAD</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .container-form {
            max-width: 600px;
            margin-top: 60px;
        }
        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .card-header-custom {
            background: #ffffff;
            border-bottom: 1px solid #edf2f7;
            padding: 30px;
            border-radius: 20px 20px 0 0 !important;
        }
        .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #4a5568;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            font-size: 14px;
        }
        .btn-update {
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            background-color: #ffc107;
            color: #000;
            border: none;
            transition: all 0.3s;
        }
        .btn-update:hover {
            background-color: #e0a800;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
        }
        .btn-back {
            color: #718096;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #a0aec0;
        }
        .form-control-with-icon {
            border-left: none;
        }
    </style>
</head>
<body>

<div class="container container-form mb-5">
    <div class="mb-4 text-start">
        <a href="{{ route('mahasiswa.index') }}" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
        </a>
    </div>

    <div class="card card-custom">
        <div class="card-header-custom text-center">
            <h4 class="fw-bold mb-1 text-dark">Edit Data Mahasiswa</h4>
            <p class="text-muted small mb-0">Pastikan data yang diubah sudah benar</p>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf 
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Nomor Induk Mahasiswa (NIM)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" name="nim" value="{{ $mahasiswa->nim }}" class="form-control form-control-with-icon" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="nama" value="{{ $mahasiswa->nama }}" class="form-control form-control-with-icon" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" value="{{ $mahasiswa->email }}" class="form-control form-control-with-icon" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Program Studi / Jurusan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                        <select name="jurusan_id" class="form-select form-control-with-icon" required>
                            @foreach($jurusans as $j)
                                <option value="{{ $j->id }}" {{ $mahasiswa->jurusan_id == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-warning btn-update">
                        <i class="fas fa-sync-alt me-2"></i>Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>