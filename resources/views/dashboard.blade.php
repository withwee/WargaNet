<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warganet Dashboard</title>
</head>
<body>
@extends('layouts.app')

@section('content')
  
<main>
    <section class="space-y-4">
        <div class="">
            <div class="flex justify-between items-center mb-8 gap-6">
                <div class="bg-blue-500 rounded-lg w-full relative flex justify-between items-center px-4 py-6">
                    <div class="text-white space-y-3">
                        <h1 class="font-bold w-[21rem] text-2xl">Jadwal Pencalonan Ketua RT dan Sekretaris RT 2025</h1>
                        <p class="w-[80%]">Dimohon bagi warga yang berminat untuk mencalonkan diri sebagai Ketua dan Sekretaris RT bisa menghubungi Tuhan YME.</p>
                        <div class="bg-white w-32 text-blue-500 text-center rounded-3xl p-2">
                            3 Maret 2025
                        </div>
                    </div>
                    <div class="w-40 absolute bottom-0 right-0">
                        <img src="{{ asset('images/toa.png') }}" alt="toa">
                    </div>
                </div>
            
            <div class="space-y-2">
    <div class="flex justify-between items-center">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4m0 0l6-6m-6 6l6 6"/></svg>
        <h1>Maret, 2025</h1>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16m0 0l-6 6m6-6l-6-6"/></svg>
    </div>
                {{-- Kalender --}}
                <div class="bg-white rounded-lg shadow-md p-4 w-80">
                    <div class="grid grid-cols-7 gap-2 text-gray-500 font-semibold text-xs mb-2">
                        <div>SUN</div>
                        <div>MON</div>
                        <div>TUE</div>
                        <div>WED</div>
                        <div>THU</div>
                        <div>FRI</div>
                        <div>SAT</div>
                    </div>
                    <div class="grid grid-cols-7 gap-2 text-center text-gray-700 text-sm">
                        @php
                            $days = [
                                1,2,3,4,5,6,7,
                                8,9,10,11,12,13,14,
                                15,16,17,18,19,20,21,
                                22,23,24,25,26,27,28,
                                29,30,31
                            ];
                        @endphp
                
                        @foreach ($days as $day)
                            @if ($day == '')
                                <div></div>
                            @elseif ($day == 1)
                                <div class="bg-red-200 rounded-md py-1 font-bold">{{ $day }}</div>
                            @elseif ($day == 11)
                                <div class="bg-green-200 rounded-md py-1 font-bold">{{ $day }}</div>
                            @elseif ($day == 21)
                                <div class="bg-purple-200 rounded-md py-1 font-bold">{{ $day }}</div>
                            @else
                                <div class="py-1">{{ $day }}</div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
        </div>

        <div class="space-y-3">
        <h1 class="font-bold text-xl">Data Warga</h1>
        <div class="grid grid-cols-3 place-items-start  gap-3">
            <div class="bg-white px-4 py-6 w-full rounded-xl gap-2 flex items-center justify-center">
                <div class="space-y-1 text-center">
                    <h1 class="text-4xl font-extrabold text-[#26BFA3]">43</h1>
                    <p class="font-bold text-xl">Laki-Laki</p>
                </div>
                    <img src="icon/man.svg" alt="man" class="w-10">
            </div>

            <div class="bg-white px-4 py-6 w-full rounded-xl gap-2 flex items-center justify-center">
                <div class="space-y-1 text-center">
                    <h1 class="text-4xl font-extrabold text-[#F27EA9]">43</h1>
                    <p class="font-bold text-xl">Perempuan</p>
                </div>
                    <img src="icon/woman.svg" alt="woman" class="w-10">
            </div>

            <div class="bg-white px-4 py-6 w-full rounded-xl gap-2 flex items-center justify-center">
                <div class="space-y-1 text-center">
                    <h1 class="text-4xl font-extrabold text-[#26BFA3]">75</h1>
                    <p class="font-bold text-xl">Warga</p>
                </div>
                <div class="flex items-center gap-3">
                <img src="icon/woman.svg" alt="woman" class="w-10">
                    <img src="icon/man.svg" alt="man" class="w-10">
                </div>
            </div>


            <div class="bg-white px-4 py-6 w-full col-span-3 rounded-xl gap-2 flex items-center justify-center">
                    <div class="space-y-1 text-center">
                        <h1 class="text-5xl font-extrabold text-[#26BFA3]">20</h1>
                        <p class="font-bold text-2xl">Kartu Keluarga</p>
                    </div>
                        <img src="icon/totalKeluarga.svg" alt="family" class="w-20">
                </div>
        </div>
        </div>

        <div class="space-y-3">
        <h1 class="font-bold text-xl">Keuangan RT</h1>
        <div class="flex justify-between gap-3 items-center">
            <div class="bg-white px-4 py-6 w-full col-span-3 rounded-xl gap-2 flex flex-col items-center justify-center">
                <h1 class="text-blue-500 font-extrabold text-4xl">Rp 120.000.000</h1>
                <p class="font-bold">Total Iuran Terkumpul</p>
            </div>
            <div class="bg-white px-4 py-6 w-full col-span-3 rounded-xl gap-2 flex flex-col items-center justify-center">
                <h1 class="text-red-500 font-extrabold text-4xl">Rp 24.000.000</h1>
                <p class="font-bold">Total Pengeluaran</p>
            </div>
        </div>
        </div>
    </section>
</main>

@endsection
</body>
</html>