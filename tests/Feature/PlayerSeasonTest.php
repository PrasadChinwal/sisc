<?php

use App\Models\Player;
use App\Models\Season;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('a player belongs to a season', function () {
    $season = Season::factory()->active()->create();
    $player = Player::factory()->create(['season_id' => $season->id]);

    expect($player->season)->toBeInstanceOf(Season::class)
        ->and($player->season->id)->toBe($season->id);
});

it('a season has many players', function () {
    $season = Season::factory()->active()->create();
    Player::factory()->count(3)->create(['season_id' => $season->id]);

    expect($season->players)->toHaveCount(3);
});

it('cannot delete a season that has players', function () {
    $season = Season::factory()->active()->create();
    Player::factory()->create(['season_id' => $season->id]);

    expect(fn () => $season->delete())->toThrow(QueryException::class);
});
