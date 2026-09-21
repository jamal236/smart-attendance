<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StudentService;

class StudentController extends Controller
{
    protected StudentService $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index()
    {
        $students = $this->studentService->getStudents();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
        ]);

        $result = $this->studentService->createStudent($validated);

        if (!$result['success']) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $result['message']);
        }

        return redirect()
            ->route('students.index')
            ->with('success', $result['message']);
    }

    public function qr($id)
    {
        $student = $this->studentService->getStudentById($id);

        if (!$student) {
            abort(404, 'Mahasiswa tidak ditemukan.');
        }

        return view('students.qr', compact('student'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT MAHASISWA
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $student = $this->studentService->getStudentById($id);

        if (!$student) {
            abort(404, 'Mahasiswa tidak ditemukan.');
        }

        return view('students.edit', compact('student'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE MAHASISWA
    |--------------------------------------------------------------------------
    */

public function update(Request $request, $id)
{
    $student = $this->studentService->getStudentById($id);

    if (!$student) {
        abort(404, 'Mahasiswa tidak ditemukan.');
    }

    $validated = $request->validate([
        'nim' => 'required',
        'nama' => 'required',
        'kelas' => 'required',
        'status' => 'required',
    ]);

    $result = $this->studentService->updateStudent($id, $validated);

    if (!$result['success']) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', $result['message']);
    }

    return redirect()
        ->route('students.index')
        ->with('success', $result['message']);
}
public function destroy($id)
{
    $student = $this->studentService->getStudentById($id);

    if (!$student) {
        abort(404, 'Mahasiswa tidak ditemukan.');
    }

    $result = $this->studentService->deleteStudent($id);

    if (!$result['success']) {
        return redirect()
            ->back()
            ->with('error', $result['message']);
    }

    return redirect()
        ->route('students.index')
        ->with('success', $result['message']);
}
}