<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showDashboard()
    {
        return view('userDashboard.home');
    }

    public function profileSetting()
    {
        return view('userDashboard.Profile setting');
    }

    public function changePassword()
    {
        return view('userDashboard.change password');
    }

    public function message()
    {
        return view('userDashboard.message');
    }
}



