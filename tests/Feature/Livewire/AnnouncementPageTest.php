<?php

use App\Livewire\AnnouncementPage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(AnnouncementPage::class)
        ->assertStatus(200);
});
