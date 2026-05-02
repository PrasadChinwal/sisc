<?php

use App\Models\Fee;
use App\Models\Player;
use App\Models\Season;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('a player has many fees', function () {
    $player = Player::factory()->create();
    Fee::factory()->count(3)->create(['player_id' => $player->id]);

    expect($player->fees)->toHaveCount(3);
});

it('a fee belongs to a player', function () {
    $player = Player::factory()->create();
    $fee = Fee::factory()->create(['player_id' => $player->id]);

    expect($fee->player)->toBeInstanceOf(Player::class)
        ->and($fee->player->id)->toBe($player->id);
});

it('calculates the total paid correctly', function () {
    $player = Player::factory()->create();
    Fee::factory()->create(['player_id' => $player->id, 'amount' => 50.00]);
    Fee::factory()->create(['player_id' => $player->id, 'amount' => 30.00]);

    expect($player->totalPaid())->toBe(80.0);
});

it('calculates the balance correctly', function () {
    $season = Season::factory()->create(['registration_fee' => 120.00]);
    $player = Player::factory()->create(['season_id' => $season->id]);
    Fee::factory()->create(['player_id' => $player->id, 'amount' => 50.00]);

    expect($player->balance())->toBe(70.0);
});

it('treats a zero registration fee as zero when calculating balance', function () {
    $season = Season::factory()->create(['registration_fee' => 0]);
    $player = Player::factory()->create(['season_id' => $season->id]);
    Fee::factory()->create(['player_id' => $player->id, 'amount' => 25.00]);

    expect($player->balance())->toBe(-25.0);
});

it('reports fully paid when balance is zero', function () {
    $season = Season::factory()->create(['registration_fee' => 100.00]);
    $player = Player::factory()->create(['season_id' => $season->id]);
    Fee::factory()->create(['player_id' => $player->id, 'amount' => 100.00]);

    expect($player->isFullyPaid())->toBeTrue();
});

it('reports not fully paid when balance remains', function () {
    $season = Season::factory()->create(['registration_fee' => 100.00]);
    $player = Player::factory()->create(['season_id' => $season->id]);
    Fee::factory()->create(['player_id' => $player->id, 'amount' => 60.00]);

    expect($player->isFullyPaid())->toBeFalse();
});

it('deleting a player cascades to fees', function () {
    $player = Player::factory()->create();
    Fee::factory()->count(2)->create(['player_id' => $player->id]);

    $player->delete();

    expect(Fee::where('player_id', $player->id)->count())->toBe(0);
});
