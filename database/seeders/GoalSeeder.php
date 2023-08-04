<?php

namespace Database\Seeders;

use App\Models\Goal;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $goals = [
            'Dimagrimento/Ricomposizione corporea',
            'Percorso riabilitativo post trauma/post parto',
            'Resistenza cardio-respiratoria (allenamento improntato per la performance aerobica, cardio)',
            'Tonificazione muscolare',
            'Aumento della mobilità articolare (ginnastica posturale-allungamento)',
            'Ipertrofia muscolare (aumento massa magra)',
            'Powerbuilding (programmi di aumento della forza)'
        ];

        foreach ($goals as $goal) {
            Goal::create([
                'name' => $goal
            ]);
        }
    }
}
