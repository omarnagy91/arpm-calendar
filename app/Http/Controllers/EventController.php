<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function store(Request $request)
    {
        Event::create($request->all());
        return redirect()->route('events.index');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index');
    }
    public function create()
{
    return view('events.create');
}

public function edit(Event $event)
{
    return view('events.edit', compact('event'));
}

public function update(Request $request, Event $event)
{
    $event->update($request->all());
    return redirect()->route('events.index')->with('success', 'Event updated successfully');
}
}
