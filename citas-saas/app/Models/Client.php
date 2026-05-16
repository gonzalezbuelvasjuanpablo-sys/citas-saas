<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = [
        'business_id',
        'user_id',
        'name',
        'email',
        'phone',
        'notes',
    ];

    // Un cliente pertenece a un negocio
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    // Un cliente puede tener un usuario asociado
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Un cliente tiene muchas citas
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}