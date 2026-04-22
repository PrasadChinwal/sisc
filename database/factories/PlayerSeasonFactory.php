<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlayerSeason>
 */
class PlayerSeasonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'player_id' => Player::factory()->create(),
            'season_id' => Season::factory()->create(),
        ];
    }
}
