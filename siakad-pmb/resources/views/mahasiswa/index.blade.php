<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa - SIAKAD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <style>
        body { background-color: #f8fafc; }
        .card { border: none; border-radius: 15px; }
        .table thead { background-color: #f1f5f9; }
        .img-table { width: 45px; height: 45px; object-fit: cover; border-radius: 50%; }
    </style>
</head>
<body class="py-5">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-primary">Data Mahasiswa</h5>
                <button type="button" class="btn btn-primary btn-sm" onclick="addForm()">
                    <i class="fas fa-plus me-1"></i> Tambah Mahasiswa
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Mahasiswa</th>
                                <th>NIM</th>
                                <th>Jurusan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswa as $mhs)
                            <tr id="row_{{ $mhs->id }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $mhs->foto ? asset('storage/' . $mhs->foto) : 'https://ui-avatars.com/api/?name='.urlencode($mhs->nama) }}" class="img-table me-3">
                                        <div>
                                            <div class="fw-bold">{{ $mhs->nama }}</div>
                                            <small class="text-muted">{{ $mhs->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $mhs->nim }}</td>
                                <td>{{ $mhs->jurusan->nama_jurusan ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button onclick="editForm({{ $mhs->id }})" class="btn btn-sm btn-outline-warning border-0">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMahasiswa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formAjax" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">
                <input type="hidden" name="id" id="mhs_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="modalTitle">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" id="mhs_nim" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" id="mhs_nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="mhs_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jurusan</label>
                            <select name="jurusan_id" id="mhs_jurusan" class="form-select" required>
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach($jurusans as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Aktifkan Fitur Search, Sort, Paginate Realtime
            $('#myTable').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json' }
            });
        });

        // Fungsi Buka Modal Tambah
        function addForm() {
            $('#formAjax')[0].reset();
            $('#methodField').val('POST');
            $('#mhs_id').val('');
            $('#modalTitle').text('Tambah Mahasiswa Baru');
            $('#modalMahasiswa').modal('show');
        }

        // Fungsi Buka Modal Edit (Ambil data via AJAX)
        function editForm(id) {
            $.get('/mahasiswa/' + id, function(data) {
                $('#modalTitle').text('Edit Data Mahasiswa');
                $('#methodField').val('PATCH');
                $('#mhs_id').val(data.id);
                $('#mhs_nim').val(data.nim);
                $('#mhs_nama').val(data.nama);
                $('#mhs_email').val(data.email);
                $('#mhs_jurusan').val(data.jurusan_id);
                $('#modalMahasiswa').modal('show');
            });
        }

        // Proses Simpan/Update via AJAX
        $('#formAjax').on('submit', function(e) {
            e.preventDefault();
            let id = $('#mhs_id').val();
            let url = id ? '/mahasiswa/' + id : "{{ route('mahasiswa.store') }}";
            
            $.ajax({
                url: url,
                type: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#modalMahasiswa').modal('hide');
                    Swal.fire('Berhasil!', 'Data telah disimpan.', 'success').then(() => {
                        location.reload(); 
                    });
                },
                error: function() {
                    Swal.fire('Eror!', 'Gagal menyimpan data. Cek NIM atau koneksi.', 'error');
                }
            });
        });
    </script>
</body>
</html>