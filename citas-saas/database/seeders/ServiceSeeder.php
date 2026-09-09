<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $business = Business::first();

        $services = [
            [
                'name'             => 'Corte de cabello',
                'description'      => 'Corte clásico o moderno a tu elección',
                'duration_minutes' => 30,
                'price'            => 25000,
            ],
            [
                'name'             => 'Corte y barba',
                'description'      => 'Corte de cabello más arreglo de barba',
                'duration_minutes' => 45,
                'price'            => 35000,
            ],
            [
                'name'             => 'Afeitado clásico',
                'description'      => 'Afeitado tradicional con navaja y toalla caliente',
                'duration_minutes' => 30,
                'price'            => 20000,
            ],
            [
                'name'             => 'Corte infantil',
                'description'      => 'Corte especial para niños hasta 12 años',
                'duration_minutes' => 20,
                'price'            => 18000,
            ],
            [
                'name'             => 'Tratamiento capilar',
                'description'      => 'Hidratación y cuidado del cabello',
                'duration_minutes' => 45,
                'price'            => 40000,
            ],
        ];

        foreach ($services as $service) {
            Service::create([
                'business_id'      => $business->id,
                'name'             => $service['name'],
                'description'      => $service['description'],
                'duration_minutes' => $service['duration_minutes'],
                'price'            => $service['price'],
                'is_active'        => true,
            ]);
        }
    }
}