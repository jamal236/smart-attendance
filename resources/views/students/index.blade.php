@extends('layouts.app')

@section('title', 'Data Mahasiswa - Smart Attendance')

@section('content')

<div class="students-page">

    <!-- =========================
         HEADER
    ========================== -->

    <div class="page-header">

        <div>

            <a href="{{ route('dashboard') }}" class="back-link">
                ← Kembali ke Dashboard
            </a>

            <span class="eyebrow">
                DATA AKADEMIK
            </span>

            <h1>
                Data Mahasiswa
            </h1>

            <p>
                Kelola mahasiswa dan QR Code yang digunakan untuk absensi.
            </p>

        </div>


        <a
            href="{{ route('students.create') }}"
            class="primary-button"
        >
            <span class="button-plus">+</span>
            Tambah Mahasiswa
        </a>

    </div>


    <!-- =========================
         SUMMARY
    ========================== -->

    <div class="summary-grid">

        <div class="summary-card">

            <div class="summary-icon">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M16 20v-1.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 4 18.5V20" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                    <circle cx="10" cy="8" r="3" stroke="currentColor" stroke-width="1.7"/>
                    <path d="M17 11a3 3 0 1 0-1.2-5.75M20 20v-1.5a3.5 3.5 0 0 0-2.5-3.35" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                </svg>
            </div>

            <div>

                <span class="summary-label">
                    Total Mahasiswa
                </span>

                <strong>
                    {{ count($students) }}
                </strong>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon active-icon">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="m7 12 3 3 7-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div>

                <span class="summary-label">
                    Mahasiswa Aktif
                </span>

                <strong>
                    {{ collect($students)->where('status', 'Aktif')->count() }}
                </strong>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon qr-icon">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4z" stroke="currentColor" stroke-width="1.6"/>
                    <path d="M14 14h3v3h-3zM17 17h3v3h-3zM17 14h3" stroke="currentColor" stroke-width="1.6"/>
                </svg>
            </div>

            <div>

                <span class="summary-label">
                    QR Code
                </span>

                <strong>
                    {{ count($students) }}
                </strong>

            </div>

        </div>

    </div>


    <!-- =========================
         MAIN CARD
    ========================== -->

    <div class="student-card">

        <!-- CARD TOP -->

        <div class="card-top">

            <div>

                <div class="card-title-row">

                    <h2>
                        Daftar Mahasiswa
                    </h2>

                    <span class="data-count">
                        {{ count($students) }} data
                    </span>

                </div>

                <p>
                    Data mahasiswa yang terdaftar dalam sistem Smart Attendance.
                </p>

            </div>


            <!-- SEARCH -->

            <div class="search-wrapper">

                <span class="search-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="1.7"/>
                        <path d="m16 16 4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                    </svg>
                </span>

                <input
                    type="text"
                    id="searchMahasiswa"
                    class="search-input"
                    placeholder="Cari NIM atau nama..."
                >

            </div>

        </div>


        <!-- TABLE -->

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th class="number-column">
                            No
                        </th>

                        <th>
                            NIM
                        </th>

                        <th>
                            Mahasiswa
                        </th>

                        <th>
                            Kelas
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            QR Code
                        </th>

                        <th class="action-column">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody id="studentTableBody">

                    @forelse($students as $index => $student)

                        <tr>

                            <!-- NO -->

                            <td class="number-cell">
                                {{ $index + 1 }}
                            </td>


                            <!-- NIM -->

                            <td>

                                <span class="nim-text">
                                    {{ $student['nim'] }}
                                </span>

                            </td>


                            <!-- NAMA -->

                            <td>

                                <div class="student-name">

                                    <div class="avatar">
                                        {{ strtoupper(substr($student['nama'], 0, 1)) }}
                                    </div>

                                    <div>

                                        <strong>
                                            {{ $student['nama'] }}
                                        </strong>

                                        <span>
                                            Mahasiswa
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <!-- KELAS -->

                            <td>

                                <span class="class-badge">
                                    {{ $student['kelas'] }}
                                </span>

                            </td>


                            <!-- STATUS -->

                            <td>

                                @if(($student['status'] ?? 'Aktif') === 'Aktif')

                                    <span class="status-badge status-active">
                                        <span></span>
                                        Aktif
                                    </span>

                                @else

                                    <span class="status-badge status-inactive">
                                        <span></span>
                                        Nonaktif
                                    </span>

                                @endif

                            </td>


                            <!-- QR -->

                            <td>

                                <span class="qr-badge">
                                    <span>✓</span>
                                    QR Aktif
                                </span>

                            </td>


                            <!-- AKSI -->

                            <td>

                                <div class="actions">

                                    <a
                                        href="{{ route('students.qr', $student['id']) }}"
                                        class="action-button qr-action"
                                    >
                                        Lihat QR
                                    </a>


                                    <a
                                        href="{{ route('students.edit', $student['id']) }}"
                                        class="action-button"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        action="{{ route('students.destroy', $student['id']) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus mahasiswa {{ $student['nama'] }}?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-button delete-button"
                                        >
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="empty-state"
                            >

                                <div class="empty-icon">
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M16 20v-1.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 4 18.5V20" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                        <circle cx="10" cy="8" r="3" stroke="currentColor" stroke-width="1.7"/>
                                        <path d="M17 11a3 3 0 1 0-1.2-5.75M20 20v-1.5a3.5 3.5 0 0 0-2.5-3.35" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                    </svg>
                                </div>

                                <strong>
                                    Belum ada mahasiswa
                                </strong>

                                <p>
                                    Tambahkan data mahasiswa untuk mulai menggunakan
                                    sistem absensi QR.
                                </p>

                                <a
                                    href="{{ route('students.create') }}"
                                    class="empty-button"
                                >
                                    + Tambah Mahasiswa
                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- FOOTER -->

        @if(count($students) > 0)

            <div class="table-footer">

                <span>
                    Menampilkan
                    <strong id="visibleCount">
                        {{ count($students) }}
                    </strong>
                    mahasiswa
                </span>

                <span>
                    Smart Attendance
                </span>

            </div>

        @endif

    </div>

</div>


<style>
.students-page{max-width:1200px;margin:0 auto;padding-bottom:30px}.page-header{display:flex;justify-content:space-between;align-items:flex-end;gap:20px;margin-bottom:25px}.back-link{display:inline-flex;margin-bottom:10px;color:#4A5C6A;text-decoration:none;font-size:13px;font-weight:500}.eyebrow{display:block;margin-bottom:6px;color:#253745;font-size:10px;font-weight:800;letter-spacing:1.1px}.page-header h1{margin:0;color:#06141B;font-size:30px;font-weight:750;letter-spacing:-.6px}.page-header p{margin:7px 0 0;color:#4A5C6A;font-size:14px}.primary-button{display:inline-flex;align-items:center;gap:8px;height:44px;box-sizing:border-box;padding:0 17px;border:none;border-radius:10px;background:linear-gradient(135deg,#253745,#11212D);color:#fff;text-decoration:none;font-size:13px;font-weight:700;box-shadow:0 8px 18px rgba(6,20,27,.14)}.button-plus{font-size:18px;line-height:1}.summary-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-bottom:20px}.summary-card{display:flex;align-items:center;gap:13px;padding:18px;border:1px solid #D9DEDF;border-radius:15px;background:#fff;box-shadow:0 5px 20px rgba(15,23,42,.035)}.summary-icon{display:flex;align-items:center;justify-content:center;width:44px;height:44px;flex-shrink:0;border-radius:11px;background:#E8ECEE;color:#4A5C6A}.summary-icon svg{width:20px!important;height:20px!important;max-width:20px!important;max-height:20px!important}.active-icon{background:#EDF7F1;color:#28784D}.qr-icon{background:#E8ECEE}.summary-label{display:block;margin-bottom:4px;color:#9BA8AB;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.5px}.summary-card strong{color:#06141B;font-size:22px;font-weight:750}.student-card{overflow:hidden;border:1px solid #D9DEDF;border-radius:18px;background:#fff;box-shadow:0 8px 30px rgba(15,23,42,.05),0 2px 6px rgba(15,23,42,.03)}.card-top{display:flex;justify-content:space-between;align-items:center;gap:20px;padding:23px 24px;border-bottom:1px solid #E8ECEE}.card-title-row{display:flex;align-items:center;gap:9px}.card-top h2{margin:0;color:#06141B;font-size:18px;font-weight:700}.card-top p{margin:6px 0 0;color:#4A5C6A;font-size:12px}.data-count{padding:4px 8px;border-radius:999px;background:#E8ECEE;color:#4A5C6A;font-size:10px;font-weight:700}.search-wrapper{position:relative;width:250px;flex-shrink:0}.search-icon{position:absolute;top:50%;left:12px;transform:translateY(-52%);width:17px;height:17px;color:#9BA8AB;pointer-events:none}.search-icon svg{display:block;width:17px!important;height:17px!important}.search-input{width:100%;height:40px;box-sizing:border-box;padding:0 12px 0 37px;border:1px solid #CCD0CF;border-radius:10px;outline:none;background:#F7F8F8;color:#06141B;font-size:12px}.search-input:focus{border-color:#253745;background:#fff;box-shadow:0 0 0 3px rgba(37,55,69,.08)}.search-input::placeholder{color:#9BA8AB}.table-wrapper{width:100%;overflow-x:auto}table{width:100%;min-width:920px;border-collapse:collapse}th{padding:13px 15px;border-bottom:1px solid #D9DEDF;background:#F7F8F8;color:#4A5C6A;font-size:10px;font-weight:800;text-align:left;text-transform:uppercase;letter-spacing:.4px}td{padding:15px;border-bottom:1px solid #E8ECEE;color:#06141B;font-size:13px;vertical-align:middle}tbody tr:hover{background:#F8F9F9}tbody tr:last-child td{border-bottom:none}.number-column{width:50px}.action-column{width:245px}.number-cell{color:#9BA8AB;font-size:12px;font-weight:600}.nim-text{color:#253745;font-weight:750}.student-name{display:flex;align-items:center;gap:10px}.avatar{display:flex;align-items:center;justify-content:center;width:36px;height:36px;flex-shrink:0;border-radius:11px;background:#E8ECEE;color:#253745;font-size:11px;font-weight:800}.student-name strong{display:block;margin-bottom:3px;color:#06141B;font-size:11px;font-weight:750}.student-name span{display:block;color:#9BA8AB;font-size:9px}.class-badge{display:inline-flex;align-items:center;justify-content:center;min-width:38px;padding:5px 9px;border:1px solid #D9DEDF;border-radius:8px;background:#F2F4F4;color:#253745;font-size:9px;font-weight:800}.status-badge{display:inline-flex;align-items:center;gap:6px;padding:6px 10px;border-radius:999px;font-size:9px;font-weight:800;line-height:1}.status-badge>span{width:5px;height:5px;flex-shrink:0;border-radius:50%}.status-active{background:#EDF7F1;color:#28784D}.status-active>span{background:#39A76A}.status-inactive{background:#FEF2F2;color:#B42318}.status-inactive>span{background:#EF4444}.qr-badge{display:inline-flex;align-items:center;gap:6px;padding:6px 10px;border:1px solid #DCEDE3;border-radius:999px;background:#F1F8F4;color:#28784D;font-size:9px;font-weight:800;line-height:1}.qr-badge>span{display:inline-flex;align-items:center;justify-content:center;width:12px;height:12px;font-size:9px}.actions{display:flex;align-items:center;gap:6px}.actions form{margin:0}.action-button{display:inline-flex;align-items:center;justify-content:center;min-width:44px;height:32px;box-sizing:border-box;padding:0 10px;border:1px solid #D9DEDF;border-radius:8px;background:#fff;color:#253745;font-size:9px;font-weight:700;text-decoration:none;cursor:pointer}.qr-action{background:#F7F8F8}.delete-button{border-color:#F1CACA;color:#B42318}.empty-state{height:260px!important;padding:40px 20px!important;text-align:center!important;vertical-align:middle!important}.empty-icon{display:flex!important;align-items:center!important;justify-content:center!important;width:52px!important;height:52px!important;min-width:52px!important;min-height:52px!important;margin:0 auto 16px!important;box-sizing:border-box;border-radius:14px;background:#E8ECEE;color:#253745}.empty-icon svg{display:block!important;width:24px!important;height:24px!important;max-width:24px!important;max-height:24px!important}.empty-state strong{display:block;margin:0 0 6px;color:#06141B;font-size:14px;font-weight:700}.empty-state p{max-width:360px;margin:0 auto 16px;color:#9BA8AB;font-size:12px;line-height:1.6}.empty-button{display:inline-flex;align-items:center;justify-content:center;height:38px;padding:0 15px;border-radius:9px;background:#253745;color:#fff;font-size:11px;font-weight:700;text-decoration:none}.table-footer{display:flex;justify-content:space-between;padding:13px 24px;border-top:1px solid #E8ECEE;background:#F7F8F8;color:#9BA8AB;font-size:10px}.table-footer strong{color:#253745}@media(max-width:850px){.summary-grid{grid-template-columns:1fr}.page-header{align-items:flex-start;flex-direction:column}.primary-button{width:100%;justify-content:center}.card-top{align-items:flex-start;flex-direction:column}.search-wrapper{width:100%}}@media(max-width:520px){.page-header h1{font-size:25px}.student-card{border-radius:16px}.card-top{padding:18px}.table-footer{padding:12px 18px}}
</style>


<script>

const searchInput =
    document.getElementById('searchMahasiswa');

const tableBody =
    document.getElementById('studentTableBody');

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
                row.cells[1]
                    .textContent
                    .toLowerCase();

            const nama =
                row.cells[2]
                    .textContent
                    .toLowerCase();


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