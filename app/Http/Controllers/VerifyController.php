<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify($token){
        User::where('token', $token)->FirstorFail()
                ->update(['token' => null]);


        return redirect()->route('home')->with('success', 'Account successfully verified');

    }
}
