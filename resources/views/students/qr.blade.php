@extends('layouts.app')

@section('title', 'QR Mahasiswa - Smart Attendance')

@section('content')

<div class="qr-page">

    {{-- =========================
         HEADER
    ========================== --}}

    <div class="page-header">

        <div>

            <a
                href="{{ route('students.index') }}"
                class="back-link"
            >
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M19 12H5M12 19l-7-7 7-7"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>

                Kembali ke Data Mahasiswa
            </a>

            <span class="eyebrow">
                IDENTITAS MAHASISWA
            </span>

            <h1>
                QR Mahasiswa
            </h1>

            <p>
                Gunakan QR Code ini untuk melakukan absensi.
            </p>

        </div>

    </div>


    {{-- =========================
         QR CARD
    ========================== --}}

    <div class="qr-card">

        {{-- STUDENT --}}
        <div class="student-icon">
            {{ strtoupper(substr($student['nama'], 0, 1)) }}
        </div>

        <h2>
            {{ $student['nama'] }}
        </h2>

        <div class="student-info">

            <span>
                NIM:
                <strong>{{ $student['nim'] }}</strong>
            </span>

            <span class="separator">
                /
            </span>

            <span>
                Kelas
                <strong>{{ $student['kelas'] }}</strong>
            </span>

        </div>


        {{-- =========================
             QR CODE
        ========================== --}}

        <div class="qr-wrapper">

            <div id="qrcode"></div>

        </div>


        {{-- =========================
             QR ID
        ========================== --}}

        <div class="qr-id">

            <span class="qr-id-label">
                QR IDENTITAS
            </span>

            <strong>
                {{ $student['qr_code'] }}
            </strong>

        </div>


        {{-- =========================
             INFO
        ========================== --}}

        <div class="info-box">

            <div class="info-icon">

                <svg
                    width="15"
                    height="15"
                    viewBox="0 0 24 24"
                    fill="none"
                >
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
                    QR Code Aktif
                </strong>

                <p>
                    Tunjukkan QR Code ini kepada kamera scanner
                    saat melakukan absensi.
                </p>

            </div>

        </div>


        {{-- =========================
             ACTION
        ========================== --}}

        <div class="qr-actions">

            <button
                type="button"
                id="downloadQr"
                class="download-button"
            >

                <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                >
                    <path
                        d="M12 3v12"
                        stroke="currentColor"
                        stroke-width="1.9"
                        stroke-linecap="round"
                    />

                    <path
                        d="m7 11 5 5 5-5"
                        stroke="currentColor"
                        stroke-width="1.9"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />

                    <path
                        d="M5 21h14"
                        stroke="currentColor"
                        stroke-width="1.9"
                        stroke-linecap="round"
                    />
                </svg>

                Unduh QR Code

            </button>


            <a
                href="{{ route('students.index') }}"
                class="back-button"
            >
                Kembali
            </a>

        </div>

    </div>

</div>


<style>

/* =========================================
   PAGE
========================================= */

.qr-page {
    max-width: 650px;
    margin: 0 auto;
    padding-bottom: 40px;
}


/* =========================================
   HEADER
========================================= */

.page-header {
    margin-bottom: 24px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    margin-bottom: 11px;

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

    margin-bottom: 6px;

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

    letter-spacing: -.6px;
}

.page-header p {
    margin: 7px 0 0;

    color: #4A5C6A;

    font-size: 14px;
}


/* =========================================
   QR CARD
========================================= */

.qr-card {
    padding: 32px;

    border: 1px solid #E1E6E8;
    border-radius: 20px;

    background: #FFFFFF;

    text-align: center;

    box-shadow:
        0 12px 35px rgba(6, 20, 27, .06),
        0 2px 8px rgba(6, 20, 27, .03);
}


/* =========================================
   STUDENT
========================================= */

.student-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 48px;
    height: 48px;

    margin: 0 auto 12px;

    border: 1px solid #D8E0E3;
    border-radius: 13px;

    background: #E8ECEE;
    color: #253745;

    font-size: 17px;
    font-weight: 800;
}

.qr-card h2 {
    margin: 0 0 7px;

    color: #06141B;

    font-size: 21px;
    font-weight: 750;
}

.student-info {
    display: flex;
    justify-content: center;
    align-items: center;

    gap: 8px;

    color: #9BA8AB;

    font-size: 12px;
}

.student-info strong {
    color: #253745;
}

.separator {
    color: #CCD0CF;
}


/* =========================================
   QR
========================================= */

.qr-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;

    width: 290px;
    height: 290px;

    margin: 25px auto;

    border: 1px solid #DDE3E5;
    border-radius: 16px;

    background: #FFFFFF;

    box-shadow:
        0 7px 22px rgba(6, 20, 27, .045);
}

#qrcode {
    display: flex;
    align-items: center;
    justify-content: center;
}

#qrcode img,
#qrcode canvas {
    display: block;

    width: 250px !important;
    height: 250px !important;
}


/* =========================================
   QR ID
========================================= */

.qr-id {
    display: inline-flex;
    flex-direction: column;
    align-items: center;

    gap: 5px;

    margin-bottom: 20px;
}

.qr-id-label {
    color: #9BA8AB;

    font-size: 9px;
    font-weight: 800;

    letter-spacing: 1px;
}

.qr-id strong {
    padding: 6px 10px;

    border: 1px solid #D8E0E3;
    border-radius: 7px;

    background: #F2F4F4;
    color: #253745;

    font-family: monospace;
    font-size: 11px;
}


/* =========================================
   INFO
========================================= */

.info-box {
    display: flex;
    align-items: flex-start;

    gap: 11px;

    margin-bottom: 22px;
    padding: 14px;

    border: 1px solid #DDE4E6;
    border-radius: 11px;

    background: #F2F4F4;

    text-align: left;
}

.info-icon {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 28px;
    height: 28px;

    flex-shrink: 0;

    border-radius: 8px;

    background: #E1EEE8;
    color: #27704A;
}

.info-box strong {
    display: block;

    margin-bottom: 3px;

    color: #253745;

    font-size: 12px;
}

.info-box p {
    margin: 0;

    color: #4A5C6A;

    font-size: 11px;
    line-height: 1.5;
}


/* =========================================
   ACTION
========================================= */

.qr-actions {
    display: flex;
    justify-content: center;

    gap: 9px;

    padding-top: 20px;

    border-top: 1px solid #E7EBEC;
}

.download-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    height: 43px;

    padding: 0 20px;

    border: none;
    border-radius: 9px;

    background: #253745;
    color: #FFFFFF;

    font-size: 12px;
    font-weight: 700;

    cursor: pointer;

    box-shadow:
        0 7px 16px rgba(6, 20, 27, .13);

    transition: .2s ease;
}

.download-button:hover {
    background: #11212D;

    transform: translateY(-1px);

    box-shadow:
        0 10px 20px rgba(6, 20, 27, .17);
}

.download-button svg {
    flex-shrink: 0;
}

.back-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    height: 43px;

    padding: 0 18px;

    border: 1px solid #DCE2E4;
    border-radius: 9px;

    background: #F2F4F4;
    color: #4A5C6A;

    text-decoration: none;

    font-size: 12px;
    font-weight: 700;

    transition: .2s ease;
}

.back-button:hover {
    background: #E8ECEE;
    color: #253745;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 600px) {

    .qr-page {
        padding-bottom: 25px;
    }

    .page-header h1 {
        font-size: 25px;
    }

    .qr-card {
        padding: 22px 16px;
        border-radius: 16px;
    }

    .qr-wrapper {
        width: 270px;
        height: 270px;
    }

    #qrcode img,
    #qrcode canvas {
        width: 230px !important;
        height: 230px !important;
    }

    .qr-actions {
        flex-direction: column;
    }

    .download-button,
    .back-button {
        width: 100%;
    }

}

</style>


{{-- =========================
     QR CODE LIBRARY
========================== --}}

<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>


<script>

const qrElement =
    document.getElementById('qrcode');


/*
=========================================
BUAT QR CODE
=========================================
*/

new QRCode(qrElement, {

    text: @json($student['qr_code']),

    width: 250,

    height: 250,

    colorDark: '#000000',

    colorLight: '#ffffff',

    correctLevel: QRCode.CorrectLevel.H

});


/*
=========================================
DOWNLOAD QR CODE
=========================================
*/

document
    .getElementById('downloadQr')
    .addEventListener('click', function () {

        const canvas =
            qrElement.querySelector('canvas');

        const img =
            qrElement.querySelector('img');


        /*
        QRCodeJS biasanya membuat canvas.
        Jika canvas tidak tersedia,
        gunakan gambar QR.
        */

        if (canvas) {

            const link =
                document.createElement('a');

            link.download =
                'QR-{{ $student["nim"] }}.png';

            link.href =
                canvas.toDataURL('image/png');

            link.click();

            return;
        }


        if (img) {

            const link =
                document.createElement('a');

            link.download =
                'QR-{{ $student["nim"] }}.png';

            link.href =
                img.src;

            link.click();

            return;
        }


        alert(
            'QR Code belum selesai dibuat. Silakan coba lagi.'
        );

    });

</script>

@endsection