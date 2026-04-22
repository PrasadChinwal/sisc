<?php

use App\Livewire\AboutPage;
use App\Livewire\AnnouncementPage;
use App\Livewire\GalleryPage;
use App\Livewire\HomePage;
use App\Livewire\TeamPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)
    ->name('home');
Route::get('/about', AboutPage::class)
    ->name('about');
Route::get('/announcement', AnnouncementPage::class)
    ->name('announcement');
Route::get('/team', TeamPage::class)
    ->name('team');
Route::get('/gallery', GalleryPage::class)
    ->name('gallery');
