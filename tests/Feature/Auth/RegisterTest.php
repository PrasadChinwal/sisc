<?php

use App\Filament\Pages\Auth\Register;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders the registration page', function () {
    $this->get('/admin/register')->assertSuccessful();
});

it('registers a user with first and last name', function () {
    Livewire::test(Register::class)
        ->fillForm([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'password' => 'password',
            'passwordConfirmation' => 'password',
        ])
        ->call('register')
        ->assertHasNoFormErrors();

    $user = User::where('email', 'jane@example.com')->first();

    expect($user)->not->toBeNull()
        ->and($user->first_name)->toBe('Jane')
        ->and($user->last_name)->toBe('Doe')
        ->and($user->fresh()->name)->toBe('Jane Doe');
});

it('requires first name', function () {
    Livewire::test(Register::class)
        ->fillForm([
            'first_name' => '',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'password' => 'password',
            'passwordConfirmation' => 'password',
        ])
        ->call('register')
        ->assertHasFormErrors(['first_name' => 'required']);
});

it('requires last name', function () {
    Livewire::test(Register::class)
        ->fillForm([
            'first_name' => 'Jane',
            'last_name' => '',
            'email' => 'jane@example.com',
            'password' => 'password',
            'passwordConfirmation' => 'password',
        ])
        ->call('register')
        ->assertHasFormErrors(['last_name' => 'required']);
});

it('requires a unique email', function () {
    User::factory()->create(['email' => 'jane@example.com']);

    Livewire::test(Register::class)
        ->fillForm([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'password' => 'password',
            'passwordConfirmation' => 'password',
        ])
        ->call('register')
        ->assertHasFormErrors(['email' => 'unique']);
});
