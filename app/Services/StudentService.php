<?php

namespace App\Services;

use App\Repositories\StudentRepository;
use App\Repositories\GoogleSheetRepository;

class StudentService
{
    protected StudentRepository $studentRepository;
    protected GoogleSheetRepository $googleSheetRepository;

    public function __construct(
        StudentRepository $studentRepository,
        GoogleSheetRepository $googleSheetRepository
    ) {
        $this->studentRepository = $studentRepository;
        $this->googleSheetRepository = $googleSheetRepository;
    }

    /*
    |--------------------------------------------------------------------------
    | GET SEMUA MAHASISWA
    |--------------------------------------------------------------------------
    */

    public function getStudents()
    {
        $students = $this->googleSheetRepository->getStudents();

        return collect($students)
            ->map(function ($student) {
                return [
                    'id' => $student['nim'],
                    'nim' => $student['nim'],
                    'nama' => $student['nama'],
                    'kelas' => $student['kelas'],
                    'status' => $student['status'],
                    'qr_code' => $student['qr_id'],
                ];
            })
            ->values()
            ->toArray();
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH MAHASISWA
    |--------------------------------------------------------------------------
    */

    public function createStudent(array $data)
    {
        $googleStudents = $this->googleSheetRepository->getStudents();

        $existingStudent = collect($googleStudents)
            ->firstWhere('nim', $data['nim']);

        if ($existingStudent) {
            return [
                'success' => false,
                'message' => 'NIM mahasiswa sudah terdaftar di Google Sheets.'
            ];
        }

        $googleResult = $this->googleSheetRepository->createStudent([
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'kelas' => $data['kelas'],
            'status' => 'Aktif',
        ]);

        if (!($googleResult['success'] ?? false)) {
            return [
                'success' => false,
                'message' => $googleResult['message']
                    ?? 'Gagal menyimpan mahasiswa ke Google Sheets.'
            ];
        }

        return [
            'success' => true,
            'message' => 'Mahasiswa berhasil ditambahkan.',
            'data' => $googleResult['data'] ?? null
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | CARI MAHASISWA
    |--------------------------------------------------------------------------
    */

    public function getStudentById(string $id)
    {
        $students = $this->getStudents();

        return collect($students)
            ->firstWhere('id', $id);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE MAHASISWA
    |--------------------------------------------------------------------------
    */

    public function updateStudent(string $id, array $data)
    {
        /*
        | ID sekarang menggunakan NIM lama
        */

        $student = $this->getStudentById($id);

        if (!$student) {
            return [
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan.'
            ];
        }

        /*
        | Cek NIM baru jika berubah
        */

        $googleStudents = $this->googleSheetRepository->getStudents();

        $duplicateNim = collect($googleStudents)
            ->first(function ($student) use ($data, $id) {
                return $student['nim'] === $data['nim']
                    && $student['nim'] !== $id;
            });

        if ($duplicateNim) {
            return [
                'success' => false,
                'message' => 'NIM tersebut sudah digunakan mahasiswa lain.'
            ];
        }

        /*
        | Update ke Google Sheets
        */

        $result = $this->googleSheetRepository->updateStudent(
            $id,
            [
                'nim' => $data['nim'],
                'nama' => $data['nama'],
                'kelas' => $data['kelas'],
                'status' => $data['status'],
            ]
        );

        if (!($result['success'] ?? false)) {
            return [
                'success' => false,
                'message' => $result['message']
                    ?? 'Gagal memperbarui data mahasiswa.'
            ];
        }

        return [
            'success' => true,
            'message' => 'Data mahasiswa berhasil diperbarui.',
            'data' => $result['data'] ?? null
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS MAHASISWA
    |--------------------------------------------------------------------------
    */

public function deleteStudent(string $id)
{
    $result = $this->googleSheetRepository->deleteStudent($id);

    if (!($result['success'] ?? false)) {
        return [
            'success' => false,
            'message' => $result['message']
                ?? 'Gagal menghapus mahasiswa.'
        ];
    }

    return [
        'success' => true,
        'message' => 'Mahasiswa berhasil dihapus.'
    ];
}
}