@extends('layouts.app')

@section('title', 'Riwayat Absensi - Smart Attendance')

@section('content')

<div class="attendance-page">

    <!-- =========================
         HEADER
    ========================== -->

    <div class="page-header">

        <div>

            <a href="{{ route('dashboard') }}" class="back-link">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M15 18l-6-6 6-6"></path>
                </svg>
                Kembali ke Dashboard
            </a>

            <span class="eyebrow">
                DATA KEHADIRAN
            </span>

            <h1>
                Riwayat Absensi
            </h1>

            <p>
                Pantau seluruh data kehadiran mahasiswa yang tercatat dalam sistem.
            </p>

        </div>

        <div class="header-status">
            <span class="status-dot"></span>
            Data Kehadiran
        </div>

    </div>


    <!-- =========================
         SUMMARY
    ========================== -->

    <div class="summary-grid">

        <div class="summary-card">

            <div class="summary-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12.5l4 4L19 7"></path>
                </svg>
            </div>

            <div>

                <span class="summary-label">
                    Total Kehadiran
                </span>

                <strong>
                    {{ count($attendances) }}
                </strong>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon today-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <rect x="3.5" y="5.5" width="17" height="15" rx="2"></rect>
                    <path d="M7 3.5v4M17 3.5v4M3.5 9.5h17"></path>
                </svg>
            </div>

            <div>

                <span class="summary-label">
                    Kehadiran Hari Ini
                </span>

                <strong>
                    {{ collect($attendances)->where('tanggal', now()->format('Y-m-d'))->count() }}
                </strong>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon student-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="9" cy="8" r="3"></circle>
                    <path d="M3.5 19c.6-3 2.4-4.5 5.5-4.5s4.9 1.5 5.5 4.5"></path>
                    <path d="M16 5.5a3 3 0 0 1 0 5.8M17 14.7c2 .5 3.2 1.8 3.6 4.3"></path>
                </svg>
            </div>

            <div>

                <span class="summary-label">
                    Mahasiswa Hadir
                </span>

                <strong>
                    {{ collect($attendances)->pluck('nim')->unique()->count() }}
                </strong>

            </div>

        </div>

    </div>


    <!-- =========================
         MAIN CARD
    ========================== -->

    <div class="attendance-card">

        <div class="card-top">

            <div>

                <div class="card-title-row">

                    <h2>
                        Data Kehadiran
                    </h2>

                    <span class="data-count">
                        {{ count($attendances) }} data
                    </span>

                </div>

                <p>
                    Riwayat mahasiswa yang telah melakukan absensi.
                </p>

            </div>


            <!-- SEARCH -->

            <div class="search-wrapper">

                <span class="search-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <circle cx="10.8" cy="10.8" r="6.8"></circle>
                        <path d="M16 16l5 5"></path>
                    </svg>
                </span>

                <input
                    type="text"
                    id="searchAbsensi"
                    class="search-input"
                    placeholder="Cari mahasiswa atau NIM..."
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
                            Mahasiswa
                        </th>

                        <th>
                            NIM
                        </th>

                        <th>
                            Kelas
                        </th>

                        <th>
                            Mata Kuliah
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


                <tbody id="attendanceTableBody">

                    @forelse($attendances as $index => $attendance)

                        <tr>

                            <!-- NO -->

                            <td class="number-cell">
                                {{ $index + 1 }}
                            </td>


                            <!-- MAHASISWA -->

                            <td>

                                <div class="student-name">

                                    <div class="avatar">
                                        {{ strtoupper(substr($attendance['nama'], 0, 1)) }}
                                    </div>

                                    <div>

                                        <strong>
                                            {{ $attendance['nama'] }}
                                        </strong>

                                        <span>
                                            Mahasiswa
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <!-- NIM -->

                            <td>

                                <span class="nim-text">
                                    {{ $attendance['nim'] }}
                                </span>

                            </td>


                            <!-- KELAS -->

                            <td>

                                <span class="class-badge">
                                    {{ $attendance['kelas'] }}
                                </span>

                            </td>


                            <!-- MATA KULIAH -->

                            <td>

                                <span class="course-text">
                                    {{ $attendance['mata_kuliah'] }}
                                </span>

                            </td>


                            <!-- PERTEMUAN -->

                            <td>

                                <span class="meeting-badge">
                                    Pertemuan {{ $attendance['pertemuan'] }}
                                </span>

                            </td>


                            <!-- MATERI -->

                            <td>

                                <span class="material-text">
                                    {{ $attendance['materi'] }}
                                </span>

                            </td>


                            <!-- TANGGAL -->

                            <td>

                                <span class="date-text">
                                    {{ $attendance['tanggal'] }}
                                </span>

                            </td>


                            <!-- JAM -->

                            <td>

                                <span class="time-text">
                                    {{ $attendance['jam'] }}
                                </span>

                            </td>


                            <!-- STATUS -->

                            <td>

                                <span class="status-badge">
                                    <span></span>
                                    {{ $attendance['status'] }}
                                </span>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="10"
                                class="empty-state"
                            >

                                <div class="empty-icon">
                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M5 12.5l4 4L19 7"></path>
                                    </svg>
                                </div>

                                <strong>
                                    Belum ada data absensi
                                </strong>

                                <p>
                                    Data kehadiran mahasiswa akan muncul
                                    setelah proses scan QR berhasil.
                                </p>

                                <a
                                    href="{{ route('scanner') }}"
                                    class="scanner-button"
                                >
                                    Buka Scanner
                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        @if(count($attendances) > 0)

            <div class="table-footer">

                <span>
                    Menampilkan
                    <strong id="visibleCount">
                        {{ count($attendances) }}
                    </strong>
                    data absensi
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
   RIWAYAT ABSENSI — DARK SLATE SAAS
   Visual-only redesign. Laravel logic unchanged.
========================================= */

.attendance-page {
    max-width: 1180px;
    margin: 0 auto;
    padding-bottom: 34px;
}

/* HEADER */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 20px;
    margin-bottom: 26px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 11px;
    color: #4A5C6A;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    transition: .2s ease;
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
    color: #253745;
}

.eyebrow {
    display: block;
    margin-bottom: 6px;
    color: #4A5C6A;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.15px;
}

.page-header h1 {
    margin: 0;
    color: #06141B;
    font-size: 30px;
    font-weight: 750;
    letter-spacing: -.65px;
}

.page-header p {
    margin: 7px 0 0;
    color: #6E7E88;
    font-size: 13px;
    line-height: 1.5;
}

.header-status {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 14px;
    border: 1px solid #DCE7E2;
    border-radius: 999px;
    background: #F0F8F4;
    color: #23805A;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.status-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #2FA36B;
    box-shadow: 0 0 0 3px rgba(47, 163, 107, .10);
}

/* SUMMARY */
.summary-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.summary-card {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 18px;
    border: 1px solid #E1E6E8;
    border-radius: 16px;
    background: #FFFFFF;
    box-shadow: 0 7px 24px rgba(6, 20, 27, .035);
    transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
}

.summary-card:hover {
    transform: translateY(-1px);
    border-color: #D5DDE0;
    box-shadow: 0 10px 28px rgba(6, 20, 27, .055);
}

.summary-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 43px;
    height: 43px;
    flex-shrink: 0;
    border-radius: 12px;
    background: #EAF4EF;
    color: #23805A;
}

.summary-icon svg {
    width: 20px;
    height: 20px;
    fill: none;
    stroke: currentColor;
    stroke-width: 1.8;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.today-icon {
    background: #E8ECEE;
    color: #253745;
}

.student-icon {
    background: #E8ECEE;
    color: #4A5C6A;
}

.summary-label {
    display: block;
    margin-bottom: 4px;
    color: #9BA8AB;
    font-size: 10px;
    font-weight: 750;
    text-transform: uppercase;
    letter-spacing: .55px;
}

.summary-card strong {
    color: #06141B;
    font-size: 23px;
    font-weight: 750;
    letter-spacing: -.3px;
}

/* MAIN CARD */
.attendance-card {
    overflow: hidden;
    border: 1px solid #DDE3E5;
    border-radius: 20px;
    background: #FFFFFF;
    box-shadow:
        0 10px 34px rgba(6, 20, 27, .055),
        0 2px 7px rgba(6, 20, 27, .025);
}

/* CARD TOP */
.card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    padding: 23px 24px;
    border-bottom: 1px solid #E7EBEC;
}

.card-title-row {
    display: flex;
    align-items: center;
    gap: 9px;
}

.card-top h2 {
    margin: 0;
    color: #06141B;
    font-size: 18px;
    font-weight: 700;
    letter-spacing: -.15px;
}

.card-top p {
    margin: 6px 0 0;
    color: #6E7E88;
    font-size: 12px;
}

.data-count {
    padding: 4px 8px;
    border: 1px solid #E0E5E7;
    border-radius: 999px;
    background: #F1F3F4;
    color: #4A5C6A;
    font-size: 10px;
    font-weight: 750;
}

/* SEARCH */
.search-wrapper {
    position: relative;
    width: 260px;
    flex-shrink: 0;
}

.search-icon {
    position: absolute;
    top: 50%;
    left: 12px;
    transform: translateY(-52%);
    color: #9BA8AB;
    pointer-events: none;
}

.search-icon svg {
    width: 17px;
    height: 17px;
    fill: none;
    stroke: currentColor;
    stroke-width: 1.8;
    stroke-linecap: round;
}

.search-input {
    width: 100%;
    height: 40px;
    box-sizing: border-box;
    padding: 0 12px 0 37px;
    border: 1px solid #D6DEE1;
    border-radius: 10px;
    outline: none;
    background: #F7F8F8;
    color: #172A33;
    font-size: 12px;
    transition: .2s ease;
}

.search-input:focus {
    border-color: #7C8C94;
    background: #FFFFFF;
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
    min-width: 1200px;
    border-collapse: collapse;
}

th {
    padding: 13px 14px;
    border-bottom: 1px solid #E1E6E8;
    background: #F5F7F7;
    color: #5E707B;
    font-size: 10px;
    font-weight: 800;
    text-align: left;
    text-transform: uppercase;
    letter-spacing: .4px;
    white-space: nowrap;
}

td {
    padding: 15px 14px;
    border-bottom: 1px solid #EDF0F1;
    color: #172A33;
    font-size: 12px;
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
    font-size: 11px;
    font-weight: 650;
}

/* STUDENT */
.student-name {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 170px;
}

.avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    border: 1px solid #DCE3E5;
    border-radius: 10px;
    background: #E8ECEE;
    color: #253745;
    font-size: 12px;
    font-weight: 800;
}

.student-name strong {
    display: block;
    margin-bottom: 3px;
    color: #172A33;
    font-size: 12px;
}

.student-name span {
    display: block;
    color: #9BA8AB;
    font-size: 9px;
}

/* NIM */
.nim-text {
    color: #334B57;
    font-weight: 650;
    white-space: nowrap;
}

/* CLASS */
.class-badge {
    display: inline-flex;
    align-items: center;
    padding: 5px 9px;
    border: 1px solid #D8E0E3;
    border-radius: 7px;
    background: #F0F3F4;
    color: #334B57;
    font-size: 10px;
    font-weight: 750;
}

/* COURSE */
.course-text {
    display: block;
    max-width: 190px;
    color: #334B57;
    font-size: 11px;
    font-weight: 600;
    line-height: 1.4;
}

/* MEETING */
.meeting-badge {
    display: inline-flex;
    padding: 5px 8px;
    border: 1px solid #D8E0E3;
    border-radius: 7px;
    background: #F0F3F4;
    color: #4A5C6A;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

/* MATERIAL */
.material-text {
    display: block;
    max-width: 150px;
    color: #6E7E88;
    font-size: 11px;
    line-height: 1.4;
}

/* DATE & TIME */
.date-text {
    color: #4A5C6A;
    white-space: nowrap;
}

.time-text {
    color: #334B57;
    font-weight: 650;
    white-space: nowrap;
}

/* STATUS */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 9px;
    border: 1px solid #DCEBE3;
    border-radius: 999px;
    background: #EEF8F2;
    color: #23805A;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.status-badge span {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #2FA36B;
}

/* EMPTY */
.empty-state {
    padding: 60px 20px !important;
    text-align: center;
}

.empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 55px;
    height: 55px;
    margin: 0 auto 12px;
    border-radius: 15px;
    background: #EAF4EF;
    color: #23805A;
}

.empty-icon svg {
    width: 23px;
    height: 23px;
    fill: none;
    stroke: currentColor;
    stroke-width: 1.9;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.empty-state strong {
    display: block;
    margin-bottom: 5px;
    color: #334B57;
    font-size: 14px;
}

.empty-state p {
    max-width: 370px;
    margin: 0 auto 16px;
    color: #9BA8AB;
    font-size: 12px;
    line-height: 1.5;
}

.scanner-button {
    display: inline-flex;
    align-items: center;
    padding: 9px 14px;
    border: 1px solid #D8E0E3;
    border-radius: 8px;
    background: #253745;
    color: #FFFFFF;
    text-decoration: none;
    font-size: 11px;
    font-weight: 700;
    transition: .2s ease;
}

.scanner-button:hover {
    background: #11212D;
    transform: translateY(-1px);
}

/* FOOTER */
.table-footer {
    display: flex;
    justify-content: space-between;
    padding: 13px 24px;
    border-top: 1px solid #E7EBEC;
    background: #FAFBFB;
    color: #9BA8AB;
    font-size: 10px;
}

.table-footer strong {
    color: #4A5C6A;
}

/* RESPONSIVE */
@media (max-width: 850px) {
    .summary-grid {
        grid-template-columns: 1fr;
    }

    .page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .header-status {
        width: fit-content;
    }

    .card-top {
        align-items: flex-start;
        flex-direction: column;
    }

    .search-wrapper {
        width: 100%;
    }
}

@media (max-width: 520px) {
    .attendance-page {
        padding-bottom: 24px;
    }

    .page-header h1 {
        font-size: 25px;
    }

    .attendance-card {
        border-radius: 16px;
    }

    .card-top {
        padding: 18px;
    }

    .table-footer {
        padding: 12px 18px;
    }
}
</style>


<script>

const searchInput =
    document.getElementById('searchAbsensi');

const tableBody =
    document.getElementById('attendanceTableBody');

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
            Baris kosong tidak ikut pencarian
            */

            if (!row.cells[1]) {
                return;
            }


            const nim =
                row.cells[2]
                    ?.textContent
                    .toLowerCase() || '';

            const nama =
                row.cells[1]
                    ?.textContent
                    .toLowerCase() || '';


            if (
                nim.includes(keyword) ||
                nama.includes(keyword)
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