<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    protected $fillable = [
        'employee_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Constantes para los días de la semana
    const DAYS = [
        0 => 'Domingo',
        1 => 'Lunes',
        2 => 'Martes',
        3 => 'Miércoles',
        4 => 'Jueves',
        5 => 'Viernes',
        6 => 'Sábado',
    ];

    // Un horario pertenece a un empleado
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    // Obtener el nombre del día
    public function getDayNameAttribute(): string
    {
        return self::DAYS[$this->day_of_week];
    }
}