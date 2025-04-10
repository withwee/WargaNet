@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #2C79FF;
            min-height: 100vh;
            color: white;
            padding: 20px;
        }

        .sidebar .logo {
            font-weight: 800;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .sidebar span {
            font-weight: 400;
        }

        .nav-link {
            color: white;
        }

        .nav-item.active {
            background-color: white;
            border-radius: 10px;
        }

        .nav-item.active .nav-link {
            color: #2C79FF;
            font-weight: bold;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        .status-paid {
            background-color: #d4edda;
            color: #155724;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #2C79FF;
            border-color: #2C79FF;
        }

        .btn-primary:hover {
            background-color: #1b5dc1;
        }

    </style>
<div class="header">
                <h2>Bayar Iuran</h2>
                <div class="user-info">
                    Cipengs
                    <img src="avatar.png" alt="User">
                </div>
            </div>

            <!-- Search -->
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Masukkan Nomor Kartu Keluarga">
                <button class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
            </div>

            <!-- Tabel Iuran -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Daftar Iuran</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Iuran</th>
                                <th>Nama</th>
                                <th>Jenis Iuran</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#20462</td>
                                <td>Cipengs</td>
                                <td>Iuran Sampah</td>
                                <td>Rp 125.000</td>
                                <td><button class="btn btn-primary"><i class="fas fa-wallet me-1"></i> Bayar</button></td>
                            </tr>
                            <tr>
                                <td>#20463</td>
                                <td>Cipengs</td>
                                <td>Iuran Keamanan</td>
                                <td>Rp 25.000</td>
                                <td><span class="status-paid">Sudah Bayar</span></td>
                            </tr>
                            <tr>
                                <td>#20464</td>
                                <td>Cipengs</td>
                                <td>Iuran Acara 17 Agustus</td>
                                <td>Rp 55.000</td>
                                <td><span class="status-paid">Sudah Bayar</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
@endsection