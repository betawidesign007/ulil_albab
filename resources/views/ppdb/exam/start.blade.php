<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBT Ujian Masuk PPDB - {{ $registration->nama_lengkap }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-emerald: #065f46;
            --primary-dark: #022c22;
            --accent-gold: #d97706;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
        }
        .font-arabic {
            font-family: 'Amiri', serif;
        }
        /* Sticky Top CBT Header */
        .cbt-header {
            background: #ffffff;
            border-bottom: 2px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 1020;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .timer-box {
            background: linear-gradient(135deg, #022c22 0%, #064e3b 100%);
            color: #ffffff;
            border-radius: 12px;
            padding: 0.45rem 1rem;
            font-family: monospace;
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 10px rgba(2, 44, 34, 0.25);
        }
        .timer-warning {
            background: linear-gradient(135deg, #b91c1c 0%, #dc2626 100%) !important;
            animation: pulse 1s infinite alternate;
        }
        @keyframes pulse {
            from { transform: scale(1); }
            to { transform: scale(1.04); }
        }

        /* Option Card */
        .option-label {
            display: block;
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            padding: 1rem 1.25rem;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }
        .option-label:hover {
            border-color: #10b981;
            background: #f8fafc;
            transform: translateX(4px);
        }
        .option-radio {
            display: none;
        }
        .option-radio:checked + .option-label {
            border-color: #059669;
            background-color: #ecfdf5;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.15);
        }
        .option-key-badge {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #f1f5f9;
            color: #475569;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.85rem;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }
        .option-radio:checked + .option-label .option-key-badge {
            background: #059669;
            color: #ffffff;
        }

        /* Question Navigation Grid */
        .grid-q-btn {
            width: 42px;
            height: 42px;
            font-size: 0.88rem;
            font-weight: 700;
            border-radius: 10px;
            border: 1.5px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }
        .grid-q-btn:hover {
            border-color: #065f46;
            color: #065f46;
        }
        .grid-q-btn.answered {
            background: #059669;
            color: #ffffff;
            border-color: #059669;
        }
        .grid-q-btn.doubt {
            background: #f59e0b;
            color: #ffffff;
            border-color: #d97706;
        }
        .grid-q-btn.current {
            border: 2.5px solid #022c22 !important;
            box-shadow: 0 0 0 3px rgba(6, 95, 70, 0.3);
            font-weight: 800;
        }

        .btn-pesantren {
            background: linear-gradient(135deg, #065f46 0%, #047857 100%);
            color: #ffffff;
            font-weight: 600;
            border: none;
        }
        .btn-pesantren:hover {
            background: #022c22;
            color: #ffffff;
        }
        @media (max-width: 767.98px) {
            .timer-box {
                font-size: 1.05rem;
                padding: 0.35rem 0.75rem;
            }
            .option-label {
                padding: 0.75rem 1rem;
            }
            .grid-q-btn {
                width: 36px;
                height: 36px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>

    <!-- Header CBT Bar -->
    <header class="cbt-header py-2 px-3 px-lg-4">
        <div class="container-fluid d-flex flex-wrap align-items-center justify-content-between gap-3">
            <!-- Info Peserta -->
            <div class="d-flex align-items-center gap-3">
                @if($ppdbSetting->logo_url)
                    <img src="{{ $ppdbSetting->logo_url }}" alt="Logo" class="rounded-2 p-1 bg-light d-none d-sm-block" style="width: 40px; height: 40px; object-fit: contain;">
                @endif
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <h6 class="fw-bold mb-0 text-dark">{{ $registration->nama_lengkap }}</h6>
                        <span class="badge bg-success bg-opacity-10 text-success fw-bold font-monospace">{{ $registration->no_pendaftaran }}</span>
                    </div>
                    <small class="text-muted d-block" style="font-size: 0.76rem;">
                        Jenjang: <strong>{{ $registration->jenjang }}</strong> &bull; Jalur: <strong>{{ $registration->jalur }}</strong>
                    </small>
                </div>
            </div>

            <!-- Timer & Action Status -->
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <small class="text-muted d-block fw-semibold" style="font-size: 0.72rem;">SISA WAKTU UJIAN:</small>
                    <div class="timer-box" id="examTimerBox">
                        <i class="bi bi-clock-history text-warning"></i>
                        <span id="countdownDisplay">01:30:00</span>
                    </div>
                </div>
                <div class="d-md-none timer-box" id="examTimerBoxMobile" style="font-size: 1rem; padding: 0.35rem 0.75rem;">
                    <i class="bi bi-clock-history text-warning"></i>
                    <span id="countdownDisplayMobile">01:30:00</span>
                </div>

                <button type="button" class="btn btn-danger fw-bold px-3 py-2 shadow-sm d-flex align-items-center gap-2" onclick="bukaModalKonfirmasiSelesai()">
                    <i class="bi bi-send-check-fill"></i> <span class="d-none d-sm-inline">Kumpulkan Ujian</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Main CBT Content Area -->
    <main class="container-fluid px-3 px-lg-4 py-4" style="max-width: 1440px;">
        <form id="formCbtExam" action="{{ route('ppdb.exam.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="no_pendaftaran" value="{{ $registration->no_pendaftaran }}">

            <div class="row g-4">
                <!-- Kolom Kiri: Pertanyaan Soal (Dynamic Display One Question at a Time) -->
                <div class="col-lg-8 col-xl-9">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">

                        <!-- Question Header Card -->
                        <div class="card-header bg-white p-3 p-md-4 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success px-3 py-2 fw-bold fs-6" id="badgeSoalNomor">
                                    Soal Nomor 1
                                </span>
                                <span class="badge bg-light text-secondary border px-3 py-2" id="badgeSoalKategori">
                                    PAI &amp; Fiqih
                                </span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-outline-warning btn-sm fw-semibold" id="btnRaguRagu" onclick="toggleRaguRagu()">
                                    <i class="bi bi-flag"></i> Tandai Ragu-Ragu
                                </button>
                            </div>
                        </div>

                        <!-- Question Body Container (Semua Soal Dirender, tapi hanya 1 yang Visible) -->
                        <div class="card-body p-4 p-md-5">
                            @foreach($soals as $idx => $soal)
                                <div class="soal-container {{ $idx === 0 ? '' : 'd-none' }}" id="soalWrapper_{{ $idx + 1 }}" data-nomor="{{ $idx + 1 }}" data-id="{{ $soal->id }}" data-kategori="{{ $soal->kategori }}">
                                    <!-- Soal Teks -->
                                    <div class="mb-4">
                                        <div class="fs-5 text-dark fw-semibold lh-base" style="white-space: pre-line;">{!! nl2br(e($soal->pertanyaan)) !!}</div>
                                    </div>

                                    <!-- Opsi Jawaban Radio List -->
                                    <div class="d-flex flex-column gap-3">
                                        <!-- Opsi A -->
                                        <div>
                                            <input type="radio"
                                                   name="answers[{{ $soal->id }}]"
                                                   id="opt_{{ $soal->id }}_A"
                                                   value="A"
                                                   class="option-radio"
                                                   onchange="handlePilihJawaban({{ $idx + 1 }}, 'A')">
                                            <label for="opt_{{ $soal->id }}_A" class="option-label">
                                                <div class="d-flex align-items-center">
                                                    <span class="option-key-badge">A</span>
                                                    <span class="text-dark fw-medium fs-6">{{ $soal->opsi_a }}</span>
                                                </div>
                                            </label>
                                        </div>

                                        <!-- Opsi B -->
                                        <div>
                                            <input type="radio"
                                                   name="answers[{{ $soal->id }}]"
                                                   id="opt_{{ $soal->id }}_B"
                                                   value="B"
                                                   class="option-radio"
                                                   onchange="handlePilihJawaban({{ $idx + 1 }}, 'B')">
                                            <label for="opt_{{ $soal->id }}_B" class="option-label">
                                                <div class="d-flex align-items-center">
                                                    <span class="option-key-badge">B</span>
                                                    <span class="text-dark fw-medium fs-6">{{ $soal->opsi_b }}</span>
                                                </div>
                                            </label>
                                        </div>

                                        <!-- Opsi C -->
                                        <div>
                                            <input type="radio"
                                                   name="answers[{{ $soal->id }}]"
                                                   id="opt_{{ $soal->id }}_C"
                                                   value="C"
                                                   class="option-radio"
                                                   onchange="handlePilihJawaban({{ $idx + 1 }}, 'C')">
                                            <label for="opt_{{ $soal->id }}_C" class="option-label">
                                                <div class="d-flex align-items-center">
                                                    <span class="option-key-badge">C</span>
                                                    <span class="text-dark fw-medium fs-6">{{ $soal->opsi_c }}</span>
                                                </div>
                                            </label>
                                        </div>

                                        <!-- Opsi D -->
                                        <div>
                                            <input type="radio"
                                                   name="answers[{{ $soal->id }}]"
                                                   id="opt_{{ $soal->id }}_D"
                                                   value="D"
                                                   class="option-radio"
                                                   onchange="handlePilihJawaban({{ $idx + 1 }}, 'D')">
                                            <label for="opt_{{ $soal->id }}_D" class="option-label">
                                                <div class="d-flex align-items-center">
                                                    <span class="option-key-badge">D</span>
                                                    <span class="text-dark fw-medium fs-6">{{ $soal->opsi_d }}</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Card Footer Navigation Buttons -->
                        <div class="card-footer bg-light p-3 p-md-4 d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-outline-secondary px-3 py-2 fw-semibold" id="btnPrev" onclick="navigasiSoal(-1)">
                                <i class="bi bi-arrow-left me-1"></i> Soal Sebelumnya
                            </button>
                            <div class="small text-muted d-none d-sm-block">
                                Menampilkan Soal <strong id="currentSoalIndexText">1</strong> dari <strong>{{ count($soals) }}</strong>
                            </div>
                            <button type="button" class="btn btn-pesantren px-4 py-2 fw-semibold" id="btnNext" onclick="navigasiSoal(1)">
                                Soal Selanjutnya <i class="bi bi-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Grid Navigasi Butir Soal 1 - 50 -->
                <div class="col-lg-4 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4 bg-white p-3 p-md-4 sticky-top" style="top: 80px;">
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                            <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-grid-3x3-gap-fill text-success me-2"></i>Daftar Soal</h6>
                            <span class="badge bg-success bg-opacity-10 text-success fw-bold" id="badgeTerjawab">0 / {{ count($soals) }} Terjawab</span>
                        </div>

                        <!-- Keterangan Warna Indikator -->
                        <div class="d-flex flex-wrap gap-2 small text-muted mb-3" style="font-size: 0.74rem;">
                            <span class="d-inline-flex align-items-center gap-1">
                                <span class="d-inline-block rounded-1 bg-success" style="width: 12px; height: 12px;"></span> Sudah
                            </span>
                            <span class="d-inline-flex align-items-center gap-1">
                                <span class="d-inline-block rounded-1 bg-warning" style="width: 12px; height: 12px;"></span> Ragu
                            </span>
                            <span class="d-inline-flex align-items-center gap-1">
                                <span class="d-inline-block rounded-1 bg-white border" style="width: 12px; height: 12px;"></span> Belum
                            </span>
                        </div>

                        <!-- Grid Butir Soal 1-50 -->
                        <div class="d-flex flex-wrap gap-2 justify-content-start overflow-y-auto" style="max-height: 380px;">
                            @foreach($soals as $idx => $s)
                                <button type="button"
                                        class="grid-q-btn {{ $idx === 0 ? 'current' : '' }}"
                                        id="gridBtn_{{ $idx + 1 }}"
                                        onclick="pilihNomorSoal({{ $idx + 1 }})">
                                    {{ $idx + 1 }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Tombol Selesai & Kirim -->
                        <div class="pt-4 mt-3 border-top">
                            <button type="button" class="btn btn-danger w-100 py-2 fw-bold shadow-sm" onclick="bukaModalKonfirmasiSelesai()">
                                <i class="bi bi-check2-circle me-1"></i> Selesai &amp; Kumpulkan Jawaban
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <!-- Modal Konfirmasi Pengumpulan Lembar Jawaban -->
    <div class="modal fade" id="modalKonfirmasiSelesai" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-danger text-white py-3 px-4">
                    <h6 class="modal-title fw-bold mb-0"><i class="bi bi-question-circle-fill me-2"></i>Konfirmasi Pengumpulan Ujian</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-dark mb-3">
                        Apakah Anda yakin ingin menyelesaikan dan mengumpulkan lembar jawaban ujian masuk sekarang?
                    </p>

                    <div class="p-3 bg-light rounded-3 mb-3 small">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Total Soal:</span>
                            <strong>{{ count($soals) }} Butir</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Sudah Dijawab:</span>
                            <strong class="text-success" id="modalStatTerjawab">0</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Ditandai Ragu-Ragu:</span>
                            <strong class="text-warning" id="modalStatRagu">0</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Belum Dijawab:</span>
                            <strong class="text-danger" id="modalStatKosong">{{ count($soals) }}</strong>
                        </div>
                    </div>

                    <div id="modalWarningKosong" class="alert alert-warning py-2 small d-none">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Masih ada soal yang belum dijawab. Jawaban kosong tidak mendapatkan poin.
                    </div>

                    <div class="small text-muted">
                        Setelah lembar jawaban dikirimkan, Anda tidak dapat mengubah jawaban lagi dan sistem akan langsung memproses perolehan nilai Anda.
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Kembali Periksa</button>
                    <button type="button" class="btn btn-danger fw-bold px-4" onclick="submitLembarJawaban()">
                        <i class="bi bi-send-check-fill me-1"></i> Ya, Kumpulkan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CBT Script: Navigasi, Timer, Grid Tracker, Auto-Submit -->
    <script>
        const totalSoal = {{ count($soals) }};
        let currentNomor = 1;
        const raguStatus = {}; // nomor => boolean

        // 1. Durasi & Timer Hitung Mundur
        const startTimeMs = new Date("{{ $startTime->toIso8601String() }}").getTime();
        const durationMinutes = {{ $durasiMenit }};
        const endTimeMs = startTimeMs + (durationMinutes * 60 * 1000);

        function updateTimer() {
            const now = new Date().getTime();
            const distance = endTimeMs - now;

            if (distance <= 0) {
                document.getElementById('countdownDisplay').innerText = "00:00:00";
                if (document.getElementById('countdownDisplayMobile')) {
                    document.getElementById('countdownDisplayMobile').innerText = "00:00:00";
                }
                alert("Waktu ujian telah berakhir! Lembar jawaban Anda akan otomatis dikirimkan ke sistem.");
                submitLembarJawaban();
                return;
            }

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const formatted = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            document.getElementById('countdownDisplay').innerText = formatted;
            if (document.getElementById('countdownDisplayMobile')) {
                document.getElementById('countdownDisplayMobile').innerText = formatted;
            }

            // Peringatan jika sisa waktu < 10 menit
            if (distance < 10 * 60 * 1000) {
                document.getElementById('examTimerBox').classList.add('timer-warning');
                if (document.getElementById('examTimerBoxMobile')) {
                    document.getElementById('examTimerBoxMobile').classList.add('timer-warning');
                }
            }
        }

        setInterval(updateTimer, 1000);
        updateTimer();

        // 2. Navigasi Soal
        function pilihNomorSoal(nomor) {
            if (nomor < 1 || nomor > totalSoal) return;

            // Sembunyikan soal sebelumnya
            const prevWrap = document.getElementById(`soalWrapper_${currentNomor}`);
            if (prevWrap) prevWrap.classList.add('d-none');

            // Hapus kelas current pada grid button
            const prevGridBtn = document.getElementById(`gridBtn_${currentNomor}`);
            if (prevGridBtn) prevGridBtn.classList.remove('current');

            // Tampilkan soal baru
            currentNomor = nomor;
            const newWrap = document.getElementById(`soalWrapper_${currentNomor}`);
            if (newWrap) {
                newWrap.classList.remove('d-none');
                document.getElementById('badgeSoalNomor').innerText = `Soal Nomor ${currentNomor}`;
                document.getElementById('badgeSoalKategori').innerText = newWrap.getAttribute('data-kategori');
                document.getElementById('currentSoalIndexText').innerText = currentNomor;
            }

            // Tandai current pada grid
            const newGridBtn = document.getElementById(`gridBtn_${currentNomor}`);
            if (newGridBtn) newGridBtn.classList.add('current');

            // Update state tombol Next / Prev
            document.getElementById('btnPrev').disabled = (currentNomor === 1);
            if (currentNomor === totalSoal) {
                document.getElementById('btnNext').innerHTML = 'Periksa Kembali <i class="bi bi-check2 ms-1"></i>';
            } else {
                document.getElementById('btnNext').innerHTML = 'Soal Selanjutnya <i class="bi bi-arrow-right ms-1"></i>';
            }

            // Update tampilan tombol ragu-ragu
            updateTombolRaguVisual();
        }

        function navigasiSoal(step) {
            const nextNomor = currentNomor + step;
            if (nextNomor >= 1 && nextNomor <= totalSoal) {
                pilihNomorSoal(nextNomor);
            }
        }

        // 3. Handle Pemilihan Jawaban Opsi
        function handlePilihJawaban(nomor, opsi) {
            const gridBtn = document.getElementById(`gridBtn_${nomor}`);
            if (gridBtn) {
                if (raguStatus[nomor]) {
                    gridBtn.className = 'grid-q-btn doubt';
                } else {
                    gridBtn.className = 'grid-q-btn answered';
                }
                if (nomor === currentNomor) {
                    gridBtn.classList.add('current');
                }
            }
            updateStatistikTerjawab();
        }

        // 4. Handle Ragu-Ragu
        function toggleRaguRagu() {
            raguStatus[currentNomor] = !raguStatus[currentNomor];
            updateTombolRaguVisual();

            const gridBtn = document.getElementById(`gridBtn_${currentNomor}`);
            const isAnswered = isSoalAnswered(currentNomor);

            if (gridBtn) {
                if (raguStatus[currentNomor]) {
                    gridBtn.className = 'grid-q-btn doubt current';
                } else if (isAnswered) {
                    gridBtn.className = 'grid-q-btn answered current';
                } else {
                    gridBtn.className = 'grid-q-btn current';
                }
            }
            updateStatistikTerjawab();
        }

        function updateTombolRaguVisual() {
            const btn = document.getElementById('btnRaguRagu');
            if (raguStatus[currentNomor]) {
                btn.className = 'btn btn-warning btn-sm fw-bold text-dark';
                btn.innerHTML = '<i class="bi bi-flag-fill"></i> Ditandai Ragu-Ragu';
            } else {
                btn.className = 'btn btn-outline-warning btn-sm fw-semibold';
                btn.innerHTML = '<i class="bi bi-flag"></i> Tandai Ragu-Ragu';
            }
        }

        function isSoalAnswered(nomor) {
            const wrap = document.getElementById(`soalWrapper_${nomor}`);
            if (!wrap) return false;
            const checked = wrap.querySelector('input[type="radio"]:checked');
            return checked !== null;
        }

        // 5. Update Statistik Terjawab
        function updateStatistikTerjawab() {
            let answeredCount = 0;
            let raguCount = 0;

            for (let i = 1; i <= totalSoal; i++) {
                if (isSoalAnswered(i)) answeredCount++;
                if (raguStatus[i]) raguCount++;
            }

            document.getElementById('badgeTerjawab').innerText = `${answeredCount} / ${totalSoal} Terjawab`;
            document.getElementById('modalStatTerjawab').innerText = answeredCount;
            document.getElementById('modalStatRagu').innerText = raguCount;
            document.getElementById('modalStatKosong').innerText = (totalSoal - answeredCount);

            const warningKosong = document.getElementById('modalWarningKosong');
            if (answeredCount < totalSoal) {
                warningKosong.classList.remove('d-none');
            } else {
                warningKosong.classList.add('d-none');
            }
        }

        // 6. Konfirmasi Selesai & Submit
        function bukaModalKonfirmasiSelesai() {
            updateStatistikTerjawab();
            const modal = new bootstrap.Modal(document.getElementById('modalKonfirmasiSelesai'));
            modal.show();
        }

        let isSubmitting = false;
        function submitLembarJawaban() {
            if (isSubmitting) return;
            isSubmitting = true;
            window.removeEventListener('beforeunload', handleBeforeUnload);
            document.getElementById('formCbtExam').submit();
        }

        // Warning sebelum meninggalkan halaman
        function handleBeforeUnload(e) {
            e.preventDefault();
            e.returnValue = 'Ujian sedang berlangsung. Meninggalkan halaman dapat membatalkan jawaban Anda.';
            return e.returnValue;
        }
        window.addEventListener('beforeunload', handleBeforeUnload);

        // Inisialisasi awal
        pilihNomorSoal(1);
    </script>
</body>
</html>
