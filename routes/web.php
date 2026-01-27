<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::livewire('/', 'front.home')->name('home');;
Route::livewire('/tentang-kami', 'front.tentang-kami')->name('tentang-kami');;


Route::get('/about', function () {
    return view('about');
});
