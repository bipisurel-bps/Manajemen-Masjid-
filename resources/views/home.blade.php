@extends('layouts.app')
@section('title', 'SAF — Sistem Operasi Manajemen Masjid Open Source (safmasjid.web.id)')

@section('content')
@php
    $masjidName = \App\Models\Setting::get('masjid_name', 'SAF');
@endphp

<!-- Custom Premium Styles for SAF Product Landing Page (Engineered via premium-web-design) -->
<style>
    /* ── 1. Hero Section (Split Variant, High-End Dark Emerald) ── */
    .hero-saf {
        background: radial-gradient(120% 120% at 50% 0%, #03392E 0%, #02261E 45%, #011914 100%);
        color: #F8FAFC;
        position: relative;
        overflow: hidden;
        padding: clamp(5rem, 8vw, 7.5rem) 0 clamp(4.5rem, 7vw, 6.5rem);
    }
    .hero-glow-emerald {
        position: absolute;
        top: -140px;
        left: 45%;
        transform: translateX(-50%);
        width: 750px;
        height: 440px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.22) 0%, transparent 68%);
        pointer-events: none;
        filter: blur(55px);
    }
    .hero-glow-candle {
        position: absolute;
        bottom: 20px;
        right: -60px;
        width: 480px;
        height: 340px;
        background: radial-gradient(circle, rgba(217, 119, 6, 0.12) 0%, transparent 68%);
        pointer-events: none;
        filter: blur(60px);
    }
    .hero-grid-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(52, 211, 153, 0.12) 1px, transparent 1px);
        background-size: 32px 32px;
        pointer-events: none;
        mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 50%, rgba(0,0,0,0) 100%);
        -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 50%, rgba(0,0,0,0) 100%);
    }

    /* ── Eyebrow Pill Badge ── */
    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #6EE7B7;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 0.45rem 1.15rem;
        border-radius: var(--radius-pill);
        backdrop-filter: blur(12px);
        margin-bottom: 1.5rem;
    }
    .hero-badge-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #10B981;
        box-shadow: 0 0 10px #10B981;
        animation: pulseDot 2s infinite ease-in-out;
    }
    @keyframes pulseDot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(0.8); }
    }

    /* ── Fluid Headline & Typography ── */
    .hero-headline {
        font-size: clamp(2.4rem, 4vw, 3.85rem);
        font-weight: 900;
        letter-spacing: -0.035em;
        line-height: 1.12;
        margin-bottom: 1.35rem;
    }
    .hero-gradient-text {
        background: linear-gradient(135deg, #34D399 0%, #A7F3D0 40%, #FBBF24 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }
    .hero-description {
        font-size: clamp(1rem, 0.95rem + 0.25vw, 1.15rem);
        line-height: 1.7;
        color: rgba(241, 245, 249, 0.88);
        max-width: 620px;
        margin-bottom: 2rem;
    }

    /* ── Action Buttons ── */
    .btn-hero-primary {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: #fff;
        font-weight: 700;
        font-size: 0.95rem;
        padding: 0.85rem 1.75rem;
        border-radius: var(--radius-pill);
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 10px 25px -4px rgba(16, 185, 129, 0.45);
        transition: transform 200ms var(--ease-out-quart), box-shadow 200ms var(--ease-out-quart);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-hero-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 32px -4px rgba(16, 185, 129, 0.55);
        color: #fff;
    }
    .btn-hero-primary:active {
        transform: translateY(0) scale(0.98);
    }

    .btn-hero-github {
        background: rgba(255, 255, 255, 0.08);
        color: #F8FAFC;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.85rem 1.5rem;
        border-radius: var(--radius-pill);
        border: 1px solid rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(10px);
        transition: transform 200ms var(--ease-out-quart), background 200ms var(--ease-out-quart);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-hero-github:hover {
        background: rgba(255, 255, 255, 0.16);
        color: #fff;
        transform: translateY(-2px);
    }
    .btn-hero-github:active {
        transform: translateY(0) scale(0.98);
    }

    .btn-hero-textlink {
        color: rgba(255, 255, 255, 0.82);
        font-weight: 600;
        font-size: 0.92rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: color 0.2s;
    }
    .btn-hero-textlink:hover {
        color: #34D399;
    }

    /* ── Trust Indicators Strip ── */
    .trust-strip {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem 1.25rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        max-width: 620px;
    }
    .trust-item {
        font-size: 0.8rem;
        color: rgba(241, 245, 249, 0.75);
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
    }
    .trust-item i {
        color: #34D399;
        font-size: 0.95rem;
    }

    /* ── Interactive Workspace Mockup (Mac/Studio Frame) ── */
    .device-mockup {
        background: #081C17;
        border: 1px solid rgba(255, 255, 255, 0.14);
        border-radius: var(--radius-lg);
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.75), 0 0 35px rgba(16, 185, 129, 0.15);
        overflow: hidden;
        color: #E2E8F0;
        transition: transform 0.3s var(--ease-out-quart);
    }
    .device-mockup:hover {
        transform: translateY(-4px);
    }
    .device-header {
        background: rgba(255, 255, 255, 0.04);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding: 0.85rem 1.25rem;
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
        color: rgba(255, 255, 255, 0.65);
        font-size: 0.76rem;
        font-weight: 600;
        padding: 0.32rem 0.85rem;
        border-radius: var(--radius-pill);
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

    /* ── Principles Strip (Visual Anchor) ── */
    .principles-strip {
        background: #011511;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding: 1rem 0;
    }
    .principles-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.25rem;
        color: #94A3B8;
        font-size: 0.76rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }
    .principles-container span {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .principles-container span i {
        color: #10B981;
    }

    /* ── Filosofi SAF Section (Spiritual Deep Night Canvas) ── */
    .filosofi-section {
        background: radial-gradient(120% 120% at 50% 0%, #032A22 0%, #021E18 45%, #011511 100%);
        color: #F8FAFC;
        padding: clamp(5rem, 8vw, 7.5rem) 0;
        position: relative;
    }
    .hadits-quote-box {
        background: rgba(255, 255, 255, 0.035);
        border: 1px solid rgba(16, 185, 129, 0.25);
        border-radius: var(--radius-lg);
        padding: 2.5rem 2rem;
        max-width: 820px;
        margin: 0 auto 3.5rem;
        text-align: center;
        position: relative;
        backdrop-filter: blur(10px);
    }
    .arabic-text {
        font-family: 'Amiri', 'Traditional Arabic', 'Scheherazade New', serif;
        font-size: clamp(1.6rem, 1.2rem + 1vw, 2.1rem);
        line-height: 1.85;
        color: #A7F3D0;
        margin-bottom: 1rem;
    }
    .hadits-translation {
        font-size: 1.05rem;
        line-height: 1.65;
        color: rgba(241, 245, 249, 0.88);
        font-style: italic;
    }
    .hadits-narrator {
        font-size: 0.8rem;
        color: #FBBF24;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        margin-top: 0.75rem;
    }

    /* ── 4 Pillar Cards ── */
    .pillar-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.09);
        border-radius: var(--radius-lg);
        padding: 2.25rem 1.75rem;
        height: 100%;
        transition: transform 0.3s var(--ease-out-quart), border-color 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .pillar-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.055);
        border-color: rgba(16, 185, 129, 0.35);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.55);
    }
    .pillar-num {
        font-size: 3.2rem;
        font-weight: 900;
        line-height: 1;
        opacity: 0.1;
        position: absolute;
        top: 1.25rem;
        right: 1.5rem;
        color: #fff;
    }
    .pillar-icon {
        width: 52px;
        height: 52px;
        border-radius: var(--radius);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.45rem;
        margin-bottom: 1.25rem;
    }

    /* ── Breathing Metric Section (Warm Alabaster) ── */
    .breathing-stat-section {
        background: var(--surface-warm);
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        padding: clamp(3.5rem, 6vw, 5rem) 0;
    }
    .stat-pill-card {
        background: #FFFFFF;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.75rem 1.5rem;
        height: 100%;
        text-align: center;
        box-shadow: var(--shadow-sm);
        transition: transform 0.25s var(--ease-out-quart), box-shadow 0.25s ease;
    }
    .stat-pill-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
        border-color: #CBD5E1;
    }
    .stat-number {
        font-size: clamp(2rem, 1.6rem + 1vw, 2.75rem);
        font-weight: 900;
        letter-spacing: -0.03em;
        line-height: 1.1;
        color: var(--primary);
    }
    .stat-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text);
        margin-top: 0.35rem;
        margin-bottom: 0.25rem;
    }
    .stat-desc {
        font-size: 0.78rem;
        color: var(--text-muted);
        line-height: 1.45;
        margin-bottom: 0;
    }

    /* ── Bento Grid Cards ── */
    .bento-section {
        background: #FFFFFF;
        padding: clamp(5rem, 8vw, 7.5rem) 0;
    }
    .bento-card {
        background: #FFFFFF;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2.25rem 2rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.25s var(--ease-out-quart), box-shadow 0.25s ease, border-color 0.25s ease;
        box-shadow: var(--shadow-sm);
        position: relative;
        overflow: hidden;
    }
    .bento-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: #CBD5E1;
    }
    .bento-icon {
        width: 50px;
        height: 50px;
        border-radius: var(--radius);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.45rem;
        margin-bottom: 1.25rem;
    }

    /* ── How It Works (3-Step Pipeline) ── */
    .how-it-works-section {
        background: var(--surface-warm);
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        padding: clamp(5rem, 8vw, 7.5rem) 0;
    }
    .step-card {
        background: #FFFFFF;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 2.25rem 1.75rem;
        height: 100%;
        position: relative;
        box-shadow: var(--shadow-sm);
        transition: transform 0.25s var(--ease-out-quart), box-shadow 0.25s ease;
    }
    .step-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }
    .step-badge {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1rem;
        margin-bottom: 1.25rem;
    }

    /* ── Two Adoption Paths ── */
    .path-card {
        border-radius: var(--radius-lg);
        padding: 2.5rem 2.25rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.25s var(--ease-out-quart), box-shadow 0.25s ease, border-color 0.25s ease;
    }
    .path-card.self-host {
        background: #FFFFFF;
        border: 2px solid var(--border);
    }
    .path-card.self-host:hover {
        border-color: var(--primary);
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }
    .path-card.consult {
        background: #F0FDF4;
        border: 2px solid #BBF7D0;
    }
    .path-card.consult:hover {
        border-color: #059669;
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    /* ── Final Call to Action ── */
    .cta-final-section {
        background: radial-gradient(circle at 50% 50%, #064E3B 0%, #022C22 60%, #011A14 100%);
        color: white;
        padding: clamp(5rem, 8vw, 7.5rem) 0;
        position: relative;
        overflow: hidden;
    }
</style>

<!-- 1. HERO SECTION (Split Layout Variant) -->
<section class="hero-saf">
    <div class="hero-glow-emerald"></div>
    <div class="hero-glow-candle"></div>
    <div class="hero-grid-pattern"></div>

    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <!-- Left Column: Value Proposition & CTAs (58%) -->
            <div class="col-lg-7" data-animate>
                <!-- Eyebrow Badge with Pulsing Beacon -->
                <div class="hero-eyebrow shadow-sm">
                    <span class="hero-badge-dot"></span>
                    <span>FILOSOFI SAF: TERTIB &bull; AMANAH &bull; BERSAMA &bull; BERKELANJUTAN &bull; safmasjid.web.id</span>
                </div>

                <!-- Main Title -->
                <h1 class="hero-headline">
                    Sistem operasi yang merapikan<br>
                    <span class="hero-gradient-text">tata kelola masjid Anda.</span>
                </h1>

                <!-- Subtitle / Value Proposition (Specific, Concrete, Respecting 65ch) -->
                <p class="hero-description">
                    Dalam salat berjamaah, saf menggambarkan <strong>keteraturan, kebersamaan, dan kesetaraan</strong>. SAF menerjemahkan filosofi ini ke dalam tata kelola masjid: <strong>Tertib</strong> dalam administrasi &amp; kegiatan, <strong>Amanah</strong> dalam tata kelola dana &amp; aset, <strong>Bersama</strong> menghubungkan pengurus dan jamaah, serta <strong>Berkelanjutan</strong> agar riwayat pengelolaan tidak hilang antar-generasi.
                </p>

                <!-- Action CTAs -->
                <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                    <button type="button" class="btn-hero-primary" data-bs-toggle="modal" data-bs-target="#demoModal">
                        <i class="bi bi-play-circle-fill fs-5"></i> Coba Demo Aplikasi <span aria-hidden="true">&nearr;</span>
                    </button>
                    <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" rel="noopener noreferrer" class="btn-hero-github">
                        <i class="bi bi-github fs-5"></i> Ambil Source Code Bebas <span aria-hidden="true">&nearr;</span>
                    </a>
                    <a href="{{ route('login') }}" class="btn-hero-textlink ms-md-2">
                        Masuk ke akun <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>

                <!-- Trust Signals Strip -->
                <div class="trust-strip">
                    <div class="trust-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>100% Bebas Royalti (Lisensi MIT)</span>
                    </div>
                    <div class="trust-item">
                        <i class="bi bi-wifi-off"></i>
                        <span>Offline-First (PWA Standalone)</span>
                    </div>
                    <div class="trust-item">
                        <i class="bi bi-shield-check"></i>
                        <span>Data Tersimpan Privat</span>
                    </div>
                    <div class="trust-item">
                        <i class="bi bi-heart-fill text-warning"></i>
                        <span>Tanpa Biaya Langganan</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Studio Mockup (42%) -->
            <div class="col-lg-5" data-animate>
                <div class="device-mockup">
                    <!-- Window Header with Interactive Switchers -->
                    <div class="device-header">
                        <div class="window-dots">
                            <span class="window-dot" style="background: #FF5F56;"></span>
                            <span class="window-dot" style="background: #FFBD2E;"></span>
                            <span class="window-dot" style="background: #27C93F;"></span>
                        </div>
                        <div class="d-flex gap-1">
                            <button type="button" class="mockup-tab-btn active" onclick="switchMockupTab('tv', this)">
                                <i class="bi bi-tv me-1"></i> Layar TV
                            </button>
                            <button type="button" class="mockup-tab-btn" onclick="switchMockupTab('kas', this)">
                                <i class="bi bi-wallet2 me-1"></i> Kas Multi-Wadah
                            </button>
                            <button type="button" class="mockup-tab-btn" onclick="switchMockupTab('rekap', this)">
                                <i class="bi bi-printer me-1"></i> Rekap A4
                            </button>
                        </div>
                    </div>

                    <!-- SCREEN 1: LAYAR TV DIGITAL MASJID -->
                    <div id="screen-tv" class="p-4" style="background: #021713;">
                        <div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom border-secondary border-opacity-25">
                            <div>
                                <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle small fw-bold">
                                    <i class="bi bi-broadcast me-1"></i> Display TV Fullscreen
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
                                    <div class="text-white-50" style="font-size: 0.65rem;">SUBUH</div>
                                    <div class="fw-bold text-white small">04:32</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 rounded-2 bg-dark bg-opacity-50 border border-secondary border-opacity-25">
                                    <div class="text-white-50" style="font-size: 0.65rem;">TERBIT</div>
                                    <div class="fw-bold text-white small">05:48</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 rounded-2 bg-dark bg-opacity-50 border border-secondary border-opacity-25">
                                    <div class="text-white-50" style="font-size: 0.65rem;">DZUHUR</div>
                                    <div class="fw-bold text-white small">11:45</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 rounded-2 bg-warning bg-opacity-25 border border-warning">
                                    <div class="text-warning fw-bold" style="font-size: 0.65rem;">ASHAR &bull; AKTIF</div>
                                    <div class="fw-bold text-warning small">15:02</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 rounded-2 bg-dark bg-opacity-50 border border-secondary border-opacity-25">
                                    <div class="text-white-50" style="font-size: 0.65rem;">MAGHRIB</div>
                                    <div class="fw-bold text-white small">17:52</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 rounded-2 bg-dark bg-opacity-50 border border-secondary border-opacity-25">
                                    <div class="text-white-50" style="font-size: 0.65rem;">ISYA</div>
                                    <div class="fw-bold text-white small">19:03</div>
                                </div>
                            </div>
                        </div>

                        <!-- Running Text Preview -->
                        <div class="p-2 rounded-2 bg-black bg-opacity-40 border border-secondary border-opacity-25 small text-truncate text-white-50">
                            <i class="bi bi-megaphone-fill text-warning me-1"></i>
                            <span>SAF: Tertib Administrasi &bull; Amanah Pengelolaan &bull; Bersama Jamaah &bull; Berkelanjutan Antar-Generasi.</span>
                        </div>
                    </div>

                    <!-- SCREEN 2: BUKU KAS MULTI-WADAH ATOMIK -->
                    <div id="screen-kas" class="p-4 d-none" style="background: #081C17;">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-secondary border-opacity-25">
                            <span class="small text-white-50 fw-bold text-uppercase">Posisi Kas Masjid (Realtime)</span>
                            <span class="badge bg-success-subtle text-success small">Database Mutex</span>
                        </div>
                        <div class="mb-3">
                            <div class="text-white-50 small">Total Saldo Konsolidasi:</div>
                            <h3 class="fw-900 text-white mb-0">{{ \App\Helpers\FormatHelper::formatRupiah($balance ?? 48750000) }}</h3>
                        </div>
                        <div class="p-2 rounded-3 bg-dark bg-opacity-50 border border-secondary border-opacity-25 mb-2 small d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-wallet text-success me-1"></i> Kas Operasional</span>
                            <strong class="text-white">Rp 24.500.000</strong>
                        </div>
                        <div class="p-2 rounded-3 bg-dark bg-opacity-50 border border-secondary border-opacity-25 mb-2 small d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-heart text-warning me-1"></i> Kas Yatim &amp; Dhuafa</span>
                            <strong class="text-white">Rp 12.250.000</strong>
                        </div>
                        <div class="p-2 rounded-3 bg-dark bg-opacity-50 border border-secondary border-opacity-25 small d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-building text-info me-1"></i> Kas Renovasi</span>
                            <strong class="text-white">Rp 12.000.000</strong>
                        </div>
                    </div>

                    <!-- SCREEN 3: REKAP CETAK KAS JUMAT A4 -->
                    <div id="screen-rekap" class="p-4 d-none" style="background: #081C17;">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-secondary border-opacity-25">
                            <span class="small text-white-50 fw-bold text-uppercase">Format Cetak Kas Jumat A4</span>
                            <span class="badge bg-warning-subtle text-warning small">Siap Cetak 1 Lembar</span>
                        </div>
                        <p class="small text-white-50 mb-3" style="line-height: 1.6;">
                            Dirancang presisi untuk dicetak pada selembar kertas A4 tanpa terpotong, memuat ringkasan saldo awal pekan, mutasi penerimaan infaq tromol, belanja operasional, dan kolom tanda tangan DKM.
                        </p>
                        <a href="{{ route('reports.rekap_jumat') }}" target="_blank" class="btn btn-warning btn-sm w-100 rounded-pill fw-bold text-dark">
                            <i class="bi bi-printer me-1"></i> Buka Format Siap Cetak A4 &rarr;
                        </a>
                    </div>
                </div>

                <!-- Subtle Highlight Micro-card -->
                <div class="p-3 rounded-3 mt-3 d-flex align-items-center gap-3 text-white-50 small border" style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.1) !important;">
                    <i class="bi bi-patch-check-fill text-success fs-5"></i>
                    <div>
                        <strong class="text-white d-block">Mutasi Kas Terverifikasi Database Mutex</strong>
                        <span>Mencegah selisih pembukuan dan memisahkan rekening wadah secara mandiri.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. PRINCIPLES RIBBON -->
<div class="principles-strip">
    <div class="container">
        <div class="principles-container">
            <span><i class="bi bi-journal-check"></i> TERTIB (ADMINISTRASI &amp; KEGIATAN)</span>
            <span><i class="bi bi-shield-check"></i> AMANAH (TRANSPARANSI DANA &amp; ASET)</span>
            <span><i class="bi bi-people-fill"></i> BERSAMA (KONEKTIVITAS JAMAAH)</span>
            <span><i class="bi bi-arrow-repeat"></i> BERKELANJUTAN (RIWAYAT TERJAGA)</span>
            <span><i class="bi bi-code-slash"></i> OPEN SOURCE &bull; LISENSI MIT</span>
        </div>
    </div>
</div>

<!-- 3. SECTION KHUSUS: FILOSOFI SAF -->
<section class="filosofi-section">
    <div class="container">
        <div class="text-center mb-4" data-animate>
            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-2 fw-bold text-uppercase" style="letter-spacing: 0.08em; font-size: 0.72rem;">
                Filosofi Spiritual &amp; Tata Kelola
            </span>
            <h2 class="display-6 fw-900 text-white" style="letter-spacing: -0.03em;">Mengapa Bernama SAF?</h2>
            <p class="text-white-50 mx-auto lead" style="max-width: 780px; font-size: 1.15rem; line-height: 1.7;">
                Dalam salat berjamaah, saf menggambarkan <strong>keteraturan, kebersamaan, dan kesetaraan</strong>. Setiap orang memiliki tempat dalam satu barisan, bergerak menuju tujuan yang sama.
            </p>
        </div>

        <!-- Hadits Kutipan Barisan Shaf & Pengantar 4 Pilar -->
        <div class="hadits-quote-box" data-animate>
            <div class="arabic-text">
                سَوُّوا صُفُوفَكُمْ، فَإِنَّ تَسْوِيَةَ الصَّفِّ مِنْ تَمَامِ الصَّلَاةِ
            </div>
            <div class="hadits-translation">
                &ldquo;Luruskan dan rapatkan shaf-shaf kalian, karena sesungguhnya lurus dan rapatnya shaf adalah bagian dari kesempurnaan shalat.&rdquo;
            </div>
            <div class="hadits-narrator">
                — H.R. Bukhari No. 723 &amp; Muslim No. 433
            </div>
            <div class="mt-3 pt-3 border-top border-success border-opacity-25 text-white-50 small" style="line-height: 1.65;">
                Filosofi ini kami terjemahkan secara nyata ke dalam <strong class="text-white">empat pilar tata kelola masjid modern</strong>:
            </div>
        </div>

        <!-- Empat Pilar Filosofi SAF Grid (4 Kolom Desktop) -->
        <div class="row g-4" data-animate-stagger>
            <!-- Pilar 1: TERTIB -->
            <div class="col-xl-3 col-md-6">
                <div class="pillar-card">
                    <span class="pillar-num">01</span>
                    <div class="pillar-icon" style="background: rgba(16, 185, 129, 0.15); color: #34D399;">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success small rounded-pill px-3 py-1 fw-bold text-uppercase mb-2">
                        النِّظَامُ &bull; An-Nizham
                    </span>
                    <h3 class="fw-800 text-white mb-2">1. TERTIB</h3>
                    <h6 class="text-success small fw-bold mb-3">Administrasi, Keuangan, Inventaris &amp; Kegiatan</h6>
                    <p class="text-white-50 small mb-4" style="line-height: 1.7;">
                        <strong class="text-white">Administrasi, keuangan, inventaris, dan kegiatan tercatat dengan baik.</strong> Seluruh surat keluar-masuk, catatan aset fisik, mutasi kas harian, dan agenda muballigh tercatat rapi tanpa ada yang tercecer.
                    </p>
                    <div class="p-3 rounded-3 bg-black bg-opacity-30 border border-secondary border-opacity-25 small text-white-50">
                        <strong class="text-white d-block mb-1"><i class="bi bi-check2 text-success me-1"></i> Penerapan Sistem:</strong>
                        Buku kas multi-wadah atomik, modul inventaris barang wakaf, buku agenda persuratan, dan penjadwalan kajian terintegrasi.
                    </div>
                </div>
            </div>

            <!-- Pilar 2: AMANAH -->
            <div class="col-xl-3 col-md-6">
                <div class="pillar-card">
                    <span class="pillar-num">02</span>
                    <div class="pillar-icon" style="background: rgba(59, 130, 246, 0.15); color: #60A5FA;">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <span class="badge bg-primary-subtle text-primary small rounded-pill px-3 py-1 fw-bold text-uppercase mb-2">
                        الأَمَانَةُ &bull; Al-Amanah
                    </span>
                    <h3 class="fw-800 text-white mb-2">2. AMANAH</h3>
                    <h6 class="text-primary small fw-bold mb-3">Transparansi Dana &amp; Pertanggungjawaban Aset</h6>
                    <p class="text-white-50 small mb-4" style="line-height: 1.7;">
                        <strong class="text-white">Pengelolaan dana dan aset dilakukan secara transparan dan bertanggung jawab.</strong> Dana titipan umat dibuka secara akuntabel, bebas celah kebocoran, serta membangun kepercayaan jamaah kepada pengurus.
                    </p>
                    <div class="p-3 rounded-3 bg-black bg-opacity-30 border border-secondary border-opacity-25 small text-white-50">
                        <strong class="text-white d-block mb-1"><i class="bi bi-check2 text-primary me-1"></i> Penerapan Sistem:</strong>
                        Portal transparansi kas real-time tanpa login, transaksi database mutex anti-selisih, dan rekap kas Jumat format A4 bertanda tangan DKM.
                    </div>
                </div>
            </div>

            <!-- Pilar 3: BERSAMA -->
            <div class="col-xl-3 col-md-6">
                <div class="pillar-card">
                    <span class="pillar-num">03</span>
                    <div class="pillar-icon" style="background: rgba(245, 158, 11, 0.15); color: #FBBF24;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning small rounded-pill px-3 py-1 fw-bold text-uppercase mb-2">
                        الجَمَاعَةُ &bull; Al-Jama'ah
                    </span>
                    <h3 class="fw-800 text-white mb-2">3. BERSAMA</h3>
                    <h6 class="text-warning small fw-bold mb-3">Pengurus, Relawan &amp; Jamaah Saling Terhubung</h6>
                    <p class="text-white-50 small mb-4" style="line-height: 1.7;">
                        <strong class="text-white">Pengurus, relawan, dan jamaah saling terhubung.</strong> Sebagaimana saf merapatkan bahu jamaah tanpa membedakan status sosial, sistem SAF menghubungkan takmir, marbot, dan warga sekitar dalam ekosistem masjid.
                    </p>
                    <div class="p-3 rounded-3 bg-black bg-opacity-30 border border-secondary border-opacity-25 small text-white-50">
                        <strong class="text-white d-block mb-1"><i class="bi bi-check2 text-warning me-1"></i> Penerapan Sistem:</strong>
                        Layar TV masjid dengan hisab Kemenag &amp; hitung mundur iqamah, portal publik info pengumuman, dan pengingat WhatsApp H-2 muballigh.
                    </div>
                </div>
            </div>

            <!-- Pilar 4: BERKELANJUTAN -->
            <div class="col-xl-3 col-md-6">
                <div class="pillar-card">
                    <span class="pillar-num">04</span>
                    <div class="pillar-icon" style="background: rgba(139, 92, 246, 0.15); color: #A78BFA;">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <span class="badge bg-info-subtle text-info small rounded-pill px-3 py-1 fw-bold text-uppercase mb-2">
                        الإِسْتِمْرَارُ &bull; Al-Istimrar
                    </span>
                    <h3 class="fw-800 text-white mb-2">4. BERKELANJUTAN</h3>
                    <h6 class="text-info small fw-bold mb-3">Riwayat Pengelolaan Aman Antar-Generasi</h6>
                    <p class="text-white-50 small mb-4" style="line-height: 1.7;">
                        <strong class="text-white">Pergantian kepengurusan tidak membuat data dan riwayat pengelolaan hilang.</strong> Solusi tuntas atas masalah klasik masjid di mana data kas dan inventaris raib saat regenerasi DKM; seluruh arsip digital tersimpan abadi.
                    </p>
                    <div class="p-3 rounded-3 bg-black bg-opacity-30 border border-secondary border-opacity-25 small text-white-50">
                        <strong class="text-white d-block mb-1"><i class="bi bi-check2 text-info me-1"></i> Penerapan Sistem:</strong>
                        Database digital mandiri (SQLite / MySQL), ekspor arsip berkala (Excel/PDF), log audit histori aktivitas, dan transfer hak akses kepengurusan yang mulus.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. BREATHING SECTION: DAMPAK & STATISTIK (Law 5 & Rhythm Law) -->
<section class="breathing-stat-section">
    <div class="container">
        <div class="row g-4 justify-content-center" data-animate-stagger>
            <div class="col-6 col-lg-3">
                <div class="stat-pill-card">
                    <div class="stat-number">Rp 0</div>
                    <div class="stat-label">Bebas Royalti</div>
                    <p class="stat-desc">Lisensi MIT 100% open-source, bebas dipakai dan dimodifikasi tanpa pungutan biaya sepeser pun.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-pill-card">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Offline-First</div>
                    <p class="stat-desc">Hisab astronomis lokal resmi Kemenag RI dan PWA Service Worker tetap menyala saat internet masjid padam.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-pill-card">
                    <div class="stat-number">4 Pilar</div>
                    <div class="stat-label">Tata Kelola</div>
                    <p class="stat-desc">Tertib administrasi, Amanah dana umat, Bersama jamaah, dan Berkelanjutan lintas kepengurusan.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-pill-card">
                    <div class="stat-number">1-Klik</div>
                    <div class="stat-label">Demo Instan</div>
                    <p class="stat-desc">Uji coba langsung sebagai bendahara atau super admin dengan sandbox terisolasi tanpa perlu registrasi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. BENTO GRID SECTION: KEMAMPUAN UTAMA (6 Fitur Inti) -->
<section class="bento-section">
    <div class="container">
        <div class="text-center mb-5" data-animate>
            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-2 fw-bold text-uppercase" style="letter-spacing: 0.05em; font-size: 0.72rem;">
                Kemampuan Sistem
            </span>
            <h2 class="display-6 fw-900 text-dark" style="letter-spacing: -0.03em;">Bukan Sekadar Catatan Kas, Ini Sistem Operasi Masjid</h2>
            <p class="text-muted mx-auto lead" style="max-width: 680px; font-size: 1.1rem;">
                Semua instrumen digital yang dibutuhkan pengurus masjid dirancang menyatu, ringan, mandiri, dan siap pakai tanpa memerlukan infrastruktur mahal.
            </p>
        </div>

        <div class="row g-4" data-animate-stagger>
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
                        <p class="text-muted mb-4" style="line-height: 1.7;">
                            Tampilan fullscreen khusus yang dapat dihubungkan ke Android TV Box, Smart TV, atau PC mini tanpa perlu membuka panel admin. Dilengkapi jam digital realtime sinkron, 5 waktu salat otomatis berbasis hisab astronomis Kemenag tanpa butuh API luar, hitung mundur iqomah, serta running text saldo kas &amp; pengumuman kajian.
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
                        <p class="text-muted small mb-3" style="line-height: 1.65;">
                            Satu lembar kertas A4 siap cetak yang rapi, memuat ringkasan saldo awal pekan, seluruh mutasi pemasukan infaq tromol, pengeluaran operasional, dan kolom tanda tangan takmir sebelum salat Jumat.
                        </p>
                    </div>
                    <div class="pt-3 border-top">
                        <a href="{{ route('reports.rekap_jumat') }}" target="_blank" class="btn btn-outline-warning text-dark btn-sm rounded-pill w-100 fw-bold">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Lihat Format Siap Cetak
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bento 3: Portal Transparansi Publik (Col 4) -->
            <div class="col-lg-4">
                <div class="bento-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon" style="background: #ECFDF5; color: #059669;">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 fw-bold">Publik &amp; Audit</span>
                        </div>
                        <h5 class="fw-800 text-dark mb-2">3. Portal Transparansi Jamaah</h5>
                        <p class="text-muted small mb-3" style="line-height: 1.65;">
                            Halaman publik read-only tanpa login. Menampilkan grafik keuangan bulanan menggunakan Chart.js yang dibundel secara lokal, ringkasan saldo amanah per wadah kas, dan mutasi terverifikasi.
                        </p>
                    </div>
                    <div class="pt-3 border-top">
                        <a href="{{ route('transparency.index') }}" class="btn btn-outline-success btn-sm rounded-pill w-100 fw-bold">
                            <i class="bi bi-shield-check me-1"></i> Buka Portal Transparansi
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bento 4: Mutasi Kas Multi-Wadah Atomik (Col 8) -->
            <div class="col-lg-8">
                <div class="bento-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon" style="background: #F3E8FF; color: #7C3AED;">
                                <i class="bi bi-wallet2"></i>
                            </div>
                            <span class="badge bg-purple-subtle text-dark border rounded-pill px-3 py-1 fw-bold">Integritas Data</span>
                        </div>
                        <h4 class="fw-800 text-dark mb-2">4. Mutasi Kas Atomik &amp; Buku Kas Multi-Wadah</h4>
                        <p class="text-muted mb-4" style="line-height: 1.7;">
                            Setiap mutasi kas dibungkus dalam transaksi basis data atomik dengan verifikasi runtime saldo kas. Mendukung pemisahan Buku Kas independen: Kas Umum Operasional, Kas Pembangunan/Renovasi, Kas ZISWAF, dan Kas Santunan Anak Yatim sehingga dana umat tidak bercampur.
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-2 pt-3 border-top">
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#demoModal">
                            <i class="bi bi-play-fill me-1"></i> Coba Input Kas di Demo
                        </button>
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
                        <p class="text-muted small mb-3" style="line-height: 1.65;">
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

            <!-- Bento 6: Arsitektur PWA & Zero CDN (Col 6) -->
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
                        <p class="text-muted small mb-3" style="line-height: 1.65;">
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

<!-- 6. HOW IT WORKS: 3-STEP WORKFLOW (Blueprint Item 7) -->
<section class="how-it-works-section">
    <div class="container">
        <div class="text-center mb-5" data-animate>
            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-2 fw-bold text-uppercase" style="letter-spacing: 0.05em; font-size: 0.72rem;">
                Alur Pemanfaatan
            </span>
            <h2 class="display-6 fw-900 text-dark" style="letter-spacing: -0.03em;">Mulai dalam 3 Langkah Sederhana</h2>
            <p class="text-muted mx-auto lead" style="max-width: 640px; font-size: 1.1rem;">
                Tanpa konfigurasi server yang rumit, masjid Anda dapat langsung menikmati sistem administrasi modern.
            </p>
        </div>

        <div class="row g-4" data-animate-stagger>
            <div class="col-lg-4">
                <div class="step-card">
                    <div class="step-badge">1</div>
                    <h5 class="fw-800 text-dark mb-2">Ambil Kode atau Minta Bantuan</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Clone repositori secara gratis di GitHub untuk dipasang di komputer sekretariat masjid, atau hubungi pengembang untuk pendampingan setup domain HTTPS dan cloud.
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="step-card">
                    <div class="step-badge">2</div>
                    <h5 class="fw-800 text-dark mb-2">Personalisasi Data &amp; Wadah Kas</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Tentukan wadah kas (operasional, pembangunan, yatim), koordinat garis lintang untuk hisab waktu salat otomatis, nomor rekening resmi, dan QRIS infaq masjid Anda.
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="step-card">
                    <div class="step-badge">3</div>
                    <h5 class="fw-800 text-dark mb-2">Tata Kelola Aktif &amp; Siap Dipakai</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Hubungkan layar Smart TV ke mode display masjid, cetak laporan rekap kas Jumat format A4, dan bagikan tautan transparansi kas real-time kepada seluruh jamaah.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. DUA PILIHAN IMPLEMENTASI (Jalur Mandiri vs Pendampingan) -->
<section class="py-5" style="background: #FFFFFF;">
    <div class="container py-4">
        <div class="text-center mb-5" data-animate>
            <span class="badge rounded-pill bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 mb-2 fw-bold text-uppercase" style="letter-spacing: 0.05em; font-size: 0.72rem;">
                Pilihan Implementasi
            </span>
            <h2 class="display-6 fw-900 text-dark">Dua Jalur Pemanfaatan: Bebas Digunakan &amp; Mandiri</h2>
            <p class="text-muted mx-auto lead" style="max-width: 640px; font-size: 1.1rem;">
                Pilih jalur yang paling sesuai dengan kesiapan teknis dan infrastruktur takmir di masjid Anda.
            </p>
        </div>

        <div class="row g-4 justify-content-center" data-animate-stagger>
            <!-- Jalur 1: Unduh & Pasang Mandiri -->
            <div class="col-lg-6">
                <div class="path-card self-host shadow-sm">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge bg-dark text-white rounded-pill px-3 py-1 fw-bold">Jalur Mandiri</span>
                            <span class="text-success fw-bold small"><i class="bi bi-gift-fill me-1"></i> 100% Gratis Selamanya</span>
                        </div>
                        <h3 class="fw-800 text-dark mb-2">Unduh &amp; Pasang di Server Sendiri</h3>
                        <p class="text-muted mb-4" style="line-height: 1.65;">
                            Cocok untuk pengurus yang memiliki relawan IT atau komputer sekretariat. Unduh seluruh kode sumber dari GitHub, pasang di server lokal masjid (XAMPP/Docker/PHP) atau VPS sendiri.
                        </p>
                        <ul class="list-unstyled text-muted small mb-4 d-flex flex-column gap-2">
                            <li><i class="bi bi-check2 text-success me-2 fw-bold"></i> Kode sumber terbuka lengkap di bawah Lisensi MIT</li>
                            <li><i class="bi bi-check2 text-success me-2 fw-bold"></i> Data keuangan jamaah tersimpan 100% privat di server sendiri</li>
                            <li><i class="bi bi-check2 text-success me-2 fw-bold"></i> Bebas dimodifikasi sesuai AD/ART atau kebutuhan masjid</li>
                            <li><i class="bi bi-check2 text-success me-2 fw-bold"></i> Tidak ada biaya langganan bulanan maupun tahunan</li>
                        </ul>
                    </div>
                    <div>
                        <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" rel="noopener noreferrer" class="btn btn-dark btn-lg w-100 rounded-pill fw-bold shadow-sm">
                            <i class="bi bi-github me-2"></i> Unduh / Clone di GitHub <span aria-hidden="true">&nearr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Jalur 2: Konsultasi & Bantuan Implementasi -->
            <div class="col-lg-6">
                <div class="path-card consult shadow-sm">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge bg-success text-white rounded-pill px-3 py-1 fw-bold">Pendampingan Teknis</span>
                            <span class="text-success fw-bold small"><i class="bi bi-heart-pulse-fill me-1"></i> Siap Membantu</span>
                        </div>
                        <h3 class="fw-800 text-dark mb-2">Konsultasi &amp; Bantuan Pengembang</h3>
                        <p class="text-muted mb-4" style="line-height: 1.65;">
                            Cocok untuk DKM yang ingin langsung pakai tanpa repot konfigurasi server. Kami siap membantu setup domain HTTPS, instalasi display TV, serta pengenalan fitur untuk bendahara masjid.
                        </p>
                        <ul class="list-unstyled text-muted small mb-4 d-flex flex-column gap-2">
                            <li><i class="bi bi-check2 text-success me-2 fw-bold"></i> Konsultasi perencanaan hardware TV box &amp; koneksi layar masjid</li>
                            <li><i class="bi bi-check2 text-success me-2 fw-bold"></i> Bantuan migrasi data kas lama dari spreadsheet Excel</li>
                            <li><i class="bi bi-check2 text-success me-2 fw-bold"></i> Panduan langsung dari <strong>Jadda Developer</strong></li>
                            <li><i class="bi bi-check2 text-success me-2 fw-bold"></i> Kontak resmi tunggal: <code>jaddadeveloper@gmail.com</code></li>
                        </ul>
                    </div>
                    <div>
                        <a href="mailto:jaddadeveloper@gmail.com?subject=Konsultasi%20Implementasi%20SAF%20Masjid" class="btn btn-success btn-lg w-100 rounded-pill fw-bold shadow-sm">
                            <i class="bi bi-envelope-at-fill me-2"></i> Hubungi jaddadeveloper@gmail.com <span aria-hidden="true">&nearr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 8. TANYA JAWAB UMUM (FAQ) -->
<section class="py-5" style="background: var(--surface-warm); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
    <div class="container py-4">
        <div class="text-center mb-5" data-animate>
            <span class="badge rounded-pill bg-secondary-subtle text-secondary px-3 py-1 mb-2 fw-bold text-uppercase" style="letter-spacing: 0.05em; font-size: 0.72rem;">
                Tanya Jawab DKM
            </span>
            <h2 class="display-6 fw-900 text-dark">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-muted mx-auto lead" style="max-width: 600px; font-size: 1.1rem;">Penjelasan praktis seputar implementasi dan operasional sistem di masjid Anda.</p>
        </div>

        <div class="row g-4 justify-content-center" data-animate-stagger>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-question-circle-fill text-success me-2"></i>Apakah aplikasi SAF benar-benar gratis dan open source?</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Ya, <strong>SAF</strong> adalah perangkat lunak sumber terbuka (<em>open-source</em>) dengan <strong>Lisensi MIT</strong>. Takmir mana pun dapat mengunduh kode sumber, memasangnya di server sekretariat atau cloud, dan menggunakannya tanpa biaya royalti.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-question-circle-fill text-success me-2"></i>Bagaimana cara mengambil dan mengunduh source code aplikasi?</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Seluruh kode sumber disimpan secara terbuka di GitHub. Anda dapat membuka repositori <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" rel="noopener noreferrer" class="fw-bold text-success text-decoration-none">github.com/bipisurel-bps/Manajemen-Masjid-</a> untuk melakukan clone atau mengunduh arsip ZIP.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-question-circle-fill text-success me-2"></i>Apakah aplikasi ini tetap berjalan jika koneksi internet masjid padam?</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Bisa 100%. SAF dirancang secara lokal-pertama (Zero CDN). Waktu salat dihitung dengan rumus hisab astronomis internal Kemenag tanpa memerlukan API eksternal, dan antarmuka TV tetap menyala offline melalui Service Worker PWA.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-question-circle-fill text-success me-2"></i>Siapa yang mengembangkan dan bagaimana cara menghubungi bantuan teknis?</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Aplikasi ini dikembangkan oleh <strong>Jadda Developer</strong>. Satu-satunya saluran kontak resmi pengembang adalah melalui email <a href="mailto:jaddadeveloper@gmail.com" class="fw-bold text-success text-decoration-none">jaddadeveloper@gmail.com</a>.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-question-circle-fill text-success me-2"></i>Bagaimana cara mengatur rekening donasi resmi masjid kami?</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Website ini tidak memuat rekening bank bawaan agar tidak membingungkan. Setiap masjid yang memasang aplikasi ini dapat mengisi nama bank, nomor rekening, dan QRIS infaq masjid masing-masing melalui menu <strong>Pengaturan</strong> di panel admin.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-question-circle-fill text-success me-2"></i>Bagaimana cara mencoba aplikasi ini sekarang?</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Klik tombol <strong>Coba Demo Aplikasi</strong> di halaman ini. Anda dapat masuk langsung dengan 1-klik sebagai Bendahara atau Super Admin tanpa registrasi untuk mencoba mencatat kas, mencetak rekap, atau melihat display TV.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 9. FINAL CALL TO ACTION BANNER -->
<section class="cta-final-section">
    <div class="container text-center position-relative py-4" data-animate>
        <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-3 fw-bold text-uppercase" style="letter-spacing: 0.05em; font-size: 0.72rem;">
            Tertib &bull; Amanah &bull; Bersama &bull; Berkelanjutan
        </span>
        <h2 class="display-6 fw-900 mb-3" style="letter-spacing: -0.03em;">Mulai Modernisasi Tata Kelola Masjid Bersama SAF</h2>
        <p class="lead opacity-90 mx-auto mb-4" style="max-width: 650px; font-size: 1.15rem;">
            Wujudkan transparansi keuangan yang amanah dan kedisiplinan operasional masjid modern yang profesional dengan sistem yang siap pakai, handal, dan mandiri.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <button type="button" class="btn-hero-primary" data-bs-toggle="modal" data-bs-target="#demoModal">
                <i class="bi bi-play-circle-fill fs-5"></i> Coba Demo Aplikasi <span aria-hidden="true">&nearr;</span>
            </button>
            <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" rel="noopener noreferrer" class="btn-hero-github">
                <i class="bi bi-github fs-5"></i> Unduh di GitHub <span aria-hidden="true">&nearr;</span>
            </a>
            <a href="mailto:jaddadeveloper@gmail.com?subject=Konsultasi%20SAF%20Masjid" class="btn-hero-github">
                <i class="bi bi-envelope-at fs-5"></i> jaddadeveloper@gmail.com
            </a>
        </div>
    </div>
</section>

<!-- 10. MODAL DEMO 1-KLIK (SANDBOX INTERAKTIF SEPERTI MODEL SAS) -->
<div class="modal fade" id="demoModal" tabindex="-1" aria-labelledby="demoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-bottom p-4">
                <div>
                    <span class="badge bg-success-subtle text-success small rounded-pill px-3 py-1 fw-bold text-uppercase mb-1">
                        Sandbox Instan &bull; Tanpa Registrasi
                    </span>
                    <h5 class="modal-title fw-800 text-dark mb-0" id="demoModalLabel">Pilih Ruang Kerja Demo SAF</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted small mb-4" style="line-height: 1.6;">
                    Anda dapat langsung mencoba seluruh antarmuka aplikasi SAF dengan data ilustrasi terisolasi. Pilih salah satu peran di bawah ini:
                </p>

                <div class="d-flex flex-column gap-3 mb-4">
                    <a href="{{ route('demo.login', 'admin') }}" class="p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none text-dark hover-shadow" style="background: #F8FAFC; transition: all 0.2s;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 d-flex align-items-center justify-content-center bg-warning bg-opacity-25 text-warning" style="width: 44px; height: 44px; font-size: 1.35rem;">
                                <i class="bi bi-wallet2 text-dark"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Ruang Kerja Bendahara</h6>
                                <small class="text-muted">Kelola kas multi-wadah, input mutasi, cetak rekap A4</small>
                            </div>
                        </div>
                        <i class="bi bi-arrow-right fs-5 text-muted"></i>
                    </a>

                    <a href="{{ route('demo.login', 'superadmin') }}" class="p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none text-dark hover-shadow" style="background: #F8FAFC; transition: all 0.2s;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary" style="width: 44px; height: 44px; font-size: 1.35rem;">
                                <i class="bi bi-shield-lock-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Ruang Kerja Super Admin</h6>
                                <small class="text-muted">Akses penuh pengaturan sistem, display TV, &amp; pengguna</small>
                            </div>
                        </div>
                        <i class="bi bi-arrow-right fs-5 text-muted"></i>
                    </a>

                    <a href="{{ route('display.index') }}" target="_blank" class="p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none text-dark hover-shadow" style="background: #F8FAFC; transition: all 0.2s;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success" style="width: 44px; height: 44px; font-size: 1.35rem;">
                                <i class="bi bi-tv-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Layar TV Masjid Standalone</h6>
                                <small class="text-muted">Display jadwal salat hisab otomatis &amp; hitung mundur iqamah</small>
                            </div>
                        </div>
                        <i class="bi bi-box-arrow-up-right fs-6 text-muted"></i>
                    </a>
                </div>

                <div class="p-3 rounded-3 bg-light border small text-muted">
                    <i class="bi bi-info-circle text-primary me-1"></i>
                    Atau login manual di <a href="{{ route('login') }}" class="fw-bold text-dark">halaman login</a> dengan username: <code>bendahara</code> / password: <code>Password123</code>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Mockup Tab Switcher
function switchMockupTab(tab, btn) {
    document.getElementById('screen-tv').classList.add('d-none');
    document.getElementById('screen-kas').classList.add('d-none');
    document.getElementById('screen-rekap').classList.add('d-none');

    document.querySelectorAll('.mockup-tab-btn').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');

    if (tab === 'tv') {
        document.getElementById('screen-tv').classList.remove('d-none');
    } else if (tab === 'kas') {
        document.getElementById('screen-kas').classList.remove('d-none');
    } else if (tab === 'rekap') {
        document.getElementById('screen-rekap').classList.remove('d-none');
    }
}

// Live Clock for mockup
function updateLiveClock() {
    const now = new Date();
    const clockStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    const mockEl = document.getElementById('mockupClock');
    if (mockEl) {
        mockEl.innerText = clockStr;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    updateLiveClock();
    setInterval(updateLiveClock, 1000);
});
</script>
@endpush
