<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'business_id', 'client_id', 'employee_id',
        'service_id', 'starts_at', 'ends_at', 'status', 'notes',
    ];
    protected $casts = ['starts_at' => 'datetime', 'ends_at' => 'datetime'];

    const STATUS_PENDING   = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_COMPLETED = 'completed';
    const STATUS_NO_SHOW   = 'no_show';

    public function business(): BelongsTo { return $this->belongsTo(Business::class); }
    public function client(): BelongsTo { return $this->belongsTo(Client::class); }
    public function employee(): BelongsTo { return $this->belongsTo(Employee::class); }
    public function service(): BelongsTo { return $this->belongsTo(Service::class); }
}