<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'business_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Un usuario pertenece a un negocio
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    // Un usuario puede ser empleado
    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    // Un usuario puede ser cliente
    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }
}
