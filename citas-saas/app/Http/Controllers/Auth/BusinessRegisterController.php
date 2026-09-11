<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BusinessRegisterController extends Controller
{
    public function show()
    {
        return view('auth.business-register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string',
            'phone'         => 'required|string|max:20',
            'address'       => 'required|string',
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:8|confirmed',
        ]);

        // Crear negocio
        $business = Business::create([
            'name'          => $request->business_name,
            'slug'          => Str::slug($request->business_name) . '-' . Str::random(4),
            'business_type' => $request->business_type,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'timezone'      => 'America/Bogota',
            'is_active'     => true,
        ]);

        // Crear usuario dueño
        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'business_id' => $business->id,
        ]);
        $user->assignRole('business_owner');

        // Iniciar sesión automáticamente
        auth()->login($user);

        return redirect()->route('business.dashboard')
            ->with('success', '¡Bienvenido! Tu negocio ha sido registrado.');
    }
}