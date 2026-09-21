@extends('layouts.app')

@section('title', 'Dashboard - Smart Attendance')

@section('content')

<div class="dashboard-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="dashboard-hero">

        <div class="hero-content">

            <div class="hero-eyebrow">
                <span class="hero-dot"></span>
                SISTEM ABSENSI DIGITAL
            </div>

            <h1>
                Dashboard
            </h1>

            <p>
                Pantau kehadiran mahasiswa dan kelola sesi
                perkuliahan dari satu tempat.
            </p>

        </div>


        <div class="hero-action">

            @if($activeSession)

                <button
                    type="button"
                    class="dashboard-action disabled-dashboard-button"
                    onclick="alert('Masih ada sesi yang sedang berlangsung. Akhiri sesi tersebut terlebih dahulu.')"
                >
                    🔒 Sesi Sedang Aktif
                </button>

            @else

                <a
                    href="{{ route('sessions.create') }}"
                    class="dashboard-action"
                >
                    <span>＋</span>
                    Buat Sesi
                </a>

            @endif

        </div>

    </div>


    {{-- =====================================================
         STATISTICS
    ====================================================== --}}

    <div class="dashboard-stats">

        {{-- TOTAL MAHASISWA --}}

        <div class="dashboard-stat">

            <div class="stat-top">

                <div class="stat-symbol blue"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M16 20v-1.5a4 4 0 0 0-4-4H7.5a4 4 0 0 0-4 4V20M9.75 10.5a3.25 3.25 0 1 0 0-6.5 3.25 3.25 0 0 0 0 6.5ZM16.5 11a3 3 0 1 0 0-6M16.5 14.5h.5a4 4 0 0 1 4 4V20" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></div>

                <span class="stat-label">
                    TERDAFTAR
                </span>

            </div>

            <div class="stat-number">
                {{ $totalStudents }}
            </div>

            <div class="stat-description">
                Total mahasiswa
            </div>

        </div>


        {{-- SESI AKTIF --}}

        <div class="dashboard-stat">

            <div class="stat-top">

                <div class="stat-symbol green"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.7"/><path d="M12 7.5V12l3 2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></div>

                @if($activeSession)

                    <span class="stat-status online">
                        LIVE
                    </span>

                @else

                    <span class="stat-status offline">
                        OFFLINE
                    </span>

                @endif

            </div>

            <div class="stat-number">
                {{ $activeSession ? 1 : 0 }}
            </div>

            <div class="stat-description">
                Sesi sedang berlangsung
            </div>

        </div>


        {{-- ABSENSI HARI INI --}}

        <div class="dashboard-stat">

            <div class="stat-top">

                <div class="stat-symbol orange"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 12h4l2-5 3.5 10 2-5H20" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></div>

                <span class="stat-label">
                    HARI INI
                </span>

            </div>

            <div class="stat-number">
                {{ $attendanceToday }}
            </div>

            <div class="stat-description">
                Mahasiswa hadir
            </div>

        </div>


        {{-- TOTAL SESI --}}

        <div class="dashboard-stat">

            <div class="stat-top">

                <div class="stat-symbol purple"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="5" y="3.5" width="14" height="17" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="M8.5 8h7M8.5 12h7M8.5 16h4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></div>

                <span class="stat-label">
                    RIWAYAT
                </span>

            </div>

            <div class="stat-number">
                {{ $totalSessions }}
            </div>

            <div class="stat-description">
                Total sesi perkuliahan
            </div>

        </div>

    </div>


    {{-- =====================================================
         ACTIVE SESSION
    ====================================================== --}}

    <section class="dashboard-section">

        <div class="section-heading">

            <div>

                <div class="section-kicker">
                    PERKULIAHAN
                </div>

                <h2>
                    Sesi Absensi
                </h2>

                <p>
                    Informasi sesi perkuliahan yang sedang berlangsung.
                </p>

            </div>

        </div>


        @if($activeSession)

            <div class="active-session-card">

                <div class="active-session-glow"></div>


                <div class="active-session-content">

                    <div class="session-main">

                        <div class="live-badge">
                            <span></span>
                            SESI AKTIF
                        </div>


                        <h3>
                            {{ $activeSession['mata_kuliah'] }}
                        </h3>


                        <div class="session-meta">

                            <div class="session-meta-item">
                                <span>▣</span>
                                <strong>
                                    Kelas {{ $activeSession['kelas'] }}
                                </strong>
                            </div>

                            <div class="session-meta-item">
                                <span>◷</span>
                                Pertemuan {{ $activeSession['pertemuan'] }}
                            </div>

                            <div class="session-meta-item">
                                <span>▤</span>
                                {{ $activeSession['materi'] }}
                            </div>

                        </div>


                        <div class="session-time">

                            <div>
                                <small>TANGGAL</small>
                                <strong>
                                    {{ $activeSession['tanggal'] }}
                                </strong>
                            </div>

                            <div class="time-divider"></div>

                            <div>
                                <small>JAM</small>
                                <strong>
                                    {{ $activeSession['jam'] }}
                                </strong>
                            </div>

                        </div>

                    </div>


                    <div class="session-action">

                        <div class="session-camera-icon"><svg viewBox="0 0 24 24" fill="none"><rect x="3.5" y="6" width="17" height="13" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="M8 6l1.2-2h5.6L16 6M12 10a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Z" stroke="currentColor" stroke-width="1.7"/></svg></div>

                        <p>
                            Kamera siap digunakan untuk
                            pemindaian QR mahasiswa.
                        </p>

                        <a
                            href="{{ route('scanner') }}"
                            class="scanner-button"
                        >
                            Buka Scanner
                            <span>→</span>
                        </a>

                    </div>

                </div>

            </div>

        @else

            <div class="empty-session-card">

                <div class="empty-session-icon"><svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.7"/><path d="M12 7.5V12l3 2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></div>

                <h3>
                    Belum ada sesi aktif
                </h3>

                <p>
                    Buat sesi perkuliahan terlebih dahulu
                    untuk mulai menerima absensi mahasiswa.
                </p>

                <a
                    href="{{ route('sessions.create') }}"
                    class="dashboard-action"
                >
                    ＋ Buat Sesi Baru
                </a>

            </div>

        @endif

    </section>


    {{-- =====================================================
         RECENT ACTIVITY
    ====================================================== --}}

    <section class="dashboard-section">

        <div class="section-heading activity-heading">

            <div>

                <div class="section-kicker">
                    MONITORING
                </div>

                <h2>
                    Aktivitas Terbaru
                </h2>

                <p>
                    Absensi mahasiswa yang baru saja tercatat.
                </p>

            </div>


            <a
                href="{{ route('attendance.index') }}"
                class="view-all"
            >
                Lihat Semua
                <span>→</span>
            </a>

        </div>


        <div class="activity-panel">

            @if(count($recentAttendances) > 0)

                @foreach($recentAttendances as $attendance)

                    <div class="attendance-item">

                        <div class="attendance-avatar">
                            {{ strtoupper(substr($attendance['nama'], 0, 1)) }}
                        </div>


                        <div class="attendance-info">

                            <h3>
                                {{ $attendance['nama'] }}
                            </h3>

                            <p>
                                NIM {{ $attendance['nim'] }}
                                <span>•</span>
                                {{ $attendance['mata_kuliah'] }}
                            </p>

                        </div>


                        <div class="attendance-detail">

                            <strong>
                                {{ $attendance['tanggal'] }}
                            </strong>

                            <span>
                                {{ $attendance['jam'] }}
                            </span>

                        </div>


                        <div class="attendance-status">
                            <span></span>
                            {{ $attendance['status'] }}
                        </div>

                    </div>

                @endforeach

            @else

                <div class="empty-activity">

                    <div class="empty-activity-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M7 3h10c1.1 0 2 .9 2 2v14c0 1.1-.9 2-2 2H7c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2Z" stroke="currentColor" stroke-width="1.7"/><path d="M8.5 8h7M8.5 12h7M8.5 16h4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></div>

                    <h3>
                        Belum ada aktivitas
                    </h3>

                    <p>
                        Data kehadiran akan muncul di sini
                        setelah mahasiswa melakukan scan QR.
                    </p>

                </div>

            @endif

        </div>

    </section>

</div>


<style>

/* =========================================================
   DASHBOARD
========================================================= */

.dashboard-page {
    width: 100%;
}


/* =========================================================
   HERO
========================================================= */

.dashboard-hero {
    position: relative;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 25px;

    padding: 32px;

    margin-bottom: 22px;

    border: 1px solid #d9dedf;

    border-radius: 20px;

    background:
        radial-gradient(
            circle at 90% 20%,
            rgba(37, 55, 69, 0.10),
            transparent 30%
        ),
        linear-gradient(
            135deg,
            #ffffff,
            #f7f8f8
        );

    box-shadow:
        0 10px 35px rgba(15, 23, 42, 0.05);

    overflow: hidden;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-eyebrow {
    display: flex;
    align-items: center;

    gap: 8px;

    margin-bottom: 10px;

    color: #253745;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: 1.2px;
}

.hero-dot {
    width: 7px;
    height: 7px;

    border-radius: 50%;

    background: #253745;

    box-shadow:
        0 0 0 5px
        rgba(37, 55, 69, 0.10);
}

.dashboard-hero h1 {
    margin: 0 0 7px;

    color: #06141b;

    font-size: 32px;

    font-weight: 800;

    letter-spacing: -1px;
}

.dashboard-hero p {
    margin: 0;

    color: #4a5c6a;

    font-size: 13px;

    line-height: 1.6;
}


/* =========================================================
   BUTTON
========================================================= */

.dashboard-action {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 7px;

    min-height: 44px;

    padding: 0 18px;

    border: none;

    border-radius: 11px;

    background:
        linear-gradient(
            135deg,
            #253745,
            #11212D
        );

    color: white;

    font-size: 12px;

    font-weight: 700;

    text-decoration: none;

    cursor: pointer;

    box-shadow:
        0 10px 22px
        rgba(37, 55, 69, 0.18);

    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

.dashboard-action:hover {
    color: white;

    transform: translateY(-2px);

    box-shadow:
        0 14px 28px
        rgba(37, 55, 69, 0.24);
}

.disabled-dashboard-button {
    background: #ccd0cf;

    box-shadow: none;

    cursor: not-allowed;
}

.disabled-dashboard-button:hover {
    transform: none;

    box-shadow: none;
}


/* =========================================================
   STATISTICS
========================================================= */

.dashboard-stats {
    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 16px;

    margin-bottom: 34px;
}

.dashboard-stat {
    padding: 20px;

    border: 1px solid #d9dedf;

    border-radius: 16px;

    background: white;

    box-shadow:
        0 8px 25px
        rgba(15, 23, 42, 0.04);

    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

.dashboard-stat:hover {
    transform: translateY(-2px);

    box-shadow:
        0 14px 30px
        rgba(15, 23, 42, 0.07);
}

.stat-top {
    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 17px;
}

.stat-symbol {
    width: 42px;
    height: 42px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 12px;

    font-size: 17px;

    font-weight: 800;
}

.stat-symbol svg {
    width: 19px;
    height: 19px;
    display: block;
}

.stat-symbol.blue {
    background: #e8ecee;
    color: #253745;
}

.stat-symbol.green {
    background: #ecfdf5;
    color: #28784d;
}

.stat-symbol.orange {
    background: #f3f0e8;
    color: #7a6a3a;
}

.stat-symbol.purple {
    background: #e8ecee;
    color: #4a5c6a;
}

.stat-label,
.stat-status {
    font-size: 9px;

    font-weight: 800;

    letter-spacing: 0.7px;
}

.stat-label {
    color: #9ba8ab;
}

.stat-status {
    padding: 4px 7px;

    border-radius: 999px;
}

.stat-status.online {
    background: #ecf8f1;
    color: #28784d;
}

.stat-status.offline {
    background: #edf0f1;
    color: #4a5c6a;
}

.stat-number {
    color: #06141b;

    font-size: 27px;

    font-weight: 800;

    letter-spacing: -0.5px;
}

.stat-description {
    margin-top: 4px;

    color: #9ba8ab;

    font-size: 11px;
}


/* =========================================================
   SECTION
========================================================= */

.dashboard-section {
    margin-bottom: 34px;
}

.section-heading {
    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    gap: 20px;

    margin-bottom: 14px;
}

.section-kicker {
    margin-bottom: 5px;

    color: #253745;

    font-size: 9px;

    font-weight: 800;

    letter-spacing: 1px;
}

.section-heading h2 {
    margin: 0 0 5px;

    color: #06141b;

    font-size: 19px;

    font-weight: 800;

    letter-spacing: -0.3px;
}

.section-heading p {
    margin: 0;

    color: #4a5c6a;

    font-size: 12px;
}


/* =========================================================
   ACTIVE SESSION
========================================================= */

.active-session-card {
    position: relative;

    border: 1px solid #e8ecee;

    border-radius: 18px;

    background:
        linear-gradient(
            135deg,
            #ffffff 0%,
            #f7f8f8 100%
        );

    overflow: hidden;

    box-shadow:
        0 12px 35px
        rgba(37, 99, 235, 0.07);
}

.active-session-glow {
    position: absolute;

    width: 260px;
    height: 260px;

    right: -90px;
    top: -110px;

    border-radius: 50%;

    background:
        rgba(37, 99, 235, 0.08);

    filter: blur(5px);
}

.active-session-content {
    position: relative;

    display: flex;

    align-items: stretch;

    justify-content: space-between;

    gap: 30px;

    padding: 25px;
}

.session-main {
    flex: 1;
}

.live-badge {
    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 6px 10px;

    margin-bottom: 13px;

    border-radius: 999px;

    background: #ecf8f1;

    color: #28784d;

    font-size: 9px;

    font-weight: 800;

    letter-spacing: 0.5px;
}

.live-badge span {
    width: 6px;
    height: 6px;

    border-radius: 50%;

    background: #39a76a;

    box-shadow:
        0 0 0 4px
        rgba(34, 197, 94, 0.10);
}

.session-main h3 {
    margin: 0 0 14px;

    color: #06141b;

    font-size: 22px;

    font-weight: 800;

    letter-spacing: -0.5px;
}

.session-meta {
    display: flex;

    flex-wrap: wrap;

    gap: 8px;
}

.session-meta-item {
    display: flex;

    align-items: center;

    gap: 6px;

    padding: 7px 9px;

    border-radius: 8px;

    background: #f8f9f9;

    color: #4a5c6a;

    font-size: 10px;
}

.session-meta-item strong {
    color: #334155;
}

.session-time {
    display: flex;

    align-items: center;

    gap: 18px;

    margin-top: 20px;
}

.session-time small {
    display: block;

    margin-bottom: 3px;

    color: #9ba8ab;

    font-size: 8px;

    font-weight: 800;

    letter-spacing: 0.8px;
}

.session-time strong {
    color: #334155;

    font-size: 11px;
}

.time-divider {
    width: 1px;
    height: 28px;

    background: #d9dedf;
}

.session-action {
    width: 220px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-direction: column;

    padding: 20px;

    border-left: 1px solid #d9dedf;

    text-align: center;
}

.session-camera-icon {
    width: 45px;
    height: 45px;

    display: flex;

    align-items: center;
    justify-content: center;

    margin-bottom: 9px;

    border-radius: 12px;

    background: #e8ecee;

    color: #253745;

    font-size: 18px;
}

.session-action p {
    margin: 0 0 13px;

    color: #9ba8ab;

    font-size: 10px;

    line-height: 1.5;
}

.scanner-button {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 9px;

    width: 100%;

    min-height: 40px;

    border-radius: 9px;

    background: #253745;

    color: white;

    text-decoration: none;

    font-size: 11px;

    font-weight: 700;

    box-shadow:
        0 8px 18px
        rgba(37, 99, 235, 0.20);
}

.scanner-button:hover {
    color: white;

    background: #11212D;
}

.scanner-button span {
    font-size: 14px;
}


/* =========================================================
   EMPTY SESSION
========================================================= */

.empty-session-card {
    padding: 45px 20px;

    border: 1px dashed #ccd0cf;

    border-radius: 18px;

    background: rgba(255, 255, 255, 0.7);

    text-align: center;
}

.empty-session-icon {
    width: 52px;
    height: 52px;

    display: flex;

    align-items: center;
    justify-content: center;

    margin: 0 auto 14px;

    border-radius: 15px;

    background: #e8ecee;

    color: #253745;

    font-size: 22px;
}

.empty-session-card h3 {
    margin-bottom: 7px;

    color: #06141b;

    font-size: 16px;
}

.empty-session-card p {
    max-width: 420px;

    margin: 0 auto 18px;

    color: #4a5c6a;

    font-size: 11px;

    line-height: 1.6;
}


/* =========================================================
   ACTIVITY
========================================================= */

.activity-heading {
    align-items: flex-end;
}

.view-all {
    display: inline-flex;

    align-items: center;

    gap: 5px;

    color: #253745;

    text-decoration: none;

    font-size: 11px;

    font-weight: 700;
}

.view-all:hover {
    color: #11212D;
}

.activity-panel {
    border: 1px solid #d9dedf;

    border-radius: 16px;

    background: white;

    overflow: hidden;

    box-shadow:
        0 8px 25px
        rgba(15, 23, 42, 0.04);
}

.attendance-item {
    display: flex;

    align-items: center;

    gap: 13px;

    padding: 17px 20px;

    border-bottom: 1px solid #edf0f1;

    transition:
        background 0.2s ease;
}

.attendance-item:last-child {
    border-bottom: none;
}

.attendance-item:hover {
    background: #f8f9f9;
}

.attendance-avatar {
    width: 38px;
    height: 38px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background:
        linear-gradient(
            135deg,
            #e8ecee,
            #ccd0cf
        );

    color: #11212D;

    font-size: 12px;

    font-weight: 800;
}

.attendance-info {
    flex: 1;

    min-width: 0;
}

.attendance-info h3 {
    margin: 0 0 3px;

    color: #1e293b;

    font-size: 12px;

    font-weight: 700;
}

.attendance-info p {
    margin: 0;

    color: #9ba8ab;

    font-size: 10px;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}

.attendance-info p span {
    margin: 0 4px;

    color: #ccd0cf;
}

.attendance-detail {
    display: flex;

    flex-direction: column;

    align-items: flex-end;

    gap: 3px;

    min-width: 95px;
}

.attendance-detail strong {
    color: #4a5c6a;

    font-size: 9px;

    font-weight: 600;
}

.attendance-detail span {
    color: #9ba8ab;

    font-size: 9px;
}

.attendance-status {
    display: inline-flex;

    align-items: center;

    gap: 5px;

    padding: 5px 8px;

    border-radius: 999px;

    background: #ecfdf5;

    color: #28784d;

    font-size: 9px;

    font-weight: 800;
}

.attendance-status span {
    width: 5px;
    height: 5px;

    border-radius: 50%;

    background: #39a76a;
}

.empty-activity {
    padding: 45px 20px;

    text-align: center;
}

.empty-activity-icon {
    width: 48px;
    height: 48px;

    display: flex;

    align-items: center;
    justify-content: center;

    margin: 0 auto 12px;

    border-radius: 14px;

    background: #ecfdf5;

    color: #28784d;

    font-size: 18px;
}

.empty-activity h3 {
    margin-bottom: 5px;

    color: #1e293b;

    font-size: 14px;
}

.empty-activity p {
    max-width: 380px;

    margin: 0 auto;

    color: #9ba8ab;

    font-size: 10px;

    line-height: 1.6;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1050px) {

    .dashboard-stats {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }

    .session-action {
        width: 190px;
    }

}


@media (max-width: 750px) {

    .dashboard-hero {
        align-items: flex-start;

        flex-direction: column;

        padding: 24px;
    }

    .hero-action {
        width: 100%;
    }

    .dashboard-action {
        width: 100%;
    }

    .active-session-content {
        flex-direction: column;
    }

    .session-action {
        width: 100%;

        border-left: none;

        border-top: 1px solid #d9dedf;

        padding: 18px 0 0;
    }

}


@media (max-width: 600px) {

    .dashboard-stats {
        grid-template-columns: 1fr;
    }

    .dashboard-hero h1 {
        font-size: 27px;
    }

    .section-heading {
        align-items: flex-start;

        flex-direction: column;
    }

    .session-main h3 {
        font-size: 19px;
    }

    .session-meta {
        flex-direction: column;
    }

    .session-meta-item {
        width: 100%;
    }

    .session-time {
        justify-content: space-between;
    }

    .attendance-item {
        align-items: flex-start;

        flex-wrap: wrap;
    }

    .attendance-info {
        width: calc(100% - 55px);
    }

    .attendance-detail {
        margin-left: 51px;

        align-items: flex-start;
    }

    .attendance-status {
        margin-left: auto;
    }

}


@media (max-width: 420px) {

    .dashboard-hero {
        padding: 20px;
    }

    .dashboard-stat {
        padding: 17px;
    }

    .active-session-content {
        padding: 20px;
    }

    .attendance-item {
        padding: 15px;
    }

    .attendance-status {
        font-size: 8px;
    }

}


/* FINAL ICON SAFETY */
.dashboard-page svg {
    max-width: 100%;
}
.empty-session-icon svg,
.session-camera-icon svg,
.empty-activity-icon svg {
    width: 20px;
    height: 20px;
    display: block;
}

</style>

@endsection