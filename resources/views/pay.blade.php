@extends('layouts.app')
@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Iuran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  
</head>
<!-- Search -->
<form action="{{ route('iuran.cari') }}" method="GET">
    <div class="input-group mb-3">
        <input type="text" name="no_kk" class="form-control" placeholder="Masukkan Nomor Kartu Keluarga"
            value="{{ request('no_kk') }}">
        <button class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
    </div>
</form>

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
                @if(isset($iurans) && count($iurans) > 0)
                    @foreach ($iurans as $iuran)
                        <tr>
                            <td>#{{ $iuran->id_bayar }}</td>
                            <td>{{ $iuran->user->name ?? 'Tidak Ditemukan' }}</td>
                            <td>{{ $iuran->jenis_iuran }}</td>
                            <td>Rp {{ number_format($iuran->total_bayar, 0, ',', '.') }}</td>
                            <td>
                                @if ($iuran->status === 'Sudah Bayar')
                                    <span class="status-paid">Sudah Bayar</span>
                                @else
                                    <form action="{{ route('iuran.bayar', $iuran->id_bayar) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary">
                                            <i class="fas fa-wallet me-1"></i> Bayar
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">Silakan cari menggunakan nomor KK</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
