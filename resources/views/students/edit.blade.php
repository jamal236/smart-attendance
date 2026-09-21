@extends('layouts.app')

@section('title', 'Edit Mahasiswa - Smart Attendance')

@section('content')

<div class="edit-page">

    <!-- =========================
         HEADER
    ========================== -->

    <div class="page-header">

        <div>

            <a
                href="{{ route('students.index') }}"
                class="back-link"
            >
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M19 12H5"></path>
                    <path d="M11 18l-6-6 6-6"></path>
                </svg>
                Kembali ke Data Mahasiswa
            </a>

            <span class="eyebrow">
                DATA AKADEMIK
            </span>

            <h1>
                Edit Mahasiswa
            </h1>

            <p>
                Perbarui informasi mahasiswa yang terdaftar dalam sistem.
            </p>

        </div>

    </div>


    <!-- =========================
         VALIDATION ERROR
    ========================== -->

    @if ($errors->any())

        <div class="error-box">

            <div class="error-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                    <path d="M12 7v5"></path>
                    <path d="M12 16.5h.01"></path>
                    <circle cx="12" cy="12" r="8.5"></circle>
                </svg>
            </div>

            <div>

                <strong>
                    Data belum dapat disimpan
                </strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        </div>

    @endif


    <!-- =========================
         FORM CARD
    ========================== -->

    <div class="form-card">

        <div class="form-header">

            <div class="form-header-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                    <path d="M5 19l3.5-.8L18.8 7.9a2 2 0 0 0-2.8-2.8L5.7 15.4 5 19z"></path>
                    <path d="M14.5 6.5l3 3"></path>
                </svg>
            </div>

            <div>

                <h2>
                    Edit Data Mahasiswa
                </h2>

                <p>
                    Perbarui data mahasiswa di bawah ini.
                </p>

            </div>

        </div>


        <form
            action="{{ route('students.update', $student['id']) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <!-- =========================
                 NIM
            ========================== -->

            <div class="form-group">

                <label for="nim">
                    NIM
                </label>

                <input
                    type="text"
                    id="nim"
                    name="nim"
                    value="{{ old('nim', $student['nim']) }}"
                    placeholder="Contoh: 2301001"
                    required
                >

                <small>
                    NIM harus unik dan tidak boleh sama dengan mahasiswa lain.
                </small>

            </div>


            <!-- =========================
                 NAMA
            ========================== -->

            <div class="form-group">

                <label for="nama">
                    Nama Mahasiswa
                </label>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old('nama', $student['nama']) }}"
                    placeholder="Contoh: Ahmad Fauzan"
                    required
                >

            </div>


            <!-- =========================
                 KELAS
            ========================== -->

            <div class="form-group">

                <label for="kelas">
                    Semester / Kelas
                </label>

                <select
                    id="kelas"
                    name="kelas"
                    required
                >

                    <option value="">
                        -- Pilih Kelas --
                    </option>

                    <option
                        value="V.5"
                        {{ old('kelas', $student['kelas']) === 'V.5' ? 'selected' : '' }}
                    >
                        V.5
                    </option>

                    <option
                        value="V.6"
                        {{ old('kelas', $student['kelas']) === 'V.6' ? 'selected' : '' }}
                    >
                        V.6
                    </option>

                    <option
                        value="V.7"
                        {{ old('kelas', $student['kelas']) === 'V.7' ? 'selected' : '' }}
                    >
                        V.7
                    </option>

                </select>

            </div>


            <!-- =========================
                 STATUS
            ========================== -->

            <div class="form-group">

                <label for="status">
                    Status Mahasiswa
                </label>

                <select
                    id="status"
                    name="status"
                    required
                >

                    <option
                        value="Aktif"
                        {{ old('status', $student['status'] ?? 'Aktif') === 'Aktif' ? 'selected' : '' }}
                    >
                        Aktif
                    </option>

                    <option
                        value="Nonaktif"
                        {{ old('status', $student['status'] ?? 'Aktif') === 'Nonaktif' ? 'selected' : '' }}
                    >
                        Nonaktif
                    </option>

                </select>

                <small>
                    Mahasiswa Nonaktif tidak dapat melakukan absensi.
                </small>

            </div>


            <!-- =========================
                 QR INFORMATION
            ========================== -->

            <div class="qr-info">

                <div class="qr-info-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <rect x="4.5" y="4.5" width="6" height="6" rx="1"></rect>
                        <rect x="13.5" y="4.5" width="6" height="6" rx="1"></rect>
                        <rect x="4.5" y="13.5" width="6" height="6" rx="1"></rect>
                        <path d="M14 14h2v2h-2zM18 14h1.5M14 18h1.5M18 17v2"></path>
                    </svg>
                </div>

                <div>

                    <strong>
                        QR Code Mahasiswa
                    </strong>

                    <p>
                        QR Code tetap menggunakan identitas mahasiswa yang sudah dibuat sebelumnya.
                    </p>

                    <div class="qr-code-value">
                        {{ $student['qr_code'] }}
                    </div>

                </div>

            </div>


            <!-- =========================
                 ACTION
            ========================== -->

            <div class="form-footer">

                <a
                    href="{{ route('students.index') }}"
                    class="cancel-button"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="save-button"
                >
                    Simpan Perubahan
                    <svg class="save-arrow" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M5 12h13"></path>
                        <path d="M13 7l5 5-5 5"></path>
                    </svg>
                </button>

            </div>

        </form>

    </div>

</div>


<style>
/* =========================================
   EDIT MAHASISWA — DARK SLATE SAAS
   Visual-only redesign. Blade/PHP/form
   behavior remains unchanged.
========================================= */

.edit-page {
    --navy: #06141B;
    --slate: #253745;
    --slate-2: #11212D;
    --slate-3: #4A5C6A;
    --muted: #71808A;
    --soft: #9BA8AB;
    --border: #DDE3E5;
    --workspace: #F2F4F4;

    max-width: 820px;
    margin: 0 auto;
    padding: 28px 0 42px;
}

/* HEADER */

.page-header {
    margin-bottom: 24px;
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

/* ERROR */

.error-box {
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
    padding: 14px 16px;
    border: 1px solid #E8C9C9;
    border-radius: 12px;
    background: #FBF4F4;
    color: #8B3A3A;
}

.error-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 26px;
    height: 26px;
    flex: 0 0 26px;
    border: 1px solid #E7CACA;
    border-radius: 50%;
    background: #F7E7E7;
    color: #A33A3A;
}

.error-icon svg {
    width: 15px;
    height: 15px;
    fill: none;
    stroke: currentColor;
    stroke-width: 1.8;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.error-box strong {
    font-size: 12px;
    font-weight: 750;
}

.error-box ul {
    margin: 5px 0 0;
    padding-left: 18px;
    font-size: 11px;
    line-height: 1.55;
}

/* FORM CARD */

.form-card {
    padding: 27px;
    border: 1px solid var(--border);
    border-radius: 18px;
    background: #fff;
    box-shadow:
        0 9px 30px rgba(6, 20, 27, .055),
        0 2px 6px rgba(6, 20, 27, .025);
}

/* FORM HEADER */

.form-header {
    display: flex;
    align-items: center;
    gap: 13px;
    margin-bottom: 26px;
    padding-bottom: 19px;
    border-bottom: 1px solid #E8ECEE;
}

.form-header-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    border: 1px solid #DCE3E5;
    border-radius: 11px;
    background: #F1F4F5;
    color: var(--slate);
}

.form-header-icon svg {
    width: 19px;
    height: 19px;
    fill: none;
    stroke: currentColor;
    stroke-width: 1.7;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.form-header h2 {
    margin: 0 0 4px;
    color: var(--navy);
    font-size: 17px;
    font-weight: 720;
}

.form-header p {
    margin: 0;
    color: var(--muted);
    font-size: 11px;
}

/* FORM GROUP */

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 7px;
    color: #33454E;
    font-size: 12px;
    font-weight: 720;
}

.form-group input,
.form-group select {
    width: 100%;
    height: 44px;
    box-sizing: border-box;
    padding: 0 13px;
    border: 1px solid #D7DFE1;
    border-radius: 9px;
    outline: none;
    background: #fff;
    color: #17252D;
    font-size: 12px;
    transition: .18s ease;
}

.form-group input:hover,
.form-group select:hover {
    border-color: #BCC8CC;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #6E7D85;
    box-shadow: 0 0 0 3px rgba(37, 55, 69, .08);
}

.form-group input::placeholder {
    color: #9BA8AB;
}

.form-group small {
    display: block;
    margin-top: 6px;
    color: #9BA8AB;
    font-size: 10px;
    line-height: 1.45;
}

/* QR INFO */

.qr-info {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    margin-top: 5px;
    margin-bottom: 24px;
    padding: 15px;
    border: 1px solid #DCE3E5;
    border-radius: 12px;
    background: #F3F6F7;
}

.qr-info-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    flex: 0 0 38px;
    border: 1px solid #DDE4E6;
    border-radius: 9px;
    background: #fff;
    color: var(--slate);
}

.qr-info-icon svg {
    width: 18px;
    height: 18px;
    fill: none;
    stroke: currentColor;
    stroke-width: 1.6;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.qr-info strong {
    display: block;
    margin-bottom: 4px;
    color: var(--navy);
    font-size: 12px;
    font-weight: 750;
}

.qr-info p {
    margin: 0 0 8px;
    color: #68777F;
    font-size: 10px;
    line-height: 1.5;
}

.qr-code-value {
    display: inline-flex;
    padding: 6px 9px;
    border: 1px solid #D6DFE2;
    border-radius: 7px;
    background: #fff;
    color: var(--slate);
    font-family: monospace;
    font-size: 10px;
    font-weight: 750;
}

/* FOOTER */

.form-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 9px;
    padding-top: 19px;
    border-top: 1px solid #E8ECEE;
}

.cancel-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 42px;
    padding: 0 17px;
    border: 1px solid #DCE2E4;
    border-radius: 9px;
    background: #F3F5F5;
    color: #52636C;
    text-decoration: none;
    font-size: 11px;
    font-weight: 720;
    transition: .18s ease;
}

.cancel-button:hover {
    background: #E8ECEE;
    border-color: #CCD5D8;
    color: var(--navy);
}

.save-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 42px;
    padding: 0 17px;
    border: 1px solid var(--slate);
    border-radius: 9px;
    background: var(--slate);
    color: #fff;
    font-size: 11px;
    font-weight: 750;
    cursor: pointer;
    box-shadow: 0 7px 16px rgba(6, 20, 27, .12);
    transition: .18s ease;
}

.save-button:hover {
    background: var(--navy);
    border-color: var(--navy);
    transform: translateY(-1px);
    box-shadow: 0 10px 20px rgba(6, 20, 27, .16);
}

.save-arrow {
    width: 15px;
    height: 15px;
    fill: none;
    stroke: currentColor;
    stroke-width: 1.8;
    stroke-linecap: round;
    stroke-linejoin: round;
}

/* RESPONSIVE */

@media (max-width: 1050px) {
    .edit-page {
        padding-left: 18px;
        padding-right: 18px;
    }
}

@media (max-width: 600px) {
    .edit-page {
        padding: 20px 12px 30px;
    }

    .page-header h1 {
        font-size: 25px;
    }

    .page-header p {
        font-size: 12px;
    }

    .form-card {
        padding: 20px;
        border-radius: 16px;
    }

    .form-header {
        align-items: flex-start;
    }

    .qr-info {
        padding: 13px;
    }

    .form-footer {
        flex-direction: column-reverse;
    }

    .cancel-button,
    .save-button {
        width: 100%;
    }
}

</style>

@endsection