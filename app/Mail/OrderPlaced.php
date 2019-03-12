<?php

namespace App\Mail;

use App\User;
use App\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', '=', $user_id)->firstOrFail();
        $tickets = Ticket::where('user_id', '=', $user_id)->get();
        return view("emails.orders.placed", compact('user', 'tickets'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->to('email@email.com', 'BUYER')
                    ->subject('Your Purchased Ticket.')
                    ->view('emails.orders.placed');
    }
}
