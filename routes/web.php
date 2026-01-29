<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
// Route::get('/', function () {
//     return view('welcome');
// });


// LANDINGPAGE
Route::livewire('/', 'front.home')->name('home');;
Route::livewire('/tentang-kami', 'front.tentang-kami')->name('tentang-kami');
Route::livewire('/berita/{post:slug}', 'admin.berita-detail')->name('berita.show');


Route::livewire('/login', 'auth.login')->name('login');

// ADMIN
Route::livewire('/login', 'auth.login')->name('login');




Route::middleware(['auth'])->group(function () {

    Route::livewire('/admin', 'admin.dashboard')->name('dashboard');
    Route::livewire('/admin/berita', 'admin.berita')->name('berita');
});
