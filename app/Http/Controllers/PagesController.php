<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\User;
use Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //Contact Us Page
    public function contact()
    {
        return view('contact');
    }

    public function contactmail(Request $request)
    {
        $this->validate($request, [
            'name' =>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required',
        ]);

        Mail::send('emails.contactus.contactus', [
                'msg' => $request->message
            ]
            , function($mail) use($request){
                $mail->from($request->email, $request->name);
                $mail->to('admin@admin.com')->subject($request->subject);
            });

        return redirect('contact')->with('status', 'We have received your response, we shall be contacting you soon!');;
    }

    //Checkout Page
    public function checkout()
    {
        return view('checkout');
    }

    //How to purchase Tickets page
    public function instructions()
    {
        return view('instructions');
    }

    //Reports Page
    public function reports()
    {
        $duration= 'ALL SALES';
        $tickets = DB::table('tickets')
            ->join('users', 'users.id', '=', 'tickets.user_id')
            ->join('events', 'events.id', '=', 'tickets.event_id')
            ->select('users.name as username', 'events.name as eventname', 'tickets.*')
            ->get();

        $total = Ticket::sum('charges');

        $ticketssold = Ticket::sum('quantity');

        $ticketsremaining = DB::table('events')
                                ->sum('events.number_of_tickets');


        return view("reports", compact('tickets', 'total', 'duration', 'ticketssold', 'ticketsremaining'));

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

                $ticketssold = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->whereYear('tickets.created_at' , request('year'))
                    ->sum('tickets.quantity');

                $ticketsremaining = DB::table('events')
                    ->whereYear('events.created_at' , request('year'))
                    ->sum('events.number_of_tickets');

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
                $ticketssold = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->whereMonth('tickets.created_at' , $monthnumber )
                    ->whereYear('tickets.created_at' , request('year'))
                    ->sum('tickets.quantity');
                $ticketsremaining = DB::table('events')
                    ->whereMonth('events.created_at' , $monthnumber )
                    ->whereYear('events.created_at' , request('year'))
                    ->sum('events.number_of_tickets');


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

                $duration= '' . request('name'). ' IN THE YEAR ' . request('year');

                $total = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->where('events.name', 'like', '%' . $request->input('name') . '%')
                    ->orWhere('users.name', 'like', '%' . $request->input('name') . '%')
                    ->whereYear('tickets.created_at' , request('year'))
                    ->sum('tickets.charges');

                $ticketssold = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->where('events.name', 'like', '%' . $request->input('name') . '%')
                    ->orWhere('users.name', 'like', '%' . $request->input('name') . '%')
                    ->whereYear('tickets.created_at' , request('year'))
                    ->sum('tickets.quantity');

                $ticketsremaining = DB::table('events')
                    ->where('events.name', 'like', '%' . $request->input('name') . '%')
//                    ->orWhere('users.name', 'like', '%' . $request->input('name') . '%')
                    ->whereYear('events.created_at' , request('year'))
                    ->sum('number_of_tickets');


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
                $duration= ' ' . request('name'). ' FOR THE MONTH OF ' . request('month'). ' in '. request('year');
                $total = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->whereYear('tickets.created_at' , request('year'))
                    ->whereMonth('tickets.created_at' , $monthnumber )
                    ->where('events.name', 'like', '%' . $request->input('name') . '%')
                    ->orWhere('users.name', 'like', '%' . $request->input('name') . '%')
                    ->sum('tickets.charges');


                $ticketssold = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->join('events', 'events.id', '=', 'tickets.event_id')
                    ->whereYear('tickets.created_at' , request('year'))
                    ->whereMonth('tickets.created_at' , $monthnumber )
                    ->where('events.name', 'like', '%' . $request->input('name') . '%')
                    ->orWhere('users.name', 'like', '%' . $request->input('name') . '%')
                    ->sum('tickets.quantity');

                $ticketsremaining = DB::table('events')
                    ->where('events.name', 'like', '%' . $request->input('name') . '%')
                    ->whereYear('events.created_at' , request('year'))
                    ->whereMonth('events.created_at' , $monthnumber )
                    ->sum('events.number_of_tickets');
            }
        }


        return view("reports", compact('tickets', 'total', 'duration', 'ticketssold', 'ticketsremaining'));
    }

    }
