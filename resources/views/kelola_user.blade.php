<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Kelola Pengguna Persib Food Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="{{ asset('css/kelola_user.css') }}" rel="stylesheet">
</head>

<body>
    @if(session('success_add') || session('success_edit') || session('success_delete') || session('error'))
        <div id="customAlert" class="custom-alert 
            @if(session('success_add')) custom-alert-success
            @elseif(session('success_edit')) custom-alert-warning
            @elseif(session('success_delete') || session('error')) custom-alert-danger
            @endif
        ">
            <div class="custom-alert-content">
                @if(session('success_add'))
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success_add') }}</span>
                @elseif(session('success_edit'))
                    <i class="bi bi-pencil-square"></i>
                    <span>{{ session('success_edit') }}</span>
                @elseif(session('success_delete'))
                    <i class="bi bi-x-circle-fill"></i>
                    <span>{{ session('success_delete') }}</span>
                @elseif(session('error'))
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <span>{{ session('error') }}</span>
                @endif
            </div>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-4 sidebar d-flex flex-column align-items-center">
                <div class="admin-avatar mb-3">
                    <img src="{{ asset('admin.jpeg') }}" alt="Admin Icon"
                        style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;">
                </div>
                <h4>Admin</h4>
                <a href="{{ route('kelola.user') }}"
                    class="btn {{ Request::routeIs('kelola.user') ? 'btn-primary' : 'btn-outline-primary' }} mb-2 w-100">
                    Kelola Pengguna
                </a>
                <a href="{{ route('kelola.laporan') }}"
                    class="btn {{ Request::routeIs('kelola.laporan') ? 'btn-primary' : 'btn-outline-primary' }} mb-2 w-100">
                    Kelola Laporan
                </a>
                <a href="{{ route('admin.log') }}"
                    class="btn {{ Request::routeIs('admin.log') ? 'btn-primary' : 'btn-outline-primary' }} mb-2 w-100">
                    Log Aktivitas
                </a>
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
                            <input type="hidden" name="mode" id="mode" value="tambah">
                            <div class="row g-3 mb-3">
                                <div class="col-md-3">
                                    <label class="form-label">Tipe Pengguna</label>
                                    <select name="tipe_user" class="form-select" required>
                                        <option value="">Pilih</option>
                                        <option value="Gudang" {{ old('tipe_user') == 'Gudang' ? 'selected' : '' }}>
                                            Gudang
                                        </option>
                                        <option value="Kasir" {{ old('tipe_user') == 'Kasir' ? 'selected' : '' }}>
                                            Kasir
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control"
                                        value="{{ old('nama') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Telepon</label>
                                    <input type="text" name="telpon" class="form-control"
                                        value="{{ old('telpon') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" name="alamat" class="form-control"
                                        value="{{ old('alamat') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control"
                                        value="{{ old('username') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control"
                                        {{ isset($editUser) ? '' : 'required' }}>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success me-2" id="btnTambah">Tambah</button>
                                <button type="button" class="btn btn-warning me-2" id="btnEdit"
                                    disabled>Edit</button>
                                <button type="button" class="btn btn-danger" id="btnHapus" disabled>Hapus</button>
                            </div>
                        </form>
                        <form method="GET" class="search-box" onsubmit="return false;">
                            <input type="text" id="searchUser" class="form-control" placeholder="Cari pengguna...">
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mt-2" id="userTable">
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
                                                    data-password="{{ $user->password }}">Edit</button>
                                                <form action="{{ route('kelola.user.hapus', $user->id_user) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin hapus pengguna ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Tidak ada data pengguna.
                                            </td>
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
<script src="{{ asset('js/kelola_user.js') }}"></script>
</body>

</html>
