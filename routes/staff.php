<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;


Route::get('/homeStaff', function () {
    return view('homeStaff');
})->name('homeStaff');