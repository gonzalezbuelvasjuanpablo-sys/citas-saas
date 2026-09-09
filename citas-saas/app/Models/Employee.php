<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = ['business_id', 'user_id', 'title', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function business(): BelongsTo { return $this->belongsTo(Business::class); }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function schedules(): HasMany { return $this->hasMany(Schedule::class); }
    public function appointments(): HasMany { return $this->hasMany(Appointment::class); }
}