<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Ticket;

class UsersController extends Controller
{
    public function index()
    {
        $user_id=Auth::user()->id;
        $user = User::where('id', '=', $user_id)->firstOrFail();
        $tickets = Ticket::where('user_id', '=', $user_id)->get();
        return view("user.index", compact('user', 'tickets'));
    }
    public function showedit($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();
        return view("user.edit", compact('user'));
    }

}
