<?php

namespace App\Services;

use App\Repositories\GoogleSheetRepository;
use App\Repositories\AttendanceRepository;
use App\Repositories\StudentRepository;
use App\Repositories\SessionRepository;

class AttendanceService
{
protected AttendanceRepository $attendanceRepository;
protected StudentRepository $studentRepository;
protected SessionRepository $sessionRepository;
protected GoogleSheetRepository $googleSheetRepository;

public function __construct(
    AttendanceRepository $attendanceRepository,
    StudentRepository $studentRepository,
    SessionRepository $sessionRepository,
    GoogleSheetRepository $googleSheetRepository
) {
    $this->attendanceRepository = $attendanceRepository;
    $this->studentRepository = $studentRepository;
    $this->sessionRepository = $sessionRepository;
    $this->googleSheetRepository = $googleSheetRepository;
}

    public function processAttendance(string $qrCode)
    {
        /*
        |--------------------------------------------------------------------------
        | 1. CARI MAHASISWA BERDASARKAN QR CODE
        |--------------------------------------------------------------------------
        */

        $student = $this->googleSheetRepository->findStudentByQrCode($qrCode);

if ($student) {
    $student = [
        'id' => $student['nim'],
        'nim' => $student['nim'],
        'nama' => $student['nama'],
        'kelas' => $student['kelas'],
        'status' => $student['status'],
        'qr_code' => $student['qr_id'],
    ];
}

        if (!$student) {
            return [
                'success' => false,
                'message' => 'QR Code mahasiswa tidak terdaftar.'
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | 2. CEK STATUS MAHASISWA
        |--------------------------------------------------------------------------
        */

        if (($student['status'] ?? 'Aktif') !== 'Aktif') {
            return [
                'success' => false,
                'message' => 'Mahasiswa tidak aktif dan tidak dapat melakukan absensi.'
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | 3. CEK SESI AKTIF
        |--------------------------------------------------------------------------
        */

        $activeSession = $this->sessionRepository->getActiveSession();

        if (!$activeSession) {
            return [
                'success' => false,
                'message' => 'Sesi absensi sudah ditutup.'
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | 4. AMBIL DATA ABSENSI
        |--------------------------------------------------------------------------
        */

        $attendances = $this->attendanceRepository->getAttendances();

        /*
        |--------------------------------------------------------------------------
        | 5. CEK DOUBLE ABSENSI
        |--------------------------------------------------------------------------
        */

        $alreadyPresent = collect($attendances)->first(function ($attendance) use ($student, $activeSession) {

            return $attendance['nim'] === $student['nim']
                && $attendance['mata_kuliah'] === $activeSession['mata_kuliah']
                && $attendance['pertemuan'] === $activeSession['pertemuan']
                && $attendance['tanggal'] === $activeSession['tanggal'];
        });

        if ($alreadyPresent) {
            return [
                'success' => false,
                'message' => 'Mahasiswa sudah melakukan absensi pada sesi ini.'
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | 6. SIMPAN ABSENSI
        |--------------------------------------------------------------------------
        */

        $attendance = [
            'id' => uniqid(),
            'nim' => $student['nim'],
            'nama' => $student['nama'],
            'kelas' => $student['kelas'],
            'mata_kuliah' => $activeSession['mata_kuliah'],
            'pertemuan' => $activeSession['pertemuan'],
            'materi' => $activeSession['materi'],
            'tanggal' => $activeSession['tanggal'],
            'jam' => now()->format('H:i:s'),
            'status' => 'HADIR',
        ];

$googleResult = $this->googleSheetRepository->createAttendance([
    'id' => $attendance['id'],
    'nim' => $attendance['nim'],
    'nama' => $attendance['nama'],
    'kode_mata_kuliah' => $activeSession['mata_kuliah'],
    'pertemuan' => $attendance['pertemuan'],
    'tanggal' => $attendance['tanggal'],
    'jam' => $attendance['jam'],
    'status' => $attendance['status'],
    'qr_id' => $student['qr_code'],
]);

if (!($googleResult['success'] ?? false)) {
    return [
        'success' => false,
        'message' => $googleResult['message']
            ?? 'Gagal menyimpan absensi ke Google Sheets.'
    ];
}

        $this->attendanceRepository->saveAttendance($attendance);

        return [
            'success' => true,
            'message' => 'Absensi berhasil dicatat.',
            'data' => $attendance
        ];
    }
public function getAttendances()
{
    $attendances = $this->googleSheetRepository->getAttendances();

    return collect($attendances)
        ->map(function ($attendance) {
            return [
                'id' => $attendance['id'],
                'nim' => $attendance['nim'],
                'nama' => $attendance['nama'],
                'kelas' => $attendance['kelas'],
                'mata_kuliah' => $attendance['mata_kuliah'],
                'pertemuan' => $attendance['pertemuan'],
                'tanggal' => $attendance['tanggal'],
                'jam' => $attendance['jam'],
                'status' => $attendance['status'],
                'qr_id' => $attendance['qr_id'],
                'materi' => '-',
            ];
        })
        ->values()
        ->toArray();
}
}