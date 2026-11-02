@extends('layouts.app')
@section('title', 'SAF — Sistem Operasi Manajemen Masjid Open Source (safmasjid.web.id)')

@section('content')
@php
    $masjidName = \App\Models\Setting::get('masjid_name', 'SAF');
    $initialBalance = $balance ?? 48750000;
@endphp

<!-- UI/UX PRO MAX DESIGN SYSTEM STYLES -->
<style>
    /* ── Ambient Colors & Design Tokens ── */
    :root {
        --saf-deep-emerald: #011A14;
        --saf-dark-emerald: #022C22;
        --saf-mid-emerald: #064E3B;
        --saf-forest: #065F46;
        --saf-neon-jade: #10B981;
        --saf-mint: #34D399;
        --saf-mint-soft: #A7F3D0;
        --saf-gold: #D97706;
        --saf-gold-bright: #F59E0B;
        --saf-gold-light: #FEF3C7;
        --saf-sand: #FAF9F6;
        --saf-slate-900: #0F172A;
        --saf-slate-800: #1E293B;
        --saf-slate-600: #475569;
        --saf-slate-400: #94A3B8;
        --saf-slate-200: #E2E8F0;
        --saf-slate-100: #F1F5F9;
        --saf-ease: cubic-bezier(0.16, 1, 0.3, 1);
        --saf-spring: cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* ── 1. Hero Section (Modern Executive Islamic Tech) ── */
    .hero-saf-pro {
        background: radial-gradient(130% 120% at 50% -10%, #03392E 0%, #02261E 40%, #01140F 100%);
        color: #F8FAFC;
        position: relative;
        overflow: hidden;
        padding: clamp(5rem, 8vw, 7.5rem) 0 clamp(4.5rem, 7vw, 6.5rem);
    }
    .hero-ambient-glow-1 {
        position: absolute;
        top: -140px;
        left: 45%;
        transform: translateX(-50%);
        width: 800px;
        height: 480px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.22) 0%, transparent 70%);
        filter: blur(60px);
        pointer-events: none;
        z-index: 0;
    }
    .hero-ambient-glow-2 {
        position: absolute;
        bottom: -60px;
        right: -80px;
        width: 500px;
        height: 380px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.12) 0%, transparent 70%);
        filter: blur(65px);
        pointer-events: none;
        z-index: 0;
    }
    .hero-pattern-overlay {
        position: absolute;
        inset: 0;
        background-image: 
            radial-gradient(rgba(52, 211, 153, 0.12) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(1, 26, 20, 0) 60%, rgba(1, 26, 20, 0.95) 100%);
        background-size: 32px 32px, 100% 100%;
        pointer-events: none;
        z-index: 0;
    }

    /* ── Eyebrow Badge ── */
    .hero-eyebrow-pro {
        display: inline-flex;
        align-items: center;
        gap: 0.65rem;
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        backdrop-filter: blur(8px);
        padding: 0.45rem 1.15rem;
        border-radius: 9999px;
        font-size: var(--text-xs);
        font-weight: 700;
        color: var(--saf-mint);
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    .hero-eyebrow-beacon {
        width: 8px;
        height: 8px;
        background: #10B981;
        border-radius: 50%;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: heroPulseBeacon 2s infinite;
    }
    @keyframes heroPulseBeacon {
        0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { box-shadow: 0 0 0 9px rgba(16, 185, 129, 0); }
        100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    /* ── Hero Typography ── */
    .hero-headline-pro {
        font-size: var(--text-4xl);
        font-weight: 900;
        line-height: 1.12;
        letter-spacing: -0.04em;
        margin-bottom: 1.5rem;
        color: #FFFFFF;
    }
    .hero-gradient-text {
        background: linear-gradient(135deg, #A7F3D0 0%, #34D399 50%, #F59E0B 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }
    .hero-description-pro {
        font-size: var(--text-lg);
        line-height: 1.7;
        color: #CBD5E1;
        max-width: 62ch;
        margin-bottom: 2rem;
    }

    /* ── Hero Buttons ── */
    .btn-saf-primary {
        display: inline-flex;
        align-items: center;
        gap: 0.65rem;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: #FFFFFF;
        font-weight: 700;
        font-size: var(--text-base);
        padding: 0.95rem 1.85rem;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 25px -4px rgba(16, 185, 129, 0.45);
        transition: all 0.25s var(--saf-ease);
        cursor: pointer;
        text-decoration: none;
    }
    .btn-saf-primary:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #34D399 0%, #059669 100%);
        color: #FFFFFF;
        box-shadow: 0 16px 32px -4px rgba(16, 185, 129, 0.55);
    }
    .btn-saf-outline {
        display: inline-flex;
        align-items: center;
        gap: 0.65rem;
        background: rgba(255, 255, 255, 0.06);
        color: #F1F5F9;
        font-weight: 700;
        font-size: var(--text-base);
        padding: 0.95rem 1.75rem;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(8px);
        transition: all 0.25s var(--saf-ease);
        cursor: pointer;
        text-decoration: none;
    }
    .btn-saf-outline:hover {
        background: rgba(255, 255, 255, 0.12);
        color: #FFFFFF;
        border-color: rgba(255, 255, 255, 0.35);
        transform: translateY(-2px);
    }

    /* ── Trust Signals ── */
    .trust-strip-pro {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        padding-top: 1.75rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 2rem;
    }
    .trust-item-pro {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: var(--text-xs);
        font-weight: 600;
        color: #94A3B8;
        letter-spacing: 0.02em;
    }
    .trust-item-pro i {
        color: var(--saf-mint);
        font-size: 1rem;
    }

    /* ── Interactive Studio Mockup Frame ── */
    .device-studio {
        background: #021713;
        border: 1px solid rgba(16, 185, 129, 0.25);
        border-radius: 20px;
        box-shadow: 0 25px 60px -10px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(255, 255, 255, 0.08);
        overflow: hidden;
        position: relative;
    }
    .studio-header {
        background: #01120F;
        padding: 0.85rem 1.25rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    .studio-dots {
        display: flex;
        gap: 6px;
    }
    .studio-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }
    .studio-tabs {
        display: flex;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 9999px;
        padding: 3px;
        gap: 3px;
    }
    .studio-tab-btn {
        background: transparent;
        border: none;
        color: #94A3B8;
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
    .studio-tab-btn.active {
        background: #10B981;
        color: #FFFFFF;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);
    }

    /* ── Mockup Screens ── */
    .screen-panel {
        min-height: 420px;
    }
    .prayer-chip {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 10px;
        padding: 0.65rem 0.5rem;
        text-align: center;
        transition: all 0.2s var(--saf-ease);
    }
    .prayer-chip.is-active {
        background: rgba(245, 158, 11, 0.15);
        border-color: #F59E0B;
        box-shadow: 0 0 15px rgba(245, 158, 11, 0.2);
    }
    .prayer-chip .prayer-name {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94A3B8;
        margin-bottom: 0.25rem;
    }
    .prayer-chip.is-active .prayer-name {
        color: #FBBF24;
    }
    .prayer-chip .prayer-time {
        font-size: 0.95rem;
        font-weight: 800;
        color: #FFFFFF;
        font-family: monospace;
    }

    /* ── Simulator Pot Cards ── */
    .sim-pot-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.2s var(--saf-ease);
    }
    .sim-pot-card:hover {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(16, 185, 129, 0.3);
    }
    .sim-chip-btn {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: #F1F5F9;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.35rem 0.65rem;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.15s;
    }
    .sim-chip-btn:hover, .sim-chip-btn.active {
        background: #10B981;
        border-color: #10B981;
        color: #FFFFFF;
    }

    /* ── A4 Sheet Preview ── */
    .a4-paper-preview {
        background: #FFFFFF;
        color: #0F172A;
        border-radius: 6px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.35);
        padding: 1.5rem;
        font-size: 0.8rem;
        line-height: 1.45;
        position: relative;
    }
    .a4-stamp {
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

    /* ── 2. Principles Strip (Marquee) ── */
    .principles-strip-pro {
        background: #01120F;
        border-top: 1px solid rgba(16, 185, 129, 0.2);
        border-bottom: 1px solid rgba(16, 185, 129, 0.2);
        padding: 0.95rem 0;
        overflow: hidden;
        white-space: nowrap;
        position: relative;
    }
    .marquee-track {
        display: inline-flex;
        gap: 2.5rem;
        animation: marqueeScroll 35s linear infinite;
        will-change: transform;
    }
    @keyframes marqueeScroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .marquee-item {
        font-size: 0.78rem;
        font-weight: 800;
        color: #34D399;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* ── 3. The 4 SAF Pillars (Deep Philosophy Section) ── */
    .filosofi-section-pro {
        background: radial-gradient(120% 120% at 50% 0%, #032E24 0%, #011A14 60%, #01120D 100%);
        color: #F8FAFC;
        padding: clamp(5rem, 8vw, 7.5rem) 0;
        position: relative;
        overflow: hidden;
    }
    .hadits-quote-pro {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(16, 185, 129, 0.25);
        border-radius: 20px;
        padding: clamp(2rem, 4vw, 3rem);
        margin-bottom: 3.5rem;
        backdrop-filter: blur(12px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        text-align: center;
        position: relative;
    }
    .arabic-calligraphy {
        font-family: 'Amiri', 'Traditional Arabic', serif;
        font-size: clamp(1.75rem, 3.5vw, 2.5rem);
        color: #FBBF24;
        direction: rtl;
        line-height: 1.8;
        margin-bottom: 1rem;
        text-shadow: 0 2px 10px rgba(245, 158, 11, 0.25);
    }
    .hadits-trans-text {
        font-size: var(--text-base);
        font-style: italic;
        color: #E2E8F0;
        max-width: 68ch;
        margin: 0 auto 0.75rem;
        line-height: 1.7;
    }
    .hadits-reference {
        font-size: var(--text-xs);
        font-weight: 700;
        color: var(--saf-mint);
        letter-spacing: 0.05em;
    }

    /* ── Pillar Cards ── */
    .pillar-card-pro {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 18px;
        padding: 2rem 1.65rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        transition: all 0.3s var(--saf-ease);
    }
    .pillar-card-pro:hover {
        transform: translateY(-6px);
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(16, 185, 129, 0.4);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5), 0 0 25px rgba(16, 185, 129, 0.15);
    }
    .pillar-num-watermark {
        position: absolute;
        top: -15px;
        right: 15px;
        font-size: 5rem;
        font-weight: 900;
        color: rgba(255, 255, 255, 0.03);
        line-height: 1;
        pointer-events: none;
        user-select: none;
        transition: color 0.3s;
    }
    .pillar-card-pro:hover .pillar-num-watermark {
        color: rgba(16, 185, 129, 0.08);
    }
    .pillar-arabic-chip {
        font-family: 'Amiri', 'Traditional Arabic', serif;
        font-size: 1.15rem;
        color: #FBBF24;
        display: inline-block;
        margin-bottom: 0.5rem;
    }
    .pillar-problem-solution {
        background: rgba(0, 0, 0, 0.35);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 1rem;
        font-size: 0.8rem;
        line-height: 1.6;
        margin-top: 1.25rem;
    }

    /* ── 4. Breathing Stats Section ── */
    .stat-strip-section {
        background: #FFFFFF;
        border-bottom: 1px solid var(--saf-slate-200);
        padding: 3.5rem 0;
    }
    .stat-pro-card {
        text-align: center;
        padding: 1.5rem 1rem;
        border-radius: 14px;
        transition: transform 0.2s;
    }
    .stat-pro-card:hover {
        transform: translateY(-3px);
    }
    .stat-pro-num {
        font-size: clamp(2.25rem, 4vw, 3.25rem);
        font-weight: 900;
        color: var(--saf-forest);
        letter-spacing: -0.04em;
        line-height: 1;
        margin-bottom: 0.5rem;
    }
    .stat-pro-title {
        font-size: 1rem;
        font-weight: 800;
        color: var(--saf-slate-900);
        margin-bottom: 0.35rem;
    }
    .stat-pro-text {
        font-size: 0.825rem;
        color: var(--saf-slate-600);
        line-height: 1.55;
        margin-bottom: 0;
    }

    /* ── 5. Bento Grid Capabilities ── */
    .bento-section-pro {
        background: #FAF9F6;
        padding: clamp(5rem, 8vw, 7rem) 0;
    }
    .bento-pro-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        padding: 2.25rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
        transition: all 0.3s var(--saf-ease);
        position: relative;
    }
    .bento-pro-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 35px -5px rgba(15, 23, 42, 0.08);
        border-color: #CBD5E1;
    }
    .bento-pro-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 1.25rem;
    }

    /* ── 6. Live Benchmark Table ── */
    .benchmark-table-wrapper {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    }
    .benchmark-badge-demo {
        background: rgba(245, 158, 11, 0.12);
        color: #B45309;
        border: 1px solid rgba(245, 158, 11, 0.3);
        padding: 0.35rem 0.85rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    /* ── 7. Paths Section ── */
    .path-pro-card {
        border-radius: 20px;
        padding: 2.5rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.3s;
    }
    .path-pro-card.self-serve {
        background: #FFFFFF;
        border: 2px solid #0F172A;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
    }
    .path-pro-card.managed {
        background: radial-gradient(120% 120% at 50% 0%, #03392E 0%, #02261E 60%, #011914 100%);
        color: #FFFFFF;
        border: 1px solid rgba(16, 185, 129, 0.3);
        box-shadow: 0 12px 35px rgba(2, 44, 34, 0.2);
    }

    /* ── 8. Call to Action ── */
    .cta-final-pro {
        background: radial-gradient(130% 120% at 50% 0%, #044E3F 0%, #022B22 50%, #011812 100%);
        color: #FFFFFF;
        padding: clamp(5rem, 8vw, 7rem) 0;
        position: relative;
        overflow: hidden;
    }
</style>

<!-- 1. HERO SECTION (Split Executive Islamic Tech) -->
<section class="hero-saf-pro">
    <div class="hero-ambient-glow-1"></div>
    <div class="hero-ambient-glow-2"></div>
    <div class="hero-pattern-overlay"></div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center g-5">
            <!-- Left Column: Value Proposition & Philosophy (58%) -->
            <div class="col-lg-7" data-animate>
                <!-- Eyebrow Pill with Pulsing Beacon -->
                <div class="hero-eyebrow-pro">
                    <span class="hero-eyebrow-beacon"></span>
                    <span>FILOSOFI SAF &bull; TERTIB &bull; AMANAH &bull; BERSAMA &bull; BERKELANJUTAN</span>
                </div>

                <!-- Main Title -->
                <h1 class="hero-headline-pro">
                    Sistem Operasi Manajemen Masjid Yang Menghidupkan<br>
                    <span class="hero-gradient-text">Tata Kelola Amanah.</span>
                </h1>

                <!-- Subtitle / Value Proposition with Authentic Philosophy -->
                <p class="hero-description-pro">
                    Dalam salat berjamaah, saf menggambarkan <strong>keteraturan, kebersamaan, dan kesetaraan</strong>. Setiap orang memiliki tempat dalam satu barisan, bergerak menuju tujuan yang sama. SAF menerjemahkan filosofi ini ke dalam pengelolaan masjid: <strong>Tertib</strong> administrasi &amp; kegiatan, <strong>Amanah</strong> dalam tata kelola dana &amp; aset, <strong>Bersama</strong> menghubungkan pengurus dan jamaah, serta <strong>Berkelanjutan</strong> agar riwayat pengelolaan tidak hilang antar-generasi.
                </p>

                <!-- Action CTAs -->
                <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                    <button type="button" class="btn-saf-primary" data-bs-toggle="modal" data-bs-target="#demoModal">
                        <i class="bi bi-play-circle-fill fs-5"></i> Coba Demo Interaktif (1-Klik) <span aria-hidden="true">&nearr;</span>
                    </button>
                    <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" rel="noopener noreferrer" class="btn-saf-outline">
                        <i class="bi bi-github fs-5"></i> Ambil Source Code Bebas <span aria-hidden="true">&nearr;</span>
                    </a>
                    <a href="{{ route('display.index') }}" target="_blank" class="btn-saf-outline">
                        <i class="bi bi-tv fs-5 text-warning"></i> Mode Layar TV &rarr;
                    </a>
                </div>

                <!-- Trust Signals Strip -->
                <div class="trust-strip-pro">
                    <div class="trust-item-pro">
                        <i class="bi bi-patch-check-fill"></i>
                        <span>100% Bebas Royalti (Lisensi MIT)</span>
                    </div>
                    <div class="trust-item-pro">
                        <i class="bi bi-wifi-off"></i>
                        <span>100% Offline-First (PWA Standalone)</span>
                    </div>
                    <div class="trust-item-pro">
                        <i class="bi bi-shield-lock-fill"></i>
                        <span>Data Tersimpan Privat di Server Masjid</span>
                    </div>
                    <div class="trust-item-pro">
                        <i class="bi bi-heart-fill text-warning"></i>
                        <span>Tanpa Biaya Langganan Bulanan</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Studio Mockup (42%) -->
            <div class="col-lg-5" data-animate>
                <div class="device-studio">
                    <!-- Window Header with Traffic Lights & Tab Switcher -->
                    <div class="studio-header">
                        <div class="studio-dots">
                            <span class="studio-dot" style="background: #FF5F56;"></span>
                            <span class="studio-dot" style="background: #FFBD2E;"></span>
                            <span class="studio-dot" style="background: #27C93F;"></span>
                        </div>
                        <div class="studio-tabs">
                            <button type="button" class="studio-tab-btn active" onclick="switchStudioTab('tv', this)">
                                <i class="bi bi-tv"></i> Layar TV
                            </button>
                            <button type="button" class="studio-tab-btn" onclick="switchStudioTab('kas', this)">
                                <i class="bi bi-wallet2"></i> Simulasi Kas
                            </button>
                            <button type="button" class="studio-tab-btn" onclick="switchStudioTab('rekap', this)">
                                <i class="bi bi-printer"></i> Rekap A4
                            </button>
                        </div>
                    </div>

                    <!-- SCREEN 1: LAYAR TV DIGITAL MASJID -->
                    <div id="screen-tv" class="screen-panel p-4">
                        <div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom border-secondary border-opacity-25">
                            <div>
                                <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle small fw-bold">
                                    <i class="bi bi-broadcast me-1"></i> Hisab Astronomis Kemenag
                                </span>
                            </div>
                            <div class="text-end">
                                <div class="font-monospace text-warning fw-bold fs-4" id="studioLiveClock">--:--:--</div>
                                <div class="text-white-50" style="font-size: 0.68rem;" id="studioLiveDate">Memuat tanggal...</div>
                            </div>
                        </div>

                        <!-- 6 Mini Prayer Tiles with Active State -->
                        <div class="row g-2 mb-3">
                            <div class="col-4">
                                <div class="prayer-chip">
                                    <div class="prayer-name">SUBUH</div>
                                    <div class="prayer-time">04:32</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="prayer-chip">
                                    <div class="prayer-name">TERBIT</div>
                                    <div class="prayer-time">05:48</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="prayer-chip">
                                    <div class="prayer-name">DZUHUR</div>
                                    <div class="prayer-time">11:45</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="prayer-chip is-active" id="prayerActiveChip">
                                    <div class="prayer-name">ASHAR &bull; AKTIF</div>
                                    <div class="prayer-time">15:02</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="prayer-chip">
                                    <div class="prayer-name">MAGHRIB</div>
                                    <div class="prayer-time">17:52</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="prayer-chip">
                                    <div class="prayer-name">ISYA</div>
                                    <div class="prayer-time">19:03</div>
                                </div>
                            </div>
                        </div>

                        <!-- Interactive Iqamah Simulator Strip -->
                        <div class="p-3 rounded-3 bg-black bg-opacity-40 border border-secondary border-opacity-25 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="text-white small fw-bold" id="iqamahStatusLabel">
                                    <i class="bi bi-hourglass-split text-warning me-1"></i> Hitung Mundur Iqamah
                                </span>
                                <span class="badge bg-warning text-dark font-monospace fw-bold" id="iqamahCountdownTimer">04:45</span>
                            </div>
                            <div class="progress" style="height: 6px; background: rgba(255,255,255,0.1);">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 65%;" id="iqamahProgressBar"></div>
                            </div>
                        </div>

                        <!-- Running Text Preview -->
                        <div class="p-2 rounded-2 bg-black bg-opacity-50 border border-secondary border-opacity-25 small text-truncate text-white-50 mb-3">
                            <i class="bi bi-megaphone-fill text-warning me-1"></i>
                            <span>SAF: Tertib Administrasi &bull; Amanah Pengelolaan &bull; Bersama Jamaah &bull; Berkelanjutan Antar-Generasi.</span>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-warning rounded-pill w-50 fw-bold" onclick="simulateIqamahBeep()">
                                <i class="bi bi-volume-up-fill me-1"></i> Uji Bunyi Adzan
                            </button>
                            <a href="{{ route('display.index') }}" target="_blank" class="btn btn-sm btn-success rounded-pill w-50 fw-bold">
                                <i class="bi bi-arrows-fullscreen me-1"></i> Buka Fullscreen &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- SCREEN 2: SIMULATOR INFAQ & MULTI-WADAH ATOMIK -->
                    <div id="screen-kas" class="screen-panel p-4 d-none">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-secondary border-opacity-25">
                            <div>
                                <span class="small text-white-50 fw-bold text-uppercase">Posisi Saldo Konsolidasi</span>
                                <div class="fs-4 fw-900 text-white font-monospace" id="liveBalanceAmount">
                                    Rp 48.750.000
                                </div>
                            </div>
                            <span class="badge bg-success-subtle text-success small rounded-pill px-3 py-1">
                                <i class="bi bi-shield-check me-1"></i> Mutex Database
                            </span>
                        </div>

                        <!-- 3 Wadah Kas Mini Summary -->
                        <div class="d-flex flex-column gap-2 mb-3">
                            <div class="sim-pot-card">
                                <div>
                                    <div class="text-white-50 small"><i class="bi bi-wallet2 text-success me-1"></i> Kas Operasional</div>
                                    <div class="fw-bold text-white small" id="potOperasional">Rp 24.500.000</div>
                                </div>
                                <span class="badge bg-success bg-opacity-25 text-success small">Aktif</span>
                            </div>
                            <div class="sim-pot-card">
                                <div>
                                    <div class="text-white-50 small"><i class="bi bi-heart-fill text-warning me-1"></i> Kas Anak Yatim &amp; Dhuafa</div>
                                    <div class="fw-bold text-white small" id="potYatim">Rp 12.250.000</div>
                                </div>
                                <span class="badge bg-warning bg-opacity-25 text-warning small">Terpisah</span>
                            </div>
                            <div class="sim-pot-card">
                                <div>
                                    <div class="text-white-50 small"><i class="bi bi-building text-info me-1"></i> Kas Renovasi Masjid</div>
                                    <div class="fw-bold text-white small" id="potRenovasi">Rp 12.000.000</div>
                                </div>
                                <span class="badge bg-info bg-opacity-25 text-info small">Terikat</span>
                            </div>
                        </div>

                        <!-- Interactive Simulation Controls -->
                        <div class="p-3 rounded-3 bg-black bg-opacity-40 border border-secondary border-opacity-25">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small text-white-50 fw-bold">Uji Simulasi Infaq Masuk:</span>
                                <span class="text-warning small" id="simFeedbackNote">Pilih nominal &bull; Klik simulasi</span>
                            </div>
                            <div class="d-flex gap-1 mb-2">
                                <button type="button" class="sim-chip-btn flex-fill active" onclick="selectSimAmount(50000, this)">+50rb</button>
                                <button type="button" class="sim-chip-btn flex-fill" onclick="selectSimAmount(100000, this)">+100rb</button>
                                <button type="button" class="sim-chip-btn flex-fill" onclick="selectSimAmount(250000, this)">+250rb</button>
                                <button type="button" class="sim-chip-btn flex-fill" onclick="selectSimAmount(500000, this)">+500rb</button>
                            </div>
                            <div class="row g-2">
                                <div class="col-7">
                                    <select class="form-select form-select-sm bg-dark text-white border-secondary" id="simPotSelect">
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

                    <!-- SCREEN 3: REKAP CETAK KAS JUMAT A4 -->
                    <div id="screen-rekap" class="screen-panel p-4 d-none">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-secondary border-opacity-25">
                            <span class="small text-white-50 fw-bold text-uppercase">Format Cetak Kas Jumat A4</span>
                            <span class="badge bg-warning-subtle text-warning small">Siap Cetak 1 Lembar</span>
                        </div>

                        <!-- Tactile Paper Preview -->
                        <div class="a4-paper-preview mb-3">
                            <div class="d-flex justify-content-between align-items-start border-bottom pb-2 mb-2">
                                <div>
                                    <div class="fw-bold text-uppercase" style="font-size: 0.75rem;">DEWAN KEMAKMURAN MASJID</div>
                                    <div class="text-muted" style="font-size: 0.65rem;">Laporan Keuangan Pekanan Sebelum Khutbah Jumat</div>
                                </div>
                                <div class="a4-stamp">Terverifikasi DKM</div>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom border-light" style="font-size: 0.72rem;">
                                <span>Saldo Awal Pekan Lalu:</span>
                                <strong class="font-monospace">Rp 45.200.000</strong>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom border-light text-success" style="font-size: 0.72rem;">
                                <span>Penerimaan Infaq Kotak &amp; Tromol:</span>
                                <strong class="font-monospace">+Rp 6.350.000</strong>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom border-light text-danger" style="font-size: 0.72rem;">
                                <span>Biaya Operasional, Listrik &amp; Marbot:</span>
                                <strong class="font-monospace">-Rp 2.800.000</strong>
                            </div>
                            <div class="d-flex justify-content-between pt-2 fw-bold" style="font-size: 0.8rem;">
                                <span>Saldo Akhir Kas Ditutup:</span>
                                <span class="font-monospace text-success">Rp 48.750.000</span>
                            </div>
                        </div>

                        <a href="{{ route('reports.rekap_jumat') }}" target="_blank" class="btn btn-warning btn-sm w-100 rounded-pill fw-bold text-dark">
                            <i class="bi bi-printer me-1"></i> Buka Format Siap Cetak A4 Asli &rarr;
                        </a>
                    </div>
                </div>

                <!-- Subtle Micro-Card Highlight -->
                <div class="p-3 rounded-3 mt-3 d-flex align-items-center gap-3 text-white-50 small border" style="background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.1) !important;">
                    <i class="bi bi-shield-check text-success fs-4"></i>
                    <div>
                        <strong class="text-white d-block">Database Mutex Transaction Guard</strong>
                        <span>Mencegah selisih pembukuan saat pencatatan bersama dan menjamin akurasi saldo amanah.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. PRINCIPLES RIBBON (Smooth Infinite Marquee) -->
<div class="principles-strip-pro">
    <div class="marquee-track">
        <span class="marquee-item"><i class="bi bi-journal-check"></i> TERTIB: ADMINISTRASI, KEUANGAN &amp; KEGIATAN TERCATAT</span>
        <span class="marquee-item"><i class="bi bi-shield-check"></i> AMANAH: PENGELOLAAN DANA &amp; ASET TRANSPARAN</span>
        <span class="marquee-item"><i class="bi bi-people-fill"></i> BERSAMA: PENGURUS, RELAWAN &amp; JAMAAH TERHUBUNG</span>
        <span class="marquee-item"><i class="bi bi-arrow-repeat"></i> BERKELANJUTAN: RIWAYAT PENGELOLAAN TIDAK HILANG</span>
        <span class="marquee-item"><i class="bi bi-code-slash"></i> 100% OPEN SOURCE &bull; LISENSI MIT</span>
        <span class="marquee-item"><i class="bi bi-wifi-off"></i> 100% OFFLINE-FIRST &bull; ZERO CDN DEPENDENCY</span>
        <!-- Duplicated items for smooth infinite loop -->
        <span class="marquee-item"><i class="bi bi-journal-check"></i> TERTIB: ADMINISTRASI, KEUANGAN &amp; KEGIATAN TERCATAT</span>
        <span class="marquee-item"><i class="bi bi-shield-check"></i> AMANAH: PENGELOLAAN DANA &amp; ASET TRANSPARAN</span>
        <span class="marquee-item"><i class="bi bi-people-fill"></i> BERSAMA: PENGURUS, RELAWAN &amp; JAMAAH TERHUBUNG</span>
        <span class="marquee-item"><i class="bi bi-arrow-repeat"></i> BERKELANJUTAN: RIWAYAT PENGELOLAAN TIDAK HILANG</span>
        <span class="marquee-item"><i class="bi bi-code-slash"></i> 100% OPEN SOURCE &bull; LISENSI MIT</span>
        <span class="marquee-item"><i class="bi bi-wifi-off"></i> 100% OFFLINE-FIRST &bull; ZERO CDN DEPENDENCY</span>
    </div>
</div>

<!-- 3. SECTION KHUSUS: FILOSOFI SAF (Spiritual & Governance Depth) -->
<section class="filosofi-section-pro">
    <div class="container position-relative">
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
        <div class="hadits-quote-pro" data-animate>
            <div class="arabic-calligraphy">
                سَوُّوا صُفُوفَكُمْ، فَإِنَّ تَسْوِيَةَ الصَّفِّ مِنْ تَمَامِ الصَّلَاةِ
            </div>
            <div class="hadits-trans-text">
                &ldquo;Luruskan dan rapatkan shaf-shaf kalian, karena sesungguhnya lurus dan rapatnya shaf adalah bagian dari kesempurnaan shalat.&rdquo;
            </div>
            <div class="hadits-reference">
                — H.R. Bukhari No. 723 &amp; Muslim No. 433
            </div>
            <div class="mt-3 pt-3 border-top border-secondary border-opacity-25 text-white-50 small" style="line-height: 1.65;">
                Filosofi kelurusan dan kerapatan barisan shalat kami terjemahkan ke dalam <strong class="text-white">empat pilar tata kelola masjid modern</strong>:
            </div>
        </div>

        <!-- Empat Pilar Filosofi SAF Grid (4 Kolom Desktop) -->
        <div class="row g-4" data-animate-stagger>
            <!-- Pilar 1: TERTIB -->
            <div class="col-xl-3 col-md-6">
                <div class="pillar-card-pro">
                    <span class="pillar-num-watermark">01</span>
                    <div>
                        <span class="pillar-arabic-chip">النِّظَامُ &bull; An-Nizham</span>
                        <h4 class="fw-800 text-white mb-1">1. TERTIB</h4>
                        <h6 class="text-success small fw-bold mb-3">Administrasi, Keuangan, Inventaris &amp; Kegiatan</h6>
                        <p class="text-white-50 small mb-0" style="line-height: 1.7;">
                            <strong class="text-white">Administrasi, keuangan, inventaris, dan kegiatan tercatat dengan baik.</strong> Seluruh surat masuk-keluar, barang inventaris wakaf, mutasi uang kas harian, serta agenda pengajian terdokumentasi rapi tanpa tercecer.
                        </p>
                    </div>
                    <div class="pillar-problem-solution">
                        <div class="text-danger-emphasis small mb-1"><strong>Masalah Klasik:</strong> Catatan fisik tercecer, jadwal ustadz tabrakan, barang wakaf raib tanpa inventaris.</div>
                        <div class="text-success small"><strong>Solusi SAF:</strong> Arsip digital persuratan, inventaris bernomor registrasi, dan penjadwalan kajian otomatis.</div>
                    </div>
                </div>
            </div>

            <!-- Pilar 2: AMANAH -->
            <div class="col-xl-3 col-md-6">
                <div class="pillar-card-pro">
                    <span class="pillar-num-watermark">02</span>
                    <div>
                        <span class="pillar-arabic-chip">الأَمَانَةُ &bull; Al-Amanah</span>
                        <h4 class="fw-800 text-white mb-1">2. AMANAH</h4>
                        <h6 class="text-info small fw-bold mb-3">Transparansi Dana &amp; Pertanggungjawaban Aset</h6>
                        <p class="text-white-50 small mb-0" style="line-height: 1.7;">
                            <strong class="text-white">Pengelolaan dana dan aset dilakukan secara transparan dan bertanggung jawab.</strong> Dana titipan umat dibuka secara akuntabel, bebas celah kebocoran, serta membangun rasa percaya jamaah kepada para pengurus DKM.
                        </p>
                    </div>
                    <div class="pillar-problem-solution">
                        <div class="text-danger-emphasis small mb-1"><strong>Masalah Klasik:</strong> Laporan kas terlambat berbulan-bulan, dana yatim tercampur dana operasional.</div>
                        <div class="text-info small"><strong>Solusi SAF:</strong> Kas multi-wadah atomik, portal transparansi publik realtime tanpa login, rekap cetak Jumat A4.</div>
                    </div>
                </div>
            </div>

            <!-- Pilar 3: BERSAMA -->
            <div class="col-xl-3 col-md-6">
                <div class="pillar-card-pro">
                    <span class="pillar-num-watermark">03</span>
                    <div>
                        <span class="pillar-arabic-chip">الجَمَاعَةُ &bull; Al-Jama'ah</span>
                        <h4 class="fw-800 text-white mb-1">3. BERSAMA</h4>
                        <h6 class="text-warning small fw-bold mb-3">Pengurus, Relawan &amp; Jamaah Saling Terhubung</h6>
                        <p class="text-white-50 small mb-0" style="line-height: 1.7;">
                            <strong class="text-white">Pengurus, relawan, dan jamaah saling terhubung.</strong> Sebagaimana barisan saf merapatkan bahu jamaah tanpa membedakan status sosial, sistem SAF menghubungkan takmir, marbot, dan warga sekitar masjid.
                        </p>
                    </div>
                    <div class="pillar-problem-solution">
                        <div class="text-danger-emphasis small mb-1"><strong>Masalah Klasik:</strong> Pengumuman hanya di mading kusam, jamaah pasif dan minim keterlibatan.</div>
                        <div class="text-warning small"><strong>Solusi SAF:</strong> Display TV dinding masjid, pengumuman online, dan pengingat WhatsApp H-2 muballigh.</div>
                    </div>
                </div>
            </div>

            <!-- Pilar 4: BERKELANJUTAN -->
            <div class="col-xl-3 col-md-6">
                <div class="pillar-card-pro">
                    <span class="pillar-num-watermark">04</span>
                    <div>
                        <span class="pillar-arabic-chip">الإِسْتِمْرَارُ &bull; Al-Istimrar</span>
                        <h4 class="fw-800 text-white mb-1">4. BERKELANJUTAN</h4>
                        <h6 class="text-primary-emphasis small fw-bold mb-3">Riwayat Pengelolaan Aman Antar-Generasi</h6>
                        <p class="text-white-50 small mb-0" style="line-height: 1.7;">
                            <strong class="text-white">Pergantian kepengurusan tidak membuat data dan riwayat pengelolaan hilang.</strong> Solusi tuntas atas problematika regenerasi takmir, di mana riwayat pembukuan dan aset tetap abadi tersimpan dalam database digital.
                        </p>
                    </div>
                    <div class="pillar-problem-solution">
                        <div class="text-danger-emphasis small mb-1"><strong>Masalah Klasik:</strong> Ganti pengurus ganti buku kas, riwayat renovasi masa lalu musnah tak terlacak.</div>
                        <div class="text-primary-emphasis small"><strong>Solusi SAF:</strong> Database mandiri permanen, ekspor arsip Excel/PDF, dan transfer hak akses mulus.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. BREATHING SECTION: DAMPAK & STATISTIK KUNCI -->
<section class="stat-strip-section">
    <div class="container">
        <div class="row g-4 justify-content-center" data-animate-stagger>
            <div class="col-6 col-lg-3">
                <div class="stat-pro-card">
                    <div class="stat-pro-num">Rp 0</div>
                    <div class="stat-pro-title">Bebas Royalti</div>
                    <p class="stat-pro-text">Lisensi MIT 100% open-source, bebas dipakai dan dimodifikasi tanpa pungutan biaya lisensi.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-pro-card">
                    <div class="stat-pro-num">100%</div>
                    <div class="stat-pro-title">Offline-First</div>
                    <p class="stat-pro-text">Hisab astronomis lokal resmi Kemenag RI dan PWA Service Worker tetap menyala saat internet padam.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-pro-card">
                    <div class="stat-pro-num">4 Pilar</div>
                    <div class="stat-pro-title">Tata Kelola SAF</div>
                    <p class="stat-pro-text">Tertib administrasi, Amanah dana umat, Bersama jamaah, dan Berkelanjutan lintas kepengurusan.</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-pro-card">
                    <div class="stat-pro-num">1-Klik</div>
                    <div class="stat-pro-title">Sandbox Demo</div>
                    <p class="stat-pro-text">Uji coba langsung sebagai bendahara atau super admin dengan data contoh terisolasi tanpa registrasi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. BENTO GRID CAPABILITIES (6 Fitur Inti Modern) -->
<section class="bento-section-pro">
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
                <div class="bento-pro-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-pro-icon" style="background: #EFF6FF; color: #2563EB;">
                                <i class="bi bi-tv-fill"></i>
                            </div>
                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 fw-bold">Live Standalone</span>
                        </div>
                        <h4 class="fw-800 text-dark mb-2">1. Mode Layar TV Digital Dinding Masjid</h4>
                        <p class="text-muted mb-4" style="line-height: 1.7;">
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
                <div class="bento-pro-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-pro-icon" style="background: #FEF3C7; color: #D97706;">
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
                <div class="bento-pro-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-pro-icon" style="background: #ECFDF5; color: #059669;">
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
                <div class="bento-pro-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-pro-icon" style="background: #F3E8FF; color: #7C3AED;">
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
                <div class="bento-pro-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-pro-icon" style="background: #F0FDF4; color: #16A34A;">
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
                <div class="bento-pro-card">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="bento-pro-icon" style="background: #FFF1F2; color: #E11D48;">
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

<!-- 6. BENCHMARK TRANSPARANSI DATA PUBLIK (Format Terbuka ala Sistem Akuntansi Sekolah) -->
<section class="py-5" style="background: #FFFFFF; border-top: 1px solid #E2E8F0; border-bottom: 1px solid #E2E8F0;">
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4" data-animate>
            <div>
                <span class="benchmark-badge-demo mb-2">
                    <i class="bi bi-graph-up-arrow"></i> Benchmark Transparansi Data Publik
                </span>
                <h3 class="fw-900 text-dark mb-1">Pratinjau Pembukuan Kas Terverifikasi</h3>
                <p class="text-muted small mb-0">Contoh data transaksi riil dari basis data masjid yang dapat diakses publik tanpa login.</p>
            </div>
            <div>
                <a href="{{ route('transparency.index') }}" class="btn btn-outline-success rounded-pill fw-bold btn-sm px-4">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Portal Transparansi Lengkap &rarr;
                </a>
            </div>
        </div>

        <div class="benchmark-table-wrapper" data-animate>
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
<section class="py-5" style="background: #FAF9F6;">
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
                <div class="path-pro-card self-serve">
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
                <div class="path-pro-card managed">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge bg-success text-white rounded-pill px-3 py-1 fw-bold">Pendampingan Teknis</span>
                            <span class="text-warning fw-bold small"><i class="bi bi-heart-pulse-fill me-1"></i> Siap Membantu</span>
                        </div>
                        <h3 class="fw-800 text-white mb-2">Konsultasi &amp; Bantuan Pengembang</h3>
                        <p class="text-white-50 mb-4" style="line-height: 1.65;">
                            Cocok untuk DKM yang ingin langsung pakai tanpa repot konfigurasi server. Kami siap membantu setup domain HTTPS, instalasi display TV, serta pengenalan fitur untuk bendahara masjid.
                        </p>
                        <ul class="list-unstyled text-white-50 small mb-4 d-flex flex-column gap-2">
                            <li><i class="bi bi-check2 text-warning me-2 fw-bold"></i> Konsultasi perencanaan hardware TV box &amp; koneksi layar masjid</li>
                            <li><i class="bi bi-check2 text-warning me-2 fw-bold"></i> Bantuan migrasi data kas lama dari spreadsheet Excel</li>
                            <li><i class="bi bi-check2 text-warning me-2 fw-bold"></i> Panduan langsung dari <strong>Jadda Developer</strong></li>
                            <li><i class="bi bi-check2 text-warning me-2 fw-bold"></i> Kontak resmi tunggal: <code>jaddadeveloper@gmail.com</code></li>
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
<section class="py-5" style="background: var(--saf-sand); border-top: 1px solid var(--saf-slate-200); border-bottom: 1px solid var(--saf-slate-200);">
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

<!-- 10. FINAL CALL TO ACTION BANNER -->
<section class="cta-final-pro">
    <div class="container text-center position-relative py-4" data-animate>
        <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-3 fw-bold text-uppercase" style="letter-spacing: 0.05em; font-size: 0.72rem;">
            Tertib &bull; Amanah &bull; Bersama &bull; Berkelanjutan
        </span>
        <h2 class="display-6 fw-900 mb-3" style="letter-spacing: -0.03em;">Mulai Modernisasi Tata Kelola Masjid Bersama SAF</h2>
        <p class="lead opacity-90 mx-auto mb-4" style="max-width: 650px; font-size: 1.15rem;">
            Wujudkan transparansi keuangan yang amanah dan kedisiplinan operasional masjid modern yang profesional dengan sistem yang siap pakai, handal, dan mandiri.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <button type="button" class="btn-saf-primary" data-bs-toggle="modal" data-bs-target="#demoModal">
                <i class="bi bi-play-circle-fill fs-5"></i> Coba Demo Interaktif (1-Klik) <span aria-hidden="true">&nearr;</span>
            </button>
            <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" rel="noopener noreferrer" class="btn-saf-outline">
                <i class="bi bi-github fs-5"></i> Unduh di GitHub <span aria-hidden="true">&nearr;</span>
            </a>
            <a href="mailto:jaddadeveloper@gmail.com?subject=Konsultasi%20SAF%20Masjid" class="btn-saf-outline">
                <i class="bi bi-envelope-at fs-5"></i> jaddadeveloper@gmail.com
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

    document.querySelectorAll('.studio-tab-btn').forEach(b => b.classList.remove('active'));
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
        gain.gain.setValueAtTime(0.15, ctx.currentTime);
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
    document.querySelectorAll('.sim-chip-btn').forEach(b => b.classList.remove('active'));
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
        balEl.style.transform = 'scale(1.08)';
        balEl.style.color = '#34D399';
        setTimeout(() => {
            balEl.style.transform = 'scale(1)';
            balEl.style.color = '#FFFFFF';
        }, 400);
    }

    const feedbackEl = document.getElementById('simFeedbackNote');
    if (feedbackEl) {
        feedbackEl.innerHTML = '<span class="text-success fw-bold"><i class="bi bi-check-circle-fill"></i> +' + formatRupiahJs(currentSimAmount) + ' tercatat atomik!</span>';
        setTimeout(() => {
            feedbackEl.innerText = 'Pilih nominal • Klik simulasi';
        }, 4000);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    updateStudioClock();
    setInterval(updateStudioClock, 1000);
});
</script>
@endpush
