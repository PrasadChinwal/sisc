<?php

use App\Livewire\AnnouncementPage;
use App\Models\Announcement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders successfully', function () {
    Livewire::test(AnnouncementPage::class)
        ->assertStatus(200);
});

it('displays published announcements', function () {
    $published = Announcement::factory()->published()->create(['title' => 'Published Title']);

    Livewire::test(AnnouncementPage::class)
        ->assertSee('Published Title');
});

it('does not display unpublished announcements', function () {
    $unpublished = Announcement::factory()->unpublished()->create(['title' => 'Draft Title']);

    Livewire::test(AnnouncementPage::class)
        ->assertDontSee('Draft Title');
});

it('shows empty state when no published announcements exist', function () {
    Livewire::test(AnnouncementPage::class)
        ->assertSee('No announcements at this time.');
});
