<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\User;

class EmployeePolicy
{
    public function update(User $user, Employee $employee): bool
    {
        return $user->business_id === $employee->business_id;
    }

    public function delete(User $user, Employee $employee): bool
    {
        return $user->business_id === $employee->business_id;
    }
}