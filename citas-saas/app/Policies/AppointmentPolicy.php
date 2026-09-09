<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;

class AppointmentPolicy
{
    public function view(User $user, Appointment $appointment): bool
    {
        return $user->business_id === $appointment->business_id;
    }

    public function update(User $user, Appointment $appointment): bool
    {
        return $user->business_id === $appointment->business_id;
    }

    public function delete(User $user, Appointment $appointment): bool
    {
        return $user->business_id === $appointment->business_id;
    }
}