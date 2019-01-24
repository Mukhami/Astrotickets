<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Event;
use App\Category;
class EventsController extends Controller
{
    //show events
    public function events()
    {
        $events = Event::all();
        $categories= Category::limit(4)->get();
        return view('index', compact('events','categories'));
    }
    //show single event
    public function event($slug)
    {
        $event = Event::where('slug', '=', $slug)->firstOrFail();
        return view('event', compact('event'));
    }
    //browse events by category
    public function browsecategory($slug)
    {
        $events = Event::where('cat_id', '=', $slug)->get();
        $categories= Category::limit(4)->get();
        return view('browsecategory', compact('events','categories'));
    }
}
