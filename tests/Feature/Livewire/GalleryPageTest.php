<?php

use App\Livewire\GalleryPage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(GalleryPage::class)
        ->assertStatus(200);
});
