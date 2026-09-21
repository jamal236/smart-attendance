<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    protected AttendanceService $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function scan(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string',
        ]);

        $result = $this->attendanceService->processAttendance(
            $request->qr_code
        );

        return response()->json($result);
    }

    public function index()
    {
        $attendances = $this->attendanceService->getAttendances();

        return view('attendance.index', compact('attendances'));
    }
}