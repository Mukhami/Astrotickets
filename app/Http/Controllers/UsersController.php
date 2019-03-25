<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Ticket;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function index()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', '=', $user_id)->firstOrFail();
        $tickets = Ticket::where('user_id', '=', $user_id)
                            ->get();
        return view("user.index", compact('user', 'tickets'));
    }
    public function showedit(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::where('id', '=', $user_id)->firstOrFail();
        return view("user.edit", compact('user'));
    }

    public function editinfo(Request $request)
    {
        $user_id = $request->get('id');
        $name = $request->get('name');
        $email = $request->get('email');
        $phonenumber = $request->get('phonenumber');

        $user = User::find($user_id);
        $user->name = $name;
        $user->email=$email;
        $user->phone_number =$phonenumber;

        $user->save();

        return redirect('user')->with('status', 'You details have been changed successfully');
    }

    //Send Ticket Cancellation Request Page

    public function cancelticket(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::where('id', '=', $user_id)->firstOrFail();
       return view('cancelticket', compact('user'));
//        return view('cancelticket');
    }

    public function cancelticketmail(Request $request){
        $this->validate($request, [
            'name' =>'required',
            'email'=>'required|email',
            'message'=>'required',
        ]);

        Mail::send('emails.issues.cancellation', [
            'ticketnumber'=> $request->ticketnumber,
            'msg' => $request->message
        ]
            , function($mail) use($request){
            $mail->from($request->email, $request->name);
            $mail->to('admin@admin.com')->subject($request->subject);
        });

        return redirect('user')->with('status', 'We have received your response, we shall be contacting you soon!');

//   DD($data);
    }
}
