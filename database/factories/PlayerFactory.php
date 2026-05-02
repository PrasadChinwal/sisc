<?php

namespace Database\Factories;

use App\Enums\PlayingPosition;
use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'season_id' => Season::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date('Y-m-d', now()->subYears(18)),
            'email' => $this->faker->safeEmail(),
            'contact' => $this->faker->numerify('##########'),
            'positions' => $this->faker->randomElements(PlayingPosition::values(), fake()->numberBetween(1, 4), false),
        ];
    }
}
