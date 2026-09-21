<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    protected DashboardRepository $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getDashboardData()
    {
        $students = $this->dashboardRepository->getStudents();
        $attendances = $this->dashboardRepository->getAttendances();
        $sessionHistory = $this->dashboardRepository->getSessions();
        $activeSession = $this->dashboardRepository->getActiveSession();

        $totalStudents = count($students);

        $totalSessions = count($sessionHistory);

        $today = now()->format('Y-m-d');

        $attendanceToday = collect($attendances)
            ->where('tanggal', $today)
            ->count();

        return [
            'totalStudents' => $totalStudents,
            'totalSessions' => $totalSessions,
            'attendanceToday' => $attendanceToday,
            'activeSession' => $activeSession,
            'recentAttendances' => array_slice(
                array_reverse($attendances),
                0,
                5
            ),
        ];
    }
}