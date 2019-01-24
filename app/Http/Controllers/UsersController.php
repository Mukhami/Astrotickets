<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();
        return view("user.index", compact('user'));
    }
    public function showedit($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();
        return view("user.edit", compact('user'));
    }
}
