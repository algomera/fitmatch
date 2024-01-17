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
            $admin = Role::create([
                'name'  => 'admin',
                'label' => 'Amministratore'
            ]);
            $personal_trainer = Role::create([
                'name'  => 'personal-trainer',
                'label' => 'Personal Trainer'
            ]);
            $athlete = Role::create([
                'name'  => 'athlete',
                'label' => 'Atleta'
            ]);
        }
    }
