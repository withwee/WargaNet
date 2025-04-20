@extends('layouts.app')

@section('content')
<div class="space-y-6 ">

    <!-- Banner Pengumuman Khusus -->
    <div class="bg-blue-500 rounded-lg w-full relative flex justify-between items-center px-4 py-6">
        <div class="text-white space-y-3">
            <h1 class="font-bold text-2xl w-full md:w-[21rem]">Jadwal Pencalonan Ketua RT dan Sekretaris RT 2025</h1>
            <p class="w-full md:w-[80%]">Dimohon bagi warga yang berminat untuk mencalonkan diri sebagai Ketua dan Sekretaris RT bisa menghubungi Tuhan YME.</p>
            <div class="bg-white w-32 text-blue-500 text-center rounded-3xl p-2">
                3 Maret 2025
            </div>
        </div>
        <div class="w-32 absolute bottom-0 right-0">
            <img src="{{ asset('images/toa.png') }}" alt="toa">
        </div>
    </div>

    <!-- List Pengumuman -->
    <div class="space-y-4">
        <h1 class="font-bold text-xl">Pengumuman Hari Ini</h1>

        @foreach ($pengumumans as $pengumuman)
        <div class="bg-white p-4 rounded-lg space-y-3">
        <h1 class="text-2xl font-bold">{{ $pengumuman->judulPengumuman }}</h1>
        <p class="w-[80%] text-sm">{{ $pengumuman->isiPengumuman }}.</p>
        <div class="bg-blue-500 p-2 rounded-3xl text-white text-sm font-bold w-fit">
        {{ $pengumuman->created_at->format('d M Y, H:i') }}
        </div>
    </div>
        @endforeach

    </div>

</div>
@endsection