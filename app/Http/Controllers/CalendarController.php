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
    $events = Event::whereMonth('event_date', 6) // Juni
                   ->whereYear('event_date', 2025)
                   ->get()
                   ->keyBy(function ($event) {
                       return \Carbon\Carbon::parse($event->event_date)->format('Y-m-d');
                   });

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
