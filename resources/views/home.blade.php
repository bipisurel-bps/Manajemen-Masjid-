@extends('layouts.app')
@section('title', 'SAF — Sistem Operasi Manajemen Masjid Open Source (safmasjid.web.id)')

@section('content')
@php
    $masjidName = \App\Models\Setting::get('masjid_name', 'SAF');
    $initialBalance = $balance ?? 48750000;
@endphp

<!-- LUMINOUS CLEAN DESIGN SYSTEM (HIGH CONTRAST & DESKTOP PRECISION) -->
<style>
    /* ── Color Palette: Luminous Modern Islamic Tech ── */
    :root {
        --saf-primary: #065F46;         /* Deep Forest Emerald */
        --saf-primary-dark: #022C22;    /* Charcoal Emerald */
        --saf-primary-light: #ECFDF5;   /* Soft Tinted Mint */
        --saf-primary-border: #A7F3D0;  /* Subtle Green Border */
        --saf-jade: #059669;            /* Vibrant Jade */
        --saf-gold: #D97706;            /* Warm Amber Gold */
        --saf-gold-light: #FEF3C7;      /* Warm Gold Tint */
        --saf-gold-text: #92400E;       /* Readable Gold Text */
        
        /* Surfaces & Neutrals (Bright, Clean, High Legibility) */
        --saf-bg-page: #F8FAF9;
        --saf-bg-surface: #FFFFFF;
        --saf-bg-card: #FFFFFF;
        --saf-bg-subtle: #F1F5F9;
        
        /* High Contrast Typography */
        --saf-text-heading: #0F172A;    /* Slate 900 */
        --saf-text-body: #334155;       /* Slate 700 */
        --saf-text-muted: #64748B;      /* Slate 500 */
        --saf-border: #E2E8F0;          /* Clean Subtle Border */
        --saf-border-hover: #CBD5E1;
        
        /* Animation & Easing */
        --saf-ease: cubic-bezier(0.16, 1, 0.3, 1);
        --saf-shadow-sm: 0 1px 3px rgba(15, 23, 42, 0.05);
        --saf-shadow-card: 0 4px 20px -2px rgba(15, 23, 42, 0.06), 0 2px 6px -1px rgba(15, 23, 42, 0.03);
        --saf-shadow-hover: 0 16px 36px -4px rgba(6, 95, 70, 0.12), 0 4px 12px -2px rgba(15, 23, 42, 0.04);
    }

    /* ── 1. Hero Section (Luminous Split Layout) ── */
    .hero-luminous {
        background: radial-gradient(120% 90% at 50% 0%, #ECFDF5 0%, #F8FAF9 50%, #FFFFFF 100%);
        color: var(--saf-text-heading);
        position: relative;
        overflow: hidden;
        padding: clamp(3.5rem, 6vw, 5.5rem) 0 clamp(3.5rem, 5vw, 5rem);
        border-bottom: 1px solid #E2E8F0;
    }
    .hero-glow-soft-1 {
        position: absolute;
        top: -120px;
        left: 30%;
        transform: translateX(-50%);
        width: 700px;
        height: 450px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.12) 0%, transparent 70%);
        filter: blur(50px);
        pointer-events: none;
        z-index: 0;
    }
    .hero-glow-soft-2 {
        position: absolute;
        bottom: -80px;
        right: 10%;
        width: 500px;
        height: 380px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.09) 0%, transparent 70%);
        filter: blur(55px);
        pointer-events: none;
        z-index: 0;
    }
    .hero-pattern-subtle {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(6, 95, 70, 0.05) 1.2px, transparent 1.2px);
        background-size: 28px 28px;
        pointer-events: none;
        z-index: 0;
    }

    /* ── Eyebrow Pill ── */
    .hero-eyebrow-clean {
        display: inline-flex;
        align-items: center;
        gap: 0.65rem;
        background: #FFFFFF;
        border: 1px solid var(--saf-primary-border);
        box-shadow: 0 2px 8px rgba(6, 95, 70, 0.08);
        padding: 0.45rem 1.15rem;
        border-radius: 9999px;
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--saf-primary);
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 1.5rem;
    }
    .hero-pulse-dot {
        width: 8px;
        height: 8px;
        background: #10B981;
        border-radius: 50%;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: pulseBeacon 2s infinite;
    }
    @keyframes pulseBeacon {
        0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { box-shadow: 0 0 0 9px rgba(16, 185, 129, 0); }
        100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    /* ── Hero Typography ── */
    .hero-title-clean {
        font-size: clamp(2.2rem, 3.8vw, 3.5rem);
        font-weight: 900;
        line-height: 1.15;
        letter-spacing: -0.04em;
        color: var(--saf-text-heading);
        margin-bottom: 1.35rem;
    }
    .hero-gradient-emerald {
        background: linear-gradient(135deg, #065F46 0%, #059669 60%, #D97706 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }
    .hero-desc-clean {
        font-size: clamp(1rem, 1.2vw, 1.15rem);
        line-height: 1.75;
        color: var(--saf-text-body);
        max-width: 62ch;
        margin-bottom: 2rem;
    }

    /* ── Buttons ── */
    .btn-saf-solid {
        display: inline-flex;
        align-items: center;
        gap: 0.65rem;
        background: linear-gradient(135deg, #065F46 0%, #047857 100%);
        color: #FFFFFF;
        font-weight: 700;
        font-size: 0.95rem;
        padding: 0.85rem 1.75rem;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 20px -3px rgba(6, 95, 70, 0.35);
        transition: all 0.25s var(--saf-ease);
        cursor: pointer;
        text-decoration: none;
    }
    .btn-saf-solid:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #047857 0%, #065F46 100%);
        color: #FFFFFF;
        box-shadow: 0 12px 28px -3px rgba(6, 95, 70, 0.45);
    }
    .btn-saf-light {
        display: inline-flex;
        align-items: center;
        gap: 0.65rem;
        background: #FFFFFF;
        color: var(--saf-text-heading);
        font-weight: 700;
        font-size: 0.95rem;
        padding: 0.85rem 1.65rem;
        border-radius: 9999px;
        border: 1px solid var(--saf-border);
        box-shadow: var(--saf-shadow-sm);
        transition: all 0.25s var(--saf-ease);
        cursor: pointer;
        text-decoration: none;
    }
    .btn-saf-light:hover {
        background: #F8FAFC;
        border-color: #CBD5E1;
        color: var(--saf-primary);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(15, 23, 42, 0.08);
    }

    /* ── Trust Signals ── */
    .trust-row-clean {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        padding-top: 1.75rem;
        border-top: 1px solid #E2E8F0;
        margin-top: 2rem;
    }
    .trust-chip {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.825rem;
        font-weight: 600;
        color: var(--saf-text-body);
    }
    .trust-chip i {
        color: var(--saf-primary);
        font-size: 1.05rem;
    }

    /* ── High-End Studio Mockup Frame (Desktop Centered & Pristine) ── */
    .studio-frame-clean {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        border-radius: 20px;
        box-shadow: 0 20px 45px -8px rgba(15, 23, 42, 0.12), 0 0 0 1px rgba(0, 0, 0, 0.03);
        overflow: hidden;
        position: relative;
    }
    .studio-frame-bar {
        background: #F8FAFC;
        padding: 0.85rem 1.25rem;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    .traffic-dots {
        display: flex;
        gap: 6px;
    }
    .t-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
    }
    .studio-pill-nav {
        display: flex;
        background: #EDEAE4;
        background: rgba(15, 23, 42, 0.06);
        border-radius: 9999px;
        padding: 3px;
        gap: 3px;
    }
    .pill-tab-btn {
        background: transparent;
        border: none;
        color: var(--saf-text-muted);
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.35rem 0.85rem;
        border-radius: 9999px;
        cursor: pointer;
        transition: all 0.2s var(--saf-ease);
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }
    .pill-tab-btn.active {
        background: #FFFFFF;
        color: var(--saf-primary);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    /* ── Studio Panels ── */
    .studio-body {
        padding: 1.5rem;
        min-height: 420px;
        background: #FAFAFA;
    }
    .tv-screen-box {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 1.25rem;
        box-shadow: var(--saf-shadow-sm);
    }
    .prayer-slot {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 0.65rem 0.5rem;
        text-align: center;
        transition: all 0.2s;
    }
    .prayer-slot.slot-active {
        background: #FEF3C7;
        border-color: #F59E0B;
        box-shadow: 0 2px 10px rgba(245, 158, 11, 0.2);
    }
    .prayer-slot .p-name {
        font-size: 0.65rem;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: var(--saf-text-muted);
        margin-bottom: 0.2rem;
    }
    .prayer-slot.slot-active .p-name {
        color: var(--saf-gold-text);
    }
    .prayer-slot .p-time {
        font-size: 0.95rem;
        font-weight: 800;
        color: var(--saf-text-heading);
        font-family: monospace;
    }

    /* ── Cash Simulator Cards ── */
    .pot-card-clean {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.2s;
    }
    .pot-card-clean:hover {
        border-color: #10B981;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.08);
    }
    .chip-btn-clean {
        background: #F1F5F9;
        border: 1px solid #CBD5E1;
        color: var(--saf-text-heading);
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.35rem 0.65rem;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.15s;
    }
    .chip-btn-clean:hover, .chip-btn-clean.active {
        background: #065F46;
        border-color: #065F46;
        color: #FFFFFF;
    }

    /* ── Tactile A4 Preview ── */
    .a4-sheet-clean {
        background: #FFFFFF;
        color: #0F172A;
        border: 1px solid #CBD5E1;
        border-radius: 8px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        padding: 1.5rem;
        font-size: 0.825rem;
        line-height: 1.5;
    }
    .stamp-verified {
        border: 2px dashed #059669;
        color: #059669;
        font-weight: 800;
        font-size: 0.65rem;
        padding: 0.35rem 0.75rem;
        border-radius: 4px;
        display: inline-block;
        transform: rotate(-3deg);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* ── 2. Principles Ribbon (Serene Marquee) ── */
    .ribbon-luminous {
        background: #FFFFFF;
        border-top: 1px solid #E2E8F0;
        border-bottom: 1px solid #E2E8F0;
        padding: 0.95rem 0;
        overflow: hidden;
        white-space: nowrap;
    }
    .ribbon-track {
        display: inline-flex;
        gap: 3rem;
        animation: marqueeScroll 35s linear infinite;
        will-change: transform;
    }
    @keyframes marqueeScroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .ribbon-item {
        font-size: 0.8rem;
        font-weight: 800;
        color: var(--saf-primary);
        letter-spacing: 0.08em;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* ── 3. The 4 SAF Pillars (Light Executive Philosophy) ── */
    .filosofi-section-luminous {
        background: #FAF9F6;
        padding: clamp(4.5rem, 7vw, 6.5rem) 0;
        position: relative;
        border-bottom: 1px solid #E2E8F0;
    }
    .hadits-box-clean {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-top: 4px solid var(--saf-primary);
        border-radius: 18px;
        padding: clamp(2rem, 3.5vw, 2.75rem);
        margin-bottom: 3.5rem;
        box-shadow: var(--saf-shadow-card);
        text-align: center;
    }
    .arabic-calligraphy-clean {
        font-family: 'Amiri', 'Traditional Arabic', serif;
        font-size: clamp(1.75rem, 3vw, 2.4rem);
        color: #92400E;
        direction: rtl;
        line-height: 1.8;
        margin-bottom: 0.85rem;
    }
    .hadits-trans-clean {
        font-size: 1.05rem;
        font-style: italic;
        color: var(--saf-text-body);
        max-width: 68ch;
        margin: 0 auto 0.75rem;
        line-height: 1.7;
    }

    /* ── 4 Pillar Cards (Clean Desktop Grid) ── */
    .pillar-card-clean {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        padding: 2rem 1.65rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        box-shadow: var(--saf-shadow-sm);
        transition: all 0.3s var(--saf-ease);
    }
    .pillar-card-clean:hover {
        transform: translateY(-5px);
        border-color: #10B981;
        box-shadow: var(--saf-shadow-hover);
    }
    .pillar-num-light {
        position: absolute;
        top: 10px;
        right: 18px;
        font-size: 3.5rem;
        font-weight: 900;
        color: #F1F5F9;
        line-height: 1;
        pointer-events: none;
        user-select: none;
        transition: color 0.3s;
    }
    .pillar-card-clean:hover .pillar-num-light {
        color: #E2E8F0;
    }
    .pillar-tag {
        font-family: 'Amiri', 'Traditional Arabic', serif;
        font-size: 1.15rem;
        color: var(--saf-gold-text);
        display: inline-block;
        margin-bottom: 0.35rem;
    }
    .pillar-contrast-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 0.95rem;
        font-size: 0.8rem;
        line-height: 1.6;
        margin-top: 1.25rem;
    }

    /* ── 4. Breathing Metric Stats ── */
    .stat-section-clean {
        background: #FFFFFF;
        border-bottom: 1px solid #E2E8F0;
        padding: 3.5rem 0;
    }
    .stat-box-clean {
        text-align: center;
        padding: 1rem;
    }
    .stat-val-clean {
        font-size: clamp(2.25rem, 3.5vw, 3rem);
        font-weight: 900;
        color: var(--saf-primary);
        letter-spacing: -0.04em;
        line-height: 1;
        margin-bottom: 0.4rem;
    }
    .stat-lbl-clean {
        font-size: 1rem;
        font-weight: 800;
        color: var(--saf-text-heading);
        margin-bottom: 0.25rem;
    }
    .stat-sub-clean {
        font-size: 0.825rem;
        color: var(--saf-text-muted);
        line-height: 1.5;
        margin-bottom: 0;
    }

    /* ── 5. Bento Grid Capabilities (Clean & Tidy) ── */
    .bento-section-clean {
        background: #F8FAF9;
        padding: clamp(4.5rem, 7vw, 6.5rem) 0;
        border-bottom: 1px solid #E2E8F0;
    }
    .bento-card-clean {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        padding: 2rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: var(--saf-shadow-sm);
        transition: all 0.3s var(--saf-ease);
    }
    .bento-card-clean:hover {
        transform: translateY(-4px);
        box-shadow: var(--saf-shadow-hover);
        border-color: #CBD5E1;
    }
    .bento-icon-clean {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        margin-bottom: 1.25rem;
    }

    /* ── 6. Live Benchmark Table ── */
    .table-container-clean {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--saf-shadow-card);
    }

    /* ── 7. Paths Section ── */
    .path-card-clean {
        background: #FFFFFF;
        border-radius: 18px;
        padding: 2.25rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.3s;
        border: 1px solid #CBD5E1;
        box-shadow: var(--saf-shadow-sm);
    }
    .path-card-clean.featured {
        border: 2px solid var(--saf-primary);
        box-shadow: 0 12px 35px -5px rgba(6, 95, 70, 0.15);
    }

    /* ── 8. Call to Action (Executive Emerald) ── */
    .cta-banner-clean {
        background: linear-gradient(135deg, #065F46 0%, #047857 50%, #024734 100%);
        color: #FFFFFF;
        padding: clamp(4.5rem, 6vw, 6rem) 0;
        position: relative;
        overflow: hidden;
    }
</style>

<!-- 1. HERO SECTION (Luminous Clean Split Layout) -->
<section class="hero-luminous">
    <div class="hero-glow-soft-1"></div>
    <div class="hero-glow-soft-2"></div>
    <div class="hero-pattern-subtle"></div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center g-5">
            <!-- Left Column: Value Proposition & Philosophy (56%) -->
            <div class="col-lg-7" data-animate>
                <!-- Eyebrow Pill with Pulsing Beacon -->
                <div class="hero-eyebrow-clean">
                    <span class="hero-pulse-dot"></span>
                    <span>FILOSOFI SAF &bull; TERTIB &bull; AMANAH &bull; BERSAMA &bull; BERKELANJUTAN</span>
                </div>

                <!-- Main Title -->
                <h1 class="hero-title-clean">
                    Sistem Operasi Manajemen Masjid Yang Menghidupkan<br>
                    <span class="hero-gradient-emerald">Tata Kelola Amanah.</span>
                </h1>

                <!-- Subtitle / Value Proposition with Deep Philosophy -->
                <p class="hero-desc-clean">
                    Dalam salat berjamaah, saf menggambarkan <strong>keteraturan, kebersamaan, dan kesetaraan</strong>. Setiap orang memiliki tempat dalam satu barisan, bergerak menuju tujuan yang sama. SAF menerjemahkan filosofi ini ke dalam pengelolaan masjid: <strong>Tertib</strong> administrasi &amp; kegiatan, <strong>Amanah</strong> dalam tata kelola dana &amp; aset, <strong>Bersama</strong> menghubungkan pengurus dan jamaah, serta <strong>Berkelanjutan</strong> agar riwayat pengelolaan tidak hilang antar-generasi.
                </p>

                <!-- Action CTAs -->
                <div class="d-flex flex-wrap align-items-center gap-3 mb-2">
                    <button type="button" class="btn-saf-solid" data-bs-toggle="modal" data-bs-target="#demoModal">
                        <i class="bi bi-play-circle-fill fs-5"></i> Coba Demo Interaktif (1-Klik) <span aria-hidden="true">&nearr;</span>
                    </button>
                    <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" rel="noopener noreferrer" class="btn-saf-light">
                        <i class="bi bi-github fs-5"></i> Ambil Source Code Bebas <span aria-hidden="true">&nearr;</span>
                    </a>
                    <a href="{{ route('display.index') }}" target="_blank" class="btn-saf-light">
                        <i class="bi bi-tv fs-5 text-success"></i> Layar TV Masjid &rarr;
                    </a>
                </div>

                <!-- Trust Signals Strip -->
                <div class="trust-row-clean">
                    <div class="trust-chip">
                        <i class="bi bi-patch-check-fill"></i>
                        <span>100% Bebas Royalti (Lisensi MIT)</span>
                    </div>
                    <div class="trust-chip">
                        <i class="bi bi-wifi-off"></i>
                        <span>100% Offline-First (PWA Standalone)</span>
                    </div>
                    <div class="trust-chip">
                        <i class="bi bi-shield-lock-fill"></i>
                        <span>Data Tersimpan Privat di Server Masjid</span>
                    </div>
                    <div class="trust-chip">
                        <i class="bi bi-heart-fill text-warning"></i>
                        <span>Tanpa Biaya Langganan Bulanan</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Studio Mockup (44%) -->
            <div class="col-lg-5" data-animate>
                <div class="studio-frame-clean">
                    <!-- Browser / Window Header -->
                    <div class="studio-frame-bar">
                        <div class="traffic-dots">
                            <span class="t-dot" style="background: #FF5F56;"></span>
                            <span class="t-dot" style="background: #FFBD2E;"></span>
                            <span class="t-dot" style="background: #27C93F;"></span>
                        </div>
                        <div class="studio-pill-nav">
                            <button type="button" class="pill-tab-btn active" onclick="switchStudioTab('tv', this)">
                                <i class="bi bi-tv"></i> Layar TV
                            </button>
                            <button type="button" class="pill-tab-btn" onclick="switchStudioTab('kas', this)">
                                <i class="bi bi-wallet2"></i> Simulasi Kas
                            </button>
                            <button type="button" class="pill-tab-btn" onclick="switchStudioTab('rekap', this)">
                                <i class="bi bi-printer"></i> Rekap A4
                            </button>
                        </div>
                    </div>

                    <!-- SCREEN 1: LAYAR TV DIGITAL MASJID -->
                    <div id="screen-tv" class="studio-body">
                        <div class="tv-screen-box mb-3">
                            <div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom">
                                <div>
                                    <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle small fw-bold">
                                        <i class="bi bi-broadcast me-1"></i> Hisab Astronomis Kemenag
                                    </span>
                                </div>
                                <div class="text-end">
                                    <div class="font-monospace text-success fw-bold fs-4" id="studioLiveClock">--:--:--</div>
                                    <div class="text-muted" style="font-size: 0.7rem;" id="studioLiveDate">Memuat tanggal...</div>
                                </div>
                            </div>

                            <!-- 6 Mini Prayer Tiles -->
                            <div class="row g-2 mb-3">
                                <div class="col-4">
                                    <div class="prayer-slot">
                                        <div class="p-name">SUBUH</div>
                                        <div class="p-time">04:32</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="prayer-slot">
                                        <div class="p-name">TERBIT</div>
                                        <div class="p-time">05:48</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="prayer-slot">
                                        <div class="p-name">DZUHUR</div>
                                        <div class="p-time">11:45</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="prayer-slot slot-active" id="prayerActiveChip">
                                        <div class="p-name">ASHAR &bull; AKTIF</div>
                                        <div class="p-time text-warning-emphasis">15:02</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="prayer-slot">
                                        <div class="p-name">MAGHRIB</div>
                                        <div class="p-time">17:52</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="prayer-slot">
                                        <div class="p-name">ISYA</div>
                                        <div class="p-time">19:03</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Iqamah Countdown Bar -->
                            <div class="p-2 rounded-3 bg-light border mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="small fw-bold text-dark" id="iqamahStatusLabel">
                                        <i class="bi bi-hourglass-split text-warning me-1"></i> Hitung Mundur Iqamah
                                    </span>
                                    <span class="badge bg-warning text-dark font-monospace fw-bold" id="iqamahCountdownTimer">04:45</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 65%;" id="iqamahProgressBar"></div>
                                </div>
                            </div>

                            <!-- Running Text Preview -->
                            <div class="p-2 rounded-2 bg-light border small text-truncate text-muted mb-0">
                                <i class="bi bi-megaphone-fill text-warning me-1"></i>
                                <span>SAF: Tertib Administrasi &bull; Amanah Pengelolaan &bull; Bersama Jamaah &bull; Berkelanjutan Antar-Generasi.</span>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-success rounded-pill w-50 fw-bold" onclick="simulateIqamahBeep()">
                                <i class="bi bi-volume-up-fill me-1"></i> Uji Bunyi Adzan
                            </button>
                            <a href="{{ route('display.index') }}" target="_blank" class="btn btn-sm btn-success rounded-pill w-50 fw-bold">
                                <i class="bi bi-arrows-fullscreen me-1"></i> Buka Fullscreen &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- SCREEN 2: SIMULATOR INFAQ & MULTI-WADAH -->
                    <div id="screen-kas" class="studio-body d-none">
                        <div class="bg-white border rounded-3 p-3 mb-3 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center pb-2 mb-2 border-bottom">
                                <div>
                                    <span class="small text-muted fw-bold text-uppercase">Posisi Saldo Konsolidasi</span>
                                    <div class="fs-4 fw-900 text-dark font-monospace" id="liveBalanceAmount">
                                        Rp 48.750.000
                                    </div>
                                </div>
                                <span class="badge bg-success-subtle text-success small rounded-pill px-3 py-1">
                                    <i class="bi bi-shield-check me-1"></i> Mutex Guard
                                </span>
                            </div>

                            <!-- 3 Wadah Kas Mini Summary -->
                            <div class="d-flex flex-column gap-2 mb-3">
                                <div class="pot-card-clean">
                                    <div>
                                        <div class="text-muted small"><i class="bi bi-wallet2 text-success me-1"></i> Kas Operasional</div>
                                        <div class="fw-bold text-dark small" id="potOperasional">Rp 24.500.000</div>
                                    </div>
                                    <span class="badge bg-success-subtle text-success small">Aktif</span>
                                </div>
                                <div class="pot-card-clean">
                                    <div>
                                        <div class="text-muted small"><i class="bi bi-heart-fill text-warning me-1"></i> Kas Anak Yatim &amp; Dhuafa</div>
                                        <div class="fw-bold text-dark small" id="potYatim">Rp 12.250.000</div>
                                    </div>
                                    <span class="badge bg-warning-subtle text-warning small">Terpisah</span>
                                </div>
                                <div class="pot-card-clean">
                                    <div>
                                        <div class="text-muted small"><i class="bi bi-building text-info me-1"></i> Kas Renovasi Masjid</div>
                                        <div class="fw-bold text-dark small" id="potRenovasi">Rp 12.000.000</div>
                                    </div>
                                    <span class="badge bg-info-subtle text-info small">Terikat</span>
                                </div>
                            </div>

                            <!-- Interactive Simulation Controls -->
                            <div class="p-2 rounded-3 bg-light border">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="small text-muted fw-bold">Uji Coba Mutasi Masuk:</span>
                                    <span class="text-success small fw-bold" id="simFeedbackNote">Pilih nominal &bull; Klik catat</span>
                                </div>
                                <div class="d-flex gap-1 mb-2">
                                    <button type="button" class="chip-btn-clean flex-fill active" onclick="selectSimAmount(50000, this)">+50rb</button>
                                    <button type="button" class="chip-btn-clean flex-fill" onclick="selectSimAmount(100000, this)">+100rb</button>
                                    <button type="button" class="chip-btn-clean flex-fill" onclick="selectSimAmount(250000, this)">+250rb</button>
                                    <button type="button" class="chip-btn-clean flex-fill" onclick="selectSimAmount(500000, this)">+500rb</button>
                                </div>
                                <div class="row g-2">
                                    <div class="col-7">
                                        <select class="form-select form-select-sm" id="simPotSelect">
                                            <option value="operasional">Wadah: Kas Operasional</option>
                                            <option value="yatim">Wadah: Kas Yatim</option>
                                            <option value="renovasi">Wadah: Kas Renovasi</option>
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <button type="button" class="btn btn-sm btn-success w-100 fw-bold" onclick="executeDonationSimulation()">
                                            <i class="bi bi-plus-circle me-1"></i> Catat Infaq
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SCREEN 3: REKAP CETAK KAS JUMAT A4 -->
                    <div id="screen-rekap" class="studio-body d-none">
                        <div class="a4-sheet-clean mb-3">
                            <div class="d-flex justify-content-between align-items-start border-bottom pb-2 mb-2">
                                <div>
                                    <div class="fw-bold text-uppercase" style="font-size: 0.75rem;">DEWAN KEMAKMURAN MASJID</div>
                                    <div class="text-muted" style="font-size: 0.68rem;">Laporan Rekap Kas Pekanan Sebelum Salat Jumat</div>
                                </div>
                                <div class="stamp-verified">Terverifikasi DKM</div>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom border-light" style="font-size: 0.75rem;">
                                <span>Saldo Awal Pekan Lalu:</span>
                                <strong class="font-monospace">Rp 45.200.000</strong>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom border-light text-success" style="font-size: 0.75rem;">
                                <span>Penerimaan Infaq Kotak &amp; Tromol:</span>
                                <strong class="font-monospace">+Rp 6.350.000</strong>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom border-light text-danger" style="font-size: 0.75rem;">
                                <span>Biaya Operasional, Listrik &amp; Marbot:</span>
                                <strong class="font-monospace">-Rp 2.800.000</strong>
                            </div>
                            <div class="d-flex justify-content-between pt-2 fw-bold" style="font-size: 0.85rem;">
                                <span>Saldo Akhir Kas Ditutup:</span>
                                <span class="font-monospace text-success">Rp 48.750.000</span>
                            </div>
                        </div>

                        <a href="{{ route('reports.rekap_jumat') }}" target="_blank" class="btn btn-outline-success btn-sm w-100 rounded-pill fw-bold">
                            <i class="bi bi-printer me-1"></i> Buka Format Siap Cetak A4 Asli &rarr;
                        </a>
                    </div>
                </div>

                <!-- Trust Micro-Card -->
                <div class="p-3 rounded-3 mt-3 d-flex align-items-center gap-3 bg-white border shadow-sm">
                    <i class="bi bi-shield-check text-success fs-3"></i>
                    <div class="small">
                        <strong class="text-dark d-block">Database Mutex Transaction Guard</strong>
                        <span class="text-muted">Mencegah selisih pembukuan saat pencatatan bersama dan menjamin akurasi saldo amanah.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. PRINCIPLES RIBBON (Serene Minimalist Marquee) -->
<div class="ribbon-luminous">
    <div class="ribbon-track">
        <span class="ribbon-item"><i class="bi bi-journal-check"></i> TERTIB: ADMINISTRASI, KEUANGAN &amp; KEGIATAN TERCATAT</span>
        <span class="ribbon-item"><i class="bi bi-shield-check"></i> AMANAH: PENGELOLAAN DANA &amp; ASET TRANSPARAN</span>
        <span class="ribbon-item"><i class="bi bi-people-fill"></i> BERSAMA: PENGURUS, RELAWAN &amp; JAMAAH TERHUBUNG</span>
        <span class="ribbon-item"><i class="bi bi-arrow-repeat"></i> BERKELANJUTAN: RIWAYAT PENGELOLAAN TIDAK HILANG</span>
        <span class="ribbon-item"><i class="bi bi-code-slash"></i> 100% OPEN SOURCE &bull; LISENSI MIT</span>
        <span class="ribbon-item"><i class="bi bi-wifi-off"></i> 100% OFFLINE-FIRST &bull; ZERO CDN DEPENDENCY</span>
        <!-- Duplicated items for infinite loop -->
        <span class="ribbon-item"><i class="bi bi-journal-check"></i> TERTIB: ADMINISTRASI, KEUANGAN &amp; KEGIATAN TERCATAT</span>
        <span class="ribbon-item"><i class="bi bi-shield-check"></i> AMANAH: PENGELOLAAN DANA &amp; ASET TRANSPARAN</span>
        <span class="ribbon-item"><i class="bi bi-people-fill"></i> BERSAMA: PENGURUS, RELAWAN &amp; JAMAAH TERHUBUNG</span>
        <span class="ribbon-item"><i class="bi bi-arrow-repeat"></i> BERKELANJUTAN: RIWAYAT PENGELOLAAN TIDAK HILANG</span>
        <span class="ribbon-item"><i class="bi bi-code-slash"></i> 100% OPEN SOURCE &bull; LISENSI MIT</span>
        <span class="ribbon-item"><i class="bi bi-wifi-off"></i> 100% OFFLINE-FIRST &bull; ZERO CDN DEPENDENCY</span>
    </div>
</div>

<!-- 3. SECTION KHUSUS: FILOSOFI SAF (Light, Clear, Deep) -->
<section class="filosofi-section-luminous">
    <div class="container position-relative">
        <div class="text-center mb-4" data-animate>
            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-2 fw-bold text-uppercase" style="letter-spacing: 0.08em; font-size: 0.75rem;">
                Filosofi Spiritual &amp; Tata Kelola
            </span>
            <h2 class="display-6 fw-900 text-dark" style="letter-spacing: -0.03em;">Mengapa Bernama SAF?</h2>
            <p class="text-muted mx-auto lead" style="max-width: 780px; font-size: 1.15rem; line-height: 1.75;">
                Dalam salat berjamaah, saf menggambarkan <strong>keteraturan, kebersamaan, dan kesetaraan</strong>. Setiap orang memiliki tempat dalam satu barisan, bergerak menuju tujuan yang sama.
            </p>
        </div>

        <!-- Hadits Kutipan Barisan Shaf -->
        <div class="hadits-box-clean" data-animate>
            <div class="arabic-calligraphy-clean">
                سَوُّوا صُفُوفَكُمْ، فَإِنَّ تَسْوِيَةَ الصَّفِّ مِنْ تَمَامِ الصَّلَاةِ
            </div>
            <div class="hadits-trans-clean">
                &ldquo;Luruskan dan rapatkan shaf-shaf kalian, karena sesungguhnya lurus dan rapatnya shaf adalah bagian dari kesempurnaan shalat.&rdquo;
            </div>
            <div class="fw-bold text-success small mb-2">
                — H.R. Bukhari No. 723 &amp; Muslim No. 433
            </div>
            <div class="pt-3 border-top text-muted small" style="line-height: 1.65;">
                Filosofi kelurusan dan kerapatan barisan shalat ini kami terjemahkan ke dalam <strong class="text-dark">empat pilar tata kelola masjid modern</strong>:
            </div>
        </div>

        <!-- Empat Pilar Filosofi SAF Grid (4 Kolom Desktop) -->
        <div class="row g-4" data-animate-stagger>
            <!-- Pilar 1: TERTIB -->
            <div class="col-xl-3 col-md-6">
                <div class="pillar-card-clean">
                    <span class="pillar-num-light">01</span>
                    <div>
                        <span class="pillar-tag">النِّظَامُ &bull; An-Nizham</span>
                        <h4 class="fw-800 text-dark mb-1">1. TERTIB</h4>
                        <h6 class="text-success small fw-bold mb-3">Administrasi, Keuangan, Inventaris &amp; Kegiatan</h6>
                        <p class="text-muted small mb-0" style="line-height: 1.7;">
                            <strong class="text-dark">Administrasi, keuangan, inventaris, dan kegiatan tercatat dengan baik.</strong> Seluruh surat masuk-keluar, barang inventaris wakaf, mutasi uang kas harian, serta agenda pengajian terdokumentasi rapi tanpa tercecer.
                        </p>
                    </div>
                    <div class="pillar-contrast-box">
                        <div class="text-danger small mb-1"><strong>Masalah:</strong> Surat tercecer, aset wakaf raib tanpa inventaris, jadwal muballigh tabrakan.</div>
                        <div class="text-success small"><strong>Solusi SAF:</strong> Arsip digital persuratan, kode aset wakaf, kalender muballigh terintegrasi.</div>
                    </div>
                </div>
            </div>

            <!-- Pilar 2: AMANAH -->
            <div class="col-xl-3 col-md-6">
                <div class="pillar-card-clean">
                    <span class="pillar-num-light">02</span>
                    <div>
                        <span class="pillar-tag">الأَمَانَةُ &bull; Al-Amanah</span>
                        <h4 class="fw-800 text-dark mb-1">2. AMANAH</h4>
                        <h6 class="text-info small fw-bold mb-3">Transparansi Dana &amp; Pertanggungjawaban Aset</h6>
                        <p class="text-muted small mb-0" style="line-height: 1.7;">
                            <strong class="text-dark">Pengelolaan dana dan aset dilakukan secara transparan dan bertanggung jawab.</strong> Dana titipan umat dibuka secara akuntabel, bebas celah kebocoran, serta membangun rasa percaya jamaah kepada para pengurus DKM.
                        </p>
                    </div>
                    <div class="pillar-contrast-box">
                        <div class="text-danger small mb-1"><strong>Masalah:</strong> Laporan kas terlambat berbulan-bulan, dana yatim tercampur dana operasional.</div>
                        <div class="text-info small"><strong>Solusi SAF:</strong> Kas multi-wadah atomik, portal transparansi publik realtime tanpa login, rekap cetak Jumat A4.</div>
                    </div>
                </div>
            </div>

            <!-- Pilar 3: BERSAMA -->
            <div class="col-xl-3 col-md-6">
                <div class="pillar-card-clean">
                    <span class="pillar-num-light">03</span>
                    <div>
                        <span class="pillar-tag">الجَمَاعَةُ &bull; Al-Jama'ah</span>
                        <h4 class="fw-800 text-dark mb-1">3. BERSAMA</h4>
                        <h6 class="text-warning small fw-bold mb-3">Pengurus, Relawan &amp; Jamaah Saling Terhubung</h6>
                        <p class="text-muted small mb-0" style="line-height: 1.7;">
                            <strong class="text-dark">Pengurus, relawan, dan jamaah saling terhubung.</strong> Sebagaimana barisan saf merapatkan bahu jamaah tanpa membedakan status sosial, sistem SAF menghubungkan takmir, marbot, dan warga sekitar masjid.
                        </p>
                    </div>
                    <div class="pillar-contrast-box">
                        <div class="text-danger small mb-1"><strong>Masalah:</strong> Pengumuman hanya di mading kusam, jamaah pasif dan minim keterlibatan.</div>
                        <div class="text-warning small"><strong>Solusi SAF:</strong> Display TV dinding masjid, portal publik info kajian, pengingat WhatsApp H-2 muballigh.</div>
                    </div>
                </div>
            </div>

            <!-- Pilar 4: BERKELANJUTAN -->
            <div class="col-xl-3 col-md-6">
                <div class="pillar-card-clean">
                    <span class="pillar-num-light">04</span>
                    <div>
                        <span class="pillar-tag">الإِسْتِمْرَارُ &bull; Al-Istimrar</span>
                        <h4 class="fw-800 text-dark mb-1">4. BERKELANJUTAN</h4>
                        <h6 class="text-primary-emphasis small fw-bold mb-3">Riwayat Pengelolaan Aman Antar-Generasi</h6>
                        <p class="text-muted small mb-0" style="line-height: 1.7;">
                            <strong class="text-dark">Pergantian kepengurusan tidak membuat data dan riwayat pengelolaan hilang.</strong> Solusi tuntas atas problematika regenerasi takmir, di mana riwayat pembukuan dan aset tetap abadi tersimpan dalam database digital.
                        </p>
                    </div>
                    <div class="pillar-contrast-box">
                        <div class="text-danger small mb-1"><strong>Masalah:</strong> Ganti pengurus ganti buku kas, riwayat renovasi masa lalu musnah tak terlacak.</div>
                        <div class="text-primary-emphasis small"><strong>Solusi SAF:</strong> Database mandiri permanen, ekspor arsip Excel/PDF, transfer hak akses mulus.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. BREATHING SECTION: METRIK & DAMPAK -->
<section class="stat-section-clean">
    <div class="container">
        <div class="row g-4 justify-content-center" data-animate-stagger>
            <div class="col-6 col-lg-3">
                <div class="stat-box-clean">
                    <div class="stat-val-clean">Rp 0</div>
                    <div class="stat-lbl-clean">Bebas Royalti</div>
                    <p class="stat-sub-clean">Lisensi MIT 100% open-source, bebas dipakai dan dimodifikasi tanpa biaya lisensi.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-box-clean">
                    <div class="stat-val-clean">100%</div>
                    <div class="stat-lbl-clean">Offline-First</div>
                    <p class="stat-sub-clean">Hisab astronomis resmi Kemenag RI dan PWA Service Worker tetap menyala saat internet padam.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-box-clean">
                    <div class="stat-val-clean">4 Pilar</div>
                    <div class="stat-lbl-clean">Tata Kelola SAF</div>
                    <p class="stat-sub-clean">Tertib administrasi, Amanah dana umat, Bersama jamaah, dan Berkelanjutan lintas masa.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-box-clean">
                    <div class="stat-val-clean">1-Klik</div>
                    <div class="stat-lbl-clean">Sandbox Demo</div>
                    <p class="stat-sub-clean">Uji coba langsung sebagai bendahara atau super admin dengan data contoh tanpa registrasi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. BENTO GRID CAPABILITIES (6 Fitur Inti Rapi & Jelas) -->
<section class="bento-section-clean">
    <div class="container">
        <div class="text-center mb-5" data-animate>
            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-2 fw-bold text-uppercase" style="letter-spacing: 0.05em; font-size: 0.72rem;">
                Kemampuan Sistem Terintegrasi
            </span>
            <h2 class="display-6 fw-900 text-dark" style="letter-spacing: -0.03em;">Bukan Sekadar Catatan Kas, Ini Sistem Operasi Masjid</h2>
            <p class="text-muted mx-auto lead" style="max-width: 680px; font-size: 1.1rem;">
                Semua instrumen digital yang dibutuhkan pengurus masjid dirancang menyatu, ringan, mandiri, dan siap pakai tanpa memerlukan infrastruktur mahal.
            </p>
        </div>

        <div class="row g-4" data-animate-stagger>
            <!-- Bento 1: Mode Layar TV (Col 8) -->
            <div class="col-lg-8">
                <div class="bento-card-clean">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon-clean" style="background: #EFF6FF; color: #2563EB;">
                                <i class="bi bi-tv-fill"></i>
                            </div>
                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 fw-bold">Live Standalone</span>
                        </div>
                        <h4 class="fw-800 text-dark mb-2">1. Mode Layar TV Digital Dinding Masjid</h4>
                        <p class="text-muted mb-4" style="line-height: 1.75;">
                            Tampilan fullscreen khusus yang dapat dihubungkan ke Android TV Box, Smart TV, atau PC mini tanpa perlu membuka panel admin. Dilengkapi jam digital realtime sinkron, 5 waktu salat otomatis berbasis hisab astronomis Kemenag tanpa butuh koneksi API luar, hitung mundur iqamah, serta running text saldo kas &amp; pengumuman kajian.
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
                <div class="bento-card-clean">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon-clean" style="background: #FEF3C7; color: #D97706;">
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
                <div class="bento-card-clean">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon-clean" style="background: #ECFDF5; color: #059669;">
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
                <div class="bento-card-clean">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon-clean" style="background: #F3E8FF; color: #7C3AED;">
                                <i class="bi bi-wallet2"></i>
                            </div>
                            <span class="badge bg-purple-subtle text-dark border rounded-pill px-3 py-1 fw-bold">Integritas Data</span>
                        </div>
                        <h4 class="fw-800 text-dark mb-2">4. Mutasi Kas Atomik &amp; Buku Kas Multi-Wadah</h4>
                        <p class="text-muted mb-4" style="line-height: 1.75;">
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
                <div class="bento-card-clean">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon-clean" style="background: #F0FDF4; color: #16A34A;">
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
                <div class="bento-card-clean">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-icon-clean" style="background: #FFF1F2; color: #E11D48;">
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

<!-- 6. BENCHMARK TRANSPARANSI DATA PUBLIK (Format Terbuka & Bersih) -->
<section class="py-5" style="background: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4" data-animate>
            <div>
                <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-1 fw-bold small mb-2">
                    <i class="bi bi-graph-up-arrow me-1"></i> Benchmark Transparansi Data Publik
                </span>
                <h3 class="fw-900 text-dark mb-1">Pratinjau Pembukuan Kas Terverifikasi</h3>
                <p class="text-muted small mb-0">Contoh data transaksi riil dari basis data masjid yang dapat diakses publik tanpa login.</p>
            </div>
            <div>
                <a href="{{ route('transparency.index') }}" class="btn btn-outline-success rounded-pill fw-bold btn-sm px-4">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Buka Portal Transparansi Lengkap &rarr;
                </a>
            </div>
        </div>

        <div class="table-container-clean" data-animate>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-uppercase text-muted" style="font-size: 0.72rem; letter-spacing: 0.05em;">
                            <th class="ps-4">Tanggal</th>
                            <th>Wadah Kas</th>
                            <th>Uraian Transaksi</th>
                            <th>Kategori</th>
                            <th class="text-end pe-4">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions ?? [] as $trx)
                        <tr>
                            <td class="ps-4 font-monospace small text-muted">{{ optional($trx->transaction_date)->format('d/m/Y') ?? '01/11/2026' }}</td>
                            <td><span class="badge bg-light text-dark border">{{ optional($trx->cashBook)->name ?? 'Kas Utama' }}</span></td>
                            <td class="fw-bold text-dark">{{ $trx->description ?? 'Infaq Rutin Jamaah' }}</td>
                            <td><span class="badge bg-secondary-subtle text-secondary small">{{ optional($trx->category)->name ?? 'Infaq Umum' }}</span></td>
                            <td class="text-end pe-4 font-monospace fw-bold {{ ($trx->type ?? 'income') === 'income' ? 'text-success' : 'text-danger' }}">
                                {{ ($trx->type ?? 'income') === 'income' ? '+' : '-' }}Rp {{ number_format($trx->amount ?? 500000, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="ps-4 font-monospace small text-muted">01/11/2026</td>
                            <td><span class="badge bg-light text-dark border">Kas Operasional</span></td>
                            <td class="fw-bold text-dark">Infaq Tromol Kotak Jumat Utama</td>
                            <td><span class="badge bg-success-subtle text-success small">Infaq Jumat</span></td>
                            <td class="text-end pe-4 font-monospace fw-bold text-success">+Rp 4.850.000</td>
                        </tr>
                        <tr>
                            <td class="ps-4 font-monospace small text-muted">31/10/2026</td>
                            <td><span class="badge bg-light text-dark border">Kas Operasional</span></td>
                            <td class="fw-bold text-dark">Bisyarah Muballigh Kajian Subuh Ahad</td>
                            <td><span class="badge bg-danger-subtle text-danger small">Operasional Dakwah</span></td>
                            <td class="text-end pe-4 font-monospace fw-bold text-danger">-Rp 500.000</td>
                        </tr>
                        <tr>
                            <td class="ps-4 font-monospace small text-muted">30/10/2026</td>
                            <td><span class="badge bg-light text-dark border">Kas Anak Yatim</span></td>
                            <td class="fw-bold text-dark">Santunan Bulanan 15 Anak Yatim Binaan</td>
                            <td><span class="badge bg-warning-subtle text-warning small">Santunan Yatim</span></td>
                            <td class="text-end pe-4 font-monospace fw-bold text-danger">-Rp 4.500.000</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3 bg-light border-top d-flex justify-content-between align-items-center flex-wrap gap-2 text-muted small">
                <div>
                    <i class="bi bi-info-circle text-primary me-1"></i>
                    <em>Setiap masjid yang memasang SAF mengatur nomor rekening bank &amp; QRIS masing-masing secara privat di panel admin.</em>
                </div>
                <div class="fw-bold">
                    Total Transaksi Tercatat: <span class="text-dark">{{ $totalTransactions ?? 142 }} Mutasi</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. HOW IT WORKS: 3-STEP WORKFLOW -->
<section class="py-5" style="background: #F8FAF9; border-bottom: 1px solid #E2E8F0;">
    <div class="container py-4">
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
                <div class="p-4 rounded-4 bg-white border h-100 shadow-sm">
                    <div class="rounded-pill bg-dark text-white fw-bold d-inline-flex align-items-center justify-content-center mb-3" style="width: 36px; height: 36px; font-size: 1rem;">1</div>
                    <h5 class="fw-800 text-dark mb-2">Ambil Kode atau Minta Bantuan</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Clone repositori secara bebas di GitHub untuk dipasang di komputer sekretariat masjid (XAMPP/Docker/PHP), atau hubungi pengembang untuk pendampingan setup domain HTTPS dan cloud VPS.
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="p-4 rounded-4 bg-white border h-100 shadow-sm">
                    <div class="rounded-pill bg-success text-white fw-bold d-inline-flex align-items-center justify-content-center mb-3" style="width: 36px; height: 36px; font-size: 1rem;">2</div>
                    <h5 class="fw-800 text-dark mb-2">Personalisasi Data &amp; Wadah Kas</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Tentukan wadah kas (operasional, pembangunan, yatim), koordinat garis lintang &amp; bujur untuk hisab waktu salat otomatis, nomor rekening resmi, serta QRIS infaq masjid Anda.
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="p-4 rounded-4 bg-white border h-100 shadow-sm">
                    <div class="rounded-pill bg-warning text-dark fw-bold d-inline-flex align-items-center justify-content-center mb-3" style="width: 36px; height: 36px; font-size: 1rem;">3</div>
                    <h5 class="fw-800 text-dark mb-2">Tata Kelola Aktif &amp; Siap Dipakai</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Hubungkan layar Smart TV ke mode display masjid, cetak laporan rekap kas Jumat format A4, dan bagikan tautan transparansi kas real-time kepada seluruh jamaah.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 8. DUA PILIHAN IMPLEMENTASI (Jalur Mandiri vs Pendampingan Teknis) -->
<section class="py-5" style="background: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
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
                <div class="path-card-clean">
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
                <div class="path-card-clean featured">
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

<!-- 9. TANYA JAWAB UMUM (FAQ) -->
<section class="py-5" style="background: #F8FAF9; border-bottom: 1px solid #E2E8F0;">
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
                        Ya, <strong>SAF</strong> adalah perangkat lunak sumber terbuka (<em>open-source</em>) dengan <strong>Lisensi MIT</strong>. Takmir mana pun dapat mengunduh kode sumber, memasangnya di server sekretariat atau cloud, dan menggunakannya tanpa biaya royalti sepeser pun.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-question-circle-fill text-success me-2"></i>Bagaimana cara mengambil dan mengunduh source code aplikasi?</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Seluruh kode sumber disimpan secara terbuka di GitHub. Anda dapat membuka repositori <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" rel="noopener noreferrer" class="fw-bold text-success text-decoration-none">github.com/bipisurel-bps/Manajemen-Masjid-</a> untuk melakukan clone atau mengunduh arsip ZIP secara langsung.
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
                        Website ini tidak memuat rekening bank bawaan agar tidak membingungkan pengunjung. Setiap masjid yang memasang aplikasi ini dapat mengisi nama bank, nomor rekening, dan QRIS infaq masjid masing-masing melalui menu <strong>Pengaturan</strong> di panel admin.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 rounded-4 border bg-white h-100 shadow-sm">
                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-question-circle-fill text-success me-2"></i>Bagaimana cara mencoba aplikasi ini sekarang?</h6>
                    <p class="text-muted small mb-0" style="line-height: 1.65;">
                        Klik tombol <strong>Coba Demo Interaktif</strong> di halaman ini. Anda dapat masuk langsung dengan 1-klik sebagai Bendahara atau Super Admin tanpa registrasi untuk mencoba mencatat kas, mencetak rekap, atau melihat display TV.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 10. FINAL CALL TO ACTION BANNER (Executive Emerald & Pristine Contrast) -->
<section class="cta-banner-clean">
    <div class="container text-center position-relative py-4" data-animate>
        <span class="badge rounded-pill bg-white text-success px-3 py-1 mb-3 fw-bold text-uppercase" style="letter-spacing: 0.05em; font-size: 0.75rem;">
            Tertib &bull; Amanah &bull; Bersama &bull; Berkelanjutan
        </span>
        <h2 class="display-6 fw-900 mb-3 text-white" style="letter-spacing: -0.03em;">Mulai Modernisasi Tata Kelola Masjid Bersama SAF</h2>
        <p class="lead text-white-50 mx-auto mb-4" style="max-width: 650px; font-size: 1.15rem; color: #D1FAE5 !important;">
            Wujudkan transparansi keuangan yang amanah dan kedisiplinan operasional masjid modern yang profesional dengan sistem yang siap pakai, handal, dan mandiri.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <button type="button" class="btn btn-warning btn-lg rounded-pill fw-bold px-4 text-dark shadow" data-bs-toggle="modal" data-bs-target="#demoModal">
                <i class="bi bi-play-circle-fill fs-5 me-1"></i> Coba Demo Interaktif (1-Klik) <span aria-hidden="true">&nearr;</span>
            </button>
            <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" rel="noopener noreferrer" class="btn btn-outline-light btn-lg rounded-pill fw-bold px-4">
                <i class="bi bi-github fs-5 me-1"></i> Unduh di GitHub <span aria-hidden="true">&nearr;</span>
            </a>
            <a href="mailto:jaddadeveloper@gmail.com?subject=Konsultasi%20SAF%20Masjid" class="btn btn-outline-light btn-lg rounded-pill fw-bold px-4">
                <i class="bi bi-envelope-at fs-5 me-1"></i> jaddadeveloper@gmail.com
            </a>
        </div>
    </div>
</section>

<!-- 11. MODAL DEMO 1-KLIK (SANDBOX INTERAKTIF MULTI-ROLE) -->
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
function switchStudioTab(tab, btn) {
    document.getElementById('screen-tv').classList.add('d-none');
    document.getElementById('screen-kas').classList.add('d-none');
    document.getElementById('screen-rekap').classList.add('d-none');

    document.querySelectorAll('.pill-tab-btn').forEach(b => b.classList.remove('active'));
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
function updateStudioClock() {
    const now = new Date();
    const clockStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    const mockEl = document.getElementById('studioLiveClock');
    if (mockEl) {
        mockEl.innerText = clockStr;
    }
    const dateEl = document.getElementById('studioLiveDate');
    if (dateEl) {
        dateEl.innerText = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' });
    }
}

// Synthetic Audio Chime using Web Audio API
function playChime(freq = 880, duration = 0.3) {
    try {
        const AudioContext = window.AudioContext || window.webkitAudioContext;
        if (!AudioContext) return;
        const ctx = new AudioContext();
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.type = 'sine';
        osc.frequency.setValueAtTime(freq, ctx.currentTime);
        gain.gain.setValueAtTime(0.12, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + duration);
        osc.connect(gain);
        gain.connect(ctx.destination);
        osc.start();
        osc.stop(ctx.currentTime + duration);
    } catch (e) {
        // audio context blocked or unsupported, fail gracefully
    }
}

function simulateIqamahBeep() {
    playChime(587.33, 0.4); // D5
    setTimeout(() => playChime(880, 0.6), 250); // A5
    const lbl = document.getElementById('iqamahStatusLabel');
    if (lbl) {
        lbl.innerHTML = '<i class="bi bi-bell-fill text-danger me-1"></i> Waktu Shalat Tiba &bull; Masuk Shaf!';
        setTimeout(() => {
            lbl.innerHTML = '<i class="bi bi-hourglass-split text-warning me-1"></i> Hitung Mundur Iqamah';
        }, 6000);
    }
}

// Interactive Donation Simulation State
let currentSimAmount = 50000;
let totalBalanceState = {{ $initialBalance }};
let potOperasionalState = 24500000;
let potYatimState = 12250000;
let potRenovasiState = 12000000;

function selectSimAmount(amount, btn) {
    currentSimAmount = amount;
    document.querySelectorAll('.chip-btn-clean').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');
}

function formatRupiahJs(number) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
}

function executeDonationSimulation() {
    playChime(659.25, 0.2); // E5
    setTimeout(() => playChime(987.77, 0.4), 150); // B5

    totalBalanceState += currentSimAmount;
    const potType = document.getElementById('simPotSelect').value;

    if (potType === 'operasional') {
        potOperasionalState += currentSimAmount;
        document.getElementById('potOperasional').innerText = formatRupiahJs(potOperasionalState);
    } else if (potType === 'yatim') {
        potYatimState += currentSimAmount;
        document.getElementById('potYatim').innerText = formatRupiahJs(potYatimState);
    } else if (potType === 'renovasi') {
        potRenovasiState += currentSimAmount;
        document.getElementById('potRenovasi').innerText = formatRupiahJs(potRenovasiState);
    }

    const balEl = document.getElementById('liveBalanceAmount');
    if (balEl) {
        balEl.innerText = formatRupiahJs(totalBalanceState);
        balEl.style.transform = 'scale(1.06)';
        balEl.style.color = '#059669';
        setTimeout(() => {
            balEl.style.transform = 'scale(1)';
            balEl.style.color = '#0F172A';
        }, 400);
    }

    const feedbackEl = document.getElementById('simFeedbackNote');
    if (feedbackEl) {
        feedbackEl.innerHTML = '<span class="text-success fw-bold"><i class="bi bi-check-circle-fill"></i> +' + formatRupiahJs(currentSimAmount) + ' tercatat atomik!</span>';
        setTimeout(() => {
            feedbackEl.innerText = 'Pilih nominal • Klik catat';
        }, 4000);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    updateStudioClock();
    setInterval(updateStudioClock, 1000);
});
</script>
@endpush
