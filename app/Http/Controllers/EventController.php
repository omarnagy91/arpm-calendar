<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::whereBetween('start_time', [now()->startOfWeek(), now()->endOfWeek()])->get();
        return view('events.index', compact('events'));
    }

    public function store(Request $request)
    {
        // Code to add a new event
        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->save();

        return redirect()->back();
    }

    public function destroy(Event $event)
    {
        // Code to delete an event
        $event->delete();

        return redirect()->back();
    }
}
