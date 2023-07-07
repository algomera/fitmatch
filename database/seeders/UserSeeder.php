<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin = User::factory()->create([
            'email' => 'admin@example.test',
            'status' => null
        ]);
        $admin->assignRole('admin');
        $admin->informations()->create([
            'first_name' => 'Admin',
        ]);

        // Personal Trainer
        $pt = User::factory()->create([
            'email' => 'pt@example.test',
            'onboarding_current_step' => 12,
            'status' => 'waiting',
        ]);
        $pt->assignRole('personal-trainer');
        $pt->informations()->create([
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'dob' => fake()->dateTimeBetween(),
            'phone' => fake()->phoneNumber,
            'city' => fake()->city,
            'profile_type' => 'public',
            'remote' => false,
            'in_person' => true,
            'company_name' => fake()->company,
            'company_address' => fake()->streetName,
            'company_civic' => fake()->numberBetween(0, 99),
            'company_city' => fake()->city,
            'company_zip_code' => fake()->numerify('#####'),
            'company_vat_number' => fake()->numerify('IT###########'),
            'bio' => fake()->paragraph,
        ]);
    }
}
