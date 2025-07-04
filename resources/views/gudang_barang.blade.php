<!DOCTYPE html>
<html lang="id">

<head>
    <title>Kelola Barang - Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/kelola_user.css') }}" rel="stylesheet">
</head>

<body>
    {{-- ALERT ELEGAN --}}
    @if (session('success'))
        <div id="customAlert" class="custom-alert custom-alert-success">
            <div class="custom-alert-content">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @elseif(session('error'))
        <div id="customAlert" class="custom-alert custom-alert-danger">
            <div class="custom-alert-content">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 col-md-4 sidebar d-flex flex-column align-items-center">
                <div class="admin-avatar mb-3">
                    <img src="{{ asset('gudang.jpeg') }}" alt="Gudang Icon"
                        style="width:80px; height:80px; border-radius:50%; object-fit:cover;">
                </div>
                <h4>GUDANG</h4>
                <a href="{{ route('gudang.barang') }}" class="btn btn-primary mb-2 w-100">Kelola Barang</a>
                <form method="POST" action="{{ route('logout') }}" class="w-100">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Logout</button>
                </form>
            </div>
            <!-- Content -->
            <div class="col-lg-9 col-md-8 content-area">
                <div class="card p-4">
                    <h3 class="mb-4 fw-bold">Kelola Barang</h3>
                    <!-- Form Barang -->
                    <form id="barangForm" method="POST" action="{{ route('gudang.barang.simpan') }}">
                        @csrf
                        <input type="hidden" name="id_barang" id="id_barang">
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Jumlah Barang</label>
                                <input type="number" name="jumlah_barang" class="form-control" min="1" required>
                                <div class="form-text text-danger" id="jumlahBarangError" style="display:none;">Jumlah
                                    barang harus lebih dari 0</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Satuan</label>
                                <input type="text" name="satuan" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Expired Date</label>
                                <input type="date" name="expired_date" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Harga Per Satuan</label>
                                <input type="number" name="harga_satuan" class="form-control" min="1" required>
                                <div class="form-text text-danger" id="hargaSatuanError" style="display:none;">Harga
                                    harus lebih dari 0</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success me-2" id="btnTambah">Tambah</button>
                            <button type="button" class="btn btn-warning me-2" id="btnEdit" disabled>Edit</button>
                            <button type="button" class="btn btn-danger" id="btnHapus" disabled>Hapus</button>
                        </div>
                    </form>
                    <!-- Search -->
                    <form method="GET" class="search-box">
                        <input type="text" name="cari" class="form-control" placeholder="Cari nama barang..."
                            value="{{ request('cari') }}">
                    </form>
                    <!-- Table Barang -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mt-2" id="barangTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Expired Date</th>
                                    <th>Harga Satuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($barangs as $barang)
                                    <tr
                                        data-id="{{ $barang->id_barang }}"
                                        data-kode_barang="{{ $barang->kode_barang }}"
                                        data-nama_barang="{{ $barang->nama_barang }}"
                                        data-jumlah_barang="{{ $barang->jumlah_barang }}"
                                        data-satuan="{{ $barang->satuan }}"
                                        data-expired_date="{{ $barang->expired_date }}"
                                        data-harga_satuan="{{ $barang->harga_satuan }}"
                                    >
                                        <td>{{ $barang->kode_barang }}</td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td>{{ $barang->jumlah_barang }}</td>
                                        <td>{{ $barang->satuan }}</td>
                                        <td>{{ $barang->expired_date }}</td>
                                        <td>Rp. {{ number_format($barang->harga_satuan, 0, ',', '.') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning btnEditBarang"
                                                data-id="{{ $barang->id_barang }}"
                                                data-kode_barang="{{ $barang->kode_barang }}"
                                                data-nama_barang="{{ $barang->nama_barang }}"
                                                data-jumlah_barang="{{ $barang->jumlah_barang }}"
                                                data-satuan="{{ $barang->satuan }}"
                                                data-expired_date="{{ $barang->expired_date }}"
                                                data-harga_satuan="{{ $barang->harga_satuan }}">Edit</button>
                                            <form action="{{ route('gudang.barang.hapus', $barang->id_barang) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin hapus barang ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Tidak ada data barang.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validasi jumlah barang dan harga satuan
        document.getElementById('barangForm').addEventListener('submit', function(e) {
            let valid = true;
            let jumlah = document.querySelector('input[name=jumlah_barang]');
            let harga = document.querySelector('input[name=harga_satuan]');
            document.getElementById('jumlahBarangError').style.display = 'none';
            document.getElementById('hargaSatuanError').style.display = 'none';
            if (jumlah.value <= 0) {
                document.getElementById('jumlahBarangError').style.display = 'block';
                valid = false;
            }
            if (harga.value <= 0) {
                document.getElementById('hargaSatuanError').style.display = 'block';
                valid = false;
            }
            if (!valid) e.preventDefault();
        });

        // Isi form saat klik Edit
        document.querySelectorAll('.btnEditBarang').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('id_barang').value = this.dataset.id;
                document.querySelector('input[name=kode_barang]').value = this.dataset.kode_barang;
                document.querySelector('input[name=nama_barang]').value = this.dataset.nama_barang;
                document.querySelector('input[name=jumlah_barang]').value = this.dataset.jumlah_barang;
                document.querySelector('input[name=satuan]').value = this.dataset.satuan;
                document.querySelector('input[name=expired_date]').value = this.dataset.expired_date;
                document.querySelector('input[name=harga_satuan]').value = this.dataset.harga_satuan;
                document.getElementById('barangForm').action = "{{ route('gudang.barang.update') }}";
                document.getElementById('btnTambah').disabled = true;
                document.getElementById('btnEdit').disabled = false;
                document.getElementById('btnHapus').disabled = false;
            });
        });
        // Reset form saat tambah
        document.getElementById('btnTambah').addEventListener('click', function() {
            document.getElementById('barangForm').action = "{{ route('gudang.barang.simpan') }}";
            document.getElementById('id_barang').value = '';
            document.getElementById('btnTambah').disabled = false;
            document.getElementById('btnEdit').disabled = true;
            document.getElementById('btnHapus').disabled = true;
        });
        // Saat klik tombol Edit di form
        document.getElementById('btnEdit').addEventListener('click', function() {
            document.getElementById('barangForm').submit();
        });

        // Alert animasi auto-close
        document.addEventListener('DOMContentLoaded', function() {
            const alertBox = document.getElementById('customAlert');
            if (alertBox) {
                setTimeout(() => {
                    alertBox.classList.add('hide');
                    setTimeout(() => alertBox.remove(), 600);
                }, 2200);
            }
        });

        // Klik baris tabel langsung isi form (seperti klik tombol Edit)
        document.querySelectorAll('#barangTable tbody tr').forEach(row => {
            row.addEventListener('click', function(e) {
                // Jangan trigger kalau yang diklik adalah tombol Hapus
                if (e.target.classList.contains('btn-danger')) return;
                // Isi form dengan data dari atribut baris
                document.getElementById('id_barang').value = this.dataset.id;
                document.querySelector('input[name=kode_barang]').value = this.dataset.kode_barang;
                document.querySelector('input[name=nama_barang]').value = this.dataset.nama_barang;
                document.querySelector('input[name=jumlah_barang]').value = this.dataset.jumlah_barang;
                document.querySelector('input[name=satuan]').value = this.dataset.satuan;
                document.querySelector('input[name=expired_date]').value = this.dataset.expired_date;
                document.querySelector('input[name=harga_satuan]').value = this.dataset.harga_satuan;
                document.getElementById('barangForm').action = "{{ route('gudang.barang.update') }}";
                document.getElementById('btnTambah').disabled = true;
                document.getElementById('btnEdit').disabled = false;
                document.getElementById('btnHapus').disabled = false;
            });
        });
    </script>
</body>

</html>
