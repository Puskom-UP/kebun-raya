<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// LANDINGPAGE
Route::livewire('/', 'front.home')->name('home');;
Route::livewire('/tentang-kami', 'front.tentang-kami')->name('tentang-kami');



// ADMIN
Route::livewire('/login', 'auth.login')->name('login');

Route::livewire('/admin', 'admin.dashboard')->name('dashboard');

Route::get('/about', function () {
    return view('about');
});
