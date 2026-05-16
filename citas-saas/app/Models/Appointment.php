<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'business_id',
        'client_id',
        'employee_id',
        'service_id',
        'starts_at',
        'ends_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    // Constantes de estados
    const STATUS_PENDING   = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_COMPLETED = 'completed';
    const STATUS_NO_SHOW   = 'no_show';

    // Una cita pertenece a un negocio
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    // Una cita pertenece a un cliente
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    // Una cita pertenece a un empleado
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    // Una cita pertenece a un servicio
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // Verificar si la cita está pendiente
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    // Verificar si la cita está confirmada
    public function isConfirmed(): bool
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    // Verificar si la cita fue cancelada
    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }
}