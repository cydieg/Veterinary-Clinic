<?php

use Illuminate\Support\Facades\Route;

Route::get('/client', function () {
    return 'Anyong client';
});

Route::get('/home', function () {
    return view('home');
})->name('home'); // Give a name to the route


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/dentalClinic', function () {
    return view('dentalClinic');
})->name('dentalClinic');

Route::get('/map', function () {
    return view('map');
})->name('map');

