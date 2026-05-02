<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'body' => fake()->paragraphs(3, true),
            'is_published' => fake()->boolean(70),
        ];
    }

    public function published(): static
    {
        return $this->state(['is_published' => true]);
    }

    public function unpublished(): static
    {
        return $this->state(['is_published' => false]);
    }
}
