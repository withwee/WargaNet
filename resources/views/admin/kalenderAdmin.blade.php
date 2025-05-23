
@extends('layouts.app')

@section('content')


<div class="space-y-6">

<div class="space-y-3">
        <h1 class="font-extrabold text-xl">Buat Kegiatan</h1>
        <div class="bg-white rounded-xl mx-auto p-4 space-y-3">
            <form method="POST" action="{{ route('kegiatan.store') }}" class="space-y-4" id="formKegiatan">
                @csrf
                <div>
                    <label class="block text-base font-semibold mb-1 text-gray-700">Judul Kegiatan</label>
                    <input type="text" name="judulKegiatan" minlength="5"
                        placeholder="Ketik judul kegiatan..." class="w-full border border-gray-300 rounded-full px-5 py-3" required>
                </div>
                <div>
                    <label class="block text-base font-semibold mb-1 text-gray-700">Deskripsi Kegiatan</label>
                    <textarea name="deskripsiKegiatan" minlength="10"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-3 h-40 resize-none" required></textarea>
                </div>
                <div>
                    <label class="block text-base font-semibold mb-1 text-gray-700">Tanggal Kegiatan</label>
                    <input type="date" name="tanggalKegiatan" class="w-full border border-gray-300 rounded-full px-5 py-3" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white font-semibold px-6 py-2 rounded-full">Simpan Kegiatan</button>
            </form>
        </div>


@php
    $prevMonth = $currentDate->copy()->subMonth();
    $nextMonth = $currentDate->copy()->addMonth();

    $startOfMonth = $currentDate->copy()->startOfMonth();
    $endOfMonth = $currentDate->copy()->endOfMonth();

    $startDayOfWeek = $startOfMonth->dayOfWeekIso; // Senin = 1
    $daysInMonth = $currentDate->daysInMonth;

    $firstDayInCalendar = $startOfMonth->copy()->subDays($startDayOfWeek - 1);
    $lastDayInCalendar = $endOfMonth->copy()->addDays(42 - ($startDayOfWeek - 1 + $daysInMonth));
@endphp

<div class="space-y-3">
    <div class="bg-white rounded-xl p-4 space-y-3 shadow">
        <div class="flex justify-between items-center">

            <h1 class="font-extrabold text-3xl text-blue-600">{{ $currentDate->translatedFormat('F, Y') }}</h1>
            <div class="flex justify-end gap-4">
                <a href="{{ route('kalender', ['month' => $prevMonth->month, 'year' => $prevMonth->year]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4m0 0l6-6m-6 6l6 6"/></svg>
                </a>
                <a href="{{ route('kalender', ['month' => $nextMonth->month, 'year' => $nextMonth->year]) }}">
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16m0 0l-6 6m6-6l-6-6"/></svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-7 border border-blue-300 text-center text-sm font-semibold">
            @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $day)
                <div class="p-2 border border-blue-300 ">{{ $day }}</div>
            @endforeach

            @for ($date = $firstDayInCalendar; $date <= $lastDayInCalendar; $date->addDay())
                @php
                    $tanggal = $date->toDateString();
                    $kegiatanHariIni = $kalendars->where('tanggal', $tanggal);
                    $isCurrentMonth = $date->month === $currentDate->month;

                    // Warna latar kegiatan berdasarkan ID
                    $bgColor = '';
                    if ($kegiatanHariIni->isNotEmpty()) {
                        $colors = ['bg-red-200', 'bg-green-200', 'bg-purple-200', 'bg-yellow-200', 'bg-pink-200'];
                        $bgColor = $colors[$kegiatanHariIni->first()->id % count($colors)];
                    }
                @endphp

                <div class="border border-blue-300 p-2 h-28 overflow-auto text-left 
                    {{ $isCurrentMonth ? '' : 'bg-gray-100 text-gray-400' }} {{ $bgColor }}">
                    <p class="font-bold text-sm">{{ $date->day }}</p>
                    @foreach ($kegiatanHariIni as $kegiatan)
                        <p class="text-xs">{{ $kegiatan->judul }}</p>
                        <p class="text-xs">{{ $kegiatan->deskripsi }}</p>
                    @endforeach
                </div>
            @endfor
        </div>
    </div>
</div>

</div>

@endsection