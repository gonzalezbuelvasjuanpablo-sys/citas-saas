<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Business;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $business = Business::first();

        $juan = User::where('email', 'juan@barberiaeltigre.com')->first();
        $luis = User::where('email', 'luis@barberiaeltigre.com')->first();

        Employee::create([
            'business_id' => $business->id,
            'user_id'     => $juan->id,
            'title'       => 'Barbero Senior',
            'is_active'   => true,
        ]);

        Employee::create([
            'business_id' => $business->id,
            'user_id'     => $luis->id,
            'title'       => 'Barbero',
            'is_active'   => true,
        ]);
    }
}