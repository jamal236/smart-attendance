@extends('layouts.app')

@section('title', 'Riwayat Sesi - Smart Attendance')

@section('content')

<div class="session-page">

    <!-- =========================
         HEADER
    ========================== -->

    <div class="page-header">

        <div>

            <a
                href="{{ route('dashboard') }}"
                class="back-link"
            >
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M19 12H5"></path>
                    <path d="M11 18l-6-6 6-6"></path>
                </svg>
                Kembali ke Dashboard
            </a>

            <span class="eyebrow">
                DATA PERKULIAHAN
            </span>

            <h1>
                Riwayat Sesi
            </h1>

            <p>
                Pantau seluruh sesi perkuliahan yang telah dibuat.
            </p>

        </div>

        <a
            href="{{ route('sessions.create') }}"
            class="primary-button"
        >
            <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 5v14"></path>
                    <path d="M5 12h14"></path>
                </svg>
                Buat Sesi
        </a>

    </div>


    <!-- =========================
         SUMMARY
    ========================== -->

    <div class="summary-grid">

        <div class="summary-card">

            <div class="summary-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="8.5"></circle>
                    <path d="M12 7v5l3.2 2"></path>
                </svg>
            </div>

            <div>

                <span class="summary-label">
                    Total Sesi
                </span>

                <strong>
                    {{ count($sessions) }}
                </strong>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5.5 12.5l4.1 4.1L18.5 7.7"></path>
                </svg>
            </div>

            <div>

                <span class="summary-label">
                    Sesi Aktif
                </span>

                <strong>
                    {{ collect($sessions)->where('status', 'AKTIF')->count() }}
                </strong>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <rect x="5" y="5" width="14" height="14" rx="2.5"></rect>
                    <path d="M8.5 9h7M8.5 12h7M8.5 15h4"></path>
                </svg>
            </div>

            <div>

                <span class="summary-label">
                    Sesi Selesai
                </span>

                <strong>
                    {{ collect($sessions)->where('status', 'SELESAI')->count() }}
                </strong>

            </div>

        </div>

    </div>


    <!-- =========================
         MAIN CARD
    ========================== -->

    <div class="session-card">

        <div class="card-top">

            <div>

                <div class="card-title-row">

                    <h2>
                        Daftar Sesi Perkuliahan
                    </h2>

                    <span class="data-count">
                        {{ count($sessions) }} data
                    </span>

                </div>

                <p>
                    Riwayat sesi yang telah dibuat dalam sistem Smart Attendance.
                </p>

            </div>


            <!-- SEARCH -->

            <div class="search-wrapper">

                <span class="search-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <circle cx="10.8" cy="10.8" r="5.8"></circle>
                        <path d="M15.2 15.2L20 20"></path>
                    </svg>
                </span>

                <input
                    type="text"
                    id="searchSession"
                    class="search-input"
                    placeholder="Cari mata kuliah atau kelas..."
                >

            </div>

        </div>


        <!-- =========================
             TABLE
        ========================== -->

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th class="number-column">
                            No
                        </th>

                        <th>
                            Mata Kuliah
                        </th>

                        <th>
                            Kelas
                        </th>

                        <th>
                            Pertemuan
                        </th>

                        <th>
                            Materi
                        </th>

                        <th>
                            Tanggal
                        </th>

                        <th>
                            Jam
                        </th>

                        <th>
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody id="sessionTableBody">

                    @forelse($sessions as $index => $session)

                        <tr>

                            <!-- NO -->

                            <td class="number-cell">
                                {{ $index + 1 }}
                            </td>


                            <!-- MATA KULIAH -->

                            <td>

                                <div class="course-name">

                                    <div class="course-icon">
                                        {{ strtoupper(substr($session['mata_kuliah'], 0, 1)) }}
                                    </div>

                                    <div>

                                        <strong>
                                            {{ $session['mata_kuliah'] }}
                                        </strong>

                                        <span>
                                            Sesi Perkuliahan
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <!-- KELAS -->

                            <td>

                                <span class="class-badge">
                                    {{ $session['kelas'] }}
                                </span>

                            </td>


                            <!-- PERTEMUAN -->

                            <td>

                                <span class="meeting-badge">
                                    Pertemuan {{ $session['pertemuan'] }}
                                </span>

                            </td>


                            <!-- MATERI -->

                            <td>

                                <span class="material-text">
                                    {{ $session['materi'] }}
                                </span>

                            </td>


                            <!-- TANGGAL -->

                            <td>

                                <span class="date-text">
                                    {{ $session['tanggal'] }}
                                </span>

                            </td>


                            <!-- JAM -->

                            <td>

                                <span class="time-text">
                                    {{ $session['jam'] }}
                                </span>

                            </td>


                            <!-- STATUS -->

                            <td>

                                @if($session['status'] === 'AKTIF')

                                    <span class="status-badge active">

                                        <span></span>

                                        AKTIF

                                    </span>

                                @else

                                    <span class="status-badge completed">

                                        <span></span>

                                        SELESAI

                                    </span>

                                @endif

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="empty-state"
                            >

                                <div class="empty-icon">
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <circle cx="12" cy="12" r="8.5"></circle>
                                        <path d="M12 7v5l3.2 2"></path>
                                    </svg>
                                </div>

                                <strong>
                                    Belum ada riwayat sesi
                                </strong>

                                <p>
                                    Sesi perkuliahan yang dibuat akan
                                    muncul di halaman ini.
                                </p>

                                <a
                                    href="{{ route('sessions.create') }}"
                                    class="empty-button"
                                >
                                    Buat Sesi Pertama
                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        @if(count($sessions) > 0)

            <div class="table-footer">

                <span>
                    Menampilkan
                    <strong id="visibleCount">
                        {{ count($sessions) }}
                    </strong>
                    sesi
                </span>

                <span>
                    Smart Attendance
                </span>

            </div>

        @endif

    </div>

</div>


<style>
/* =========================================
   RIWAYAT SESI — DARK SLATE SAAS
   Visual-only redesign. Blade/PHP/JS logic
   remains unchanged.
========================================= */

.session-page {
    --navy: #06141B;
    --slate: #253745;
    --slate-2: #11212D;
    --slate-3: #4A5C6A;
    --muted: #71808A;
    --soft: #9BA8AB;
    --border: #DDE3E5;
    --workspace: #F2F4F4;
    --green: #16A34A;

    max-width: 1180px;
    margin: 0 auto;
    padding: 28px 0 42px;
}

/* HEADER */

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 24px;
    margin-bottom: 24px;
}

.page-header > div {
    min-width: 0;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 14px;
    color: var(--slate-3);
    text-decoration: none;
    font-size: 12px;
    font-weight: 650;
    transition: .18s ease;
}

.back-link svg {
    width: 15px;
    height: 15px;
    fill: none;
    stroke: currentColor;
    stroke-width: 1.8;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.back-link:hover {
    color: var(--navy);
    transform: translateX(-1px);
}

.eyebrow {
    display: block;
    margin-bottom: 7px;
    color: var(--slate-3);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.2px;
}

.page-header h1 {
    margin: 0;
    color: var(--navy);
    font-size: 30px;
    line-height: 1.15;
    font-weight: 760;
    letter-spacing: -.65px;
}

.page-header p {
    margin: 8px 0 0;
    color: var(--muted);
    font-size: 13px;
}

.primary-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 42px;
    padding: 0 16px;
    border: 1px solid var(--slate);
    border-radius: 10px;
    background: var(--slate);
    color: #fff;
    text-decoration: none;
    font-size: 12px;
    font-weight: 750;
    box-shadow: 0 7px 18px rgba(6, 20, 27, .12);
    transition: .18s ease;
    white-space: nowrap;
}

.primary-button svg {
    width: 15px;
    height: 15px;
    fill: none;
    stroke: currentColor;
    stroke-width: 1.9;
    stroke-linecap: round;
}

.primary-button:hover {
    background: var(--navy);
    border-color: var(--navy);
    transform: translateY(-1px);
    box-shadow: 0 10px 22px rgba(6, 20, 27, .16);
}

/* SUMMARY */

.summary-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: 18px;
}

.summary-card {
    display: flex;
    align-items: center;
    gap: 13px;
    min-height: 86px;
    padding: 17px 18px;
    border: 1px solid var(--border);
    border-radius: 15px;
    background: #fff;
    box-shadow: 0 5px 18px rgba(6, 20, 27, .035);
}

.summary-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    border: 1px solid #DCE3E5;
    border-radius: 11px;
    background: #F3F6F7;
    color: var(--slate);
}

.summary-icon svg {
    width: 19px;
    height: 19px;
    fill: none;
    stroke: currentColor;
    stroke-width: 1.8;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.summary-label {
    display: block;
    margin-bottom: 4px;
    color: var(--soft);
    font-size: 9px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .65px;
}

.summary-card strong {
    color: var(--navy);
    font-size: 22px;
    line-height: 1;
    font-weight: 760;
}

/* MAIN CARD */

.session-card {
    overflow: hidden;
    border: 1px solid var(--border);
    border-radius: 18px;
    background: #fff;
    box-shadow:
        0 9px 30px rgba(6, 20, 27, .055),
        0 2px 6px rgba(6, 20, 27, .025);
}

/* CARD TOP */

.card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 22px;
    padding: 22px 23px;
    border-bottom: 1px solid #E8ECEE;
}

.card-title-row {
    display: flex;
    align-items: center;
    gap: 9px;
}

.card-top h2 {
    margin: 0;
    color: var(--navy);
    font-size: 17px;
    font-weight: 720;
}

.card-top p {
    margin: 6px 0 0;
    color: var(--muted);
    font-size: 11px;
}

.data-count {
    padding: 4px 8px;
    border: 1px solid #E0E5E7;
    border-radius: 999px;
    background: #F4F6F7;
    color: var(--slate-3);
    font-size: 9px;
    font-weight: 750;
}

/* SEARCH */

.search-wrapper {
    position: relative;
    width: 270px;
    flex: 0 0 270px;
}

.search-icon {
    position: absolute;
    top: 50%;
    left: 12px;
    display: flex;
    transform: translateY(-50%);
    color: var(--soft);
    pointer-events: none;
}

.search-icon svg {
    width: 15px;
    height: 15px;
    fill: none;
    stroke: currentColor;
    stroke-width: 1.7;
    stroke-linecap: round;
}

.search-input {
    width: 100%;
    height: 39px;
    box-sizing: border-box;
    padding: 0 12px 0 36px;
    border: 1px solid #D9E0E2;
    border-radius: 9px;
    outline: none;
    background: #F7F9F9;
    color: var(--navy);
    font-size: 11px;
    transition: .18s ease;
}

.search-input:focus {
    border-color: #8A989F;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(37, 55, 69, .08);
}

.search-input::placeholder {
    color: #9BA8AB;
}

/* TABLE */

.table-wrapper {
    width: 100%;
    overflow-x: auto;
}

table {
    width: 100%;
    min-width: 950px;
    border-collapse: collapse;
}

th {
    padding: 12px 14px;
    border-bottom: 1px solid #E4E9EA;
    background: #F7F9F9;
    color: #6E7D85;
    font-size: 9px;
    font-weight: 800;
    text-align: left;
    text-transform: uppercase;
    letter-spacing: .45px;
    white-space: nowrap;
}

td {
    padding: 14px;
    border-bottom: 1px solid #EDF0F1;
    color: #26353D;
    font-size: 11px;
    vertical-align: middle;
}

tbody tr {
    transition: background .15s ease;
}

tbody tr:hover {
    background: #F8FAFA;
}

tbody tr:last-child td {
    border-bottom: none;
}

.number-column {
    width: 45px;
}

.number-cell {
    color: #9BA8AB;
    font-size: 10px;
    font-weight: 650;
}

/* COURSE */

.course-name {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 230px;
}

.course-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    flex: 0 0 34px;
    border: 1px solid #DCE3E5;
    border-radius: 9px;
    background: #F1F4F5;
    color: var(--slate);
    font-size: 11px;
    font-weight: 800;
}

.course-name strong {
    display: block;
    max-width: 240px;
    margin-bottom: 3px;
    color: var(--navy);
    font-size: 11px;
    line-height: 1.4;
    font-weight: 720;
}

.course-name span {
    display: block;
    color: #9BA8AB;
    font-size: 9px;
}

/* CLASS */

.class-badge {
    display: inline-flex;
    align-items: center;
    padding: 5px 9px;
    border: 1px solid #D9E1E4;
    border-radius: 7px;
    background: #F3F6F7;
    color: var(--slate-3);
    font-size: 9px;
    font-weight: 750;
}

/* MEETING */

.meeting-badge {
    display: inline-flex;
    padding: 5px 8px;
    border: 1px solid #E0E4E5;
    border-radius: 7px;
    background: #F5F6F6;
    color: var(--slate-3);
    font-size: 9px;
    font-weight: 750;
    white-space: nowrap;
}

/* MATERIAL */

.material-text {
    display: block;
    max-width: 150px;
    color: #68777F;
    font-size: 10px;
    line-height: 1.4;
}

/* DATE / TIME */

.date-text {
    color: #68777F;
    white-space: nowrap;
}

.time-text {
    color: var(--navy);
    font-weight: 700;
    white-space: nowrap;
}

/* STATUS */

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 9px;
    border-radius: 999px;
    font-size: 9px;
    font-weight: 800;
    white-space: nowrap;
}

.status-badge span {
    width: 6px;
    height: 6px;
    border-radius: 50%;
}

.status-badge.active {
    background: #DCFCE7;
    color: #15803D;
}

.status-badge.active span {
    background: #22C55E;
    box-shadow: 0 0 0 3px rgba(34, 197, 94, .10);
}

.status-badge.completed {
    background: #EEF1F2;
    color: #65747C;
}

.status-badge.completed span {
    background: #97A5AA;
}

/* EMPTY */

.empty-state {
    padding: 64px 20px !important;
    text-align: center;
}

.empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 55px;
    height: 55px;
    margin: 0 auto 13px;
    border: 1px solid #DDE4E6;
    border-radius: 15px;
    background: #F2F5F6;
    color: var(--slate);
}

.empty-icon svg {
    width: 23px;
    height: 23px;
    fill: none;
    stroke: currentColor;
    stroke-width: 1.7;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.empty-state strong {
    display: block;
    margin-bottom: 5px;
    color: var(--navy);
    font-size: 14px;
}

.empty-state p {
    max-width: 370px;
    margin: 0 auto 16px;
    color: #9BA8AB;
    font-size: 11px;
    line-height: 1.55;
}

.empty-button {
    display: inline-flex;
    align-items: center;
    padding: 9px 13px;
    border: 1px solid #D9E0E2;
    border-radius: 8px;
    background: #F2F5F6;
    color: var(--slate);
    text-decoration: none;
    font-size: 10px;
    font-weight: 750;
    transition: .18s ease;
}

.empty-button:hover {
    background: var(--slate);
    border-color: var(--slate);
    color: #fff;
}

/* FOOTER */

.table-footer {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    padding: 12px 23px;
    border-top: 1px solid #E8ECEE;
    background: #FAFBFB;
    color: #9BA8AB;
    font-size: 9px;
}

.table-footer strong {
    color: #52636C;
}

/* RESPONSIVE */

@media (max-width: 1050px) {
    .session-page {
        padding-left: 18px;
        padding-right: 18px;
    }
}

@media (max-width: 850px) {
    .page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .primary-button {
        width: 100%;
    }

    .summary-grid {
        grid-template-columns: 1fr;
    }

    .card-top {
        align-items: flex-start;
        flex-direction: column;
    }

    .search-wrapper {
        width: 100%;
        flex-basis: auto;
    }
}

@media (max-width: 520px) {
    .session-page {
        padding: 20px 12px 30px;
    }

    .page-header h1 {
        font-size: 25px;
    }

    .page-header p {
        font-size: 12px;
    }

    .session-card {
        border-radius: 15px;
    }

    .card-top {
        padding: 17px;
    }

    .summary-card {
        min-height: 78px;
        padding: 15px;
    }

    .table-footer {
        padding: 11px 17px;
    }
}

</style>


<script>

const searchInput =
    document.getElementById('searchSession');

const tableBody =
    document.getElementById('sessionTableBody');

const visibleCount =
    document.getElementById('visibleCount');


if (searchInput && tableBody) {

    searchInput.addEventListener('input', function () {

        const keyword =
            this.value
                .toLowerCase()
                .trim();

        const rows =
            tableBody.querySelectorAll('tr');

        let visibleRows = 0;


        rows.forEach(function (row) {

            /*
            Lewati baris empty state
            */

            if (!row.cells[1]) {
                return;
            }


            const course =
                row.cells[1]
                    ?.textContent
                    .toLowerCase() || '';

            const kelas =
                row.cells[2]
                    ?.textContent
                    .toLowerCase() || '';


            if (
                course.includes(keyword) ||
                kelas.includes(keyword)
            ) {

                row.style.display = '';
                visibleRows++;

            } else {

                row.style.display = 'none';

            }

        });


        if (visibleCount) {

            visibleCount.textContent =
                visibleRows;

        }

    });

}

</script>

@endsection