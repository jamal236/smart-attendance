<?php

namespace App\Repositories;

class CourseRepository
{
    public function getCourses()
    {
        return [
            [
                'kode' => 'MK001',
                'mata_kuliah' => 'Interaksi Manusia & Komputer',
                'dosen' => 'Wahyuni Harahap, ST., MM',
                'kelas' => 'V.5',
                'hari' => 'Kamis',
                'jam' => '14.30–17.00',
                'ruang' => 'FTI-10',
            ],

            [
                'kode' => 'MK002',
                'mata_kuliah' => 'Jaringan Komputer II',
                'dosen' => 'Sayed Achmady, ST., M.Kom',
                'kelas' => 'V.5',
                'hari' => 'Kamis',
                'jam' => '11.00–13.30',
                'ruang' => 'LAB-04',
            ],

            [
                'kode' => 'MK003',
                'mata_kuliah' => 'Komputer Grafik',
                'dosen' => 'Wahyuni Harahap, ST., MM',
                'kelas' => 'V.5',
                'hari' => 'Rabu',
                'jam' => '14.30–17.00',
                'ruang' => 'LAB-04',
            ],

            [
                'kode' => 'MK004',
                'mata_kuliah' => 'Konsep Data Warehouse & Data Mining',
                'dosen' => 'Jessika, S.Kom., M.Kom',
                'kelas' => 'V.5',
                'hari' => 'Senin',
                'jam' => '08.30–11.00',
                'ruang' => 'LAB-03',
            ],

            [
                'kode' => 'MK005',
                'mata_kuliah' => 'Pemrograman Berorientasi Objek',
                'dosen' => 'Ilal Mahdi, S.T., M.T',
                'kelas' => 'V.5',
                'hari' => 'Selasa',
                'jam' => '14.30–17.00',
                'ruang' => 'FTI-03',
            ],

            [
                'kode' => 'MK006',
                'mata_kuliah' => 'Proyek Perangkat Lunak',
                'dosen' => 'Ilal Mahdi, S.T., M.T',
                'kelas' => 'V.5',
                'hari' => 'Selasa',
                'jam' => '08.30–11.00',
                'ruang' => 'FTI-02',
            ],

            [
                'kode' => 'MK007',
                'mata_kuliah' => 'Rekayasa Perangkat Lunak II',
                'dosen' => 'Zikrul Khalid, ST., MT',
                'kelas' => 'V.5',
                'hari' => 'Rabu',
                'jam' => '08.30–11.00',
                'ruang' => 'FTI-04',
            ],
        ];
    }

    public function findByCourseName(string $mataKuliah)
    {
        return collect($this->getCourses())
            ->firstWhere('mata_kuliah', $mataKuliah);
    }
}