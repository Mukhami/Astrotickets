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

    public $order;
    public $user;
    public $ticket;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($order)
    {
    $this->order = $order;
        }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->to($this->order->user->email, $this->order->user->name)
                    ->subject('Your Purchased Ticket(s).')
                    ->view('emails.orders.placed', compact('order', 'user'));
    }
}
