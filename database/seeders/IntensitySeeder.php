<?php

namespace Database\Seeders;

use App\Models\Intensity;
use Illuminate\Database\Seeder;

class IntensitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $intensities = [
            'Piramidale Crescente',
            'Piramidale Inverso',
            'Superset',
            'Triset',
            'Stripping',
            'Rest Pause',
            'Doppio Rest Pause',
            'Triplo Rest Pause',
            'Emom',
            'Ladder',
            'Jump Set',
            'Giant Set',
            'Super Slow',
            'Serie A 21',
            'Peak Contraction',
            'Negative',
            'Sst Training',
            'Ciclo Russo',
            '5X5 Set',
            '10X10 Set',
            'Old School 1-10-1',
            'Complete+Parz',
            'Ripetizioni Totali',
        ];

        foreach ($intensities as $intensity) {
            Intensity::create([
                'name' => $intensity
            ]);
        }
    }
}
