<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function allEvents()
    {
        $allEvents = Event::latest()->paginate(10);
        return view('pages.all-events', compact('allEvents'));

    }
    public function showEvent(Event $event){
        return view('pages.event-show', [
            'event' => $event
        ]);
    }
}
