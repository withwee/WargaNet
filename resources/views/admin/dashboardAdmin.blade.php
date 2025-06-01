@extends('layouts.app')

@section('content')
  
<main>
    <section class="space-y-4">

        {{-- Kelola Boxes --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-blue-100 p-6 rounded-lg shadow text-center">
                <h2 class="text-xl font-semibold mb-4">Kelola Pengumuman</h2>
                <p class="text-blue-700 mb-4">Kelola pengumuman RT dengan mudah</p>
                <a href="{{ route('pengumuman') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg">Kelola</a>
            </div>
            <div class="bg-yellow-100 p-6 rounded-lg shadow text-center">
                <h2 class="text-xl font-semibold mb-4">Kelola Acara</h2>
                <p class="text-yellow-700 mb-4">Atur dan kelola acara RT</p>
                <a href="{{ route('kalender') }}" class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white font-semibold px-6 py-2 rounded-lg">Kelola</a>
            </div>
            <div class="bg-green-100 p-6 rounded-lg shadow text-center">
                <h2 class="text-xl font-semibold mb-4">Kelola Iuran</h2>
                <p class="text-green-700 mb-4">Kelola pembayaran iuran warga</p>
                <a href="{{ route('bayar-iuran') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg">Kelola</a>
            </div>
        </div>

        {{-- Statistik --}}
        <div class="space-y-3 mt-6">
            <h1 class="font-bold text-xl">Statistik</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="bg-blue-100 p-6 rounded-lg shadow text-center">
                    <h2 class="text-xl font-semibold mb-4">Jumlah Pengumuman</h2>
                    <p class="text-blue-700 text-3xl font-bold">{{ $jumlahPengumuman ?? 0 }}</p>
                </div>
                <div class="bg-yellow-100 p-6 rounded-lg shadow text-center">
                    <h2 class="text-xl font-semibold mb-4">Jumlah Acara</h2>
                    <p class="text-yellow-700 text-3xl font-bold">{{ $jumlahAcara ?? 0 }}</p>
                </div>
                <div class="bg-green-100 p-6 rounded-lg shadow text-center">
                    <h2 class="text-xl font-semibold mb-4">Jumlah Iuran</h2>
                    <p class="text-green-700 text-3xl font-bold">{{ $jumlahIuran ?? 0 }}</p>
                </div>
            </div>
        </div>

        {{-- Keuangan RT --}}
        <div class="space-y-3">
            <h1 class="font-bold text-xl">Keuangan RT</h1>

            <form action="{{ route('admin.pengeluaran.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 bg-white p-6 rounded-lg shadow">
                @csrf
                <div>
                    <label for="description" class="block text-sm font-semibold mb-1">Jenis Pengeluaran</label>
                    <input type="text" name="description" id="description" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ketik jenis pengeluaran di sini..." required>
                </div>
                <div>
                    <label for="amount" class="block text-sm font-semibold mb-1">Nominal Pengeluaran</label>
                    <input type="number" name="amount" id="amount" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ketik nominal pengeluaran di sini..." required>
                </div>
                <div class="col-span-1 md:col-span-2 text-center">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg">Publikasikan</button>
                </div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white px-4 py-6 rounded-xl flex flex-col items-center justify-center shadow">
                    <h1 class="text-blue-500 font-extrabold text-4xl">Rp {{ number_format($totalIuran, 0, ',', '.') }}</h1>
                    <p class="font-bold">Total Iuran Terkumpul</p>
                </div>
                <div class="bg-white px-4 py-6 rounded-xl flex flex-col items-center justify-center shadow">
                    <h1 class="text-red-500 font-extrabold text-4xl">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h1>
                    <p class="font-bold">Total Pengeluaran</p>
                </div>
                <div class="bg-white px-4 py-6 rounded-xl flex flex-col items-center justify-center shadow">
                    <h1 class="text-blue-500 font-extrabold text-4xl">Rp {{ number_format($jumlahIuranTersisa, 0, ',', '.') }}</h1>

    </section>
</main>

@endsection