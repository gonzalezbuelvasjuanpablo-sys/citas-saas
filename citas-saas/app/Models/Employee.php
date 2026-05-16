<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = [
        'business_id',
        'user_id',
        'title',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Un empleado pertenece a un negocio
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    // Un empleado pertenece a un usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Un empleado tiene muchos horarios
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    // Un empleado tiene muchas citas
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
