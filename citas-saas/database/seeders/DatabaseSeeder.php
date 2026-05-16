<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles primero
        Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'business_owner']);
        Role::create(['name' => 'employee']);
        Role::create(['name' => 'client']);

        // Correr seeders en orden
        $this->call([
            BusinessSeeder::class,
            UserSeeder::class,
            EmployeeSeeder::class,
            ServiceSeeder::class,
            ScheduleSeeder::class,
        ]);
    }
}