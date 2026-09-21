<?php

namespace App\Repositories;

class SessionRepository
{
    public function getSessions()
    {
        return session('sessions', []);
    }

    public function saveSession(array $session)
    {
        $sessions = $this->getSessions();

        $sessions[] = $session;

        session([
            'sessions' => $sessions
        ]);

        return $session;
    }

    public function setActiveSession(array $session)
{
    session([
        'active_session' => $session
    ]);

    return $session;
}

    public function getCompletedMeetings(
        string $mataKuliah,
        string $kelas
    ) {
        $sessions = $this->getSessions();

        return collect($sessions)
            ->where('mata_kuliah', $mataKuliah)
            ->where('kelas', $kelas)
            ->where('status', 'SELESAI')
            ->pluck('pertemuan')
            ->map(fn ($pertemuan) => (int) $pertemuan)
            ->values()
            ->toArray();
    }

    public function isMeetingCompleted(
        string $mataKuliah,
        string $kelas,
        string $pertemuan
    ) {
        $completedMeetings = $this->getCompletedMeetings(
            $mataKuliah,
            $kelas
        );

        return in_array(
            (int) $pertemuan,
            $completedMeetings
        );
    }

    public function endActiveSession()
    {
        $sessions = $this->getSessions();

        foreach ($sessions as &$session) {
            if ($session['status'] === 'AKTIF') {
                $session['status'] = 'SELESAI';
            }
        }

        session([
            'sessions' => $sessions,
            'active_session' => null
        ]);

        return true;
    }

    public function getActiveSession()
{
    $sessions = $this->getSessions();

    return collect($sessions)
        ->where('status', 'AKTIF')
        ->last();
}
}