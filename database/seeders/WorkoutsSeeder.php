<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkoutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assigned = Workout::create([
            'name' => 'Workout A',
            'user_id' => User::role('personal-trainer')->first()->id,
            'athlete_id' => User::role('athlete')->first()->id,
            'duration' => fake()->numberBetween(1, 4),
            'start_date' => now(),
            'goal' => 'dimagrimento'
        ]);

        $not_assigned = Workout::create([
            'name' => 'Workout B',
            'user_id' => User::role('personal-trainer')->first()->id,
            'duration' => fake()->numberBetween(1, 4),
            'start_date' => now(),
            'goal' => 'powerbuilding'
        ]);
    }
}
