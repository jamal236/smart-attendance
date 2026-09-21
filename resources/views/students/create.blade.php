@extends('layouts.app')

@section('title', 'Tambah Mahasiswa - Smart Attendance')

@section('content')

<div class="create-student-page">

    <div class="create-header">

        <div>
            <a href="{{ route('students.index') }}" class="back-link">
                <span class="back-arrow">←</span>
                Kembali ke Data Mahasiswa
            </a>

            <span class="eyebrow">
                DATA AKADEMIK
            </span>

            <h1>
                Tambah Mahasiswa
            </h1>

            <p>
                Tambahkan data mahasiswa untuk digunakan dalam sistem absensi QR.
            </p>
        </div>

    </div>


    <div class="form-card">

        <div class="form-card-header">
            <div>
                <span class="form-kicker">
                    INFORMASI MAHASISWA
                </span>

                <h2>
                    Data Mahasiswa
                </h2>

                <p>
                    Lengkapi informasi mahasiswa di bawah ini.
                </p>
            </div>

            <div class="form-header-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <path
                        d="M16 20v-1.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 4 18.5V20"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                    />
                    <circle
                        cx="10"
                        cy="8"
                        r="3"
                        stroke="currentColor"
                        stroke-width="1.7"
                    />
                    <path
                        d="M17 11a3 3 0 1 0-1.2-5.75M20 20v-1.5a3.5 3.5 0 0 0-2.5-3.35"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                    />
                </svg>
            </div>
        </div>


        @if ($errors->any())
            <div class="error-box">
                <div class="error-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <circle
                            cx="12"
                            cy="12"
                            r="8.5"
                            stroke="currentColor"
                            stroke-width="1.7"
                        />
                        <path
                            d="M12 7.5V12.5"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round"
                        />
                        <circle
                            cx="12"
                            cy="16"
                            r="1"
                            fill="currentColor"
                        />
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


        <form
            action="{{ route('students.store') }}"
            method="POST"
            class="student-form"
        >
            @csrf


            <div class="form-grid">

                <div class="form-group">

                    <label for="nim">
                        NIM
                        <span>*</span>
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <rect
                                    x="4"
                                    y="5"
                                    width="16"
                                    height="14"
                                    rx="2"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                />
                                <path
                                    d="M8 9h8M8 12h5M8 15h3"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                    stroke-linecap="round"
                                />
                            </svg>
                        </span>

                        <input
                            id="nim"
                            type="text"
                            name="nim"
                            value="{{ old('nim') }}"
                            placeholder="Contoh: 2301001"
                            autocomplete="off"
                            required
                        >

                    </div>

                    <small>
                        NIM harus unik dan tidak boleh sama dengan mahasiswa yang sudah terdaftar.
                    </small>

                </div>


                <div class="form-group">

                    <label for="nama">
                        Nama Mahasiswa
                        <span>*</span>
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <circle
                                    cx="12"
                                    cy="8"
                                    r="3"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                />
                                <path
                                    d="M5.5 20a6.5 6.5 0 0 1 13 0"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                    stroke-linecap="round"
                                />
                            </svg>
                        </span>

                        <input
                            id="nama"
                            type="text"
                            name="nama"
                            value="{{ old('nama') }}"
                            placeholder="Contoh: Ahmad Fauzan"
                            autocomplete="name"
                            required
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label for="kelas">
                        Kelas
                        <span>*</span>
                    </label>

                    <div class="input-wrapper select-wrapper">

                        <span class="input-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M4 6.5A2.5 2.5 0 0 1 6.5 4H20v13H6.5A2.5 2.5 0 0 0 4 19.5V6.5Z"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                    stroke-linecap="round"
                                />
                            </svg>
                        </span>

                        <select
                            id="kelas"
                            name="kelas"
                            required
                        >
                            <option value="">Pilih kelas</option>

                            <option
                                value="V.5"
                                {{ old('kelas') == 'V.5' ? 'selected' : '' }}
                            >
                                V.5
                            </option>

                            <option
                                value="V.6"
                                {{ old('kelas') == 'V.6' ? 'selected' : '' }}
                            >
                                V.6
                            </option>

                            <option
                                value="V.7"
                                {{ old('kelas') == 'V.7' ? 'selected' : '' }}
                            >
                                V.7
                            </option>
                        </select>

                    </div>

                </div>

            </div>


            <div class="qr-information">

                <div class="qr-information-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path
                            d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4z"
                            stroke="currentColor"
                            stroke-width="1.6"
                        />
                        <path
                            d="M14 14h3v3h-3zM17 17h3v3h-3zM17 14h3"
                            stroke="currentColor"
                            stroke-width="1.6"
                        />
                    </svg>
                </div>

                <div>
                    <strong>
                        QR Code Otomatis
                    </strong>

                    <p>
                        Setelah mahasiswa ditambahkan, sistem akan membuat
                        identitas QR Code mahasiswa secara otomatis.
                    </p>
                </div>

            </div>


            <div class="form-actions">

                <a
                    href="{{ route('students.index') }}"
                    class="cancel-button"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="submit-button"
                >
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path
                            d="M5 12.5 9.5 17 19 7.5"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>

                    Simpan Mahasiswa
                </button>

            </div>

        </form>

    </div>

</div>


<style>

/* =========================================================
   PAGE
========================================================= */

.create-student-page {
    width: 100%;
    max-width: 900px;
    margin: 0 auto;
    padding-bottom: 40px;
}


/* =========================================================
   HEADER
========================================================= */

.create-header {
    margin-bottom: 24px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    margin-bottom: 13px;

    color: #4A5C6A;
    text-decoration: none;

    font-size: 12px;
    font-weight: 600;

    transition:
        color .18s ease,
        transform .18s ease;
}

.back-link:hover {
    color: #06141B;
    transform: translateX(-2px);
}

.back-arrow {
    font-size: 15px;
    line-height: 1;
}

.eyebrow {
    display: block;

    margin-bottom: 7px;

    color: #253745;

    font-size: 10px;
    font-weight: 800;

    letter-spacing: 1.1px;
}

.create-header h1 {
    margin: 0;

    color: #06141B;

    font-size: 30px;
    font-weight: 750;

    letter-spacing: -.7px;
}

.create-header p {
    margin: 7px 0 0;

    color: #4A5C6A;

    font-size: 13px;
}


/* =========================================================
   FORM CARD
========================================================= */

.form-card {
    overflow: hidden;

    border: 1px solid #D9DEDF;
    border-radius: 18px;

    background: #FFFFFF;

    box-shadow:
        0 8px 30px rgba(6, 20, 27, .055),
        0 2px 6px rgba(6, 20, 27, .025);
}

.form-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    padding: 23px 28px;

    border-bottom: 1px solid #E8ECEE;

    background: #FFFFFF;
}

.form-kicker {
    display: block;

    margin-bottom: 5px;

    color: #9BA8AB;

    font-size: 9px;
    font-weight: 800;

    letter-spacing: .9px;
}

.form-card-header h2 {
    margin: 0;

    color: #06141B;

    font-size: 18px;
    font-weight: 750;
}

.form-card-header p {
    margin: 5px 0 0;

    color: #9BA8AB;

    font-size: 11px;
}

.form-header-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 44px;
    height: 44px;

    flex-shrink: 0;

    border-radius: 12px;

    background: #E8ECEE;
    color: #253745;
}

.form-header-icon svg {
    width: 21px;
    height: 21px;
}


/* =========================================================
   FORM
========================================================= */

.student-form {
    padding: 28px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));

    gap: 22px 20px;
}

.form-group {
    min-width: 0;
}

.form-group label {
    display: block;

    margin-bottom: 8px;

    color: #253745;

    font-size: 12px;
    font-weight: 750;
}

.form-group label span {
    color: #B42318;
}


/* =========================================================
   INPUT
========================================================= */

.input-wrapper {
    position: relative;
}

.input-icon {
    position: absolute;

    top: 50%;
    left: 13px;

    display: flex;

    width: 17px;
    height: 17px;

    transform: translateY(-50%);

    color: #9BA8AB;

    pointer-events: none;
}

.input-icon svg {
    width: 17px;
    height: 17px;
}

.input-wrapper input,
.input-wrapper select {
    width: 100%;
    height: 44px;

    box-sizing: border-box;

    padding: 0 13px 0 40px;

    border: 1px solid #CCD0CF;
    border-radius: 10px;

    outline: none;

    background: #F7F8F8;
    color: #06141B;

    font-family: inherit;
    font-size: 12px;

    transition:
        border-color .18s ease,
        background .18s ease,
        box-shadow .18s ease;
}

.input-wrapper input::placeholder {
    color: #9BA8AB;
}

.input-wrapper input:hover,
.input-wrapper select:hover {
    border-color: #9BA8AB;
    background: #FFFFFF;
}

.input-wrapper input:focus,
.input-wrapper select:focus {
    border-color: #253745;
    background: #FFFFFF;

    box-shadow:
        0 0 0 3px rgba(37, 55, 69, .09);
}

.select-wrapper select {
    appearance: none;

    cursor: pointer;
}

.select-wrapper::after {
    content: "";

    position: absolute;

    top: 50%;
    right: 15px;

    width: 7px;
    height: 7px;

    border-right: 1.5px solid #4A5C6A;
    border-bottom: 1.5px solid #4A5C6A;

    transform:
        translateY(-65%)
        rotate(45deg);

    pointer-events: none;
}

.form-group small {
    display: block;

    margin-top: 7px;

    color: #9BA8AB;

    font-size: 10px;
    line-height: 1.5;
}


/* =========================================================
   QR INFORMATION
========================================================= */

.qr-information {
    display: flex;
    align-items: flex-start;

    gap: 13px;

    margin-top: 24px;
    padding: 16px 17px;

    border: 1px solid #D9DEDF;
    border-radius: 12px;

    background: #F2F4F4;
}

.qr-information-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 38px;
    height: 38px;

    flex-shrink: 0;

    border-radius: 10px;

    background: #E8ECEE;
    color: #253745;
}

.qr-information-icon svg {
    width: 19px;
    height: 19px;
}

.qr-information strong {
    display: block;

    margin: 1px 0 4px;

    color: #06141B;

    font-size: 12px;
    font-weight: 750;
}

.qr-information p {
    margin: 0;

    color: #4A5C6A;

    font-size: 11px;
    line-height: 1.55;
}


/* =========================================================
   ERROR
========================================================= */

.error-box {
    display: flex;
    align-items: flex-start;

    gap: 12px;

    margin: 0 28px;
    padding: 14px 16px;

    border: 1px solid #F1CACA;
    border-radius: 11px;

    background: #FEF2F2;
    color: #B42318;
}

.error-icon {
    display: flex;
    width: 20px;
    height: 20px;

    flex-shrink: 0;
}

.error-icon svg {
    width: 20px;
    height: 20px;
}

.error-box strong {
    display: block;

    margin-bottom: 4px;

    font-size: 11px;
}

.error-box ul {
    margin: 0;
    padding-left: 16px;

    font-size: 10px;
    line-height: 1.5;
}


/* =========================================================
   ACTIONS
========================================================= */

.form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;

    gap: 9px;

    margin-top: 28px;
    padding-top: 22px;

    border-top: 1px solid #E8ECEE;
}

.cancel-button,
.submit-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    height: 42px;

    box-sizing: border-box;

    padding: 0 17px;

    border-radius: 9px;

    font-family: inherit;
    font-size: 11px;
    font-weight: 750;

    text-decoration: none;

    cursor: pointer;

    transition:
        transform .18s ease,
        background .18s ease,
        border-color .18s ease,
        box-shadow .18s ease;
}

.cancel-button {
    border: 1px solid #D9DEDF;

    background: #F2F4F4;
    color: #4A5C6A;
}

.cancel-button:hover {
    background: #E8ECEE;
    border-color: #CCD0CF;
    color: #06141B;
}

.submit-button {
    gap: 7px;

    border: 1px solid #253745;

    background: #253745;
    color: #FFFFFF;

    box-shadow:
        0 7px 16px rgba(6, 20, 27, .14);
}

.submit-button svg {
    width: 15px;
    height: 15px;
}

.submit-button:hover {
    background: #11212D;
    border-color: #11212D;

    transform: translateY(-1px);

    box-shadow:
        0 10px 20px rgba(6, 20, 27, .18);
}

.cancel-button:active,
.submit-button:active {
    transform: translateY(0);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 700px) {

    .create-student-page {
        max-width: 100%;
    }

    .create-header h1 {
        font-size: 26px;
    }

    .form-card-header {
        padding: 20px;
    }

    .student-form {
        padding: 20px;
    }

    .form-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .error-box {
        margin: 0 20px;
    }

    .form-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .cancel-button,
    .submit-button {
        width: 100%;
    }
}


@media (max-width: 450px) {

    .create-header p {
        font-size: 12px;
        line-height: 1.5;
    }

    .form-card {
        border-radius: 15px;
    }

    .form-card-header {
        align-items: flex-start;
    }

    .form-header-icon {
        width: 40px;
        height: 40px;
    }

    .qr-information {
        gap: 10px;
        padding: 14px;
    }

}

</style>

@endsection
