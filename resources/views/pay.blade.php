@extends('layouts.app')

@section('title', 'Bayar Iuran')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Iuran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<div class="space-y-6">
    <div class="header">
        <h1>Bayar Iuran</h1>
    </div>

    <div class="container mt-5">
    <div class="row">
        <!-- Tabel Daftar Iuran -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Iuran</h5>
                    <!-- Search -->
                    <form action="{{ route('iuran.cari') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="no_kk" class="form-control" placeholder="Masukkan Nomor Kartu Keluarga"
                                value="{{ request('no_kk') }}">
                            <button class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                        </div>
                    </form>
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
                        @if(isset($iurans) && count($iurans) > 0)
                            @foreach ($iurans as $iuran)
                                <tr>
                                    <td>#{{ $iuran->id_bayar }}</td>
                                    <td>{{ $iuran->user->name ?? 'Tidak Ditemukan' }}</td>
                                    <td>{{ $iuran->jenis_iuran }}</td>
                                    <td>Rp {{ number_format($iuran->total_bayar, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                    @if ($iuran->status === 'Sudah Bayar')
                                        <span class="badge bg-success">Sudah Bayar</span>
                                    @else
                                        <!-- Tombol Bayar -->
                                    <button id="pay-button-{{ $iuran->id_bayar }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-wallet"></i> Bayar
                                    </button>
                                    <script>
                                        document.getElementById('pay-button-{{ $iuran->id_bayar }}').addEventListener('click', function () {
                                            fetch('/pay/snap-token/{{ $iuran->id_bayar }}')
                                                .then(response => {
                                                    if (!response.ok) {
                                                        throw new Error('Gagal mendapatkan Snap Token. Silakan coba lagi.');
                                                    }
                                                    return response.json();
                                                })
                                                .then(data => {
                                                    if (!data.snapToken) {
                                                        throw new Error('Snap Token tidak tersedia. Silakan coba lagi.');
                                                    }
                                                    snap.pay(data.snapToken, {
                                                        onSuccess: function(result) {
                                                            alert('Pembayaran berhasil!');
                                                            location.reload();
                                                        },
                                                        onPending: function(result) {
                                                            alert('Menunggu pembayaran...');
                                                        },
                                                        onError: function(result) {
                                                            alert('Pembayaran gagal!');
                                                        }
                                                    });
                                                })
                                                .catch(error => {
                                                    alert(error.message);
                                                });
                                        });
                                    </script>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Silahkan cari menggunakan nomor KK</td>
                            </tr>
                        @endif
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
    <!-- Tabel Tambah Data Iuran -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Data Iuran</h5>
                <form action="{{ route('iuran.store') }}" method="POST">
                    @csrf
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><label for="jenis_iuran" class="form-label">Jenis Iuran</label></td>
                                <td><input type="text" name="jenis_iuran" class="form-control" id="jenis_iuran" required></td>
                            </tr>
                            <tr>
                                <td><label for="total_bayar" class="form-label">Total Bayar</label></td>
                                <td><input type="number" name="total_bayar" class="form-control" id="total_bayar" required></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
@endpush
