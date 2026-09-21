<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Smart Attendance')</title>

    {{-- Modern Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #253745;
            --primary-dark: #11212D;
            --primary-soft: #E8ECEE;

            --dark: #06141B;
            --dark-soft: #11212D;

            --text: #06141B;
            --text-soft: #4A5C6A;
            --muted: #9BA8AB;

            --border: #D9DEDF;
            --background: #F2F4F4;
            --white: #ffffff;

            --success: #16a34a;
            --success-soft: #f0fdf4;

            --sidebar-width: 252px;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family:
                "Plus Jakarta Sans",
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            background: var(--background);
            color: #CCD0CF;

            min-height: 100vh;

            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        a {
            color: inherit;
        }


        /* =====================================================
           APP
        ===================================================== */

        .app {
            min-height: 100vh;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            position: fixed;

            top: 0;
            left: 0;
            bottom: 0;

            width: var(--sidebar-width);

            padding: 20px 14px;

            background: #06141B;

            color: #CCD0CF;

            border-right: 1px solid #253745;

            z-index: 1000;

            overflow-y: auto;

            display: flex;
            flex-direction: column;
        }


        /* =====================================================
           BRAND
        ===================================================== */

        .brand {
            display: flex;
            align-items: center;

            gap: 11px;

            padding: 6px 10px 23px;

            margin-bottom: 8px;

            border-bottom: 1px solid #253745;
        }

        .brand-icon {
            width: 39px;
            height: 39px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background: #253745;

            color: #CCD0CF;

            box-shadow:
                0 7px 18px rgba(37, 55, 69, 0.28);
        }

        .brand-icon svg {
            width: 21px;
            height: 21px;
        }

        .brand-text {
            min-width: 0;
        }

        .brand-name {
            font-size: 15px;
            font-weight: 800;

            line-height: 1.2;

            letter-spacing: -0.4px;

            color: #FFFFFF;
        }

        .brand-name span {
            color: #CCD0CF;
        }

        .brand-subtitle {
            margin-top: 4px;

            color: #9BA8AB;

            font-size: 9px;

            font-weight: 600;

            letter-spacing: 0.7px;

            text-transform: uppercase;
        }


        /* =====================================================
           MENU TITLE
        ===================================================== */

        .menu-title {
            padding: 16px 12px 8px;

            color: #9BA8AB;

            font-size: 9px;

            font-weight: 700;

            letter-spacing: 1.1px;

            text-transform: uppercase;
        }


        /* =====================================================
           MENU
        ===================================================== */

        .menu {
            display: flex;

            flex-direction: column;

            gap: 3px;
        }

        .menu a {
            position: relative;

            display: flex;

            align-items: center;

            gap: 12px;

            min-height: 44px;

            padding: 9px 12px;

            border-radius: 10px;

            color: #9BA8AB;

            text-decoration: none;

            font-size: 12px;

            font-weight: 600;

            transition:
                background 0.18s ease,
                color 0.18s ease,
                transform 0.18s ease;
        }

        .menu a:hover {
            background: #11212D;

            color: #FFFFFF;
        }

        .menu a.active {
            background: #253745;

            color: #FFFFFF;
        }

        .menu-icon {
            width: 20px;
            height: 20px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #4A5C6A;
        }

        .menu a.active .menu-icon {
            color: #CCD0CF;
        }

        .menu a:hover .menu-icon {
            color: #CCD0CF;
        }

        .menu-icon svg {
            width: 18px;
            height: 18px;

            stroke: currentColor;
            stroke-width: 1.8;
        }

        .menu-label {
            flex: 1;
        }

        .menu-badge {
            font-size: 8px;

            padding: 3px 7px;

            border-radius: 999px;

            background: #E8F4EA;

            color: #15803d;

            font-weight: 700;

            text-transform: uppercase;
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            margin-left: var(--sidebar-width);

            min-height: 100vh;

            width: calc(100% - var(--sidebar-width));
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {
            position: sticky;

            top: 0;

            height: 70px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 32px;

            background: rgba(255, 255, 255, 0.96);

            border-bottom: 1px solid #D9DEDF;

            backdrop-filter: blur(18px);

            -webkit-backdrop-filter: blur(18px);

            z-index: 900;
        }

        .topbar-left {
            display: flex;

            flex-direction: column;

            gap: 2px;
        }

        .topbar-title {
            font-size: 13px;

            font-weight: 700;

            color: #06141B;

            letter-spacing: -0.15px;
        }

        .topbar-subtitle {
            font-size: 10px;

            color: #9BA8AB;

            font-weight: 500;
        }

        .topbar-right {
            display: flex;

            align-items: center;

            gap: 14px;
        }


        /* =====================================================
           SESSION INDICATOR
        ===================================================== */

        .session-indicator {
            display: flex;

            align-items: center;

            gap: 7px;

            padding: 7px 10px;

            border-radius: 999px;

            background: #E8F4EA;

            border: 1px solid #CDE5D1;

            color: #15803d;

            font-size: 10px;

            font-weight: 700;
        }

        .session-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: #22c55e;

            box-shadow:
                0 0 0 4px rgba(34, 197, 94, 0.10);
        }


        /* =====================================================
           PROFILE
        ===================================================== */

        .profile {
            display: flex;

            align-items: center;

            gap: 10px;

            padding-left: 14px;

            border-left: 1px solid #D9DEDF;
        }

        .profile-circle svg {
            width: 18px;
            height: 18px;
            display: block;
            stroke: currentColor;
        }

        .profile-circle {
            width: 36px;
            height: 36px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: #253745;

            color: #FFFFFF;

            font-size: 12px;

            font-weight: 800;
        }

        .profile-info {
            display: flex;

            flex-direction: column;

            gap: 2px;
        }

        .profile-name {
            font-size: 11px;

            font-weight: 700;

            color: #CCD0CF;
        }

        .profile-role {
            font-size: 9px;

            color: #9BA8AB;

            font-weight: 500;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            width: 100%;

            max-width: 1500px;

            padding: 32px 32px 50px;

            margin: 0 auto;
        }


        /* =====================================================
           GLOBAL BUTTON
        ===================================================== */

        .primary-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 7px;

            min-height: 41px;

            padding: 0 16px;

            border: none;

            border-radius: 10px;

            background: #253745;

            color: #CCD0CF;

            font-size: 11px;

            font-weight: 700;

            text-decoration: none;

            cursor: pointer;

            box-shadow:
                0 7px 16px rgba(37, 55, 69, 0.20);

            transition:
                transform 0.18s ease,
                box-shadow 0.18s ease,
                background 0.18s ease;
        }

        .primary-button:hover {
            background: #1d4ed8;

            transform: translateY(-1px);

            box-shadow:
                0 10px 22px rgba(37, 55, 69, 0.28);
        }

        .primary-button svg {
            width: 16px;
            height: 16px;
        }


        /* =====================================================
           MOBILE MENU BUTTON
        ===================================================== */

        .mobile-menu-button {
            display: none;

            width: 38px;
            height: 38px;

            border: 1px solid #CCD0CF;

            border-radius: 10px;

            background: #FFFFFF;

            color: #253745;

            cursor: pointer;

            align-items: center;
            justify-content: center;
        }

        .mobile-menu-button svg {
            width: 19px;
            height: 19px;
        }


        /* =====================================================
           OVERLAY
        ===================================================== */

        .sidebar-overlay {
            display: none;

            position: fixed;

            inset: 0;

            background: rgba(6, 20, 27, 0.52);

            backdrop-filter: blur(2px);

            z-index: 950;
        }


        /* =====================================================
           SCROLLBAR
        ===================================================== */

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #4A5C6A;

            border-radius: 999px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            :root {
                --sidebar-width: 225px;
            }

            .content {
                padding: 25px 20px 40px;
            }

            .topbar {
                padding: 0 20px;
            }

        }


        @media (max-width: 700px) {

            .sidebar {
                transform: translateX(-100%);

                transition:
                    transform 0.25s ease;

                width: 250px;

                box-shadow:
                    15px 0 40px rgba(6, 20, 27, 0.24);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .sidebar-overlay.active {
                display: block;
            }

            .main {
                margin-left: 0;

                width: 100%;
            }

            .topbar {
                height: 64px;

                padding: 0 15px;
            }

            .mobile-menu-button {
                display: flex;
            }

            .topbar-left {
                margin-left: 10px;
            }

            .topbar-title {
                font-size: 12px;
            }

            .topbar-subtitle {
                display: none;
            }

            .session-indicator {
                display: none;
            }

            .profile-info {
                display: none;
            }

            .profile {
                padding-left: 0;

                border-left: none;
            }

            .content {
                padding: 20px 15px 35px;
            }

        }


        @media (max-width: 420px) {

            .content {
                padding-left: 12px;
                padding-right: 12px;
            }

            .topbar {
                padding: 0 12px;
            }

        }

    </style>

</head>


<body>

<div class="app">


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside class="sidebar" id="sidebar">


        {{-- BRAND --}}

        <div class="brand">

            <div class="brand-icon">

                {{-- Shield / attendance icon --}}
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M12 3L19 6V11C19 15.5 16.2 19.2 12 21C7.8 19.2 5 15.5 5 11V6L12 3Z"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linejoin="round"
                    />

                    <path
                        d="M9 12L11 14L15 10"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>

            </div>


            <div class="brand-text">

                <div class="brand-name">
                    Smart <span>Attendance</span>
                </div>

                <div class="brand-subtitle">
                    Attendance Management
                </div>

            </div>

        </div>


        <div class="menu-title">
            Menu Utama
        </div>


        <nav class="menu">


            {{-- DASHBOARD --}}

            <a
                href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >

                <div class="menu-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <rect x="4" y="4" width="6" height="6" rx="1"/>
                        <rect x="14" y="4" width="6" height="6" rx="1"/>
                        <rect x="4" y="14" width="6" height="6" rx="1"/>
                        <rect x="14" y="14" width="6" height="6" rx="1"/>
                    </svg>

                </div>

                <span class="menu-label">
                    Dashboard
                </span>

            </a>


{{-- BUAT SESI --}}

@php
    $googleSheetRepository = app(\App\Repositories\GoogleSheetRepository::class);
    $activeSession = collect($googleSheetRepository->getMeetings())
        ->firstWhere('status', 'AKTIF');
@endphp

<a
    href="{{ route('sessions.create') }}"
    class="{{ request()->routeIs('sessions.create') ? 'active' : '' }}"
    @if($activeSession)
        onclick="
            event.preventDefault();
            alert('Masih ada sesi yang sedang berlangsung. Silakan akhiri sesi terlebih dahulu.');
        "
    @endif
>
    <div class="menu-icon">
        <svg
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M12 5V19"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
            />

            <path
                d="M5 12H19"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
            />
        </svg>
    </div>

    <span class="menu-label">
        Buat Sesi
    </span>

    @if($activeSession)
        <span class="menu-badge">
            Aktif
        </span>
    @endif
</a>


            {{-- SCANNER --}}

            <a
                href="{{ route('scanner') }}"
                class="{{ request()->routeIs('scanner') ? 'active' : '' }}"
            >

                <div class="menu-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M4 8V5C4 4.45 4.45 4 5 4H8"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M16 4H19C19.55 4 20 4.45 20 5V8"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M20 16V19C20 19.55 19.55 20 19 20H16"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M8 20H5C4.45 20 4 19.55 4 19V16"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M7 12H17"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />
                    </svg>

                </div>

                <span class="menu-label">
                    Scanner
                </span>

            </a>


            {{-- MAHASISWA --}}

            <a
                href="{{ route('students.index') }}"
                class="{{ request()->routeIs('students.*') ? 'active' : '' }}"
            >

                <div class="menu-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M16 20V18C16 16.34 14.66 15 13 15H7C5.34 15 4 16.34 4 18V20"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <circle
                            cx="10"
                            cy="8"
                            r="3"
                            stroke="currentColor"
                            stroke-width="1.8"
                        />

                        <path
                            d="M16 11C17.66 11 19 12.34 19 14"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M16 5.2C17.66 5.2 19 6.54 19 8.2"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />
                    </svg>

                </div>

                <span class="menu-label">
                    Data Mahasiswa
                </span>

            </a>


            {{-- RIWAYAT ABSENSI --}}

            <a
                href="{{ route('attendance.index') }}"
                class="{{ request()->routeIs('attendance.index') ? 'active' : '' }}"
            >

                <div class="menu-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M7 4H17"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M7 8H17"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M7 12H13"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M7 16H11"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M5 3H19C19.55 3 20 3.45 20 4V20C20 20.55 19.55 21 19 21H5C4.45 21 4 20.55 4 20V4C4 3.45 4.45 3 5 3Z"
                            stroke="currentColor"
                            stroke-width="1.8"
                        />
                    </svg>

                </div>

                <span class="menu-label">
                    Riwayat Absensi
                </span>

            </a>


            {{-- RIWAYAT SESI --}}

            <a
                href="{{ route('sessions.history') }}"
                class="{{ request()->routeIs('sessions.history') ? 'active' : '' }}"
            >

                <div class="menu-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="8"
                            stroke="currentColor"
                            stroke-width="1.8"
                        />

                        <path
                            d="M12 8V12L15 14"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>

                </div>

                <span class="menu-label">
                    Riwayat Sesi
                </span>

            </a>


        </nav>


    </aside>


    {{-- MOBILE OVERLAY --}}

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
        onclick="closeSidebar()"
    ></div>


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <main class="main">


        {{-- TOPBAR --}}

        <header class="topbar">


            <div
                style="
                    display:flex;
                    align-items:center;
                "
            >

                {{-- MOBILE BUTTON --}}

                <button
                    class="mobile-menu-button"
                    type="button"
                    onclick="toggleSidebar()"
                    aria-label="Buka menu"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M4 6H20"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M4 12H20"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="M4 18H20"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />
                    </svg>

                </button>


                <div class="topbar-left">

                    <div class="topbar-title">
                        Smart Attendance
                    </div>

                    <div class="topbar-subtitle">
                        Sistem Manajemen Kehadiran
                    </div>

                </div>

            </div>


            <div class="topbar-right">


                @if(session('active_session'))

                    <div class="session-indicator">

                        <span class="session-dot"></span>

                        Sesi sedang aktif

                    </div>

                @endif


                <div class="profile">

                    <div class="profile-circle" aria-label="Panel Pengajar">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 3L19 6V11C19 15.5 16.2 19.2 12 21C7.8 19.2 5 15.5 5 11V6L12 3Z"
                                stroke="currentColor"
                                stroke-width="1.7"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M9 12L11 14L15 10"
                                stroke="currentColor"
                                stroke-width="1.7"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </div>

                    <div class="profile-info">

                        <div class="profile-name">
                            Dosen
                        </div>

                        <div class="profile-role">
                            Panel Pengajar
                        </div>

                    </div>

                </div>


            </div>


        </header>


        {{-- CONTENT --}}

        <section class="content">

            @yield('content')

        </section>


    </main>


</div>


<script>

    function toggleSidebar() {

        const sidebar =
            document.getElementById('sidebar');

        const overlay =
            document.getElementById('sidebarOverlay');

        sidebar.classList.toggle('mobile-open');

        overlay.classList.toggle('active');

    }


    function closeSidebar() {

        const sidebar =
            document.getElementById('sidebar');

        const overlay =
            document.getElementById('sidebarOverlay');

        sidebar.classList.remove('mobile-open');

        overlay.classList.remove('active');

    }


    /*
        Tutup sidebar setelah menu
        dipilih pada perangkat mobile.
    */

    document
        .querySelectorAll('.sidebar a')
        .forEach(function (link) {

            link.addEventListener(
                'click',
                function () {

                    if (window.innerWidth <= 700) {

                        closeSidebar();

                    }

                }
            );

        });

</script>


</body>
</html>