<?php

namespace Database\Seeders;

use App\Models\Category;
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
            Category::create([
                'slug' => Str::slug($category),
                'title' => $category
            ]);
        }
    }
}
