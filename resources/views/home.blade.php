@extends('layouts.app')
@section('title', 'Beranda — Sistem Manajemen Masjid Modern & Offline PWA')

@section('content')
@php
    $masjidName = \App\Models\Setting::get('masjid_name', 'Masjid Al-Ikhlas');
    $masjidAddress = \App\Models\Setting::get('masjid_address', 'Jl. Raya Masjid No. 1');
@endphp

<!-- Hero Section -->
<section class="position-relative overflow-hidden text-white" style="background: radial-gradient(circle at 80% 20%, #0F766E 0%, #0D9488 35%, #064E3B 100%); padding: 4.5rem 0 4rem;">
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <!-- Developer & Platform Badge -->
                <div class="d-inline-flex align-items-center gap-2 mb-3 px-3 py-1 rounded-pill small fw-600 shadow-sm" style="background: rgba(255,255,255,0.15); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.25);">
                    <span class="badge rounded-pill bg-warning text-dark"><i class="bi bi-patch-check-fill me-1"></i> Official</span>
                    <span>Dikembangkan oleh <strong>Jadda Developer</strong> &bull; almasjid.web.id</span>
                </div>

                <h1 class="display-4 fw-800 mb-3" style="letter-spacing: -0.03em; line-height: 1.15;">
                    Sistem Manajemen Masjid Modern, Terbuka & <span class="text-warning">100% Siap Offline</span>
                </h1>

                <p class="lead mb-4 opacity-90" style="max-width: 580px; font-size: 1.15rem; line-height: 1.6;">
                    Solusi terpadu untuk Takmir &amp; Jamaah: Tata kelola buku kas multi-wadah yang akuntabel, mode layar TV digital masjid, portal transparansi infaq jamaah dengan QRIS, dan rekapitulasi kas Jumat siap cetak.
                </p>

                <!-- Primary CTAs -->
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <a href="{{ route('demo.login', 'admin') }}" class="btn btn-warning btn-lg text-dark fw-800 rounded-pill px-4 shadow">
                        <i class="bi bi-play-circle-fill me-1"></i> Coba Demo Admin (1-Klik)
                    </a>
                    <a href="{{ route('display.index') }}" target="_blank" class="btn btn-outline-light btn-lg rounded-pill px-4 fw-600">
                        <i class="bi bi-tv me-1"></i> Layar TV Masjid
                    </a>
                    <a href="{{ route('transparency.index') }}" class="btn btn-outline-light btn-lg rounded-pill px-3 fw-600">
                        <i class="bi bi-shield-check me-1"></i> Transparansi
                    </a>
                </div>

                <!-- Trust Micro-Pills -->
                <div class="d-flex flex-wrap gap-3 pt-2 text-white-50 small">
                    <div><i class="bi bi-wifi-off text-warning me-1"></i> Zero CDN &bull; PWA Offline-First</div>
                    <div><i class="bi bi-cpu text-warning me-1"></i> SQLite Ringan &amp; Mandiri</div>
                    <div><i class="bi bi-check2-circle text-warning me-1"></i> Transaksi Atomik Teruji</div>
                </div>
            </div>

            <!-- Hero Interactive Preview Card -->
            <div class="col-lg-5">
                <div class="card border-0 rounded-4 shadow-lg overflow-hidden" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px); color: #1E293B;">
                    <div class="p-3 bg-light border-bottom d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <span class="rounded-circle bg-danger d-inline-block" style="width:10px;height:10px;"></span>
                            <span class="rounded-circle bg-warning d-inline-block" style="width:10px;height:10px;"></span>
                            <span class="rounded-circle bg-success d-inline-block" style="width:10px;height:10px;"></span>
                            <span class="small text-muted fw-bold ms-2">Live Monitor &bull; {{ $masjidName }}</span>
                        </div>
                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill small">Online / Siap Offline</span>
                    </div>

                    <div class="p-4">
                        <!-- Saldo Box -->
                        <div class="p-3 rounded-3 mb-3" style="background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 100%); border: 1px solid #BBF7D0;">
                            <div class="small text-muted fw-600 text-uppercase mb-1">Total Saldo Kas Terkonsolidasi</div>
                            <div class="h3 fw-800 text-success mb-0">
                                {{ \App\Helpers\FormatHelper::formatRupiah($balance ?? 0) }}
                            </div>
                            <div class="d-flex justify-content-between mt-2 pt-2 border-top border-success-subtle small text-muted">
                                <span><i class="bi bi-arrow-down-circle text-success me-1"></i> Masuk: {{ \App\Helpers\FormatHelper::formatRupiah($totalIncome ?? 0) }}</span>
                                <span><i class="bi bi-arrow-up-circle text-danger me-1"></i> Keluar: {{ \App\Helpers\FormatHelper::formatRupiah($totalExpense ?? 0) }}</span>
                            </div>
                        </div>

                        <!-- Quick Feature Launchers inside Mockup -->
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <a href="{{ route('display.index') }}" target="_blank" class="p-2 rounded-3 border d-block text-decoration-none text-dark bg-white hover-shadow h-100">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-tv-fill text-primary fs-5"></i>
                                        <div>
                                            <div class="fw-bold small">Mode TV Masjid</div>
                                            <div class="text-muted" style="font-size: 0.7rem;">Jadwal salat + Iqomah</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('reports.rekap_jumat') }}" target="_blank" class="p-2 rounded-3 border d-block text-decoration-none text-dark bg-white hover-shadow h-100">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-printer-fill text-warning fs-5"></i>
                                        <div>
                                            <div class="fw-bold small">Rekap Cetak A4</div>
                                            <div class="text-muted" style="font-size: 0.7rem;">Papan mading Jumat</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- 1-Click Demo Sandbox Trigger -->
                        <div class="p-3 rounded-3 bg-light border text-center">
                            <div class="small fw-bold text-dark mb-1"><i class="bi bi-stars text-warning me-1"></i> Mau Uji Coba Panel Pengurus?</div>
                            <div class="text-muted small mb-2">Tanpa isi form pendaftaran, klik langsung masuk:</div>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('demo.login', 'admin') }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold">
                                    <i class="bi bi-wallet2 me-1"></i> Bendahara
                                </a>
                                <a href="{{ route('demo.login', 'superadmin') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                                    <i class="bi bi-shield-lock me-1"></i> Super Admin
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Bar -->
<section class="py-4 bg-white border-bottom shadow-sm">
    <div class="container">
        <div class="row g-3 text-center text-md-start align-items-center">
            <div class="col-md-3 col-6">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: #ECFDF5; color: #059669; font-size: 1.25rem;">
                        <i class="bi bi-wallet-fill"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-600">Saldo Terkini</div>
                        <div class="fw-800 fs-5 text-dark">{{ \App\Helpers\FormatHelper::formatRupiah($balance ?? 0) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: #EFF6FF; color: #2563EB; font-size: 1.25rem;">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-600">Buku Kas Aktif</div>
                        <div class="fw-800 fs-5 text-dark">{{ $cashBooks ?? 1 }} Wadah Kas</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: #FEF3C7; color: #D97706; font-size: 1.25rem;">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-600">Mutasi Kas</div>
                        <div class="fw-800 fs-5 text-dark">{{ $totalTransactions ?? 0 }} Transaksi</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: #F3E8FF; color: #7C3AED; font-size: 1.25rem;">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-600">Standar Sistem</div>
                        <div class="fw-800 fs-5 text-dark">PSR-12 &amp; Offline PWA</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Live Widget: Kalkulator Jadwal Salat Offline Client-Side -->
<section class="py-5" style="background: #F8FAFC;">
    <div class="container">
        <div class="row align-items-center mb-4">
            <div class="col-md-8">
                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 mb-2">
                    <i class="bi bi-lightning-charge-fill me-1"></i> Fitur Nyata &bull; Hisab Astronomis Offline
                </span>
                <h2 class="section-title mb-1">Simulasi Jadwal Salat Digital</h2>
                <p class="section-subtitle">
                    Dihitung seketika menggunakan rumus trigonometri astronomis standar Kemenag RI tanpa bergantung API eksternal. Coba pilih kota Anda:
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="d-inline-flex align-items-center gap-2 bg-white px-3 py-2 rounded-3 border shadow-sm">
                    <i class="bi bi-geo-alt-fill text-danger"></i>
                    <select id="citySelector" class="form-select form-select-sm border-0 fw-bold" style="cursor: pointer;">
                        <option value="-6.2088,106.8456,7" selected>DKI Jakarta</option>
                        <option value="-6.9175,107.6191,7">Bandung</option>
                        <option value="-7.2575,112.7521,7">Surabaya</option>
                        <option value="-7.7956,110.3695,7">Yogyakarta</option>
                        <option value="-6.9667,110.4167,7">Semarang</option>
                        <option value="3.5952,98.6722,7">Medan</option>
                        <option value="-5.1477,119.4327,8">Makassar</option>
                        <option value="-1.2379,116.8529,8">Balikpapan</option>
                        <option value="-8.6705,115.2126,8">Denpasar (Bali)</option>
                        <option value="5.5483,95.3238,7">Banda Aceh</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Prayer Times Grid -->
        <div class="row g-3" id="prayerTimesGrid">
            <div class="col-6 col-md-2">
                <div class="card border-0 rounded-3 shadow-sm text-center p-3 h-100 bg-white prayer-card" id="card-subuh">
                    <div class="small text-muted fw-bold">SUBUH</div>
                    <div class="h3 fw-800 text-dark my-1 prayer-val" id="time-subuh">--:--</div>
                    <span class="badge bg-light text-muted small rounded-pill">Fajar</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 rounded-3 shadow-sm text-center p-3 h-100 bg-white prayer-card" id="card-terbit">
                    <div class="small text-muted fw-bold">TERBIT</div>
                    <div class="h3 fw-800 text-dark my-1 prayer-val" id="time-terbit">--:--</div>
                    <span class="badge bg-light text-muted small rounded-pill">Syuruq</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 rounded-3 shadow-sm text-center p-3 h-100 bg-white prayer-card" id="card-dzuhur">
                    <div class="small text-muted fw-bold">DZUHUR</div>
                    <div class="h3 fw-800 text-dark my-1 prayer-val" id="time-dzuhur">--:--</div>
                    <span class="badge bg-light text-muted small rounded-pill">Tengah Hari</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 rounded-3 shadow-sm text-center p-3 h-100 bg-white prayer-card" id="card-ashar">
                    <div class="small text-muted fw-bold">ASHAR</div>
                    <div class="h3 fw-800 text-dark my-1 prayer-val" id="time-ashar">--:--</div>
                    <span class="badge bg-light text-muted small rounded-pill">Sore</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 rounded-3 shadow-sm text-center p-3 h-100 bg-white prayer-card" id="card-maghrib">
                    <div class="small text-muted fw-bold">MAGHRIB</div>
                    <div class="h3 fw-800 text-dark my-1 prayer-val" id="time-maghrib">--:--</div>
                    <span class="badge bg-light text-muted small rounded-pill">Senja</span>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <div class="card border-0 rounded-3 shadow-sm text-center p-3 h-100 bg-white prayer-card" id="card-isya">
                    <div class="small text-muted fw-bold">ISYA</div>
                    <div class="h3 fw-800 text-dark my-1 prayer-val" id="time-isya">--:--</div>
                    <span class="badge bg-light text-muted small rounded-pill">Malam</span>
                </div>
            </div>
        </div>

        <div class="mt-3 text-center">
            <span class="small text-muted">
                <i class="bi bi-clock-history me-1"></i> Waktu lokal saat ini: <strong id="liveClockDisplay">--:--:--</strong> &bull; Terintegrasi langsung dengan mode <a href="{{ route('display.index') }}" target="_blank" class="fw-bold text-decoration-none">Layar TV Masjid</a>
            </span>
        </div>
    </div>
</section>

<!-- Showcase 6 Fitur Unggulan -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 mb-2">
                Eksplorasi Kemampuan
            </span>
            <h2 class="section-title">Fitur Nyata Siap Pakai</h2>
            <p class="section-subtitle mx-auto">
                Dirancang khusus untuk memecahkan problematika operasional takmir masjid dan meningkatkan kepercayaan jamaah.
            </p>
        </div>

        <div class="row g-4">
            <!-- Fitur 1: Layar TV -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-4 bg-white d-flex flex-column justify-content-between hover-shadow">
                    <div>
                        <div class="rounded-3 d-inline-flex p-3 mb-3" style="background: #EFF6FF; color: #2563EB; font-size: 1.5rem;">
                            <i class="bi bi-tv"></i>
                        </div>
                        <h5 class="fw-800 mb-2">1. Layar TV Digital Masjid</h5>
                        <p class="text-muted small mb-3">
                            Tampilan fullscreen khusus monitor dinding masjid tanpa navbar admin. Jam digital sinkron realtime, jadwal salat offline otomatis, countdown iqomah, serta running text saldo kas &amp; pengumuman.
                        </p>
                    </div>
                    <div class="pt-3 border-top">
                        <a href="{{ route('display.index') }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill w-100 fw-bold">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka Mode TV Fullscreen
                        </a>
                    </div>
                </div>
            </div>

            <!-- Fitur 2: Portal Transparansi -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-4 bg-white d-flex flex-column justify-content-between hover-shadow">
                    <div>
                        <div class="rounded-3 d-inline-flex p-3 mb-3" style="background: #ECFDF5; color: #059669; font-size: 1.5rem;">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5 class="fw-800 mb-2">2. Portal Transparansi Jamaah</h5>
                        <p class="text-muted small mb-3">
                            Akses publik read-only tanpa login. Menampilkan grafik keuangan bulanan yang diproses lokal via Chart.js, ringkasan saldo amanah, dan tampilan QRIS infaq digital resmi masjid.
                        </p>
                    </div>
                    <div class="pt-3 border-top">
                        <a href="{{ route('transparency.index') }}" class="btn btn-outline-success btn-sm rounded-pill w-100 fw-bold">
                            <i class="bi bi-arrow-right me-1"></i> Buka Portal Transparansi
                        </a>
                    </div>
                </div>
            </div>

            <!-- Fitur 3: Rekap Kas Jumat A4 -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-4 bg-white d-flex flex-column justify-content-between hover-shadow">
                    <div>
                        <div class="rounded-3 d-inline-flex p-3 mb-3" style="background: #FEF3C7; color: #D97706; font-size: 1.5rem;">
                            <i class="bi bi-printer"></i>
                        </div>
                        <h5 class="fw-800 mb-2">3. Rekap Cetak Kas Jumat A4</h5>
                        <p class="text-muted small mb-3">
                            Format cetak 1 lembar kertas A4 yang ringkas, bersih, dan rapi. Didesain khusus untuk dicetak bendahara dan langsung ditempel di papan pengumuman/mading sebelum salat Jumat.
                        </p>
                    </div>
                    <div class="pt-3 border-top">
                        <a href="{{ route('reports.rekap_jumat') }}" target="_blank" class="btn btn-outline-warning btn-sm text-dark rounded-pill w-100 fw-bold">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Lihat Format Cetak A4
                        </a>
                    </div>
                </div>
            </div>

            <!-- Fitur 4: WhatsApp Khatib -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-4 bg-white d-flex flex-column justify-content-between hover-shadow">
                    <div>
                        <div class="rounded-3 d-inline-flex p-3 mb-3" style="background: #F0FDF4; color: #16A34A; font-size: 1.5rem;">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <h5 class="fw-800 mb-2">4. Konfirmasi WhatsApp H-2</h5>
                        <p class="text-muted small mb-3">
                            Manajemen jadwal khatib Jumat dan kajian dilengkapi generator tautan WhatsApp otomatis. Takmir cukup klik satu tombol untuk mengirim pesan konfirmasi sopan kepada muballigh.
                        </p>
                    </div>
                    <div class="pt-3 border-top">
                        <a href="{{ route('schedules.khatib') }}" class="btn btn-outline-success btn-sm rounded-pill w-100 fw-bold">
                            <i class="bi bi-calendar-check me-1"></i> Cek Jadwal Khatib
                        </a>
                    </div>
                </div>
            </div>

            <!-- Fitur 5: Transaksi Atomik -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-4 bg-white d-flex flex-column justify-content-between hover-shadow">
                    <div>
                        <div class="rounded-3 d-inline-flex p-3 mb-3" style="background: #F3E8FF; color: #7C3AED; font-size: 1.5rem;">
                            <i class="bi bi-lock-fill"></i>
                        </div>
                        <h5 class="fw-800 mb-2">5. Integritas Transaksi Atomik</h5>
                        <p class="text-muted small mb-3">
                            Setiap mutasi kas dibungkus dalam DB::transaction() dengan verifikasi runtime saldo kas (SUM in - SUM out), memastikan saldo buku kas tidak pernah desinkron atau corrupt.
                        </p>
                    </div>
                    <div class="pt-3 border-top">
                        <a href="{{ route('demo.login', 'admin') }}" class="btn btn-outline-secondary btn-sm rounded-pill w-100 fw-bold">
                            <i class="bi bi-gear-fill me-1"></i> Coba Catat Kas di Demo
                        </a>
                    </div>
                </div>
            </div>

            <!-- Fitur 6: Offline PWA -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-4 bg-white d-flex flex-column justify-content-between hover-shadow">
                    <div>
                        <div class="rounded-3 d-inline-flex p-3 mb-3" style="background: #FFF1F2; color: #E11D48; font-size: 1.5rem;">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h5 class="fw-800 mb-2">6. 100% PWA &amp; Bebas CDN</h5>
                        <p class="text-muted small mb-3">
                            Seluruh stylesheet, script, ikon, dan font telah dibundel secara lokal. Service Worker cerdas memastikan aplikasi tetap dapat dibuka dan berfungsi penuh saat internet masjid padam.
                        </p>
                    </div>
                    <div class="pt-3 border-top">
                        <span class="badge bg-success-subtle text-success w-100 py-2 rounded-pill small">
                            <i class="bi bi-check2-circle me-1"></i> Service Worker Aktif di Browser
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sandbox / Akses Coba Demo Langsung -->
<section class="py-5 bg-white border-top border-bottom">
    <div class="container">
        <div class="card rounded-4 border-0 shadow-sm overflow-hidden" style="background: linear-gradient(135deg, #0F766E 0%, #115E59 100%); color: white;">
            <div class="p-4 p-md-5">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-2">
                            <i class="bi bi-magic me-1"></i> Siap Diuji Sekarang
                        </span>
                        <h3 class="fw-800 mb-2">Ingin Menguji Panel Pengurus Masjid?</h3>
                        <p class="mb-3 opacity-90">
                            Kami menyediakan akses instan tanpa perlu registrasi atau konfigurasi. Cukup klik salah satu akun di bawah untuk langsung masuk dan bereksplorasi dengan data nyata:
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('demo.login', 'admin') }}" class="btn btn-warning text-dark fw-bold rounded-pill px-4 py-2">
                                <i class="bi bi-wallet2 me-1"></i> Masuk sebagai Bendahara Demo
                            </a>
                            <a href="{{ route('demo.login', 'superadmin') }}" class="btn btn-outline-light fw-bold rounded-pill px-4 py-2">
                                <i class="bi bi-shield-lock me-1"></i> Masuk sebagai Super Admin Demo
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="p-3 rounded-3" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">
                            <div class="small fw-bold text-warning mb-2 text-uppercase">Kredensial Login Manual:</div>
                            <div class="small mb-2 font-monospace">
                                &bull; <strong>Bendahara:</strong> bendahara / Password123<br>
                                &bull; <strong>Super Admin:</strong> superadmin / SuperAdmin123!
                            </div>
                            <div class="small opacity-75">
                                Akses mencakup: Tambah mutasi kas, kelola buku kas, tambah jadwal khatib, unduh laporan, hingga pengaturan identitas masjid.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Transaksi Terbaru & Jadwal Mendatang -->
<section class="py-5" style="background: #F8FAFC;">
    <div class="container">
        <div class="row g-4">
            <!-- Kolom Transaksi -->
            <div class="col-lg-7">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="fw-800 mb-0">Mutasi Kas Terbaru</h4>
                        <div class="text-muted small">Transparansi pemasukan &amp; pengeluaran terkini</div>
                    </div>
                    <a href="{{ route('reports.public') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="card-masjid overflow-hidden shadow-sm border-0">
                    <div class="table-responsive">
                        <table class="table-masjid mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    <th>Uraian</th>
                                    <th class="text-end">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTransactions ?? [] as $t)
                                <tr>
                                    <td><span class="fw-600">{{ \App\Helpers\FormatHelper::formatDate($t->transaction_date) }}</span></td>
                                    <td><span class="badge bg-light text-dark">{{ $t->category->name ?? '-' }}</span></td>
                                    <td class="text-muted small">{{ $t->description ?: '-' }}</td>
                                    <td class="text-end fw-700 {{ $t->type === 'income' ? 'text-income' : 'text-expense' }}">
                                        {{ $t->type === 'income' ? '+' : '-' }} {{ \App\Helpers\FormatHelper::formatRupiah($t->amount) }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum ada transaksi tercatat.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kolom Jadwal Terdekat -->
            <div class="col-lg-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="fw-800 mb-0">Agenda Ibadah &amp; Dakwah</h4>
                        <div class="text-muted small">Jadwal khatib &amp; majelis taklim</div>
                    </div>
                    <a href="{{ route('schedules.khatib') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                        Semua Jadwal
                    </a>
                </div>

                <!-- Khatib Card -->
                <div class="card border-0 rounded-4 shadow-sm p-4 bg-white mb-3">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: #ECFDF5; color: #059669; font-size: 1.25rem;">
                            <i class="bi bi-person-video3"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="badge bg-success-subtle text-success small rounded-pill mb-1">Khatib Jumat Mendatang</span>
                            <h6 class="fw-bold mb-1">{{ $upcomingKhatib->khatib_name ?? 'Ustadz Belum Dijadwalkan' }}</h6>
                            <p class="text-muted small mb-1">
                                <i class="bi bi-calendar3 me-1"></i> {{ isset($upcomingKhatib) ? \App\Helpers\FormatHelper::formatDate($upcomingKhatib->date) : 'Jumat mendatang' }}
                            </p>
                            @if(isset($upcomingKhatib) && ($upcomingKhatib->theme || $upcomingKhatib->khutbah_title))
                            <div class="small text-dark fw-semibold">
                                <i class="bi bi-book me-1"></i> Tema: &ldquo;{{ $upcomingKhatib->theme ?? $upcomingKhatib->khutbah_title }}&rdquo;
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Pengajian Card -->
                <div class="card border-0 rounded-4 shadow-sm p-4 bg-white">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: #EFF6FF; color: #2563EB; font-size: 1.25rem;">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="badge bg-primary-subtle text-primary small rounded-pill mb-1">Kajian / Majelis Taklim</span>
                            <h6 class="fw-bold mb-1">{{ $upcomingPengajian->title ?? 'Kajian Rutin Jamaah' }}</h6>
                            <p class="text-muted small mb-1">
                                <i class="bi bi-person me-1"></i> Pemateri: {{ $upcomingPengajian->ustadz_name ?? 'Ustadz Pembina' }}
                            </p>
                            <p class="text-muted small mb-0">
                                <i class="bi bi-clock me-1"></i> {{ isset($upcomingPengajian) ? \App\Helpers\FormatHelper::formatDate($upcomingPengajian->date) : 'Jadwal berkala' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Pengurus Masjid -->
<section class="py-5 bg-white border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-1 mb-2">FAQ Takmir</span>
            <h2 class="section-title">Pertanyaan Sering Diajukan</h2>
            <p class="section-subtitle mx-auto">Informasi praktis seputar implementasi dan operasional sistem.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-light h-100">
                    <h6 class="fw-bold mb-2"><i class="bi bi-question-circle-fill text-primary me-2"></i>Apakah sistem ini membutuhkan server mahal atau internet berkecepatan tinggi?</h6>
                    <p class="text-muted small mb-0">
                        Sama sekali tidak. Aplikasi ini menggunakan basis data SQLite yang sangat efisien dan ringan. Semua aset (Bootstrap, Chart.js, Icons) dibundel secara lokal (Zero CDN), sehingga tetap dapat berjalan lancar di VPS termurah, komputer lokal masjid, bahkan saat internet putus.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-light h-100">
                    <h6 class="fw-bold mb-2"><i class="bi bi-question-circle-fill text-primary me-2"></i>Bagaimana cara menampilkan Mode TV di dinding masjid?</h6>
                    <p class="text-muted small mb-0">
                        Cukup hubungkan Android TV Box, Smart TV, atau PC mini ke monitor TV masjid melalui HDMI. Buka browser dan arahkan ke alamat <code>/display</code> lalu tekan F11 untuk mode fullscreen. Jadwal salat otomatis berbunyi dan menghitung mundur iqomah secara mandiri.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-light h-100">
                    <h6 class="fw-bold mb-2"><i class="bi bi-question-circle-fill text-primary me-2"></i>Apakah masjid bisa memiliki beberapa rekening/buku kas terpisah?</h6>
                    <p class="text-muted small mb-0">
                        Ya! Fitur <strong>Buku Kas Independen</strong> memungkinkan pemisahan Kas Operasional, Kas Pembangunan/Renovasi, Kas Zakat/Infaq, dan Kas Anak Yatim. Masing-masing memiliki saldo dan rekap mutasi tersendiri.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-light h-100">
                    <h6 class="fw-bold mb-2"><i class="bi bi-question-circle-fill text-primary me-2"></i>Siapa yang mengembangkan dan memberikan dukungan teknis?</h6>
                    <p class="text-muted small mb-0">
                        Aplikasi ini dikembangkan oleh <strong>Jadda Developer</strong> (<a href="mailto:jaddadeveloper@gmail.com" class="text-decoration-none">jaddadeveloper@gmail.com</a>) dan dapat diimplementasikan untuk masjid, musholla, atau yayasan Islam di seluruh Indonesia.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section class="py-5" style="background: linear-gradient(135deg, #0D9488 0%, #064E3B 100%); color: white;">
    <div class="container text-center">
        <h2 class="display-6 fw-800 mb-2">Modernisasikan Tata Kelola Masjid Anda Hari Ini</h2>
        <p class="lead opacity-90 mx-auto mb-4" style="max-width: 650px;">
            Hadirkan transparansi nyata untuk jamaah dan kemudahan administrasi bagi para pengurus masjid dengan sistem yang amanah, andal, dan siap pakai.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('demo.login', 'admin') }}" class="btn btn-warning btn-lg text-dark fw-bold rounded-pill px-4 shadow">
                <i class="bi bi-play-circle-fill me-1"></i> Mulai Coba Demo Sekarang
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 fw-600">
                <i class="bi bi-envelope me-1"></i> Hubungi Jadda Developer
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Interactive Client-Side Astronomical Prayer Times Calculator (offline standard)
function computePrayers(lat, lng, tz, date) {
    const d = date || new Date();
    const year = d.getFullYear();
    const month = d.getMonth() + 1;
    const day = d.getDate();

    function julianDay(y, m, d) {
        if (m <= 2) { y -= 1; m += 12; }
        const A = Math.floor(y / 100);
        const B = 2 - A + Math.floor(A / 4);
        return Math.floor(365.25 * (y + 4716)) + Math.floor(30.6001 * (m + 1)) + d + B - 1524.5;
    }

    const jd = julianDay(year, month, day);
    const D = jd - 2451545.0;
    const g = 357.529 + 0.98560028 * D;
    const q = 280.459 + 0.98564736 * D;
    const L = q + 1.915 * Math.sin(g * Math.PI / 180) + 0.020 * Math.sin(2 * g * Math.PI / 180);
    const e = 23.439 - 0.00000036 * D;

    const ra = Math.atan2(Math.cos(e * Math.PI / 180) * Math.sin(L * Math.PI / 180), Math.cos(L * Math.PI / 180)) * 180 / Math.PI;
    const dSun = Math.asin(Math.sin(e * Math.PI / 180) * Math.sin(L * Math.PI / 180)) * 180 / Math.PI;
    const eqt = (q / 15) - (ra / 15);

    const noon = 12 + tz - (lng / 15) - eqt;

    function sunAngleHours(angle, isAfterNoon) {
        const rad = Math.PI / 180;
        const cosH = (Math.sin(angle * rad) - Math.sin(lat * rad) * Math.sin(dSun * rad)) /
                     (Math.cos(lat * rad) * Math.cos(dSun * rad));
        if (cosH > 1 || cosH < -1) return noon;
        const H = Math.acos(cosH) * (180 / Math.PI) / 15;
        return isAfterNoon ? noon + H : noon - H;
    }

    function formatHours(h) {
        let totalMin = Math.round(h * 60);
        let hh = Math.floor(totalMin / 60) % 24;
        let mm = totalMin % 60;
        return String(hh).padStart(2, '0') + ':' + String(mm).padStart(2, '0');
    }

    // Kemenag standard: Subuh -20 deg, Terbit -0.833 deg, Ashar shadow=1, Maghrib -0.833 deg, Isya -18 deg (+ ihtiyat 2 min)
    const subuhHours = sunAngleHours(-20, false) + (2 / 60);
    const terbitHours = sunAngleHours(-0.833, false) - (2 / 60);
    const dzuhurHours = noon + (2 / 60);

    const rad = Math.PI / 180;
    const asharAngle = -Math.atan(1 + Math.tan(Math.abs(lat - dSun) * rad)) * (180 / Math.PI);
    const asharHours = sunAngleHours(asharAngle, true) + (2 / 60);
    const maghribHours = sunAngleHours(-0.833, true) + (2 / 60);
    const isyaHours = sunAngleHours(-18, true) + (2 / 60);

    return {
        subuh: formatHours(subuhHours),
        terbit: formatHours(terbitHours),
        dzuhur: formatHours(dzuhurHours),
        ashar: formatHours(asharHours),
        maghrib: formatHours(maghribHours),
        isya: formatHours(isyaHours)
    };
}

function updatePrayerDisplay() {
    const sel = document.getElementById('citySelector');
    if (!sel) return;
    const parts = sel.value.split(',');
    const lat = parseFloat(parts[0]);
    const lng = parseFloat(parts[1]);
    const tz = parseFloat(parts[2]);

    const times = computePrayers(lat, lng, tz, new Date());
    document.getElementById('time-subuh').innerText = times.subuh;
    document.getElementById('time-terbit').innerText = times.terbit;
    document.getElementById('time-dzuhur').innerText = times.dzuhur;
    document.getElementById('time-ashar').innerText = times.ashar;
    document.getElementById('time-maghrib').innerText = times.maghrib;
    document.getElementById('time-isya').innerText = times.isya;
}

function updateClock() {
    const now = new Date();
    const clockEl = document.getElementById('liveClockDisplay');
    if (clockEl) {
        clockEl.innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    updatePrayerDisplay();
    updateClock();
    setInterval(updateClock, 1000);

    const sel = document.getElementById('citySelector');
    if (sel) {
        sel.addEventListener('change', updatePrayerDisplay);
    }
});
</script>
@endpush
