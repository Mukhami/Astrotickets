<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Event;
use App\Cart;
use App\Category;
use Session;

class EventsController extends Controller
{   //show events
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
    public function search(Request $request)
    {
        $query = $request->input('query');
        $events = Event::where('name', 'like', "%$query%")
                        ->orWhere('description', 'like', "%$query%")
                        ->orWhere('location', 'like', "%$query%")
                        ->orWhere('guests', 'like', "%$query%")
                        ->get();
        return view('search-results', compact('query', 'events'));
    }
}