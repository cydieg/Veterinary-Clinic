<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function dentalClinic()
    {
        return view('dentalClinic');
    }

    public function map()
    {
        return view('map');
    }

    public function showDashboard()
    {
        return view('userDashboard.home');
    }
}



