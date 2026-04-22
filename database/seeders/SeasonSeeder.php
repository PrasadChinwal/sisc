<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Season;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Season::factory()
            ->has(
                Player::factory(30)
            )
            ->create();
    }
}
