@extends('layouts.app')

@section('title', 'Bayar Iuran')

@section('content')
<div class="space-y-6">
    <div class="header">
        <h1>Bayar Iuran</h1>
    </div>

    <div class="container mt-5">
        <div class="row">
            <!-- Tabel Tambah Data Iuran -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Data Iuran</h5>
                        <form action="{{ route('iuran.store') }}" method="POST">
                            @csrf
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td><label for="no_kk" class="form-label">Nomor KK</label></td>
                                        <td><input type="text" name="no_kk" class="form-control" id="no_kk" required></td>
                                    </tr>
                                    <tr>
                                        <td><label for="jenis_iuran" class="form-label">Jenis Iuran</label></td>
                                        <td><input type="text" name="jenis_iuran" class="form-control" id="jenis_iuran" required></td>
                                    </tr>
                                    <tr>
                                        <td><label for="total_bayar" class="form-label">Total Bayar</label></td>
                                        <td><input type="number" name="total_bayar" class="form-control" id="total_bayar" required></td>
                                    </tr>
                                    <tr>
                                        <td><label for="status" class="form-label">Status</label></td>
                                        <td>
                                            <select name="status" class="form-control" id="status" required>
                                                <option value="Belum Bayar">Belum Bayar</option>
                                                <option value="Sudah Bayar">Sudah Bayar</option>
                                            </select>
                                        </td>
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

            <!-- Tabel Daftar Iuran -->
            <div class="col-md-6">
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
                                            <td>
                                                @if ($iuran->status === 'Sudah Bayar')
                                                    <span class="badge bg-success">Sudah Bayar</span>
                                                @else
                                                    <span class="badge bg-warning">Belum Bayar</span>
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
    </div>
</div>
@endsection
