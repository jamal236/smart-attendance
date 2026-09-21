<?php

namespace App\Repositories;

class StudentRepository
{
    public function getStudents()
    {
        return session('students', []);
    }

    public function findById(string $id)
    {
        $students = $this->getStudents();

        return collect($students)->firstWhere('id', $id);
    }

    public function findByNim(string $nim)
    {
        $students = $this->getStudents();

        return collect($students)->firstWhere('nim', $nim);
    }

    public function findByQrCode(string $qrCode)
    {
        $students = $this->getStudents();

        return collect($students)->firstWhere('qr_code', $qrCode);
    }

    public function saveStudent(array $student)
    {
        $students = $this->getStudents();

        $students[] = $student;

        session([
            'students' => $students
        ]);

        return $student;
    }

    public function updateStudent(string $id, array $data)
    {
        $students = $this->getStudents();

        foreach ($students as &$student) {

            if ($student['id'] === $id) {
                $student = array_merge($student, $data);
                break;
            }
        }

        session([
            'students' => $students
        ]);

        return $this->findById($id);
    }

    public function deleteStudent(string $id)
    {
        $students = $this->getStudents();

        $students = array_values(
            array_filter($students, function ($student) use ($id) {
                return $student['id'] !== $id;
            })
        );

        session([
            'students' => $students
        ]);

        return true;
    }

    public function findDuplicateNim(
    string $nim,
    string $excludeId
) {
    $students = $this->getStudents();

    return collect($students)->first(function ($student) use ($nim, $excludeId) {

        return $student['id'] !== $excludeId
            && $student['nim'] === $nim;
    });
}

}