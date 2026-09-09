<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            foreach ([1, 2, 3, 4, 5] as $day) {
                Schedule::create([
                    'employee_id' => $employee->id,
                    'day_of_week' => $day,
                    'start_time'  => '08:00:00',
                    'end_time'    => '18:00:00',
                    'is_active'   => true,
                ]);
            }

            Schedule::create([
                'employee_id' => $employee->id,
                'day_of_week' => 6,
                'start_time'  => '08:00:00',
                'end_time'    => '16:00:00',
                'is_active'   => true,
            ]);
        }
    }
}