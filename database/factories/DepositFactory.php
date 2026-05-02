<?php

namespace Database\Factories;

use App\Enums\DepositCategory;
use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deposit>
 */
class DepositFactory extends Factory
{
    public function definition(): array
    {
        return [
            'season_id' => Season::factory(),
            'fee_id' => null,
            'category' => fake()->randomElement(DepositCategory::cases()),
            'amount' => fake()->randomFloat(2, 10, 500),
            'description' => fake()->sentence(4),
            'notes' => fake()->optional()->sentence(),
            'deposited_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
