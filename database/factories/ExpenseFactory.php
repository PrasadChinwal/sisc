<?php

namespace Database\Factories;

use App\Enums\ExpenseCategory;
use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'season_id' => Season::factory(),
            'category' => fake()->randomElement(ExpenseCategory::cases()),
            'amount' => fake()->randomFloat(2, 10, 500),
            'description' => fake()->sentence(4),
            'notes' => fake()->optional()->sentence(),
            'expensed_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
