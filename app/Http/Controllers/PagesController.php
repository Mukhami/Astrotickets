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

    //Checkout Page
    public function checkout()
    {
        return view('checkout');
    }

    //Reports Page
    public function reports()
    {
        return view('reports');
    }

}
