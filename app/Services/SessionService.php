<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Repositories\SessionRepository;
use App\Repositories\GoogleSheetRepository;

class SessionService
{
    protected SessionRepository $sessionRepository;
    protected CourseRepository $courseRepository;
    protected GoogleSheetRepository $googleSheetRepository;

public function __construct(
    SessionRepository $sessionRepository,
    CourseRepository $courseRepository,
    GoogleSheetRepository $googleSheetRepository
) {
    $this->sessionRepository = $sessionRepository;
    $this->courseRepository = $courseRepository;
    $this->googleSheetRepository = $googleSheetRepository;
}

    public function createSession(array $data)
    {
        // Cek apakah masih ada sesi yang aktif
        $activeSession = $this->getActiveSession();

        if ($activeSession) {
            return [
                'success' => false,
                'message' => 'Masih ada sesi yang sedang berlangsung. Akhiri sesi tersebut terlebih dahulu.'
            ];
        }

// Cek apakah pertemuan sudah pernah dilakukan di Google Sheets
$completedMeetings = $this->getCompletedMeetings(
    $data['mata_kuliah'],
    $data['kelas']
);

$meetingCompleted = in_array(
    (int) $data['pertemuan'],
    $completedMeetings
);

if ($meetingCompleted) {
    return [
        'success' => false,
        'message' => 'Pertemuan ' . $data['pertemuan'] .
            ' untuk mata kuliah tersebut sudah pernah dilakukan.'
    ];
}



        $course = $this->courseRepository->findByCourseName(
    $data['mata_kuliah']
);

if (!$course) {
    return [
        'success' => false,
        'message' => 'Mata kuliah tidak ditemukan.'
    ];
}
$session = [
    'id' => uniqid(),
    'kode_mata_kuliah' => $course['kode'],
    'mata_kuliah' => $course['mata_kuliah'],
    'kelas' => $data['kelas'],
    'pertemuan' => $data['pertemuan'],
    'materi' => $data['materi'],
    'tanggal' => $data['tanggal'],
    'jam' => $data['jam'],
    'status' => 'AKTIF',
];

$meetingResult = $this->googleSheetRepository->createMeeting([
    'id' => $session['id'],
    'kode_mata_kuliah' => $course['kode'],
    'mata_kuliah' => $course['mata_kuliah'],
    'kelas' => $data['kelas'],
    'pertemuan' => $data['pertemuan'],
    'materi' => $data['materi'],
    'tanggal' => $data['tanggal'],
    'jam' => $data['jam'],
    'status' => 'AKTIF',
]);

if (!($meetingResult['success'] ?? false)) {
    return [
        'success' => false,
        'message' => $meetingResult['message']
            ?? 'Gagal menyimpan data pertemuan ke Google Sheets.'
    ];
}

return $this->sessionRepository->saveSession($session);
    }

public function getSessions()
{
    $meetings = $this->googleSheetRepository->getMeetings();

    return collect($meetings)
        ->map(function ($meeting) {
            return [
                'id' => $meeting['id'],
                'kode_mata_kuliah' => $meeting['kode_mata_kuliah'],
                'mata_kuliah' => $meeting['mata_kuliah'],
                'kelas' => $meeting['kelas'],
                'pertemuan' => $meeting['pertemuan'],
                'materi' => $meeting['materi'],
'tanggal' => \Carbon\Carbon::parse(
    preg_replace('/\s+\([^)]*\)$/', '', $meeting['tanggal'])
)->format('Y-m-d'),
                'jam' => $meeting['jam'],
                'status' => $meeting['status'],
            ];
        })
        ->values()
        ->toArray();
}

public function getActiveSession()
{
    $meetings = $this->googleSheetRepository->getMeetings();

    $activeMeeting = collect($meetings)
        ->filter(function ($meeting) {
            return $meeting['status'] === 'AKTIF';
        })
        ->last();

    if (!$activeMeeting) {
        return null;
    }

    return [
        'id' => $activeMeeting['id'],
        'kode_mata_kuliah' => $activeMeeting['kode_mata_kuliah'],
        'mata_kuliah' => $activeMeeting['mata_kuliah'],
        'kelas' => $activeMeeting['kelas'],
        'pertemuan' => $activeMeeting['pertemuan'],
        'materi' => $activeMeeting['materi'],
        'tanggal' => $activeMeeting['tanggal'],
        'jam' => $activeMeeting['jam'],
        'status' => $activeMeeting['status'],
    ];
}

public function setActiveSession(array $session)
{
    return $this->sessionRepository->setActiveSession($session);
}

public function getCompletedMeetings(
    string $mataKuliah,
    string $kelas
) {
    $meetings = $this->googleSheetRepository->getMeetings();

    return collect($meetings)
        ->filter(function ($meeting) use ($mataKuliah, $kelas) {
            return $meeting['mata_kuliah'] === $mataKuliah
                && $meeting['kelas'] === $kelas
                && $meeting['status'] === 'SELESAI';
        })
        ->pluck('pertemuan')
        ->map(fn ($pertemuan) => (int) $pertemuan)
        ->values()
        ->toArray();
}
public function endSession()
{
    $activeSession = $this->sessionRepository->getActiveSession();

    if (!$activeSession) {
        return [
            'success' => false,
            'message' => 'Tidak ada sesi yang sedang aktif.'
        ];
    }

    $googleResult = $this->googleSheetRepository->updateMeetingStatus(
        $activeSession['id'],
        'SELESAI'
    );

    if (!($googleResult['success'] ?? false)) {
        return [
            'success' => false,
            'message' => $googleResult['message']
                ?? 'Gagal memperbarui status sesi di Google Sheets.'
        ];
    }

    $this->sessionRepository->endActiveSession();

    return [
        'success' => true,
        'message' => 'Sesi berhasil diakhiri.'
    ];
}
}