<!DOCTYPE html>
<html lang="id">
<head>
    <title>Form Transaksi Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/kelola_user.css') }}" rel="stylesheet">
    <style>
        .keranjang-table th, .keranjang-table td { vertical-align: middle; }
        .keranjang-table .btn { padding: 2px 10px; font-size: 0.95rem; }
    </style>
</head>
<body>
    {{-- ALERT ELEGAN --}}
    @if(session('success'))
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
        <img src="{{ asset('kasir.jpeg') }}" alt="kasir Icon" style="width:80px; height:80px; border-radius:50%; object-fit:cover;">
    </div>
    <h4>Kasir</h4>
    <a href="{{ route('kasir.transaksi') }}" class="btn btn-primary mb-2 w-100">Kelola Barang</a>
    <form method="POST" action="{{ route('logout') }}" class="w-100">
        @csrf
        <button type="submit" class="btn btn-danger w-100">Logout</button>
    </form>
</div>
        <!-- Content -->
        <div class="col-lg-9 col-md-8 content-area">
            <div class="card p-4">
                <div class="card-header mb-3">
                    Form Transaksi
                </div>
                {{-- Form tambah ke keranjang --}}
                <form id="formTambahKeranjang" method="POST" action="{{ route('kasir.keranjang.tambah') }}" class="mb-3">
                    @csrf
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Nama Kasir</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->nama ?? '' }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No Transaksi</label>
                            <input type="text" name="no_transaksi" class="form-control" value="{{ $no_transaksi }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Transaksi</label>
                            <input type="date" name="tgl_transaksi" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                        </div>
                    </div>
                    <div class="row g-3 mb-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Pilih Barang</label>
                            <select name="id_barang" id="barangSelect" class="form-select" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $barang)
                                <option value="{{ $barang->id_barang }}" data-harga="{{ $barang->harga_satuan }}">
                                    {{ $barang->kode_barang }} - {{ $barang->nama_barang }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Quantitas</label>
                            <input type="number" name="qty" id="qtyInput" class="form-control" min="1" value="1" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Harga Satuan</label>
                            <input type="text" id="hargaSatuanInput" class="form-control" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Total Harga</label>
                            <input type="text" id="totalHargaInput" class="form-control" readonly>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-success">Tambah</button>
                            <a href="{{ route('kasir.keranjang.reset') }}" class="btn btn-warning">Reset</a>
                        </div>
                    </div>
                </form>
                {{-- Table Keranjang --}}
                <div class="table-responsive mb-3">
                    <table class="table table-bordered keranjang-table">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga Satuan</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @forelse($keranjang ?? [] as $i => $item)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $item['kode_barang'] }}</td>
                                    <td>{{ $item['nama_barang'] }}</td>
                                    <td>Rp {{ number_format($item['harga_satuan'],0,',','.') }}</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td>Rp {{ number_format($item['subtotal'],0,',','.') }}</td>
                                </tr>
                                @php $total += $item['subtotal']; @endphp
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Keranjang kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-end">Total Harga</th>
                                <th>Rp {{ number_format($total,0,',','.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                {{-- Form Bayar & Simpan --}}
                <form method="POST" action="{{ route('kasir.transaksi.simpan') }}">
                    @csrf
                    <input type="hidden" name="no_transaksi" value="{{ $no_transaksi }}">
                    <input type="hidden" name="tgl_transaksi" value="{{ date('Y-m-d') }}">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Bayar</label>
                            <input type="number" name="bayar" id="bayarInput" class="form-control" min="{{ $total }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kembalian</label>
                            <input type="text" id="kembalianInput" class="form-control" readonly>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            <button type="button" class="btn btn-secondary" onclick="window.print()">Print</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Update harga satuan dan total harga saat pilih barang/qty
    const barangSelect = document.getElementById('barangSelect');
    const qtyInput = document.getElementById('qtyInput');
    const hargaSatuanInput = document.getElementById('hargaSatuanInput');
    const totalHargaInput = document.getElementById('totalHargaInput');

    function updateHarga() {
        const selected = barangSelect.options[barangSelect.selectedIndex];
        const harga = selected ? parseInt(selected.getAttribute('data-harga')) : 0;
        const qty = parseInt(qtyInput.value) || 1;
        hargaSatuanInput.value = harga;
        totalHargaInput.value = harga * qty;
    }
    if(barangSelect) barangSelect.addEventListener('change', updateHarga);
    if(qtyInput) qtyInput.addEventListener('input', updateHarga);

    // Hitung kembalian otomatis
    const bayarInput = document.getElementById('bayarInput');
    const kembalianInput = document.getElementById('kembalianInput');
    if(bayarInput && kembalianInput) {
        bayarInput.addEventListener('input', function() {
            const total = {{ $total }};
            const bayar = parseInt(this.value) || 0;
            kembalianInput.value = bayar > 0 ? (bayar - total) : '';
        });
    }

    // Alert animasi auto-close
    document.addEventListener('DOMContentLoaded', function () {
        const alertBox = document.getElementById('customAlert');
        if (alertBox) {
            setTimeout(() => {
                alertBox.classList.add('hide');
                setTimeout(() => alertBox.remove(), 600);
            }, 2200);
        }
    });
</script>
</body>
</html>