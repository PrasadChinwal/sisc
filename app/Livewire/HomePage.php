<?php

namespace App\Livewire;

use Filament\Pages\SimplePage;

class HomePage extends SimplePage
{
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.home-page');
    }
}
