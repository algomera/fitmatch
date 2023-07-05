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
         $user = User::factory()->create([
             'email' => 'admin@example.test',
             'password' => bcrypt('password')
         ]);
         $user->assignRole('admin');
         $user->informations()->create([
             'first_name' => 'Admin',
         ]);
    }
}
