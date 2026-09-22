@extends('layouts.app')

@section('title', 'Buat Sesi - Smart Attendance')

@section('content')

<div class="session-page">

    {{-- =========================
         HEADER
    ========================== --}}

    <div class="page-header">

        <div>

            <a href="{{ route('dashboard') }}" class="back-link">

                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M19 12H5M12 19l-7-7 7-7"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>

                Kembali ke Dashboard

            </a>

            <div class="title-row">

                <div>

                    <span class="eyebrow">
                        SISTEM ABSENSI DIGITAL
                    </span>

                    <h1>
                        Buat Sesi Absensi
                    </h1>

                    <p>
                        Siapkan sesi perkuliahan sebelum mahasiswa melakukan absensi.
                    </p>

                </div>

            </div>

        </div>


        <div class="header-status">

            <span class="status-dot"></span>

            Sesi Baru

        </div>

    </div>


    {{-- =========================
         MAIN CARD
    ========================== --}}

    <div class="session-card">


        {{-- CARD HEADER --}}

        <div class="card-header">

            <div class="header-icon">

                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M12 5v14M5 12h14"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                    />
                </svg>

            </div>

            <div>

                <h2>
                    Sesi Perkuliahan
                </h2>

                <p>
                    Pilih mata kuliah dan pertemuan. Informasi jadwal akan
                    diisi otomatis oleh sistem.
                </p>

            </div>

        </div>


        <form action="/buat-sesi" method="POST">

            @csrf


            {{-- =========================
                 MATA KULIAH
            ========================== --}}

            <div class="section-label">
                INFORMASI PERKULIAHAN
            </div>


            <div class="session-form-grid">


                {{-- MATA KULIAH --}}

                <div class="form-group form-wide">

                    <label for="mata_kuliah">
                        Mata Kuliah
                    </label>

                    <div class="select-wrapper">

                        <select
                            id="mata_kuliah"
                            name="mata_kuliah"
                            required
                        >

                            <option value="">
                                Pilih Mata Kuliah
                            </option>

                            @foreach($courses as $course)

                                <option
                                    value="{{ $course['mata_kuliah'] }}"
                                    {{ old('mata_kuliah') == $course['mata_kuliah'] ? 'selected' : '' }}
                                >
                                    {{ $course['mata_kuliah'] }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <small>
                        Pilih mata kuliah untuk menampilkan jadwal secara otomatis.
                    </small>

                </div>


                {{-- DOSEN --}}

                <div class="form-group">

                    <label for="dosen">
                        Dosen Pengampu
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">

                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">

                                <circle
                                    cx="12"
                                    cy="8"
                                    r="3.2"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                />

                                <path
                                    d="M5.5 20c.7-3.2 2.8-5 6.5-5s5.8 1.8 6.5 5"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    stroke-linecap="round"
                                />

                            </svg>

                        </span>

                        <input
                            type="text"
                            id="dosen"
                            placeholder="Otomatis berdasarkan mata kuliah"
                            readonly
                        >

                    </div>

                </div>


                {{-- KELAS --}}

                <div class="form-group">

                    <label for="kelas">
                        Semester / Kelas
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">

                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">

                                <path
                                    d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                />

                                <path
                                    d="M16 10a2.5 2.5 0 1 0 0-5"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    stroke-linecap="round"
                                />

                                <path
                                    d="M3.5 19c.5-3 2.1-4.5 4.5-4.5s4 1.5 4.5 4.5"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    stroke-linecap="round"
                                />

                                <path
                                    d="M14 15c3.5-.1 5.5 1.3 6 4"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    stroke-linecap="round"
                                />

                            </svg>

                        </span>

                        <input
                            type="text"
                            id="kelas"
                            name="kelas"
                            placeholder="Otomatis"
                            readonly
                            required
                        >

                    </div>

                </div>

            </div>


            {{-- =========================
                 JADWAL
            ========================== --}}

            <div class="section-label schedule-label">
                JADWAL PERKULIAHAN
            </div>


            <div class="schedule-card">


                {{-- HARI --}}

                <div class="schedule-item">

                    <span class="schedule-icon">

                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none">

                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="16"
                                rx="2"
                                stroke="currentColor"
                                stroke-width="1.7"
                            />

                            <path
                                d="M16 3v4M8 3v4M3 10h18"
                                stroke="currentColor"
                                stroke-width="1.7"
                                stroke-linecap="round"
                            />

                        </svg>

                    </span>

                    <div>

                        <span class="schedule-title">
                            Hari
                        </span>

                        <strong id="hari-display">
                            —
                        </strong>

                    </div>

                </div>


                <div class="schedule-divider"></div>


                {{-- JAM --}}

                <div class="schedule-item">

                    <span class="schedule-icon">

                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none">

                            <circle
                                cx="12"
                                cy="12"
                                r="8.5"
                                stroke="currentColor"
                                stroke-width="1.7"
                            />

                            <path
                                d="M12 7v5l3 2"
                                stroke="currentColor"
                                stroke-width="1.7"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                        </svg>

                    </span>

                    <div>

                        <span class="schedule-title">
                            Jam
                        </span>

                        <strong id="jam-display">
                            —
                        </strong>

                    </div>

                </div>


                <div class="schedule-divider"></div>


                {{-- RUANG --}}

                <div class="schedule-item">

                    <span class="schedule-icon">

                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none">

                            <path
                                d="M4 21V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16"
                                stroke="currentColor"
                                stroke-width="1.7"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M2 21h20"
                                stroke="currentColor"
                                stroke-width="1.7"
                                stroke-linecap="round"
                            />

                            <path
                                d="M9 21v-4h6v4M8 8h1M12 8h1M16 8h1M8 12h1M12 12h1M16 12h1"
                                stroke="currentColor"
                                stroke-width="1.7"
                                stroke-linecap="round"
                            />

                        </svg>

                    </span>

                    <div>

                        <span class="schedule-title">
                            Ruang
                        </span>

                        <strong id="ruang-display">
                            —
                        </strong>

                    </div>

                </div>

            </div>


            {{-- HIDDEN FIELD --}}

            <input
                type="hidden"
                id="hari"
            >

            <input
                type="hidden"
                id="ruang"
            >

            <input
                type="hidden"
                id="jam"
                name="jam"
                required
            >


            {{-- =========================
                 PERTEMUAN & MATERI
            ========================== --}}

            <div class="section-label meeting-label">
                DETAIL SESI
            </div>


            <div class="session-form-grid">


                {{-- PERTEMUAN --}}

                <div class="form-group">

                    <label for="pertemuan">
                        Pertemuan
                    </label>

                    <div class="select-wrapper">

                        <select
                            id="pertemuan"
                            name="pertemuan"
                            required
                        >

                            <option value="">
                                Pilih Pertemuan
                            </option>

                            @for($i = 1; $i <= 14; $i++)

                                <option
                                    value="{{ $i }}"
                                    data-pertemuan="{{ $i }}"
                                    {{ old('pertemuan') == $i ? 'selected' : '' }}
                                >
                                    Pertemuan {{ $i }}
                                </option>

                            @endfor

                        </select>

                    </div>

                    <small>
                        Pertemuan yang sudah dilakukan akan otomatis dinonaktifkan.
                    </small>

                </div>


                {{-- MATERI --}}

                <div class="form-group">

                    <label for="materi">
                        Materi Perkuliahan
                    </label>

                    <input
                        type="text"
                        id="materi"
                        name="materi"
                        value="{{ old('materi') }}"
                        placeholder="Contoh: Pengenalan Sistem Informasi"
                        required
                    >

                </div>

            </div>


            {{-- TANGGAL --}}

            <input
                type="hidden"
                id="tanggal"
                name="tanggal"
            >


            {{-- =========================
                 INFO
            ========================== --}}

            <div class="info-box">

                <div class="info-icon">

                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none">

                        <path
                            d="M5 12.5l4 4L19 6.5"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                    </svg>

                </div>

                <div>

                    <strong>
                        Jadwal akan diisi otomatis
                    </strong>

                    <p>
                        Setelah mata kuliah dipilih, dosen, kelas, hari,
                        jam, dan ruang akan disesuaikan dengan jadwal
                        perkuliahan yang tersedia.
                    </p>

                </div>

            </div>


            {{-- =========================
                 ACTION
            ========================== --}}

            <div class="form-actions">

                <a
                    href="{{ route('dashboard') }}"
                    class="cancel-button"
                >
                    Batal
                </a>


                <button
                    type="submit"
                    class="start-button"
                >

                    Mulai Sesi

                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">

                        <path
                            d="M5 12h14"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        />

                        <path
                            d="m13 6 6 6-6 6"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                    </svg>

                </button>

            </div>

        </form>

    </div>

</div>


<script>

    const mataKuliah =
        document.getElementById('mata_kuliah');

    const dosen =
        document.getElementById('dosen');

    const kelas =
        document.getElementById('kelas');

    const hari =
        document.getElementById('hari');

    const jam =
        document.getElementById('jam');

    const ruang =
        document.getElementById('ruang');

    const tanggal =
        document.getElementById('tanggal');

    const hariDisplay =
        document.getElementById('hari-display');

    const jamDisplay =
        document.getElementById('jam-display');

    const ruangDisplay =
        document.getElementById('ruang-display');

    const courses =
        @json($courses);


    /*
    =============================================
    PILIH MATA KULIAH
    =============================================
    */

    mataKuliah.addEventListener('change', function () {

        const namaMataKuliah =
            this.value;


        const jadwal =
            courses.find(function (course) {

                return course.mata_kuliah === namaMataKuliah;

            });


        if (jadwal) {


            /*
            -----------------------------------------
            INFORMASI OTOMATIS
            -----------------------------------------
            */

            dosen.value =
                jadwal.dosen;

            kelas.value =
                jadwal.kelas;

            hari.value =
                jadwal.hari;

            jam.value =
                jadwal.jam;

            ruang.value =
                jadwal.ruang;


            /*
            -----------------------------------------
            TAMPILKAN JADWAL
            -----------------------------------------
            */

            hariDisplay.textContent =
                jadwal.hari || '—';

            jamDisplay.textContent =
                jadwal.jam || '—';

            ruangDisplay.textContent =
                jadwal.ruang || '—';


            /*
            -----------------------------------------
            AMBIL PERTEMUAN YANG SUDAH SELESAI
            -----------------------------------------
            */

            fetch(
                "{{ route('sessions.completed-meetings') }}" +
                "?mata_kuliah=" +
                encodeURIComponent(namaMataKuliah) +
                "&kelas=" +
                encodeURIComponent(jadwal.kelas)
            )

            .then(function (response) {

                return response.json();

            })

            .then(function (result) {

                const completedMeetings =
                    result.completed_meetings || [];


                const pertemuanSelect =
                    document.getElementById('pertemuan');


                const options =
                    pertemuanSelect.querySelectorAll(
                        'option[data-pertemuan]'
                    );


                options.forEach(function (option) {

                    const nomor =
                        Number(
                            option.dataset.pertemuan
                        );


                    if (
                        completedMeetings.includes(nomor)
                    ) {

                        option.disabled =
                            true;

                        option.textContent =
                            'Pertemuan ' +
                            nomor +
                            ' — Sudah dilakukan';

                    } else {

                        option.disabled =
                            false;

                        option.textContent =
                            'Pertemuan ' +
                            nomor;

                    }

                });


                /*
                -----------------------------------------
                PILIH PERTEMUAN PERTAMA YANG TERSEDIA
                -----------------------------------------
                */

                const firstAvailable =
                    Array.from(options).find(
                        function (option) {

                            return !option.disabled;

                        }
                    );


                if (firstAvailable) {

                    pertemuanSelect.value =
                        firstAvailable.value;

                }

            })

            .catch(function (error) {

                console.error(
                    'Gagal mengambil data pertemuan:',
                    error
                );

            });


        } else {


            /*
            -----------------------------------------
            RESET
            -----------------------------------------
            */

            dosen.value = '';
            kelas.value = '';
            hari.value = '';
            jam.value = '';
            ruang.value = '';

            hariDisplay.textContent = '—';
            jamDisplay.textContent = '—';
            ruangDisplay.textContent = '—';

        }

    });


    /*
    =============================================
    TANGGAL OTOMATIS
    =============================================
    */

    const sekarang =
        new Date();

    const tahun =
        sekarang.getFullYear();

    const bulan =
        String(
            sekarang.getMonth() + 1
        ).padStart(2, '0');

    const tanggalHari =
        String(
            sekarang.getDate()
        ).padStart(2, '0');


    tanggal.value =
        `${tahun}-${bulan}-${tanggalHari}`;

</script>


<style>

/* =========================================
   PAGE
========================================= */

.session-page {
    max-width: 980px;
    margin: 0 auto;
    padding-bottom: 30px;
}


/* =========================================
   HEADER
========================================= */

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;

    gap: 20px;

    margin-bottom: 28px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    margin-bottom: 12px;

    color: #4A5C6A;

    text-decoration: none;

    font-size: 13px;
    font-weight: 600;

    transition: .2s ease;
}

.back-link:hover {
    color: #06141B;
    transform: translateX(-2px);
}

.eyebrow {
    display: block;

    margin-bottom: 7px;

    color: #4A5C6A;

    font-size: 10px;
    font-weight: 800;

    letter-spacing: 1.2px;
}

.page-header h1 {
    margin: 0;

    color: #06141B;

    font-size: 30px;
    font-weight: 750;

    letter-spacing: -.7px;
}

.page-header p {
    margin: 7px 0 0;

    color: #4A5C6A;

    font-size: 14px;
}

.header-status {
    display: inline-flex;
    align-items: center;

    gap: 8px;

    padding: 9px 14px;

    border: 1px solid #D9E1E4;
    border-radius: 999px;

    background: #F2F4F4;
    color: #253745;

    font-size: 12px;
    font-weight: 700;

    white-space: nowrap;
}

.status-dot {
    width: 7px;
    height: 7px;

    border-radius: 50%;

    background: #4A5C6A;
}


/* =========================================
   MAIN CARD
========================================= */

.session-card {
    padding: 30px;

    border: 1px solid #E1E6E8;
    border-radius: 20px;

    background: #FFFFFF;

    box-shadow:
        0 12px 35px rgba(6, 20, 27, .06),
        0 2px 8px rgba(6, 20, 27, .03);
}


/* =========================================
   CARD HEADER
========================================= */

.card-header {
    display: flex;
    align-items: center;

    gap: 14px;

    padding-bottom: 24px;
    margin-bottom: 26px;

    border-bottom: 1px solid #E7EBEC;
}

.header-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 46px;
    height: 46px;

    flex-shrink: 0;

    border: 1px solid #D8E0E3;
    border-radius: 13px;

    background: #E8ECEE;
    color: #253745;
}

.card-header h2 {
    margin: 0 0 4px;

    color: #06141B;

    font-size: 18px;
    font-weight: 700;
}

.card-header p {
    margin: 0;

    color: #4A5C6A;

    font-size: 13px;
}


/* =========================================
   SECTION LABEL
========================================= */

.section-label {
    margin-bottom: 15px;

    color: #9BA8AB;

    font-size: 10px;
    font-weight: 800;

    letter-spacing: 1px;
}

.schedule-label,
.meeting-label {
    margin-top: 28px;
}


/* =========================================
   FORM GRID
========================================= */

.session-form-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 20px;
}

.form-wide {
    grid-column: 1 / -1;
}

.form-group {
    min-width: 0;
}

.form-group label {
    display: block;

    margin-bottom: 8px;

    color: #253745;

    font-size: 13px;
    font-weight: 700;
}

.form-group small {
    display: block;

    margin-top: 7px;

    color: #9BA8AB;

    font-size: 11px;
    line-height: 1.5;
}


/* =========================================
   INPUT
========================================= */

.form-group select,
.form-group input {
    width: 100%;
    height: 46px;

    box-sizing: border-box;

    padding: 0 14px;

    border: 1px solid #D5DDE0;
    border-radius: 10px;

    outline: none;

    background: #FFFFFF;
    color: #253745;

    font-family: inherit;
    font-size: 14px;

    transition: .2s ease;
}

.form-group select:focus,
.form-group input:focus {
    border-color: #4A5C6A;

    box-shadow:
        0 0 0 3px rgba(74, 92, 106, .10);
}

.form-group input[readonly] {
    background: #F2F4F4;
    color: #4A5C6A;

    cursor: default;
}

.form-group input::placeholder {
    color: #9BA8AB;
}


/* =========================================
   SELECT
========================================= */

.select-wrapper {
    position: relative;
}

.select-wrapper select {
    cursor: pointer;
}


/* =========================================
   INPUT ICON
========================================= */

.input-wrapper {
    position: relative;
}

.input-wrapper .input-icon {
    position: absolute;

    top: 50%;
    left: 14px;

    z-index: 2;

    display: flex;
    align-items: center;
    justify-content: center;

    transform: translateY(-50%);

    color: #4A5C6A;

    pointer-events: none;
}

.input-wrapper input {
    padding-left: 42px;
}


/* =========================================
   SCHEDULE CARD
========================================= */

.schedule-card {
    display: grid;

    grid-template-columns:
        1fr auto 1fr auto 1fr;

    align-items: center;

    padding: 18px;

    border: 1px solid #DDE4E6;
    border-radius: 15px;

    background: #F2F4F4;
}

.schedule-item {
    display: flex;
    align-items: center;

    gap: 12px;

    min-width: 0;
}

.schedule-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 38px;
    height: 38px;

    flex-shrink: 0;

    border: 1px solid #DCE3E5;
    border-radius: 10px;

    background: #FFFFFF;
    color: #253745;

    box-shadow:
        0 2px 7px rgba(6, 20, 27, .04);
}

.schedule-item > div {
    min-width: 0;
}

.schedule-title {
    display: block;

    margin-bottom: 4px;

    color: #9BA8AB;

    font-size: 10px;
    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: .5px;
}

.schedule-item strong {
    display: block;

    overflow: hidden;

    color: #253745;

    font-size: 13px;
    font-weight: 700;

    text-overflow: ellipsis;
    white-space: nowrap;
}

.schedule-divider {
    width: 1px;
    height: 42px;

    margin: 0 18px;

    background: #D7DFE2;
}


/* =========================================
   INFO BOX
========================================= */

.info-box {
    display: flex;

    gap: 12px;

    margin-top: 25px;
    padding: 16px;

    border: 1px solid #DDE4E6;
    border-radius: 13px;

    background: #F2F4F4;
}

.info-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 25px;
    height: 25px;

    flex-shrink: 0;

    border-radius: 50%;

    background: #E1EEE8;
    color: #27704A;
}

.info-box strong {
    display: block;

    margin-bottom: 4px;

    color: #253745;

    font-size: 13px;
}

.info-box p {
    margin: 0;

    color: #4A5C6A;

    font-size: 12px;

    line-height: 1.6;
}


/* =========================================
   ACTION
========================================= */

.form-actions {
    display: flex;
    justify-content: flex-end;

    gap: 10px;

    padding-top: 24px;
    margin-top: 26px;

    border-top: 1px solid #E7EBEC;
}

.cancel-button,
.start-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    height: 44px;

    box-sizing: border-box;

    padding: 0 20px;

    border-radius: 10px;

    font-family: inherit;
    font-size: 13px;
    font-weight: 700;

    text-decoration: none;

    cursor: pointer;

    transition: .2s ease;
}

.cancel-button {
    border: 1px solid #DCE2E4;

    background: #F2F4F4;
    color: #4A5C6A;
}

.cancel-button:hover {
    background: #E8ECEE;
    color: #253745;
}

.start-button {
    gap: 9px;

    border: none;

    background: #253745;
    color: #FFFFFF;

    box-shadow:
        0 8px 18px rgba(6, 20, 27, .13);
}

.start-button:hover {
    background: #11212D;

    transform: translateY(-1px);

    box-shadow:
        0 11px 22px rgba(6, 20, 27, .17);
}

.start-button svg {
    flex-shrink: 0;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 800px) {

    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .session-form-grid {
        grid-template-columns: 1fr;
    }

    .form-wide {
        grid-column: auto;
    }

    .schedule-card {
        grid-template-columns: 1fr;

        gap: 15px;
    }

    .schedule-divider {
        width: 100%;
        height: 1px;

        margin: 0;
    }

}


@media (max-width: 520px) {

    .session-card {
        padding: 20px;

        border-radius: 16px;
    }

    .page-header h1 {
        font-size: 25px;
    }

    .header-status {
        align-self: flex-start;
    }

    .card-header {
        align-items: flex-start;
    }

    .schedule-card {
        padding: 15px;
    }

    .form-actions {
        flex-direction: column-reverse;
    }

    .cancel-button,
    .start-button {
        width: 100%;
    }

}

</style>

@endsection