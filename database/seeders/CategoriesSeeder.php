<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Crossfit',
            'Fit-Boxe',
            'Corpo libero',
            'Body building',
            'Total Tone',
            'Pilates',
            'Yoga',
            'Spinning',
            'Aerobica'
        ];

        foreach ($categories as $category) {
            Categories::create([
                'slug' => Str::slug($category),
                'title' => $category
            ]);
        }
    }
}
