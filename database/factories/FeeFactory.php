<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fee>
 */
class FeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'player_id' => Player::factory(),
            'amount' => fake()->randomFloat(2, 10, 200),
            'notes' => fake()->optional()->sentence(),
            'paid_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
