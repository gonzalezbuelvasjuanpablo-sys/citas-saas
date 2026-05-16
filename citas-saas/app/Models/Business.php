<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'business_type',
        'phone',
        'email',
        'address',
        'timezone',
        'logo',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Un negocio tiene muchos empleados
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    // Un negocio tiene muchos servicios
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    // Un negocio tiene muchos clientes
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    // Un negocio tiene muchas citas
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    // Un negocio tiene muchos usuarios
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}