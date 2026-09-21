<?php

namespace App\Repositories;

class DashboardRepository
{
    protected GoogleSheetRepository $googleSheetRepository;

    protected ?array $dashboardData = null;

    public function __construct(
        GoogleSheetRepository $googleSheetRepository
    ) {
        $this->googleSheetRepository = $googleSheetRepository;
    }

    protected function getDashboardData()
    {
        if ($this->dashboardData === null) {
            $this->dashboardData =
                $this->googleSheetRepository->getDashboardData();
        }

        return $this->dashboardData;
    }

    public function getStudents()
    {
        return $this->getDashboardData()['students'] ?? [];
    }

    public function getAttendances()
    {
        return $this->getDashboardData()['attendances'] ?? [];
    }

    public function getSessions()
    {
        return $this->getDashboardData()['meetings'] ?? [];
    }

    public function getActiveSession()
    {
        $meetings = $this->getDashboardData()['meetings'] ?? [];

        return collect($meetings)
            ->filter(function ($meeting) {
                return ($meeting['status'] ?? '') === 'AKTIF';
            })
            ->last();
    }
}