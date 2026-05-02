<?php

namespace App\Livewire;

use App\Models\Announcement;
use Livewire\Component;

class AnnouncementPage extends Component
{
    public function render()
    {
        $announcements = Announcement::query()
            ->where('is_published', true)
            ->latest()
            ->get();

        return view('livewire.announcement-page', compact('announcements'));
    }
}
