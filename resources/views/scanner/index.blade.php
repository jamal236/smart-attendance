@extends('layouts.app')

@section('title', 'Scanner - Smart Attendance')

@section('content')

<div class="scanner-page">

    <!-- HEADER -->
    <div class="page-header">

        <div>
            <a href="/buat-sesi" class="back-link">
                ← Kembali
            </a>

            <h1>Scanner Absensi</h1>

            <p>
                Scan QR mahasiswa untuk mencatat kehadiran.
            </p>
        </div>

        <div class="active-badge">
            <span></span>
            Sesi Aktif
        </div>

    </div>


    <!-- CONTENT -->
    <div class="scanner-grid">

        <!-- CAMERA -->
        <div class="scanner-card">

            <div class="card-header">

                <div>
                    <h2>Scan QR Mahasiswa</h2>

                    <p>
                        Arahkan QR Code mahasiswa ke kamera.
                    </p>
                </div>

            </div>


<div class="camera-box">

    <div id="reader"></div>

    <div class="qr-guide">
        <div class="corner top-left"></div>
        <div class="corner top-right"></div>
        <div class="corner bottom-left"></div>
        <div class="corner bottom-right"></div>
    </div>

</div>

<div class="qr-upload">

    <label for="qr-file" class="qr-upload-label">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <rect x="3" y="4" width="18" height="16" rx="2"></rect>
            <circle cx="8.5" cy="9" r="1.4"></circle>
            <path d="m21 15-4.5-4.5L8 19"></path>
        </svg>
        Atau Upload QR Code
    </label>

    <input
        type="file"
        id="qr-file"
        accept="image/*"
    >

    <div id="upload-message">
        Pilih gambar QR Code mahasiswa.
    </div>

</div>

<div id="scan-message" class="scan-message">
    Tekan <strong>Aktifkan Kamera</strong> untuk memulai scanner.
</div>

<button
    type="button"
    id="start-camera"
    class="camera-button"
>
    Aktifkan Kamera
</button>

<button
    id="stop-camera"
    type="button"
    style="
        display: none;
        margin-top: 10px;
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        background: #dc2626;
        color: white;
        font-weight: 600;
        cursor: pointer;
    "
>
    ⏹️ Matikan Kamera
</button>

        </div>


        <!-- INFORMASI SESI -->
        <div class="session-card">

            <h2>Informasi Sesi</h2>

            @php
                $activeSession = session('active_session');
            @endphp

            @if($activeSession)

                <div class="info-row">
                    <span>Mata Kuliah</span>
                    <strong>{{ $activeSession['mata_kuliah'] }}</strong>
                </div>

                <div class="info-row">
                    <span>Kelas</span>
                    <strong>{{ $activeSession['kelas'] }}</strong>
                </div>

                <div class="info-row">
                    <span>Pertemuan</span>
                    <strong>{{ $activeSession['pertemuan'] }}</strong>
                </div>

                <div class="info-row">
                    <span>Materi</span>
                    <strong>{{ $activeSession['materi'] }}</strong>
                </div>

                <div class="info-row">
                    <span>Tanggal</span>
                    <strong>{{ $activeSession['tanggal'] }}</strong>
                </div>

                <div class="info-row">
                    <span>Jam</span>
                    <strong>{{ $activeSession['jam'] }}</strong>
                </div>

            @else

                <p class="no-session">
                    Belum ada sesi aktif.
                </p>

            @endif


            <div class="session-status">
                <span></span>
                Sesi sedang berlangsung
            </div>


<form
    action="{{ route('sessions.end') }}"
    method="POST"
    onsubmit="return confirm('Yakin ingin mengakhiri sesi ini?');"
>
    @csrf

    <button type="submit" class="finish-button">
        Akhiri Sesi
    </button>
</form>

        </div>

    </div>

</div>



<style>
/* =========================================
   SCANNER PAGE
========================================= */

.scanner-page {
    max-width: 1180px;
    margin: 0 auto;
    padding-bottom: 30px;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 20px;
    margin-bottom: 24px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    margin-bottom: 10px;
    color: #4A5C6A;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: .2s ease;
}

.back-link:hover {
    color: #253745;
}

.page-header h1 {
    margin: 0;
    color: #06141B;
    font-size: 30px;
    font-weight: 750;
    letter-spacing: -.5px;
}

.page-header p {
    margin: 7px 0 0;
    color: #4A5C6A;
    font-size: 14px;
}

/* =========================================
   ACTIVE BADGE
========================================= */

.active-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 13px;
    border: 1px solid #D8EBDD;
    border-radius: 999px;
    background: #EDF7F1;
    color: #28784D;
    font-size: 11px;
    font-weight: 800;
}

.active-badge span,
.session-status span {
    width: 7px;
    height: 7px;
    flex-shrink: 0;
    border-radius: 50%;
    background: #39A76A;
}

/* =========================================
   GRID & CARDS
========================================= */

.scanner-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 330px;
    gap: 20px;
    align-items: start;
}

.scanner-card,
.session-card {
    border: 1px solid #D9DEDF;
    border-radius: 18px;
    background: #FFFFFF;
    box-shadow:
        0 8px 30px rgba(15, 23, 42, .05),
        0 2px 6px rgba(15, 23, 42, .025);
}

.scanner-card {
    padding: 24px;
}

.session-card {
    padding: 22px;
}

.card-header {
    margin-bottom: 17px;
}

.card-header h2,
.session-card h2 {
    margin: 0;
    color: #06141B;
    font-size: 17px;
    font-weight: 750;
}

.card-header p {
    margin: 5px 0 0;
    color: #9BA8AB;
    font-size: 12px;
}

/* =========================================
   CAMERA
========================================= */

.camera-box {
    position: relative;
    min-height: 430px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 20px;
    border-radius: 14px;
    background:
        linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px),
        #06101A;
    background-size: 22px 22px;
}

#reader {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 620px;
    min-height: 300px;
    overflow: hidden;
    border-radius: 12px;
    background: #0B1620;
}

#reader video {
    width: 100% !important;
    height: auto !important;
    min-height: 300px;
    display: block;
    object-fit: cover;
}

.qr-guide {
    position: absolute;
    z-index: 10;
    width: 250px;
    height: 250px;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
}

.corner {
    position: absolute;
    width: 42px;
    height: 42px;
    border-color: #8EA4B2;
    border-style: solid;
}

.top-left {
    top: 0;
    left: 0;
    border-width: 3px 0 0 3px;
}

.top-right {
    top: 0;
    right: 0;
    border-width: 3px 3px 0 0;
}

.bottom-left {
    bottom: 0;
    left: 0;
    border-width: 0 0 3px 3px;
}

.bottom-right {
    bottom: 0;
    right: 0;
    border-width: 0 3px 3px 0;
}

/* =========================================
   UPLOAD
========================================= */

.qr-upload {
    margin-top: 14px;
    padding: 14px;
    border: 1px dashed #CCD0CF;
    border-radius: 12px;
    background: #F7F8F8;
}

.qr-upload-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 9px;
    color: #253745;
    font-size: 12px;
    font-weight: 750;
}

.qr-upload-label svg {
    width: 16px;
    height: 16px;
}

#qr-file {
    width: 100%;
    box-sizing: border-box;
    padding: 9px;
    border: 1px solid #CCD0CF;
    border-radius: 9px;
    background: #FFFFFF;
    color: #4A5C6A;
    font-size: 11px;
}

#upload-message {
    margin-top: 8px;
    color: #9BA8AB;
    font-size: 11px;
    line-height: 1.5;
}

/* =========================================
   MESSAGES & BUTTONS
========================================= */

.scan-message {
    margin-top: 13px;
    padding: 11px 13px;
    border: 1px solid #D9DEDF;
    border-radius: 9px;
    background: #F7F8F8;
    color: #4A5C6A;
    font-size: 11px;
    line-height: 1.5;
    text-align: center;
}

.camera-button {
    width: 100%;
    height: 42px;
    margin-top: 12px;
    border: none;
    border-radius: 9px;
    background: #253745;
    color: #FFFFFF;
    font-size: 12px;
    font-weight: 750;
    cursor: pointer;
    transition: .2s ease;
}

.camera-button:hover {
    background: #11212D;
    transform: translateY(-1px);
}

#stop-camera {
    width: 100%;
    height: 42px;
    margin-top: 10px !important;
    border: 1px solid #F1CACA !important;
    border-radius: 9px !important;
    background: #FEF2F2 !important;
    color: #B42318 !important;
    font-size: 12px !important;
    font-weight: 750 !important;
    cursor: pointer;
}

#stop-camera:hover {
    background: #FDE8E8 !important;
}

/* Hide the old duplicate helper message under the controls */
.scanner-card > .scan-message:last-child {
    display: none;
}

/* =========================================
   SESSION INFO
========================================= */

.session-card h2 {
    margin-bottom: 17px;
}

.info-row {
    padding: 12px 0;
    border-bottom: 1px solid #E8ECEE;
}

.info-row:first-of-type {
    padding-top: 0;
}

.info-row span {
    display: block;
    margin-bottom: 4px;
    color: #9BA8AB;
    font-size: 9px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .45px;
}

.info-row strong {
    display: block;
    color: #06141B;
    font-size: 12px;
    font-weight: 700;
    line-height: 1.45;
}

.no-session {
    color: #9BA8AB;
    font-size: 12px;
}

.session-status {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 18px 0 13px;
    padding: 10px 11px;
    border: 1px solid #DCEDE3;
    border-radius: 9px;
    background: #F1F8F4;
    color: #28784D;
    font-size: 10px;
    font-weight: 750;
}

.session-status span {
    width: 6px;
    height: 6px;
}

.finish-button {
    width: 100%;
    height: 42px;
    border: 1px solid #F1CACA;
    border-radius: 9px;
    background: #FFFFFF;
    color: #B42318;
    font-size: 11px;
    font-weight: 750;
    cursor: pointer;
    transition: .2s ease;
}

.finish-button:hover {
    background: #FEF2F2;
    border-color: #E9A8A8;
}

/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 900px) {
    .scanner-grid {
        grid-template-columns: 1fr;
    }

    .session-card {
        order: 2;
    }
}

@media (max-width: 650px) {
    .scanner-page {
        padding-bottom: 20px;
    }

    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .page-header h1 {
        font-size: 25px;
    }

    .scanner-card {
        padding: 16px;
    }

    .camera-box {
        min-height: 340px;
        padding: 10px;
    }

    #reader,
    #reader video {
        min-height: 250px;
    }

    .qr-guide {
        width: 210px;
        height: 210px;
    }

    .session-card {
        padding: 18px;
    }
}
</style>

    

<script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>

<script>

    let video = null;
    let canvas = null;
    let context = null;

    let cameraStream = null;
    let cameraRunning = false;

    let scanAnimationFrame = null;
    let scanBusy = false;
    let lastScanFrameTime = 0;

    // Native BarcodeDetector dipakai bila browser mendukung.
    let nativeBarcodeDetector = null;
    let usingNativeDetector = false;

    // Fallback jsQR.
    const JSQR_SCAN_INTERVAL = 70;

    // QR terakhir yang berhasil diproses
    let lastScannedCode = null;

    // Waktu QR terakhir diproses
    let lastScannedTime = 0;

    // Berapa lama QR yang sama diabaikan
    const SAME_QR_COOLDOWN = 1500;


    /*
    ============================================================
    PROSES ABSENSI
    ============================================================
    */

    function prosesAbsensi(decodedText, messageElement) {

        const now = Date.now();

        /*
        Jangan proses QR yang sama berulang-ulang
        dalam waktu 3 detik.
        */

        if (
            decodedText === lastScannedCode &&
            now - lastScannedTime < SAME_QR_COOLDOWN
        ) {
            return;
        }

        lastScannedCode = decodedText;
        lastScannedTime = now;


        messageElement.innerHTML =
            'QR terbaca. Memproses absensi...';


        const formData = new FormData();

        formData.append(
            'qr_code',
            decodedText
        );


        fetch("{{ route('attendance.scan') }}", {

            method: "POST",

            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },

            body: formData

        })

        .then(function (response) {

            return response.json();

        })

        .then(function (result) {

            console.log(
                'Hasil absensi:',
                result
            );


            if (result.success) {

                messageElement.innerHTML =
                    '' +
                    result.data.nama +
                    ' berhasil melakukan absensi.';

            } else {

                messageElement.innerHTML =
                    '' +
                    result.message;

            }

        })

        .catch(function (error) {

            console.error(
                'Attendance error:',
                error
            );

            messageElement.innerHTML =
                '❌ Gagal memproses absensi.';

        });

    }


    /*
    ============================================================
    SCAN KAMERA
    ============================================================
    */

    /*
    ============================================================
    SCANNER ENGINE
    ============================================================

    Prioritas:
    1. BarcodeDetector native -> sangat ringan bila tersedia.
    2. jsQR fallback -> tetap kompatibel dengan Chrome/desktop.

    Tidak menggunakan setTimeout berulang.
    requestAnimationFrame mencegah antrean timer yang menumpuk.
    ============================================================
    */

    function setupNativeDetector() {

        usingNativeDetector = false;
        nativeBarcodeDetector = null;

        if (
            'BarcodeDetector' in window &&
            typeof window.BarcodeDetector === 'function'
        ) {

            try {

                nativeBarcodeDetector =
                    new BarcodeDetector({
                        formats: ['qr_code']
                    });

                usingNativeDetector = true;

                console.log(
                    'Scanner engine: Native BarcodeDetector'
                );

            } catch (error) {

                console.log(
                    'Native BarcodeDetector tidak tersedia:',
                    error
                );

            }

        }

        if (!usingNativeDetector) {

            console.log(
                'Scanner engine: jsQR fallback'
            );

        }
    }


    async function scanNative() {

        if (
            !cameraRunning ||
            !video ||
            video.readyState < 2 ||
            !nativeBarcodeDetector
        ) {
            return;
        }

        try {

            const barcodes =
                await nativeBarcodeDetector.detect(video);

            if (
                barcodes &&
                barcodes.length &&
                barcodes[0].rawValue
            ) {

                const decodedText =
                    barcodes[0].rawValue;

                console.log(
                    'QR NATIVE TERBACA:',
                    decodedText
                );

                prosesAbsensi(
                    decodedText,
                    document.getElementById('scan-message')
                );
            }

        } catch (error) {

            console.debug(
                'Native detect:',
                error
            );

        }
    }


   function scanJsQr() {

    if (
        !cameraRunning ||
        !video ||
        !canvas ||
        !context ||
        video.readyState < 2 ||
        !video.videoWidth ||
        !video.videoHeight
    ) {
        return;
    }

    const videoWidth = video.videoWidth;
    const videoHeight = video.videoHeight;

    /*
    ============================================================
    SCAN QR DENGAN CROP LEBIH DEKAT
    ============================================================
    */

    // Fokus ke area tengah tempat QR berada.
    // Ini membuat QR mahasiswa yang kecil menjadi lebih besar
    // sebelum dibaca jsQR.
    const cropSize =
        Math.min(videoWidth, videoHeight) * 0.78;

    const sourceX =
        (videoWidth - cropSize) / 2;

    const sourceY =
        (videoHeight - cropSize) / 2;

    // Sedikit lebih tinggi dari sebelumnya
    const scanSize = 640;

    if (
        canvas.width !== scanSize ||
        canvas.height !== scanSize
    ) {
        canvas.width = scanSize;
        canvas.height = scanSize;
    }

    context.imageSmoothingEnabled = false;

    context.drawImage(
        video,
        sourceX,
        sourceY,
        cropSize,
        cropSize,
        0,
        0,
        scanSize,
        scanSize
    );

    let imageData;

    try {

        imageData =
            context.getImageData(
                0,
                0,
                scanSize,
                scanSize
            );

    } catch (error) {

        return;
    }

const code =
    jsQR(
        imageData.data,
        imageData.width,
        imageData.height,
        {
            inversionAttempts: 'attemptBoth'
        }
    );
    if (
        code &&
        code.data
    ) {

        console.log(
            'QR JSQR TERBACA:',
            code.data
        );

        prosesAbsensi(
            code.data,
            document.getElementById('scan-message')
        );
    }
}


    async function scannerLoop(timestamp) {

        if (!cameraRunning) {
            return;
        }

        /*
        Jangan jalankan decoder terlalu rapat.
        Native detector boleh berjalan setiap frame,
        sedangkan jsQR dibatasi sekitar 10x/detik.
        */

        if (
            usingNativeDetector
        ) {

            if (!scanBusy) {

                scanBusy = true;

                await scanNative();

                scanBusy = false;
            }

        } else {

            if (
                !scanBusy &&
                timestamp - lastScanFrameTime >= JSQR_SCAN_INTERVAL
            ) {

                scanBusy = true;

                lastScanFrameTime = timestamp;

                scanJsQr();

                scanBusy = false;
            }
        }

        if (cameraRunning) {

            scanAnimationFrame =
                requestAnimationFrame(
                    scannerLoop
                );
        }
    }


    function startScannerLoop() {

        if (scanAnimationFrame) {

            cancelAnimationFrame(
                scanAnimationFrame
            );
        }

        scanBusy = false;
        lastScanFrameTime = 0;

        scanAnimationFrame =
            requestAnimationFrame(
                scannerLoop
            );
    }


    /*
    ============================================================
    AKTIFKAN KAMERA
    ============================================================
    */

    document.getElementById(
        'start-camera'
    ).addEventListener(
        'click',
        async function () {

            if (cameraRunning) {
                return;
            }


            const message =
                document.getElementById(
                    'scan-message'
                );


            const startButton =
                document.getElementById(
                    'start-camera'
                );


            const stopButton =
                document.getElementById(
                    'stop-camera'
                );


            message.innerHTML =
                'Meminta izin kamera...';


            try {

cameraStream =
    await navigator.mediaDevices.getUserMedia({

        video: {
            facingMode: {
                ideal: 'environment'
            },

            width: {
                ideal: 1280,
                min: 640
            },

            height: {
                ideal: 720,
                min: 480
            },

            frameRate: {
                ideal: 30,
                min: 15
            },

            focusMode: 'continuous'
        },

        audio: false

    });


                const reader =
                    document.getElementById(
                        'reader'
                    );


                reader.innerHTML = '';


                video =
                    document.createElement(
                        'video'
                    );


                video.setAttribute(
                    'playsinline',
                    true
                );


                video.autoplay = true;

                video.muted = true;


                video.srcObject =
                    cameraStream;


                video.style.width =
                    '100%';


                video.style.display =
                    'block';


                reader.appendChild(
                    video
                );


                canvas =
                    document.createElement(
                        'canvas'
                    );


                context =
                    canvas.getContext(
                        '2d',
                        {
                            willReadFrequently: true
                        }
                    );


                cameraRunning = true;


                startButton.style.display =
                    'none';


                stopButton.style.display =
                    'block';


                message.innerHTML =
                    'Kamera aktif. Arahkan QR mahasiswa ke kotak scanner.';


                video.addEventListener(
                    'loadedmetadata',
                    function () {

                        video.play().then(async function () {

                            try {

                                const track =
                                    cameraStream.getVideoTracks()[0];

                                const capabilities =
                                    track.getCapabilities
                                        ? track.getCapabilities()
                                        : {};

                                const advanced = {};

                                if (
                                    capabilities.focusMode &&
                                    capabilities.focusMode.includes('continuous')
                                ) {
                                    advanced.focusMode = 'continuous';
                                }

                                if (
                                    capabilities.exposureMode &&
                                    capabilities.exposureMode.includes('continuous')
                                ) {
                                    advanced.exposureMode = 'continuous';
                                }

                                if (
                                    capabilities.whiteBalanceMode &&
                                    capabilities.whiteBalanceMode.includes('continuous')
                                ) {
                                    advanced.whiteBalanceMode = 'continuous';
                                }

                                if (Object.keys(advanced).length) {
                                    await track.applyConstraints({
                                        advanced: [advanced]
                                    });
                                }

                            } catch (focusError) {

                                console.log(
                                    'Continuous focus tidak tersedia:',
                                    focusError
                                );

                            }

                            setupNativeDetector();
                            startScannerLoop();

                        }).catch(function () {
                            setupNativeDetector();
                            startScannerLoop();
                        });

                    },
                    {
                        once: true
                    }
                );


            } catch (error) {

                console.error(
                    'Camera error:',
                    error
                );


                cameraRunning = false;


                message.innerHTML =
                    'Tidak dapat mengakses kamera.';

            }

        }
    );


    /*
    ============================================================
    MATIKAN KAMERA
    ============================================================
    */

    document.getElementById(
        'stop-camera'
    ).addEventListener(
        'click',
        function () {

            cameraRunning = false;


            if (scanAnimationFrame) {

                cancelAnimationFrame(
                    scanAnimationFrame
                );

                scanAnimationFrame = null;

            }

            scanBusy = false;


            if (cameraStream) {

                cameraStream
                    .getTracks()
                    .forEach(function (track) {

                        track.stop();

                    });

                cameraStream = null;

            }


            const reader =
                document.getElementById(
                    'reader'
                );


            reader.innerHTML = '';


            video = null;

            canvas = null;

            context = null;


            const startButton =
                document.getElementById(
                    'start-camera'
                );


            const stopButton =
                document.getElementById(
                    'stop-camera'
                );


            startButton.style.display =
                'block';


            stopButton.style.display =
                'none';


            const message =
                document.getElementById(
                    'scan-message'
                );


            message.innerHTML =
                'Kamera dimatikan.';

        }
    );


    /*
    ============================================================
    UPLOAD QR
    ============================================================
    */

    document.getElementById(
        'qr-file'
    ).addEventListener(
        'change',
        function (event) {

            const file =
                event.target.files[0];


            const uploadMessage =
                document.getElementById(
                    'upload-message'
                );


            if (!file) {
                return;
            }


            uploadMessage.innerHTML =
                'Membaca QR Code...';


            const reader =
                new FileReader();


            reader.onload =
                function (e) {

                    const img =
                        new Image();


                    img.onload =
                        function () {

                            const uploadCanvas =
                                document.createElement(
                                    'canvas'
                                );


                            const uploadContext =
                                uploadCanvas.getContext(
                                    '2d',
                                    {
                                        willReadFrequently: true
                                    }
                                );


                            const scale = 3;


                            uploadCanvas.width =
                                img.width * scale;


                            uploadCanvas.height =
                                img.height * scale;


                            uploadContext.imageSmoothingEnabled =
                                false;


                            uploadContext.drawImage(

                                img,

                                0,
                                0,

                                uploadCanvas.width,
                                uploadCanvas.height

                            );


                            const imageData =
                                uploadContext.getImageData(

                                    0,
                                    0,

                                    uploadCanvas.width,
                                    uploadCanvas.height

                                );


                            const code =
                                jsQR(

                                    imageData.data,

                                    imageData.width,

                                    imageData.height,

                                    {
                                        inversionAttempts:
                                            'attemptBoth'
                                    }

                                );


                            if (!code) {

                                uploadMessage.innerHTML =
                                    'QR tidak dapat dibaca dari gambar.';

                                return;

                            }


                            console.log(
                                'QR dari gambar terbaca:',
                                code.data
                            );


                            prosesAbsensi(
                                code.data,
                                uploadMessage
                            );

                        };


                    img.onerror =
                        function () {

                            uploadMessage.innerHTML =
                                'Gambar QR tidak dapat diproses.';

                        };


                    img.src =
                        e.target.result;

                };


            reader.readAsDataURL(
                file
            );

        }
    );

</script>

@endsection