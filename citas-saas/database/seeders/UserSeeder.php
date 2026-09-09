<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Business;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $business = Business::first();

        $owner = User::create([
            'name'        => 'Carlos Martínez',
            'email'       => 'carlos@barberiaeltigre.com',
            'password'    => Hash::make('password'),
            'business_id' => $business->id,
        ]);
        $owner->assignRole('business_owner');

        $barber1 = User::create([
            'name'        => 'Juan Pérez',
            'email'       => 'juan@barberiaeltigre.com',
            'password'    => Hash::make('password'),
            'business_id' => $business->id,
        ]);
        $barber1->assignRole('employee');

        $barber2 = User::create([
            'name'        => 'Luis García',
            'email'       => 'luis@barberiaeltigre.com',
            'password'    => Hash::make('password'),
            'business_id' => $business->id,
        ]);
        $barber2->assignRole('employee');

        $client = User::create([
            'name'        => 'Pedro Rodríguez',
            'email'       => 'pedro@gmail.com',
            'password'    => Hash::make('password'),
            'business_id' => null,
        ]);
        $client->assignRole('client');
    }
}