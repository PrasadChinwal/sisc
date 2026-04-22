<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'email' => 'prasad@test.com',
            'first_name' => 'Prasad',
            'last_name' => 'Chinwal',
        ]);
        $user->assignRole('super_admin');

        User::factory(10)->create();

        Artisan::call('shield:generate --panel=admin --all -n');
    }
}
