<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SessionService;
use App\Services\CourseService;

class SessionController extends Controller
{
    protected SessionService $sessionService;
    protected CourseService $courseService;

    public function __construct(
        SessionService $sessionService,
        CourseService $courseService
    ) {
        $this->sessionService = $sessionService;
        $this->courseService = $courseService;
    }

    public function create()
    {
        $activeSession = $this->sessionService->getActiveSession();

        if ($activeSession) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'Masih ada sesi yang sedang berlangsung. Akhiri sesi tersebut terlebih dahulu.'
                );
        }

$courses = $this->courseService->getCourses();

return view('sessions.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mata_kuliah' => 'required',
            'kelas' => 'required',
            'pertemuan' => 'required',
            'materi' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
        ]);

        $session = $this->sessionService->createSession($validated);

        // Jika masih ada sesi aktif
        if (
            isset($session['success']) &&
            $session['success'] === false
        ) {
            return redirect()
                ->route('dashboard')
                ->with('error', $session['message']);
        }

        // Jika sesi berhasil dibuat
$this->sessionService->setActiveSession($session);

        return redirect()->route('scanner');
    }

    public function completedMeetings(Request $request)
{
    $request->validate([
        'mata_kuliah' => 'required|string',
        'kelas' => 'required|string',
    ]);

    $completedMeetings = $this->sessionService->getCompletedMeetings(
        $request->mata_kuliah,
        $request->kelas
    );

    return response()->json([
        'success' => true,
        'completed_meetings' => $completedMeetings,
    ]);
}

    public function history()
    {
        $sessions = $this->sessionService->getSessions();

        return view('sessions.history', compact('sessions'));
    }

public function end()
{
    $result = $this->sessionService->endSession();

    if (!($result['success'] ?? false)) {
        return redirect()
            ->back()
            ->with('error', $result['message']);
    }

    return redirect()
        ->route('dashboard')
        ->with('success', $result['message']);
}
}