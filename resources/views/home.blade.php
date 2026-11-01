@extends('layouts.app')
@section('title', 'Al-Masjid — Sistem Operasi Manajemen Masjid Modern & Offline PWA')

@section('content')
@php
    $masjidName = \App\Models\Setting::get('masjid_name', 'Al-Masjid');
    $masjidAddress = \App\Models\Setting::get('masjid_address', 'Jl. Raya Masjid No. 1');
@endphp

<!-- Custom Premium Styles for Al-Masjid -->
<style>
    /* ── Hero & Luxury Palette ── */
    .hero-almasjid {
        background: radial-gradient(circle at 50% -10%, #064E3B 0%, #022C22 45%, #021411 100%);
        color: #F8FAFC;
        position: relative;
        overflow: hidden;
        padding: 5rem 0 4rem;
    }
    .hero-glow-1 {
        position: absolute;
        top: -150px;
        left: 50%;
        transform: translateX(-50%);
        width: 800px;
        height: 450px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.25) 0%, transparent 70%);
        pointer-events: none;
        filter: blur(40px);
    }
    .hero-glow-2 {
        position: absolute;
        bottom: 50px;
        right: -100px;
        width: 500px;
        height: 350px;
        background: radial-gradient(circle, rgba(217, 119, 6, 0.12) 0%, transparent 70%);
        pointer-events: none;
        filter: blur(50px);
    }
    .hero-grid-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.07) 1px, transparent 1px);
        background-size: 28px 28px;
        pointer-events: none;
        mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 40%, rgba(0,0,0,0) 100%);
        -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 40%, rgba(0,0,0,0) 100%);
    }

    .hero-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(16, 185, 129, 0.12);
        border: 1px solid rgba(16, 185, 129, 0.35);
        color: #6EE7B7;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 0.4rem 1rem;
        border-radius: 999px;
        backdrop-filter: blur(8px);
        margin-bottom: 1.5rem;
    }
    .hero-badge-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #10B981;
        box-shadow: 0 0 10px #10B981;
        animation: pulseDot 2s infinite;
    }
    @keyframes pulseDot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(0.85); }
    }

    .hero-headline {
        font-size: 3.5rem;
        font-weight: 900;
        letter-spacing: -0.04em;
        line-height: 1.1;
        margin-bottom: 1.25rem;
    }
    @media (max-width: 991.98px) {
        .hero-headline { font-size: 2.5rem; }
    }
    .hero-gradient-text {
        background: linear-gradient(135deg, #34D399 0%, #A7F3D0 50%, #FBBF24 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }
    .hero-description {
        font-size: 1.15rem;
        line-height: 1.65;
        color: rgba(241, 245, 249, 0.85);
        max-width: 600px;
        margin-bottom: 2rem;
    }

    /* ── Action Buttons ── */
    .btn-hero-primary {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
        padding: 0.875rem 1.75rem;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4), 0 8px 10px -6px rgba(16, 185, 129, 0.2);
        transition: all 0.25s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-hero-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px -5px rgba(16, 185, 129, 0.5);
        color: #fff;
    }
    .btn-hero-glass {
        background: rgba(255, 255, 255, 0.08);
        color: #F8FAFC;
        font-weight: 600;
        font-size: 1rem;
        padding: 0.875rem 1.5rem;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(8px);
        transition: all 0.25s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-hero-glass:hover {
        background: rgba(255, 255, 255, 0.16);
        color: #fff;
        transform: translateY(-2px);
    }

    /* ── Device Showcase Mockup ── */
    .device-mockup {
        background: #0B1916;
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 20px;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.6), 0 0 40px rgba(16, 185, 129, 0.1);
        overflow: hidden;
        color: #E2E8F0;
        transition: all 0.3s ease;
    }
    .device-header {
        background: rgba(255, 255, 255, 0.04);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding: 0.875rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .window-dots {
        display: flex;
        gap: 6px;
    }
    .window-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }
    .mockup-tab-btn {
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.78rem;
        font-weight: 600;
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .mockup-tab-btn:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.08);
    }
    .mockup-tab-btn.active {
        background: rgba(16, 185, 129, 0.25);
        color: #34D399;
        border: 1px solid rgba(16, 185, 129, 0.4);
    }

    /* ── Floating Ribbon ── */
    .ribbon-prayer {
        background: #FFFFFF;
        border-radius: 16px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.06);
        margin-top: -2.5rem;
        position: relative;
        z-index: 10;
        padding: 1.25rem 1.5rem;
    }

    /* ── Bento Grid ── */
    .bento-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        padding: 2rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        position: relative;
        overflow: hidden;
    }
    .bento-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.08);
        border-color: #CBD5E1;
    }
    .bento-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1.25rem;
    }

    /* ── Sandbox Card ── */
    .sandbox-card {
        background: linear-gradient(135deg, #064E3B 0%, #065F46 50%, #047857 100%);
        border-radius: 24px;
        padding: 3rem 2.5rem;
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.15);
        box-shadow: 0 20px 40px -10px rgba(6, 78, 59, 0.4);
    }
</style>

<!-- HERO SECTION -->
<section class="hero-almasjid">
    <div class="hero-glow-1"></div>
    <div class="hero-glow-2"></div>
    <div class="hero-grid-pattern"></div>

    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <!-- Platform Badge -->
                <div class="hero-badge-pill shadow-sm">
                    <span class="hero-badge-dot"></span>
                    <span>Sistem Operasi Masjid 4.0 &bull; almasjid.web.id</span>
                </div>

                <!-- Main Title -->
                <h1 class="hero-headline">
                    Transformasi Digital &amp;<br>
                    <span class="hero-gradient-text">Tata Kelola Masjid Modern.</span>
                </h1>

                <!-- Subtitle -->
                <p class="hero-description">
                    Solusi terpadu untuk Takmir &amp; Jamaah: Pembukuan kas multi-wadah atomik, mode layar TV digital jadwal salat otomatis, transparansi infaq jamaah QRIS, dan rekapitulasi kas Jumat siap cetak — dirancang mandiri &amp; 100% siap offline.
                </p>

                <!-- Primary CTAs -->
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="{{ route('demo.login', 'admin') }}" class="btn-hero-primary">
                        <i class="bi bi-play-circle-fill fs-5"></i> Coba Demo Admin (1-Klik)
                    </a>
                    <a href="{{ route('display.index') }}" target="_blank" class="btn-hero-glass">
                        <i class="bi bi-tv fs-5"></i> Layar TV Masjid
                    </a>
                    <a href="{{ route('transparency.index') }}" class="btn-hero-glass">
                        <i class="bi bi-shield-check fs-5"></i> Portal Transparansi
                    </a>
                </div>

                <!-- Proof Badges -->
                <div class="d-flex flex-wrap gap-3 pt-2 text-white-50 small">
                    <div><i class="bi bi-lightning-charge-fill text-warning me-1"></i> 100% Offline PWA</div>
                    <div><i class="bi bi-cpu-fill text-warning me-1"></i> SQLite Mutex Atomik</div>
                    <div><i class="bi bi-compass-fill text-warning me-1"></i> Hisab Astronomis Kemenag</div>
                    <div><i class="bi bi-printer-fill text-warning me-1"></i> Rekap Jumat Siap Cetak A4</div>
                </div>
            </div>

            <!-- INTERACTIVE OPERATING SYSTEM MOCKUP -->
            <div class="col-lg-5">
                <div class="device-mockup">
                    <!-- Window Bar & Interactive Switchers -->
                    <div class="device-header">
                        <div class="window-dots">
                            <span class="window-dot" style="background: #FF5F56;"></span>
                            <span class="window-dot" style="background: #FFBD2E;"></span>
                            <span class="window-dot" style="background: #27C93F;"></span>
                        </div>
                        <div class="d-flex gap-1">
                            <button type="button" class="mockup-tab-btn active" onclick="switchMockupTab('tv')">
                                <i class="bi bi-tv me-1"></i> Layar TV
                            </button>
                            <button type="button" class="mockup-tab-btn" onclick="switchMockupTab('kas')">
                                <i class="bi bi-wallet2 me-1"></i> Transparansi
                            </button>
                            <button type="button" class="mockup-tab-btn" onclick="switchMockupTab('rekap')">
                                <i class="bi bi-printer me-1"></i> Rekap A4
                            </button>
                        </div>
                    </div>

                    <!-- SCREEN 1: LAYAR TV DIGITAL -->
                    <div id="screen-tv" class="p-4" style="background: #021713;">
                        <div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom border-secondary border-opacity-25">
                            <div>
                                <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle small">
                                    <i class="bi bi-broadcast me-1"></i> Mode Display TV Fullscreen
                                </span>
                            </div>
                            <div class="text-end font-monospace text-warning fw-bold fs-5" id="mockupClock">
                                --:--:--
                            </div>
                        </div>

                        <!-- 6 Mini Prayer Tiles -->
                        <div class="row g-2 text-center mb-3">
                            <div class="col-4">
                                <div class="p-2 rounded-2 bg-dark bg-opacity-50 border border-secondary border-opacity-25">
                                    <div class="text-muted" style="font-size: 0.65rem;">SUBUH</div>
                                    <div class="fw-bold text-white small" id="mock-subuh">04:32</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 rounded-2 bg-dark bg-opacity-50 border border-secondary border-opacity-25">
                                    <div class="text-muted" style="font-size: 0.65rem;">DZUHUR</div>
                                    <div class="fw-bold text-white small" id="mock-dzuhur">11:45</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 rounded-2 bg-warning bg-opacity-25 border border-warning">
                                    <div class="text-warning fw-bold" style="font-size: 0.65rem;">ASHAR &bull; AKTIF</div>
                                    <div class="fw-bold text-warning small" id="mock-ashar">15:02</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 rounded-2 bg-dark bg-opacity-50 border border-secondary border-opacity-25">
                                    <div class="text-muted" style="font-size: 0.65rem;">MAGHRIB</div>
                                    <div class="fw-bold text-white small" id="mock-maghrib">17:53</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 rounded-2 bg-dark bg-opacity-50 border border-secondary border-opacity-25">
                                    <div class="text-muted" style="font-size: 0.65rem;">ISYA</div>
                                    <div class="fw-bold text-white small" id="mock-isya">19:04</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 rounded-2 bg-dark bg-opacity-50 border border-secondary border-opacity-25">
                                    <div class="text-muted" style="font-size: 0.65rem;">TERBIT</div>
                                    <div class="fw-bold text-white small" id="mock-terbit">05:48</div>
                                </div>
                            </div>
                        </div>

                        <!-- Countdown Banner -->
                        <div class="p-2 rounded-3 text-center mb-3" style="background: rgba(217, 119, 6, 0.15); border: 1px dashed rgba(217, 119, 6, 0.4);">
                            <span class="text-warning small fw-bold">
                                <i class="bi bi-hourglass-split me-1"></i> Menuju Maghrib: <strong>01:42:10</strong>
                            </span>
                        </div>

                        <!-- Running Marquee Simulation -->
                        <div class="p-2 rounded-2 bg-black bg-opacity-40 text-muted small overflow-hidden text-truncate mb-3" style="font-size: 0.72rem;">
                            <i class="bi bi-megaphone-fill text-warning me-1"></i> Saldo Kas Terkonsolidasi: {{ \App\Helpers\FormatHelper::formatRupiah($balance ?? 0) }} &bull; Kajian Rutin Sabtu Ba'da Maghrib.
                        </div>

                        <a href="{{ route('display.index') }}" target="_blank" class="btn btn-outline-success btn-sm w-100 rounded-pill fw-bold">
                            <i class="bi bi-arrows-fullscreen me-1"></i> Buka Layar TV Monitor (Fullscreen)
                        </a>
                    </div>

                    <!-- SCREEN 2: TRANSPARANSI KAS -->
                    <div id="screen-kas" class="p-4 d-none" style="background: #021713;">
                        <div class="p-3 rounded-3 mb-3" style="background: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.25);">
                            <div class="text-muted small fw-600">SALDO KAS TERKONSOLIDASI</div>
                            <div class="h3 fw-800 text-success mb-1">
                                {{ \App\Helpers\FormatHelper::formatRupiah($balance ?? 0) }}
                            </div>
                            <div class="d-flex justify-content-between small text-white-50 border-top border-secondary border-opacity-25 pt-2 mt-2">
                                <span><i class="bi bi-arrow-down-circle text-success me-1"></i> {{ \App\Helpers\FormatHelper::formatRupiah($totalIncome ?? 0) }}</span>
                                <span><i class="bi bi-arrow-up-circle text-danger me-1"></i> {{ \App\Helpers\FormatHelper::formatRupiah($totalExpense ?? 0) }}</span>
                            </div>
                        </div>

                        <div class="p-3 rounded-3 bg-black bg-opacity-40 border border-secondary border-opacity-25 mb-3">
                            <div class="small fw-bold text-white mb-2"><i class="bi bi-layers-fill text-warning me-1"></i> Wadah Kas Mandiri:</div>
                            <div class="d-flex justify-content-between small text-muted py-1 border-bottom border-secondary border-opacity-10">
                                <span>Kas Umum Masjid</span>
                                <span class="text-white fw-bold">Aktif</span>
                            </div>
                            <div class="d-flex justify-content-between small text-muted py-1">
                                <span>Kas Pembangunan &amp; Renovasi</span>
                                <span class="text-white fw-bold">Aktif</span>
                            </div>
                        </div>

                        <a href="{{ route('transparency.index') }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill fw-bold">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Jelajahi Portal Transparansi Publik
                        </a>
                    </div>

                    <!-- SCREEN 3: REKAP JUMAT A4 -->
                    <div id="screen-rekap" class="p-4 d-none" style="background: #021713;">
                        <div class="p-3 rounded-3 bg-white text-dark mb-3 shadow-sm" style="font-size: 0.75rem;">
                            <div class="text-center fw-bold border-bottom pb-2 mb-2">
                                LAPORAN REKAPITULASI KAS JUMAT<br>
                                <span class="text-muted fw-normal" style="font-size: 0.68rem;">Format Standar Siap Tempel di Papan Mading Masjid</span>
                            </div>
                            <div class="d-flex justify-content-between text-muted mb-1">
                                <span>Saldo Awal Pekan</span>
                                <span class="fw-bold text-dark">{{ \App\Helpers\FormatHelper::formatRupiah(($balance ?? 0) * 0.9) }}</span>
                            </div>
                            <div class="d-flex justify-content-between text-muted mb-1">
                                <span>Total Pemasukan Kotak Infaq</span>
                                <span class="fw-bold text-success">+ {{ \App\Helpers\FormatHelper::formatRupiah($totalIncome ?? 0) }}</span>
                            </div>
                            <div class="d-flex justify-content-between text-muted mb-2">
                                <span>Pengeluaran Operasional</span>
                                <span class="fw-bold text-danger">- {{ \App\Helpers\FormatHelper::formatRupiah($totalExpense ?? 0) }}</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold pt-1 border-top">
                                <span>Saldo Akhir Siap Umumkan</span>
                                <span class="text-success">{{ \App\Helpers\FormatHelper::formatRupiah($balance ?? 0) }}</span>
                            </div>
                        </div>

                        <a href="{{ route('reports.rekap_jumat') }}" target="_blank" class="btn btn-outline-warning text-white btn-sm w-100 rounded-pill fw-bold">
                            <i class="bi bi-printer me-1"></i> Buka Dokumen Siap Cetak A4
                        </a>
                    </div>

                    <!-- Demo Sandbox Trigger Inside Frame -->
                    <div class="p-3 border-top border-secondary border-opacity-25 bg-black bg-opacity-25 d-flex align-items-center justify-content-between">
                        <span class="small text-muted"><i class="bi bi-stars text-warning me-1"></i> Coba Akun Pengurus:</span>
                        <div class="d-flex gap-2">
                            <a href="{{ route('demo.login', 'admin') }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold" style="font-size: 0.72rem;">
                                Bendahara
                            </a>
                            <a href="{{ route('demo.login', 'superadmin') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" style="font-size: 0.72rem;">
                                Super Admin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FLOATING PRAYER TIMES RIBBON (OFFLINE CLIENT-SIDE CALCULATION) -->
<div class="container">
    <div class="ribbon-prayer">
        <div class="row align-items-center g-3">
            <div class="col-lg-3 col-md-12">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success" style="width: 38px; height: 38px;">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="text-muted" style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase;">Jadwal Salat Astronomis</div>
                        <select id="citySelector" class="form-select form-select-sm border-0 fw-bold text-dark p-0 bg-transparent" style="cursor: pointer; box-shadow: none;">
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

            <!-- 6 Tiles in Ribbon -->
            <div class="col-lg-9 col-md-12">
                <div class="row g-2 text-center">
                    <div class="col-4 col-md-2">
                        <div class="p-2 rounded-3 bg-light border">
                            <div class="text-muted" style="font-size: 0.68rem; font-weight: 700;">SUBUH</div>
                            <div class="fw-800 text-dark" id="time-subuh">--:--</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="p-2 rounded-3 bg-light border">
                            <div class="text-muted" style="font-size: 0.68rem; font-weight: 700;">TERBIT</div>
                            <div class="fw-800 text-dark" id="time-terbit">--:--</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="p-2 rounded-3 bg-light border">
                            <div class="text-muted" style="font-size: 0.68rem; font-weight: 700;">DZUHUR</div>
                            <div class="fw-800 text-dark" id="time-dzuhur">--:--</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="p-2 rounded-3 bg-light border">
                            <div class="text-muted" style="font-size: 0.68rem; font-weight: 700;">ASHAR</div>
                            <div class="fw-800 text-dark" id="time-ashar">--:--</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="p-2 rounded-3 bg-light border">
                            <div class="text-muted" style="font-size: 0.68rem; font-weight: 700;">MAGHRIB</div>
                            <div class="fw-800 text-dark" id="time-maghrib">--:--</div>
                        </div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="p-2 rounded-3 bg-light border">
                            <div class="text-muted" style="font-size: 0.68rem; font-weight: 700;">ISYA</div>
                            <div class="fw-800 text-dark" id="time-isya">--:--</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BENTO GRID SECTION: KEMAMPUAN UTAMA -->
<section class="py-5 mt-4">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-2 fw-bold text-uppercase" style="letter-spacing: 0.05em;">
                Kemampuan Sistem
            </span>
            <h2 class="display-6 fw-800 text-dark" style="letter-spacing: -0.03em;">Bukan Sekadar Catatan Kas, Ini Sistem Operasi Masjid</h2>
            <p class="text-muted mx-auto" style="max-width: 620px;">
                Semua instrumen digital yang dibutuhkan pengurus masjid dirancang menyatu, ringan, dan siap pakai tanpa memerlukan infrastruktur mahal.
            </p>
        </div>

        <div class="row g-4">
            <!-- Bento 1: Mode Layar TV (Col 8) -->
            <div class="col-lg-8">
                <div class="bento-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon" style="background: #EFF6FF; color: #2563EB;">
                                <i class="bi bi-tv-fill"></i>
                            </div>
                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 fw-bold">Live Standalone</span>
                        </div>
                        <h4 class="fw-800 text-dark mb-2">1. Mode Layar TV Digital Dinding Masjid</h4>
                        <p class="text-muted mb-4" style="line-height: 1.6;">
                            Tampilan fullscreen khusus yang dihubungkan ke Android TV Box, Smart TV, atau PC mini tanpa perlu membuka panel admin. Dilengkapi jam digital realtime sinkron, 5 waktu salat otomatis berbasis hisab astronomis Kemenag tanpa butuh API luar, hitung mundur iqomah, serta running text saldo kas &amp; pengumuman kajian.
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-2 pt-3 border-top">
                        <a href="{{ route('display.index') }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-4 fw-bold">
                            <i class="bi bi-arrows-fullscreen me-1"></i> Uji Coba Mode TV Fullscreen
                        </a>
                        <span class="text-muted small align-self-center"><i class="bi bi-check2-circle text-success me-1"></i> Bekerja 100% saat internet padam</span>
                    </div>
                </div>
            </div>

            <!-- Bento 2: Rekap Cetak Kas Jumat A4 (Col 4) -->
            <div class="col-lg-4">
                <div class="bento-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon" style="background: #FEF3C7; color: #D97706;">
                                <i class="bi bi-printer-fill"></i>
                            </div>
                            <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-1 fw-bold">Print-Ready</span>
                        </div>
                        <h5 class="fw-800 text-dark mb-2">2. Rekap Kas Jumat Format A4</h5>
                        <p class="text-muted small mb-3" style="line-height: 1.6;">
                            Satu lembar kertas A4 siap cetak yang rapi, memuat ringkasan saldo awal pekan, seluruh mutasi pemasukan infaq, pengeluaran operasional, dan kolom tanda tangan takmir sebelum salat Jumat.
                        </p>
                    </div>
                    <div class="pt-3 border-top">
                        <a href="{{ route('reports.rekap_jumat') }}" target="_blank" class="btn btn-outline-warning text-dark btn-sm rounded-pill w-100 fw-bold">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Lihat Format Siap Cetak
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bento 3: Portal Transparansi QRIS (Col 4) -->
            <div class="col-lg-4">
                <div class="bento-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon" style="background: #ECFDF5; color: #059669;">
                                <i class="bi bi-qr-code-scan"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fw-bold">Publik &amp; QRIS</span>
                        </div>
                        <h5 class="fw-800 text-dark mb-2">3. Portal Transparansi Jamaah</h5>
                        <p class="text-muted small mb-3" style="line-height: 1.6;">
                            Halaman publik read-only tanpa login. Menampilkan grafik keuangan bulanan menggunakan Chart.js yang dibundel secara lokal, ringkasan saldo amanah, dan barcode QRIS resmi infaq masjid.
                        </p>
                    </div>
                    <div class="pt-3 border-top">
                        <a href="{{ route('transparency.index') }}" class="btn btn-outline-success btn-sm rounded-pill w-100 fw-bold">
                            <i class="bi bi-shield-check me-1"></i> Buka Portal Transparansi
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bento 4: Transaksi Mutasi Kas Atomik (Col 8) -->
            <div class="col-lg-8">
                <div class="bento-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon" style="background: #F3E8FF; color: #7C3AED;">
                                <i class="bi bi-shield-lock-fill"></i>
                            </div>
                            <span class="badge bg-purple-subtle text-dark border rounded-pill px-3 py-1 fw-bold">Integritas Data</span>
                        </div>
                        <h4 class="fw-800 text-dark mb-2">4. Mutasi Kas Atomik &amp; Buku Kas Multi-Wadah</h4>
                        <p class="text-muted mb-4" style="line-height: 1.6;">
                            Setiap mutasi kas dibungkus dalam transaksi basis data atomik (`DB::transaction()`) dengan verifikasi runtime saldo kas (`SUM(pemasukan) - SUM(pengeluaran)`). Mendukung pemisahan Buku Kas independen: Kas Umum Operasional, Kas Pembangunan/Renovasi, Kas Zakat/Infaq, dan Kas Santunan Anak Yatim.
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-2 pt-3 border-top">
                        <a href="{{ route('demo.login', 'admin') }}" class="btn btn-outline-dark btn-sm rounded-pill px-4 fw-bold">
                            <i class="bi bi-play-fill me-1"></i> Coba Input Kas di Demo
                        </a>
                        <span class="text-muted small align-self-center"><i class="bi bi-check2-circle text-success me-1"></i> Saldo dijamin tidak pernah desinkron</span>
                    </div>
                </div>
            </div>

            <!-- Bento 5: WhatsApp H-2 Generator (Col 6) -->
            <div class="col-lg-6">
                <div class="bento-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon" style="background: #F0FDF4; color: #16A34A;">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fw-bold">Komunikasi</span>
                        </div>
                        <h5 class="fw-800 text-dark mb-2">5. Generator Pesan WhatsApp H-2 Muballigh</h5>
                        <p class="text-muted small mb-3" style="line-height: 1.6;">
                            Jadwal khatib dan pemateri majelis taklim terintegrasi dengan generator tautan WhatsApp otomatis. Pengurus masjid cukup menekan satu tombol untuk mengirim pesan konfirmasi sopan dan terformat langsung ke ustadz terkait.
                        </p>
                    </div>
                    <div class="pt-3 border-top">
                        <a href="{{ route('schedules.khatib') }}" class="btn btn-outline-success btn-sm rounded-pill w-100 fw-bold">
                            <i class="bi bi-calendar-check me-1"></i> Cek Jadwal Khatib &amp; Pengajian
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bento 6: 100% PWA & Bebas CDN (Col 6) -->
            <div class="col-lg-6">
                <div class="bento-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon" style="background: #FFF1F2; color: #E11D48;">
                                <i class="bi bi-wifi-off"></i>
                            </div>
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-1 fw-bold">Zero CDN</span>
                        </div>
                        <h5 class="fw-800 text-dark mb-2">6. Arsitektur 100% Offline-First (PWA)</h5>
                        <p class="text-muted small mb-3" style="line-height: 1.6;">
                            Seluruh stylesheet Bootstrap 5.3, icon font, Inter font, dan Chart.js dibundel lokal via Vite tanpa bergantung CDN luar. Didukung Service Worker cerdas yang memastikan web app dapat dibuka dan berfungsi saat koneksi wifi masjid padam.
                        </p>
                    </div>
                    <div class="pt-3 border-top">
                        <span class="badge bg-success-subtle text-success w-100 py-2 rounded-pill small fw-bold">
                            <i class="bi bi-patch-check-fill me-1"></i> Standalone Web App Ready (Android &amp; iOS)
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SANDBOX INSTANT TRIAL (1-CLICK TEST) -->
<section class="py-5" style="background: #F8FAFC;">
    <div class="container">
        <div class="sandbox-card">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-3">
                        <i class="bi bi-lightning-fill me-1"></i> Uji Coba Instan Tanpa Registrasi
                    </span>
                    <h3 class="fw-900 mb-2" style="letter-spacing: -0.02em;">Ingin Menguji Seluruh Kemampuan Panel Pengurus?</h3>
                    <p class="opacity-90 mb-4" style="line-height: 1.6;">
                        Silakan klik salah satu peran di bawah ini untuk langsung masuk ke dashboard administrasi aktif dengan data riil:
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('demo.login', 'admin') }}" class="btn btn-warning btn-lg text-dark fw-800 rounded-pill px-4 shadow">
                            <i class="bi bi-wallet2 me-1"></i> Masuk Sebagai Bendahara Demo
                        </a>
                        <a href="{{ route('demo.login', 'superadmin') }}" class="btn btn-outline-light btn-lg fw-700 rounded-pill px-4">
                            <i class="bi bi-shield-lock me-1"></i> Masuk Sebagai Super Admin Demo
                        </a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="p-4 rounded-4" style="background: rgba(0, 0, 0, 0.25); border: 1px solid rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px);">
                        <div class="text-warning small fw-bold text-uppercase mb-2"><i class="bi bi-key-fill me-1"></i> Kredensial Login Manual:</div>
                        <div class="font-monospace small mb-3 text-white">
                            &bull; <strong>Bendahara:</strong> bendahara / Password123<br>
                            &bull; <strong>Super Admin:</strong> superadmin / SuperAdmin123!
                        </div>
                        <div class="small opacity-75" style="line-height: 1.5;">
                            Anda dapat mencoba menambah transaksi kas baru, membuat buku kas terpisah, mengunduh laporan, atau menyunting jadwal khatib secara bebas.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MUTASI TERKINI & AGENDA DAKWAH -->
<section class="py-5 bg-white border-top">
    <div class="container">
        <div class="row g-5">
            <!-- Kolom Mutasi Kas -->
            <div class="col-lg-7">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="fw-800 text-dark mb-0">Mutasi Kas Terbaru</h4>
                        <div class="text-muted small">Aktivitas keuangan yang telah diverifikasi</div>
                    </div>
                    <a href="{{ route('reports.public') }}" class="btn btn-sm btn-outline-primary rounded-pill fw-bold">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="card border-0 rounded-4 shadow-sm overflow-hidden border">
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
                                    <td><span class="fw-600 text-dark">{{ \App\Helpers\FormatHelper::formatDate($t->transaction_date) }}</span></td>
                                    <td><span class="badge bg-light text-dark border">{{ $t->category->name ?? '-' }}</span></td>
                                    <td class="text-muted small">{{ $t->description ?: '-' }}</td>
                                    <td class="text-end fw-800 {{ $t->type === 'income' ? 'text-income' : 'text-expense' }}">
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

            <!-- Kolom Agenda Ibadah -->
            <div class="col-lg-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="fw-800 text-dark mb-0">Agenda Ibadah &amp; Dakwah</h4>
                        <div class="text-muted small">Jadwal muballigh &amp; kajian berkala</div>
                    </div>
                    <a href="{{ route('schedules.khatib') }}" class="btn btn-sm btn-outline-primary rounded-pill fw-bold">
                        Semua Jadwal
                    </a>
                </div>

                <!-- Khatib Card -->
                <div class="card border-0 rounded-4 shadow-sm p-4 bg-white mb-3 border">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success" style="width: 48px; height: 48px; font-size: 1.5rem;">
                            <i class="bi bi-person-video3"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="badge bg-success-subtle text-success small rounded-pill mb-1 fw-bold">Khatib Jumat Mendatang</span>
                            <h6 class="fw-bold text-dark mb-1">{{ $upcomingKhatib->khatib_name ?? 'Ustadz Terjadwal' }}</h6>
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
                <div class="card border-0 rounded-4 shadow-sm p-4 bg-white border">
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary" style="width: 48px; height: 48px; font-size: 1.5rem;">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="badge bg-primary-subtle text-primary small rounded-pill mb-1 fw-bold">Kajian / Majelis Taklim</span>
                            <h6 class="fw-bold text-dark mb-1">{{ $upcomingPengajian->title ?? 'Kajian Rutin Jamaah' }}</h6>
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

<!-- FAQ TEKNIS & OPERASIONAL -->
<section class="py-5 bg-light border-top">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge rounded-pill bg-secondary-subtle text-secondary px-3 py-1 mb-2 fw-bold text-uppercase" style="letter-spacing: 0.05em;">
                FAQ Takmir
            </span>
            <h2 class="display-6 fw-800 text-dark">Pertanyaan Sering Diajukan</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">Penjelasan praktis seputar implementasi dan operasional sistem di masjid Anda.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-question-circle-fill text-success me-2"></i>Apakah aplikasi ini membutuhkan server mahal atau internet cepat?</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">
                        Tidak sama sekali. Sistem ini menggunakan arsitektur SQLite yang sangat efisien dan seluruh aset dibundel secara lokal (Zero CDN). Aplikasi dapat berjalan lancar di VPS murah, komputer sekretariat masjid, atau Raspberry Pi tanpa ketergantungan kuota internet.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-question-circle-fill text-success me-2"></i>Bagaimana cara memasang mode TV di dinding masjid?</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">
                        Cukup hubungkan Android TV Box, Smart TV, atau PC mini ke layar TV masjid via HDMI. Buka browser dan arahkan ke alamat <code>/display</code> lalu aktifkan fullscreen (F11). Jadwal salat akan berbunyi dan menghitung mundur iqomah secara otomatis.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-question-circle-fill text-success me-2"></i>Apakah bisa memisahkan Kas Pembangunan dan Kas Anak Yatim?</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">
                        Ya, fitur <strong>Buku Kas Independen</strong> memungkinkan masjid mengelola banyak wadah kas terpisah. Masing-masing memiliki saldo dan mutasi tersendiri tanpa bercampur, namun tetap dapat dilihat laporan konsolidasinya.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-question-circle-fill text-success me-2"></i>Siapa yang mengembangkan dan memberikan bantuan teknis?</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">
                        Aplikasi ini dikembangkan oleh <strong>Jadda Developer</strong> (<a href="mailto:jaddadeveloper@gmail.com" class="text-decoration-none fw-bold text-success">jaddadeveloper@gmail.com</a>) dan dapat diimplementasikan untuk masjid atau yayasan di seluruh Indonesia.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CALL TO ACTION BANNER -->
<section class="py-5 position-relative overflow-hidden" style="background: radial-gradient(circle at 50% 50%, #064E3B 0%, #022C22 100%); color: white;">
    <div class="container text-center position-relative">
        <h2 class="display-6 fw-900 mb-3" style="letter-spacing: -0.03em;">Mulai Modernisasi Masjid Anda Hari Ini</h2>
        <p class="lead opacity-90 mx-auto mb-4" style="max-width: 650px; font-size: 1.15rem;">
            Wujudkan transparansi keuangan yang amanah dan tata kelola masjid yang profesional dengan sistem yang siap pakai, handal, dan mandiri.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('demo.login', 'admin') }}" class="btn-hero-primary">
                <i class="bi bi-play-circle-fill fs-5"></i> Coba Demo Admin Sekarang
            </a>
            <a href="{{ route('contact') }}" class="btn-hero-glass">
                <i class="bi bi-envelope fs-5"></i> Hubungi Jadda Developer
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Mockup Tab Switcher
function switchMockupTab(tab) {
    document.getElementById('screen-tv').classList.add('d-none');
    document.getElementById('screen-kas').classList.add('d-none');
    document.getElementById('screen-rekap').classList.add('d-none');

    document.querySelectorAll('.mockup-tab-btn').forEach(btn => btn.classList.remove('active'));

    if (tab === 'tv') {
        document.getElementById('screen-tv').classList.remove('d-none');
        event.currentTarget.classList.add('active');
    } else if (tab === 'kas') {
        document.getElementById('screen-kas').classList.remove('d-none');
        event.currentTarget.classList.add('active');
    } else if (tab === 'rekap') {
        document.getElementById('screen-rekap').classList.remove('d-none');
        event.currentTarget.classList.add('active');
    }
}

// Client-Side Astronomical Prayer Times Calculator (offline standard Kemenag RI)
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
    
    // Update Ribbon Display
    document.getElementById('time-subuh').innerText = times.subuh;
    document.getElementById('time-terbit').innerText = times.terbit;
    document.getElementById('time-dzuhur').innerText = times.dzuhur;
    document.getElementById('time-ashar').innerText = times.ashar;
    document.getElementById('time-maghrib').innerText = times.maghrib;
    document.getElementById('time-isya').innerText = times.isya;

    // Update Mockup Display
    const mSub = document.getElementById('mock-subuh');
    if (mSub) {
        document.getElementById('mock-subuh').innerText = times.subuh;
        document.getElementById('mock-dzuhur').innerText = times.dzuhur;
        document.getElementById('mock-ashar').innerText = times.ashar;
        document.getElementById('mock-maghrib').innerText = times.maghrib;
        document.getElementById('mock-isya').innerText = times.isya;
        document.getElementById('mock-terbit').innerText = times.terbit;
    }
}

function updateLiveClock() {
    const now = new Date();
    const clockStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    const mockEl = document.getElementById('mockupClock');
    if (mockEl) {
        mockEl.innerText = clockStr;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    updatePrayerDisplay();
    updateLiveClock();
    setInterval(updateLiveClock, 1000);

    const sel = document.getElementById('citySelector');
    if (sel) {
        sel.addEventListener('change', updatePrayerDisplay);
    }
});
</script>
@endpush
