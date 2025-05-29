<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
{
    // contoh data dummy jika belum ada dari database
    $events = [
        ['date' => '2025-03-01', 'title' => 'Kerja Bakti'],
        ['date' => '2025-03-15', 'title' => 'Ulang Tahun Cipeng'],
    ];

    return view('kalender', compact('events'));
}

    public function adminIndex()
    {
        $events = Event::all();
        return View::make('calendar.admin', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'event_date' => 'required|date',
        ]);

        Event::create($request->all());
        return Redirect::to('/admin/kalender')->with('success', 'Kegiatan berhasil ditambahkan!');
    }
}
