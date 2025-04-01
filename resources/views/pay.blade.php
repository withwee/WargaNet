<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Iuran | WargaNet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/pay.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <h2 class="logo">Warga<span>Net</span></h2>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-bullhorn"></i> Pengumuman</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-comments"></i> Forum</a></li>
                    <li class="nav-item active"><a href="#" class="nav-link"><i class="fas fa-wallet"></i> Bayar Iuran</a></li>
                    <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-calendar-alt"></i> Kalender</a></li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="header">
                    <h2>Bayar Iuran</h2>
                    <div class="user-info">Cipengs<img src="avatar.png" alt="User"></div>
                </div>

                <!-- Input Pencarian -->
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Masukkan Nomor Kartu Keluarga">
                    <button class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                </div>

                <!-- Tabel Iuran -->
                <div class="card mt-3">
                    <div class="card-body">
                        <h5>Daftar Iuran</h5>
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
                                    <td>Dimas Arkaan</td>
                                    <td>Iuran Sampah</td>
                                    <td>Rp 125.000</td>
                                    <td><button class="btn btn-primary"><i class="fas fa-wallet"></i> Bayar</button></td>
                                </tr>
                                <tr class="paid">
                                    <td>#20463</td>
                                    <td>Dimas Arkaan</td>
                                    <td>Iuran Keamanan</td>
                                    <td>Rp 25.000</td>
                                    <td><span class="status-paid">Sudah Bayar</span></td>
                                </tr>
                                <tr class="paid">
                                    <td>#20464</td>
                                    <td>Dimas Arkaan</td>
                                    <td>Iuran Acara 17 Agustus</td>
                                    <td>Rp 55.000</td>
                                    <td><span class="status-paid">Sudah Bayar</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
