<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //Contact Us Page
    public function contact()
    {
        return view('contact');
    }
}
