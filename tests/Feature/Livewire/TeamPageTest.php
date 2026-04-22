<?php

use App\Livewire\TeamPage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(TeamPage::class)
        ->assertStatus(200);
});
