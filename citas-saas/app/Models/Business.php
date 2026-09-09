<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    protected $fillable = [
        'name', 'slug', 'business_type', 'phone',
        'email', 'address', 'timezone', 'logo', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function employees(): HasMany { return $this->hasMany(Employee::class); }
    public function services(): HasMany { return $this->hasMany(Service::class); }
    public function clients(): HasMany { return $this->hasMany(Client::class); }
    public function appointments(): HasMany { return $this->hasMany(Appointment::class); }
    public function users(): HasMany { return $this->hasMany(User::class); }
}