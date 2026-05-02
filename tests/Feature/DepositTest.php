<?php

use App\Enums\DepositCategory;
use App\Models\Deposit;
use App\Models\Fee;
use App\Models\Player;
use App\Models\Season;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('a deposit belongs to a season', function () {
    $season = Season::factory()->create();
    $deposit = Deposit::factory()->create(['season_id' => $season->id]);

    expect($deposit->season)->toBeInstanceOf(Season::class)
        ->and($deposit->season->id)->toBe($season->id);
});

it('a season has many deposits', function () {
    $season = Season::factory()->create();
    Deposit::factory()->count(3)->create(['season_id' => $season->id]);

    expect($season->deposits)->toHaveCount(3);
});

it('a deposit can optionally belong to a fee', function () {
    $player = Player::factory()->create();
    $fee = Fee::factory()->create(['player_id' => $player->id]);
    $deposit = Deposit::factory()->create(['fee_id' => $fee->id]);

    expect($deposit->fee)->toBeInstanceOf(Fee::class)
        ->and($deposit->fee->id)->toBe($fee->id);
});

it('a deposit fee_id is nullable', function () {
    $deposit = Deposit::factory()->create(['fee_id' => null]);

    expect($deposit->fee)->toBeNull();
});

it('calculates total deposits for a season', function () {
    $season = Season::factory()->create();
    Deposit::factory()->create(['season_id' => $season->id, 'amount' => 100.00]);
    Deposit::factory()->create(['season_id' => $season->id, 'amount' => 250.00]);

    expect($season->totalDeposits())->toBe(350.0);
});

it('creating a fee auto-creates a deposit via observer', function () {
    $season = Season::factory()->create();
    $player = Player::factory()->create(['season_id' => $season->id]);

    expect(Deposit::count())->toBe(0);

    $fee = Fee::factory()->create(['player_id' => $player->id, 'amount' => 75.00]);

    expect(Deposit::count())->toBe(1);

    $deposit = Deposit::first();
    expect($deposit->season_id)->toBe($season->id)
        ->and($deposit->fee_id)->toBe($fee->id)
        ->and((float) $deposit->amount)->toBe(75.0)
        ->and($deposit->category)->toBe(DepositCategory::PlayerFees);
});

it('updating a fee updates its linked deposit', function () {
    $season = Season::factory()->create();
    $player = Player::factory()->create(['season_id' => $season->id]);
    $fee = Fee::factory()->create(['player_id' => $player->id, 'amount' => 50.00]);

    $fee->update(['amount' => 90.00]);

    expect((float) $fee->deposit->fresh()->amount)->toBe(90.0);
});

it('deleting a fee deletes its linked deposit', function () {
    $season = Season::factory()->create();
    $player = Player::factory()->create(['season_id' => $season->id]);
    Fee::factory()->create(['player_id' => $player->id, 'amount' => 50.00]);

    expect(Deposit::count())->toBe(1);

    Fee::first()->delete();

    expect(Deposit::count())->toBe(0);
});

it('deleting a season cascades to its deposits', function () {
    $season = Season::factory()->create();
    Deposit::factory()->count(3)->create(['season_id' => $season->id]);

    $season->delete();

    expect(Deposit::where('season_id', $season->id)->count())->toBe(0);
});
