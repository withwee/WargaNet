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
                                @endif
                            @endif
                        </td>
                    @endfor
                </tr>
            @endfor
        </tbody>
    </table>
</div>
@endsection
