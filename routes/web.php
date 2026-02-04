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



Route::livewire('/berita', 'front.news-index')->name('news.index');

Route::livewire('/login', 'auth.login')->name('login');






Route::middleware(['auth'])->group(function () {

    Route::livewire('/admin', 'admin.dashboard')->name('dashboard');
    Route::livewire('/admin/berita', 'admin.berita')->name('berita');
    Route::livewire('/admin/setting', 'admin.pengaturan.index')->name('pengaturan');

    Route::livewire('/admin/mitra', 'admin.mitra')->name('mitra');


    Route::livewire('/admin/penghargaan', 'admin.penghargaan')->name('penghargaan');
});
