<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapingController extends Controller
{
    public function index()
    {
        return view('mapping.map');
    }
}
