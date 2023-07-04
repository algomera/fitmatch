<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Spatie\Permission\Models\Role;

    class RolesPermissionsSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            // Ruoli
            $admin = Role::create(['name' => 'admin']);
            $personal_trainer = Role::create(['name' => 'personal-trainer']);
            $atlete = Role::create(['name' => 'atlete']);
        }
    }
