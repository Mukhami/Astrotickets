<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Event;
use App\User;
use DB;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //Contact Us Page
    public function contact()
    {
        return view('contact');
    }

    //Checkout Page
    public function checkout()
    {
        return view('checkout');
    }

    //Reports Page
    public function reports()
    {
        $duration= 'all Sales';
        $tickets = DB::table('tickets')
            ->join('users', 'users.id', '=', 'tickets.user_id')
            ->join('events', 'events.id', '=', 'tickets.event_id')
            ->select('users.name as username', 'events.name as eventname', 'tickets.*')
            ->get();

        $total = Ticket::sum('charges');
        return view("reports", compact('tickets', 'total', 'duration'));

    }
    //sort reports admin
    public function sort(Request $request)
    {
        $month = request('month');
        $monthnumber =date('m', strtotime($month));

        //If Name is Empty
        if(request('name') == ''){

            //If Months is Unspecified
            if(request('month') == 'All Months'){
                $tickets = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->whereYear('tickets.created_at' , request('year'))
                    ->select('users.name as username', 'events.name as eventname', 'tickets.*')
                    ->get();
                $duration= 'THE YEAR ' .request('year');
                $total = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->whereYear('tickets.created_at' , request('year'))
                    ->sum('tickets.charges');

        //If Month is Specified
            }else {
                $tickets = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->whereYear('tickets.created_at' , request('year'))
                    ->whereMonth('tickets.created_at' , $monthnumber )
                    ->select('users.name as username', 'events.name as eventname', 'tickets.*')
                    ->get();
                $duration= 'THE MONTH OF ' .request('month'). ' IN ' .request('year');
                $total = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->whereMonth('tickets.created_at' , $monthnumber )
                    ->whereYear('tickets.created_at' , request('year'))
                    ->sum('tickets.charges');

            }
        }

        //If name is Specified
        else{
            //Name is specified with All Months
            if(request('month') == 'All Months'){
                $tickets = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->where('events.name', 'like', '%' . $request->input('name') . '%')
                    ->orWhere('users.name', 'like', '%' . $request->input('name') . '%')
                    ->whereYear('tickets.created_at' , request('year'))
                    ->select('users.name as username', 'events.name as eventname', 'tickets.*')
                    ->get();
                $duration= 'THE EVENT/USER NAMED ' . request('name'). ' IN ' . request('year');
                $total = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->where('events.name', 'like', '%' . $request->input('name') . '%')
                    ->orWhere('users.name', 'like', '%' . $request->input('name') . '%')
                    ->whereYear('tickets.created_at' , request('year'))
                    ->sum('tickets.charges');

            }else {

                //Name is Specified with Specific Month
                $tickets = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->where('events.name', 'like', '%' . $request->input('name') . '%')
                    ->orWhere('users.name', 'like', '%' . $request->input('name') . '%')
                    ->whereYear('tickets.created_at' , request('year'))
                    ->whereMonth('tickets.created_at' , $monthnumber )
                    ->select('users.name as username', 'events.name as eventname', 'tickets.*')
                    ->get();
                $duration= 'THE EVENT/USER NAMED ' . request('name'). ' FOR THE MONTH OF ' . request('month'). ' in '. request('year');
                $total = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->where('events.name', 'like', '%' . $request->input('name') . '%')
                    ->orWhere('users.name', 'like', '%' . $request->input('name') . '%')
                    ->whereYear('tickets.created_at' , request('year'))
                    ->whereMonth('tickets.created_at' , $monthnumber )
                    ->sum('tickets.charges');
            }
        }


        return view("reports", compact('tickets', 'total', 'duration'));
    }

    //Reports Page
    public function instructions()
    {
        return view('instructions');
    }

}
