<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Iuran</title>
  
</head>
<body>
@extends('layouts.app')
@section('content')
<div class="bg-white p-4 rounded-xl space-y-6 h-screen">
    <div class="flex items-center justify-center gap-4">
        <input type="text" name="" id="" placeholder="Masukan nomor kartu keluarga" class="w-full rounded-3xl px-8 py-2 border border-black">
        <div class="bg-blue-500 p-3 w-80 text-white flex items-center justify-center text-center gap-2 rounded-xl">
        <iconify-icon icon="lets-icons:search" width="24" height="24"  style="color: #fff"></iconify-icon>
        <p>Cari</p>
        </div>
    </div>

    <div class="space-y-3">
        <h1 class="font-bold text-xl">Daftar Iuran</h1>
        <div class="overflow-x-auto">
  <table class="min-w-full border rounded-xl">
    <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
      <tr>
        <th class="py-3 px-4">ID Iuran</th>
        <th class="py-3 px-4">Nama</th>
        <th class="py-3 px-4">Jenis Iuran</th>
        <th class="py-3 px-4">Total Bayar</th>
        <th class="py-3 px-4">Status</th>
      </tr>
    </thead>
    <tbody class="text-sm text-gray-700">
      <tr class="bg-gray-50">
        <td class="py-3 px-4">#20462</td>
        <td class="py-3 px-4">Dimas Arkaan</td>
        <td class="py-3 px-4">Iuran Sampah</td>
        <td class="py-3 px-4">Rp 125.000</td>
        <td class="py-3 px-4">
          <button class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-xl">
          <iconify-icon icon="mdi:money" width="24" height="24"  style="color: #fff"></iconify-icon>
            Bayar
          </button>
        </td>
      </tr>
      <tr class="bg-blue-100">
        <td class="py-3 px-4">#20463</td>
        <td class="py-3 px-4">Dimas Arkaan</td>
        <td class="py-3 px-4">Iuran Keamanan</td>
        <td class="py-3 px-4">Rp 25.000</td>
        <td class="py-3 px-4">
          <span class="bg-green-100 text-green-600 px-4 py-1 rounded-full">Sudah Bayar</span>
        </td>
      </tr>
      <tr class="bg-gray-50">
        <td class="py-3 px-4">#20464</td>
        <td class="py-3 px-4">Dimas Arkaan</td>
        <td class="py-3 px-4">Iuran Acara 17 Agustus</td>
        <td class="py-3 px-4">Rp 55.000</td>
        <td class="py-3 px-4">
          <span class="bg-green-100 text-green-600 px-4 py-1 rounded-full">Sudah Bayar</span>
        </td>
      </tr>
    </tbody>
  </table>
</div>

    </div>
</div>

    @endsection
</body>
</html>