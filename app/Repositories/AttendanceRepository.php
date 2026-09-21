<?php

namespace App\Repositories;

class AttendanceRepository
{
    public function getAttendances()
    {
        return session('attendances', []);
    }

    public function saveAttendance(array $attendance)
    {
        $attendances = $this->getAttendances();

        $attendances[] = $attendance;

        session([
            'attendances' => $attendances
        ]);

        return $attendance;
    }
}