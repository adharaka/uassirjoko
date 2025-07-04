<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Log Aktivitas Persib Food Store</title>
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
            background: #0066CC;
            padding: 40px 20px 20px 20px;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
            color: #fff;
        }

        .sidebar .admin-avatar {
            width: 90px;
            height: 90px;
            background: #ffffff;
            border-radius: 50%;
            margin: 0 auto 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #0066CC;
            border: 3px solid #005BB5;
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
            background-color: #ffffff;
            border-color: #FFD700;
            color: #0066CC;
        }

        .sidebar .btn-primary:hover {
            background-color: #e6c200;
            border-color: #e6c200;
        }

        .sidebar .btn-danger {
            background-color: #dc3545;
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
            background-color: #0066CC;
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
            background-color: #f0f8ff;
            border: 1px solid #cfe2ff;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 10px 15px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            font-weight: 500;
            border-radius: 8px;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .table {
            --bs-table-striped-bg: #f5fafd;
            --bs-table-hover-bg: #e6f3fb;
        }

        .table th,
        .table td {
            vertical-align: middle;
            padding: 12px 15px;
            border-color: #dee2e6;
        }

        .table thead.table-light th {
            background-color: #005BB5;
            color: #fff;
            border-bottom: 2px solid #004a99;
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
                    <img src="{{ asset('admin.jpeg') }}" alt="Admin Icon"
                        style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;">
                </div>
                <h4>Admin</h4>
                <a href="{{ route('kelola.user') }}" class="btn btn-outline-primary mb-2 w-100">Kelola Pengguna</a>
                <a href="{{ route('kelola.laporan') }}" class="btn btn-outline-primary mb-2 w-100">Kelola Laporan</a>
                <a href="{{ route('admin.log') }}" class="btn btn-primary mb-2 w-100">Log Aktivitas</a>
                <form method="POST" action="{{ route('logout') }}" class="w-100">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Keluar</button>
                </form>
            </div>
            <div class="col-lg-9 col-md-8 content-area">
                <div class="card">
                    <div class="card-header">
                        Log Aktivitas Pengguna
                    </div>
                    <div class="card-body p-4">
                        <form method="GET" class="row g-3 filter-box align-items-end">
                            <div class="col-auto">
                                <label for="tanggal" class="form-label mb-0">Pilih Tanggal:</label>
                            </div>
                            <div class="col-auto">
                                <input type="date" id="tanggal" name="tanggal" class="form-control"
                                    value="{{ request('tanggal') }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success">Filter</button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mt-3">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID Log</th>
                                        <th>Waktu</th>
                                        <th>Aktivitas</th>
                                        <th>ID Pengguna</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($logs as $log)
                                        <tr>
                                           <td>{{ $log->id }}</td>
                                            <td>{{ $log->waktu }}</td>
                                            <td>{{ $log->aktivitas }}</td>
                                            <td>{{ $log->id_user }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Tidak ada data log.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- PAGINATION --}}
                            <div class="d-flex justify-content-center mt-3">
                                {{ $logs->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
