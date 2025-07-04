<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Kelola Laporan Penjualan Persib Food Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0f2f7, #c6e7f2);
        }

        .sidebar {
            min-height: 100vh;
            background: #0066CC; /* Biru Persib */
            padding: 40px 20px 20px 20px;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
            color: #fff;
        }

        .sidebar .admin-avatar {
            width: 90px;
            height: 90px;
            background: #ffffff; /* Aksen Putih */
            border-radius: 50%;
            margin: 0 auto 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #0066CC; /* Ikon Biru Persib */
            border: 3px solid #005BB5; /* Border biru sedikit lebih gelap */
        }

        .sidebar .admin-avatar img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #fff;
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
            background-color: #ffffff; /* Tombol aktif Putih */
            border-color: #FFD700; /* Border Kuning Emas untuk indikasi aktif */
            color: #0066CC; /* Teks Biru Persib pada tombol aktif */
        }

        .sidebar .btn-primary:hover {
            background-color: #e6e6e6; /* Sedikit abu-abu saat hover */
            border-color: #e6c200; /* Emas/kuning lebih gelap saat hover */
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
            color: #333;
        }

        .card {
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
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

        .filter-box {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 10px;
            background-color: #f0f8ff; /* Latar belakang biru muda untuk filter */
            border: 1px solid #cfe2ff;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 10px 15px;
        }

        .btn-filter {
            background-color: #28a745; /* Hijau standar untuk tombol filter */
            border-color: #28a745;
            font-weight: 500;
            border-radius: 8px;
        }

        .btn-filter:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .table {
            --bs-table-striped-bg: #f5fafd; /* Garis zebra lebih terang untuk tabel */
            --bs-table-hover-bg: #e6f3fb; /* Biru muda saat hover */
        }

        .table th,
        .table td {
            vertical-align: middle;
            padding: 12px 15px;
            border-color: #dee2e6; /* Border lebih terang untuk sel tabel */
        }

        .table thead.table-light th {
            background-color: #005BB5; /* Biru Persib lebih gelap untuk header tabel */
            color: #fff;
            border-bottom: 2px solid #004a99;
        }

        .chart-box {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            min-height: 250px; /* Tambahkan tinggi minimum agar chart terlihat */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-generate-chart {
            background-color: #17a2b8; /* Warna info/teal */
            border-color: #17a2b8;
            color: #fff;
            font-weight: 500;
            border-radius: 8px;
        }

        .btn-generate-chart:hover {
            background-color: #138496;
            border-color: #117a8b;
        }

        .text-muted {
            color: #6c757d !important;
        }

        @media (max-width: 991px) {
            .sidebar {
                min-height: auto;
                padding-bottom: 20px;
            }

            .content-area {
                padding: 20px 15px;
            }

            .sidebar .btn {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-4 sidebar d-flex flex-column align-items-center">
            <div class="admin-avatar mb-3">
                <img src="{{ asset('admin.jpeg') }}" alt="Admin Icon">
            </div>
            <h4>Admin</h4>
            <a href="{{ route('kelola.user') }}" class="btn btn-outline-primary mb-2 w-100">Kelola Pengguna</a>
            <a href="{{ route('kelola.laporan') }}" class="btn btn-primary mb-2 w-100">Kelola Laporan</a>
            <a href="{{ route('admin.log') }}" class="btn btn-outline-primary mb-2 w-100">Log Aktivitas</a>
            <form method="POST" action="{{ route('logout') }}" class="w-100">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Keluar</button>
            </form>
        </div>
        <div class="col-lg-9 col-md-8 content-area">
            <div class="card">
                <div class="card-header">
                    Laporan Penjualan
                </div>
                <div class="card-body p-4">
                    <form method="GET" class="row g-3 filter-box align-items-end">
                        <div class="col-auto">
                            <label for="tanggal_awal" class="form-label mb-0">Tanggal Awal</label>
                            <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                        </div>
                        <div class="col-auto">
                            <label for="tanggal_akhir" class="form-label mb-0">Tanggal Akhir</label>
                            <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-filter">Filter</button>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered table-hover align-middle mt-3">
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
                                            <td colspan="4" class="text-center text-muted">Tidak ada data laporan.</td>
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
                            <button type="button" class="btn btn-generate-chart w-100" id="btnGenerateChart">
                                <i class="bi bi-bar-chart"></i> Buat Grafik
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
                    backgroundColor: '#0066CC' /* Biru Persib */
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