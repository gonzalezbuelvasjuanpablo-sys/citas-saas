<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BusinessSeeder extends Seeder
{
    public function run(): void
    {
        Business::create([
            'name'          => 'Barbería El Tigre',
            'slug'          => Str::slug('Barbería El Tigre'),
            'business_type' => 'barbershop',
            'phone'         => '+57 300 123 4567',
            'email'         => 'contacto@barberiaeltigre.com',
            'address'       => 'Calle 72 #45-23, Barranquilla',
            'timezone'      => 'America/Bogota',
            'is_active'     => true,
        ]);
    }
}
