<!-- filepath: resources/views/kasir_transaksi.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Form Transaksi Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background: #e3f0ff;
            padding: 40px 20px 20px 20px;
            box-shadow: 2px 0 8px rgba(0,0,0,0.03);
        }
        .sidebar .kasir-icon {
            width: 90px; height: 90px; background: #fff; border-radius: 50%;
            margin: 0 auto 20px auto; display: flex; align-items: center; justify-content: center;
            font-size: 48px; color: #0d6efd; border: 3px solid #0d6efd;
        }
        .sidebar h4 { text-align: center; margin-bottom: 30px; font-weight: bold; }
        .sidebar .btn { width: 100%; margin-bottom: 15px; font-weight: 500; }
        .content-area { padding: 40px 30px; }
        .card { border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); }
        .form-label { font-weight: 500; }
        .table th, .table td { vertical-align: middle; }
        @media (max-width: 991px) {
            .sidebar { min-height: auto; }
            .content-area { padding: 20px 5px; }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 col-md-4 sidebar d-flex flex-column align-items-center">
            <div class="kasir-icon mb-3">
                <i class="bi bi-person-badge"></i>
            </div>
            <h4>KASIR</h4>
            <a href="{{ route('kasir.transaksi') }}" class="btn btn-primary mb-2 w-100">Kelola Transaksi</a>
            <form method="POST" action="{{ route('logout') }}" class="w-100">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Logout</button>
            </form>
        </div>
        <!-- Content -->
        <div class="col-lg-9 col-md-8 content-area">
            <div class="card p-4">
                <h3 class="mb-4 fw-bold">Form Transaksi</h3>
                <form id="transaksiForm" method="POST" action="{{ route('kasir.transaksi.simpan') }}">
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
                            <input type="date" name="tgl_transaksi" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="row g-3 mb-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Pilih Barang</label>
                            <select name="id_barang" id="barangSelect" class="form-select" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $barang)
                                <option value="{{ $barang->id_barang }}"
                                    data-harga="{{ $barang->harga_satuan }}"
                                >{{ $barang->kode_barang }} - {{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Quantitas</label>
                            <input type="number" id="qtyInput" class="form-control" min="1" value="1" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Harga Satuan</label>
                            <input type="text" id="hargaSatuanInput" class="form-control" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Total Harga</label>
                            <input type="text" id="totalHargaInput" name="total_bayar" class="form-control" readonly required>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    barangSelect.addEventListener('change', updateHarga);
    qtyInput.addEventListener('input', updateHarga);
</script>
</body>
</html>