<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function home()
    {
        return view('Landing_Page.Home');
    }

    public function services()
    {
        return view('Landing_Page.Services');
    }

    public function ourClinic()
    {
        return view('Landing_Page.OurClinic');
    }

    public function ourShop()
    {
        return view('Landing_Page.OurShop');
    }

    public function contactUs()
    {
        return view('Landing_Page.ContactUs');
    }
}



