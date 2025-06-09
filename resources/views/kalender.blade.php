@extends('layouts.app')

@section('title', 'Kalender')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold text-blue-600 mb-4">Juni, 2025</h2>

    @php
        $daysInMonth = 30;
        $startDay = 6; // 1 Juni 2025 jatuh pada Minggu (0=Senin, jadi Minggu=6)
        $weeks = ceil(($daysInMonth + $startDay) / 7);
    @endphp

    <table class="table-fixed w-full border text-sm">
        <thead>
            <tr class="bg-blue-100 text-blue-800 text-center">
                <th class="w-[14.28%]">Senin</th>
                <th class="w-[14.28%]">Selasa</th>
                <th class="w-[14.28%]">Rabu</th>
                <th class="w-[14.28%]">Kamis</th>
                <th class="w-[14.28%]">Jumat</th>
                <th class="w-[14.28%]">Sabtu</th>
                <th class="w-[14.28%]">Minggu</th>
            </tr>
        </thead>
        <tbody>
            @for ($week = 0; $week < $weeks; $week++)
                <tr>
                    @for ($day = 0; $day < 7; $day++)
                        @php
                            $cell = $week * 7 + $day - $startDay + 1;
                            $date = sprintf('2025-06-%02d', $cell);
                        @endphp
                        <td class="border align-top p-1 h-[100px]">
                            @if ($cell >= 1 && $cell <= $daysInMonth)
                                <div class="font-semibold text-gray-800 mb-1">{{ $cell }}</div>
                                @if (isset($events[$date]))
                                    <div class="text-xs p-1 rounded bg-blue-200 text-left break-words max-h-[60px] overflow-auto">
                                        <strong>{{ $events[$date]->title }}</strong><br>
                                        <span class="text-[10px] text-gray-600">{{ $events[$date]->description }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <div id="kegiatanModal" class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm items-center justify-center p-4 hidden z-50">
    <div id="modalContent" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg transform transition-all">
        {{-- Header Modal --}}
        <div class="p-6 border-b border-gray-200">
            <h3 id="modalJudul" class="text-2xl font-bold text-gray-900">Judul Kegiatan</h3>
            <p id="modalTanggal" class="mt-1 text-sm text-gray-500">Tanggal Kegiatan</p>
        </div>
        {{-- Body Modal --}}
        <div class="p-6 max-h-60 overflow-y-auto">
            <p id="modalDeskripsi" class="text-base text-gray-600 leading-relaxed">Deskripsi lengkap kegiatan...</p>
        </div>
        {{-- Footer Modal --}}
        <div class="px-6 py-4 bg-gray-50 rounded-b-2xl text-right">
            <button id="closeModal" class="px-6 py-2 bg-blue-600 text-white text-base font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('kegiatanModal');
        const modalContent = document.getElementById('modalContent');
        const modalJudul = document.getElementById('modalJudul');
        const modalDeskripsi = document.getElementById('modalDeskripsi');
        const modalTanggal = document.getElementById('modalTanggal');
        const closeModalBtn = document.getElementById('closeModal');
        const kegiatanItems = document.querySelectorAll('.kegiatan-item');

        const openModal = (judul, deskripsi, tanggal) => {
            modalJudul.textContent = judul;
            modalDeskripsi.textContent = deskripsi || 'Tidak ada deskripsi.';
            modalTanggal.textContent = tanggal;
            modal.classList.remove('hidden');
            modal.classList.add('flex'); 
        };

        const closeModal = () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex'); 
        };

        kegiatanItems.forEach(item => {
            item.addEventListener('click', function (event) {
                event.stopPropagation();
                const judul = this.dataset.judul;
                const deskripsi = this.dataset.deskripsi;
                const tanggal = this.dataset.tanggal;
                openModal(judul, deskripsi, tanggal);
            });
        });

        closeModalBtn.addEventListener('click', closeModal);

        modal.addEventListener('click', function (event) {
            if (!modalContent.contains(event.target)) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    });
</script>
@endsection
