@extends('layouts.app')
@section('content')
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