<?php

use App\Livewire\HomePage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(HomePage::class)
        ->assertStatus(200);
});
