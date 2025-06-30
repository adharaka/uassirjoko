
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Form Laporan</title>
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
        .sidebar .admin-avatar {
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
        .chart-box { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 2px 12px rgba(0,0,0,0.07);}
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
            <div class="admin-avatar mb-3">
                <i class="bi bi-person-circle"></i>
            </div>
            <h4>Admin</h4>
            <a href="{{ route('kelola.user') }}" class="btn btn-outline-primary mb-2 w-100">Kelola User</a>
            <a href="{{ route('kelola.laporan') }}" class="btn btn-primary mb-2 w-100">Kelola Laporan</a>
            <form method="POST" action="{{ route('logout') }}" class="w-100">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Logout</button>
            </form>
        </div>
        <!-- Content -->
        <div class="col-lg-9 col-md-8 content-area">
            <div class="card p-4">
                <h3 class="mb-4 fw-bold">Laporan Penjualan</h3>
                <form method="GET" class="row g-3 align-items-end mb-3">
                    <div class="col-auto">
                        <label class="form-label mb-0">Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                    </div>
                    <div class="col-auto">
                        <label class="form-label mb-0">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Total Pembayaran</th>
                                        <th>Nama Kasir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($laporan as $row)
                                    <tr>
                                        <td>{{ $row->id_transaksi }}</td>
                                        <td>{{ $row->tgl_transaksi }}</td>
                                        <td>Rp. {{ number_format($row->total_bayar,0,',','.') }}</td>
                                        <td>{{ $row->nama_kasir }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Tidak ada data.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="chart-box mb-3">
                            <canvas id="chartPenjualan" height="200"></canvas>
                        </div>
                        <button type="button" class="btn btn-info w-100" id="btnGenerateChart">
                            <i class="bi bi-bar-chart"></i> Generate
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data chart dari backend (contoh, sesuaikan dengan data laporan)
    const chartData = @json($chartData ?? []);
    const chartLabels = chartData.map(item => item.label);
    const chartValues = chartData.map(item => item.value);

    let chartInstance = null;
    document.getElementById('btnGenerateChart').addEventListener('click', function() {
        if(chartInstance) chartInstance.destroy();
        const ctx = document.getElementById('chartPenjualan').getContext('2d');
        chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Omzet',
                    data: chartValues,
                    backgroundColor: '#0d6efd'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
</body>
</html>