<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Kelola Pengguna Persib Food Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0f2f7, #c6e7f2); /* Latar belakang gradien biru muda */
        }
        .sidebar {
            min-height: 100vh;
            background: #0066CC; /* Biru Persib */
            padding: 40px 20px 20px 20px;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
            color: #fff; /* Teks putih untuk sidebar */
        }
        .sidebar .admin-avatar {
            width: 90px;
            height: 90px;
            background: #ffffff; /* Aksen Emas/Kuning */
            border-radius: 50%;
            margin: 0 auto 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #0066CC; /* Ikon Biru Persib */
            border: 3px solid #005BB5; /* Border biru sedikit lebih gelap */
        }
        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #fff; /* Teks putih untuk nama admin */
        }
        .sidebar .btn {
            width: 100%;
            margin-bottom: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .sidebar .btn-outline-primary {
            color: #fff;
            border-color: #fff;
        }
        .sidebar .btn-outline-primary:hover {
            background-color: #fff;
            color: #0066CC;
        }
        .sidebar .btn-primary {
            background-color: #ffffff; /* Tombol aktif Emas/Kuning */
            border-color: #FFD700;
            color: #0066CC; /* Teks Biru Persib pada tombol aktif */
        }
        .sidebar .btn-primary:hover {
            background-color: #e6c200; /* Emas/kuning lebih gelap saat hover */
            border-color: #e6c200;
        }
        .sidebar .btn-danger {
            background-color: #dc3545; /* Merah standar untuk logout */
            border-color: #dc3545;
        }
        .sidebar .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .content-area {
            padding: 40px 30px;
            color: #333; /* Teks lebih gelap untuk konten */
        }
        .card {
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1); /* Bayangan lebih kuat untuk kedalaman */
            border: none;
        }
        .card-header {
            background-color: #0066CC; /* Header Biru Persib */
            color: #fff;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            padding: 20px;
            font-weight: 600;
            font-size: 1.5rem;
        }
        .form-label {
            font-weight: 500;
            color: #333;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 10px 15px;
        }
        .btn-success {
            background-color: #28a745; /* Hijau standar */
            border-color: #28a745;
            font-weight: 500;
            border-radius: 8px;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-warning {
            background-color: #ffc107; /* Kuning standar */
            border-color: #ffc107;
            color: #333; /* Teks gelap pada tombol kuning */
            font-weight: 500;
            border-radius: 8px;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-danger {
            background-color: #dc3545; /* Merah standar */
            border-color: #dc3545;
            font-weight: 500;
            border-radius: 8px;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .search-box {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 10px;
            background-color: #f0f8ff; /* Latar belakang biru muda untuk kotak cari */
            border: 1px solid #cfe2ff;
        }
        .table {
            --bs-table-striped-bg: #f5fafd; /* Garis zebra lebih terang untuk tabel */
            --bs-table-hover-bg: #e6f3fb; /* Biru muda saat hover */
        }
        .table th, .table td {
            vertical-align: middle;
            padding: 12px 15px;
            border-color: #dee2e6; /* Border lebih terang untuk sel tabel */
        }
        .table thead.table-light th {
            background-color: #005BB5; /* Biru Persib lebih gelap untuk header tabel */
            color: #fff;
            border-bottom: 2px solid #004a99;
        }
        .text-muted {
            color: #6c757d !important;
        }

        @media (max-width: 991px) {
            .sidebar { min-height: auto; padding-bottom: 20px; }
            .content-area { padding: 20px 15px; }
            .sidebar .btn { margin-bottom: 10px; }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-4 sidebar d-flex flex-column align-items-center">
            <div class="admin-avatar mb-3">
                    <img src="{{ asset('iconadmin.webp') }}" alt="Admin Icon"
                        style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;">
                </div>
            <h4>Admin</h4>
            <a href="{{ route('admin.log') }}" class="btn btn-outline-primary mb-2 w-100">Log Aktivitas</a>
            <a href="{{ route('kelola.laporan') }}" class="btn btn-outline-primary mb-2 w-100">Kelola Laporan</a>
            <a href="{{ route('kelola.user') }}" class="btn btn-primary mb-2 w-100">Kelola Pengguna</a>
            <form method="POST" action="{{ route('logout') }}" class="w-100">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Keluar</button>
            </form>
        </div>
        <div class="col-lg-9 col-md-8 content-area">
            <div class="card">
                <div class="card-header">
                    Kelola Pengguna
                </div>
                <div class="card-body p-4">
                    <form id="userForm" method="POST" action="{{ route('kelola.user.simpan') }}">
                        @csrf
                        <input type="hidden" name="id_user" id="id_user">
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Tipe Pengguna</label>
                                <select name="tipe_user" class="form-select" required>
                                    <option value="">Pilih</option>
                                    <option value="Gudang" {{ old('tipe_user')=='Gudang' ? 'selected' : '' }}>Gudang</option>
                                    <option value="Kasir" {{ old('tipe_user')=='Kasir' ? 'selected' : '' }}>Kasir</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Telepon</label>
                                <input type="text" name="telpon" class="form-control" value="{{ old('telpon') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" {{ isset($editUser) ? '' : 'required' }}>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success me-2" id="btnTambah">Tambah</button>
                            <button type="button" class="btn btn-warning me-2" id="btnEdit" disabled>Edit</button>
                            <button type="button" class="btn btn-danger" id="btnHapus" disabled>Hapus</button>
                        </div>
                    </form>
                    <form method="GET" class="search-box">
                        <input type="text" name="cari" class="form-control" placeholder="Cari pengguna..." value="{{ request('cari') }}">
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mt-2">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Tipe Pengguna</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Username</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id_user }}</td>
                                    <td>{{ $user->tipe_user }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->alamat }}</td>
                                    <td>{{ $user->telpon }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning btnEditUser"
                                            data-id="{{ $user->id_user }}"
                                            data-tipe_user="{{ $user->tipe_user }}"
                                            data-nama="{{ $user->nama }}"
                                            data-alamat="{{ $user->alamat }}"
                                            data-telpon="{{ $user->telpon }}"
                                            data-username="{{ $user->username }}"
                                            >Edit</button>
                                        <form action="{{ route('kelola.user.hapus', $user->id_user) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus pengguna ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Tidak ada data pengguna.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Isi form saat klik Edit
    document.querySelectorAll('.btnEditUser').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('id_user').value = this.dataset.id;
            document.querySelector('select[name=tipe_user]').value = this.dataset.tipe_user;
            document.querySelector('input[name=nama]').value = this.dataset.nama;
            document.querySelector('input[name=alamat]').value = this.dataset.alamat;
            document.querySelector('input[name=telpon]').value = this.dataset.telpon;
            document.querySelector('input[name=username]').value = this.dataset.username;
            document.querySelector('input[name=password]').value = ''; // Kosongkan password untuk input baru
            document.getElementById('userForm').action = "{{ route('kelola.user.update') }}"; // Arahkan ke rute update
            document.getElementById('btnTambah').disabled = true;
            document.getElementById('btnEdit').disabled = false;
            document.getElementById('btnHapus').disabled = false;
        });
    });
    
    // Reset form saat tombol "Tambah" di-klik (sebelum submit)
    // Ini untuk memastikan form bersih jika pengguna sebelumnya mengklik edit
    document.getElementById('btnTambah').addEventListener('click', function() {
        // Pastikan ini hanya mengatur ulang UI, submit form akan dilakukan secara otomatis oleh tag <form>
        document.getElementById('userForm').reset(); // Reset semua input form
        document.getElementById('id_user').value = ''; // Pastikan ID tersembunyi kosong
        document.getElementById('userForm').action = "{{ route('kelola.user.simpan') }}"; // Arahkan kembali ke rute simpan
        document.getElementById('btnTambah').disabled = false;
        document.getElementById('btnEdit').disabled = true;
        document.getElementById('btnHapus').disabled = true;
        document.querySelector('input[name=password]').setAttribute('required', 'required'); // Pastikan password kembali wajib diisi
    });

    // Saat klik tombol Edit di form
    document.getElementById('btnEdit').addEventListener('click', function() {
        document.getElementById('userForm').submit();
    });

    // Saat klik tombol Hapus di form
    // Perlu disinkronkan dengan tombol hapus di tabel jika ingin fungsionalitas yang sama
    // Namun, tombol hapus di tabel sudah punya form sendiri, jadi ini bisa dipertimbangkan ulang
    document.getElementById('btnHapus').addEventListener('click', function() {
        const idUser = document.getElementById('id_user').value;
        if (idUser && confirm('Yakin hapus pengguna ini?')) {
            // Buat form dinamis untuk request DELETE
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ url('admin/kelola-user') }}/${idUser}`; // Sesuaikan dengan rute hapus Anda
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit();
        }
    });

    // Reset form dan tombol saat halaman dimuat atau setelah submit
    document.addEventListener('DOMContentLoaded', (event) => {
        // Periksa apakah ada ID user di hidden input, jika ada berarti ini mode edit dari request sebelumnya
        const idUserHidden = document.getElementById('id_user').value;
        if (!idUserHidden) {
            document.getElementById('btnEdit').disabled = true;
            document.getElementById('btnHapus').disabled = true;
        } else {
            // Jika ada ID, mungkin dari old() input, biarkan tombol edit/hapus aktif
            document.getElementById('btnTambah').disabled = true;
            document.getElementById('btnEdit').disabled = false;
            document.getElementById('btnHapus').disabled = false;
        }
    });

</script>
</body>
</html>