<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class GoogleSheetRepository
{
    protected string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('GOOGLE_SHEETS_API_URL');
    }

    public function getStudents()
    {
        $response = Http::withoutVerifying()
            ->get($this->apiUrl, [
                'action' => 'students',
            ]);

        if ($response->failed()) {
            return [];
        }

        $data = $response->json();

        return $data['data'] ?? [];
    }

public function getAttendances()
{
    $response = Http::withoutVerifying()
        ->get($this->apiUrl, [
            'action' => 'attendances',
        ]);

    if ($response->failed()) {
        return [];
    }

    $data = $response->json();

    return $data['data'] ?? [];
}

public function getMeetings()
{
    $response = Http::withoutVerifying()
        ->get($this->apiUrl, [
            'action' => 'meetings',
        ]);

    if ($response->failed()) {
        return [];
    }

    $data = $response->json();

    return $data['data'] ?? [];
}

public function getDashboardData()
{
    $response = Http::withoutVerifying()
        ->timeout(10)
        ->get($this->apiUrl, [
            'action' => 'dashboard',
        ]);

    if ($response->failed()) {
        return [
            'students' => [],
            'attendances' => [],
            'meetings' => [],
        ];
    }

    $data = $response->json();

    return [
        'students' => $data['data']['students'] ?? [],
        'attendances' => $data['data']['attendances'] ?? [],
        'meetings' => $data['data']['meetings'] ?? [],
    ];
}

    public function findStudentByQrCode(string $qrCode)
{
    $students = $this->getStudents();

    return collect($students)
        ->firstWhere('qr_id', $qrCode);
}

    public function createStudent(array $student)
    {
        $response = Http::withoutVerifying()
            ->asForm()
            ->post($this->apiUrl, [
                'action' => 'create_student',
                'nim' => $student['nim'],
                'nama' => $student['nama'],
                'kelas' => $student['kelas'],
                'status' => $student['status'] ?? 'Aktif',
            ]);

        if ($response->failed()) {
            return [
                'success' => false,
                'message' => 'Gagal terhubung ke Google Sheets.'
            ];
        }

        return $response->json();
    }

    public function updateStudent(
    string $oldNim,
    array $student
) {
    $response = Http::withoutVerifying()
        ->asForm()
        ->post($this->apiUrl, [
            'action' => 'update_student',
            'old_nim' => $oldNim,
            'nim' => $student['nim'],
            'nama' => $student['nama'],
            'kelas' => $student['kelas'],
            'status' => $student['status'] ?? 'Aktif',
        ]);

    if ($response->failed()) {
        return [
            'success' => false,
            'message' => 'Gagal terhubung ke Google Sheets.'
        ];
    }

    return $response->json();
}

public function deleteStudent(string $nim)
{
    $response = Http::withoutVerifying()
        ->asForm()
        ->post($this->apiUrl, [
            'action' => 'delete_student',
            'nim' => $nim,
        ]);

    if ($response->failed()) {
        return [
            'success' => false,
            'message' => 'Gagal terhubung ke Google Sheets.'
        ];
    }

    return $response->json();
}

public function createAttendance(array $attendance)
{
    $response = Http::withoutVerifying()
        ->asForm()
        ->post($this->apiUrl, [
            'action' => 'create_attendance',
            'id' => $attendance['id'] ?? null,
            'nim' => $attendance['nim'],
            'nama' => $attendance['nama'],
            'kode_mata_kuliah' => $attendance['kode_mata_kuliah'],
            'pertemuan' => $attendance['pertemuan'],
            'tanggal' => $attendance['tanggal'],
            'jam' => $attendance['jam'],
            'status' => $attendance['status'] ?? 'HADIR',
            'qr_id' => $attendance['qr_id'],
        ]);

    if ($response->failed()) {
        return [
            'success' => false,
            'message' => 'Gagal terhubung ke Google Sheets.'
        ];
    }

    return $response->json();
}

public function createMeeting(array $meeting)
{
    $response = Http::withoutVerifying()
        ->asForm()
        ->post($this->apiUrl, [
            'action' => 'create_meeting',
            'id' => $meeting['id'] ?? null,
            'kode_mata_kuliah' => $meeting['kode_mata_kuliah'],
            'mata_kuliah' => $meeting['mata_kuliah'],
            'kelas' => $meeting['kelas'],
            'pertemuan' => $meeting['pertemuan'],
            'materi' => $meeting['materi'],
            'tanggal' => $meeting['tanggal'],
            'jam' => $meeting['jam'],
            'status' => $meeting['status'] ?? 'AKTIF',
        ]);

    if ($response->failed()) {
        return [
            'success' => false,
            'message' => 'Gagal terhubung ke Google Sheets.'
        ];
    }

    return $response->json();
}

public function updateMeetingStatus(
    string $id,
    string $status
) {
    $response = Http::withoutVerifying()
        ->asForm()
        ->post($this->apiUrl, [
            'action' => 'update_meeting_status',
            'id' => $id,
            'status' => $status,
        ]);

    if ($response->failed()) {
        return [
            'success' => false,
            'message' => 'Gagal terhubung ke Google Sheets.'
        ];
    }

    return $response->json();
}

}