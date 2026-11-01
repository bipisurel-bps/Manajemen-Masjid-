@extends('layouts.app')
@section('title', 'SAF — Sistem Operasi Manajemen Masjid Open Source (safmasjid.web.id)')

@section('content')
@php
    $masjidName = \App\Models\Setting::get('masjid_name', 'SAF');
@endphp

<!-- Custom Premium Styles for SAF Product Landing Page -->
<style>
    /* ── Luxury Deep-Emerald & Gold Palette ── */
    .hero-saf {
        background: radial-gradient(circle at 50% -10%, #064E3B 0%, #022C22 50%, #011C16 100%);
        color: #F8FAFC;
        position: relative;
        overflow: hidden;
        padding: 5rem 0 4.5rem;
    }
    .hero-glow-1 {
        position: absolute;
        top: -160px;
        left: 50%;
        transform: translateX(-50%);
        width: 850px;
        height: 480px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.28) 0%, transparent 70%);
        pointer-events: none;
        filter: blur(50px);
    }
    .hero-glow-2 {
        position: absolute;
        bottom: 40px;
        right: -80px;
        width: 520px;
        height: 380px;
        background: radial-gradient(circle, rgba(217, 119, 6, 0.15) 0%, transparent 70%);
        pointer-events: none;
        filter: blur(60px);
    }
    .hero-grid-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
        background-size: 30px 30px;
        pointer-events: none;
        mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 45%, rgba(0,0,0,0) 100%);
        -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 45%, rgba(0,0,0,0) 100%);
    }

    .hero-eyebrow {
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
        padding: 0.45rem 1.1rem;
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
        margin-bottom: 1.35rem;
    }
    @media (max-width: 991.98px) {
        .hero-headline { font-size: 2.5rem; }
    }
    .hero-gradient-text {
        background: linear-gradient(135deg, #34D399 0%, #A7F3D0 45%, #FBBF24 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }
    .hero-description {
        font-size: 1.15rem;
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
        font-size: 1rem;
        padding: 0.875rem 1.75rem;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.45);
        transition: all 0.25s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-hero-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px -5px rgba(16, 185, 129, 0.55);
        color: #fff;
    }
    .btn-hero-github {
        background: rgba(255, 255, 255, 0.1);
        color: #F8FAFC;
        font-weight: 600;
        font-size: 1rem;
        padding: 0.875rem 1.5rem;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.22);
        backdrop-filter: blur(8px);
        transition: all 0.25s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-hero-github:hover {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        transform: translateY(-2px);
    }
    .btn-hero-textlink {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: color 0.2s;
    }
    .btn-hero-textlink:hover {
        color: #34D399;
    }

    /* ── Audience Ribbon ── */
    .audience-ribbon {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 0.85rem 1.25rem;
        margin-top: 1.5rem;
        max-width: 620px;
    }
    .audience-ribbon .star {
        color: #FBBF24;
        font-size: 1.1rem;
        line-height: 1;
    }
    .audience-ribbon p {
        font-size: 0.85rem;
        line-height: 1.45;
        margin: 0;
        color: rgba(255, 255, 255, 0.85);
    }

    /* ── Principles Strip ── */
    .principles-strip {
        background: #021C16;
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
        font-size: 0.78rem;
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

    /* ── Interactive Workspace Mockup ── */
    .device-mockup {
        background: #0B1916;
        border: 1px solid rgba(255, 255, 255, 0.14);
        border-radius: 20px;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.7), 0 0 40px rgba(16, 185, 129, 0.12);
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

    /* ── Filosofi SAF Section Cards ── */
    .filosofi-section {
        background: radial-gradient(circle at 50% 0%, #03251E 0%, #011712 100%);
        color: #F8FAFC;
        padding: 6rem 0 5.5rem;
        position: relative;
    }
    .hadits-quote-box {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(16, 185, 129, 0.25);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        max-width: 820px;
        margin: 0 auto 4rem;
        text-align: center;
        position: relative;
    }
    .arabic-text {
        font-family: 'Amiri', 'Traditional Arabic', serif;
        font-size: 1.85rem;
        line-height: 1.8;
        color: #A7F3D0;
        margin-bottom: 1rem;
    }
    .hadits-translation {
        font-size: 1.05rem;
        line-height: 1.65;
        color: rgba(241, 245, 249, 0.85);
        font-style: italic;
    }
    .hadits-narrator {
        font-size: 0.82rem;
        color: #FBBF24;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-top: 0.75rem;
    }

    .pillar-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 2.25rem 2rem;
        height: 100%;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
    }
    .pillar-card:hover {
        transform: translateY(-6px);
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(16, 185, 129, 0.4);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.6);
    }
    .pillar-num {
        font-size: 3rem;
        font-weight: 900;
        line-height: 1;
        opacity: 0.12;
        position: absolute;
        top: 1.5rem;
        right: 1.75rem;
        color: #fff;
    }
    .pillar-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
    }

    /* ── Bento Grid ── */
    .bento-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        padding: 2.25rem 2rem;
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

    /* ── Two Adoption Paths ── */
    .path-card {
        border-radius: 20px;
        padding: 2.5rem 2rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.25s ease;
    }
    .path-card.self-host {
        background: #FFFFFF;
        border: 2px solid #E2E8F0;
    }
    .path-card.self-host:hover {
        border-color: #10B981;
        box-shadow: 0 15px 35px -5px rgba(16, 185, 129, 0.15);
    }
    .path-card.consult {
        background: #F0FDF4;
        border: 2px solid #BBF7D0;
    }
    .path-card.consult:hover {
        border-color: #059669;
        box-shadow: 0 15px 35px -5px rgba(5, 150, 105, 0.15);
    }

    /* ── Floating Highlight Badge ── */
    .floating-note {
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 14px;
        padding: 0.85rem 1.25rem;
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 0.85rem;
        margin-top: 1rem;
    }
    .floating-note i {
        color: #34D399;
        font-size: 1.25rem;
    }
    .floating-note b {
        color: #F8FAFC;
        font-size: 0.88rem;
        display: block;
    }
    .floating-note small {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.75rem;
    }
</style>

<!-- 1. HERO SECTION -->
<section class="hero-saf">
    <div class="hero-glow-1"></div>
    <div class="hero-glow-2"></div>
    <div class="hero-grid-pattern"></div>

    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <!-- Eyebrow Badge -->
                <div class="hero-eyebrow shadow-sm">
                    <span class="hero-badge-dot"></span>
                    <span>FILOSOFI SAF: LURUS &bull; RAPAT &bull; TERATUR &bull; safmasjid.web.id</span>
                </div>

                <!-- Main Title -->
                <h1 class="hero-headline">
                    Sistem operasi yang merapikan<br>
                    <span class="hero-gradient-text">tata kelola masjid Anda.</span>
                </h1>

                <!-- Subtitle / Value Proposition -->
                <p class="hero-description">
                    Mengadopsi filosofi luhur shaf shalat: <strong>Lurus</strong> dalam transparansi kas umat, <strong>Rapat</strong> tanpa celah kebocoran dana, dan <strong>Teratur</strong> dalam disiplin waktu ibadah. Dari pembukuan kas multi-wadah atomik, layar TV hisab Kemenag otomatis, portal transparansi jamaah, hingga rekap kas Jumat format A4 siap cetak.
                </p>

                <!-- Primary CTAs -->
                <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                    <button type="button" class="btn-hero-primary" data-bs-toggle="modal" data-bs-target="#demoModal">
                        <i class="bi bi-play-circle-fill fs-5"></i> Coba Demo Aplikasi <span aria-hidden="true">&nearr;</span>
                    </button>
                    <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" rel="noopener noreferrer" class="btn-hero-github">
                        <i class="bi bi-github fs-5"></i> Ambil Source Code di GitHub <span aria-hidden="true">&nearr;</span>
                    </a>
                    <a href="{{ route('login') }}" class="btn-hero-textlink ms-md-2">
                        Masuk ke akun <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>

                <!-- Microcopy -->
                <p class="text-white-50 small mb-0">
                    <i class="bi bi-check2-circle text-success me-1"></i> Demo hanya-baca &bull; Data ilustrasi di database terpisah &bull; 100% Bebas Royalti &bull; Lisensi MIT
                </p>

                <!-- Audience Callout -->
                <div class="audience-ribbon">
                    <span class="star" aria-hidden="true">&#10035;</span>
                    <p>
                        <strong>Dirancang untuk:</strong> Dewan Kemakmuran Masjid (DKM), Takmir, Bendahara Masjid Jami', Masjid Raya, Musholla Perumahan, dan Yayasan Islam di seluruh Indonesia.
                    </p>
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
                            <button type="button" class="mockup-tab-btn active" onclick="switchMockupTab('tv', this)">
                                <i class="bi bi-tv me-1"></i> Layar TV
                            </button>
                            <button type="button" class="mockup-tab-btn" onclick="switchMockupTab('kas', this)">
                                <i class="bi bi-wallet2 me-1"></i> Transparansi
                            </button>
                            <button type="button" class="mockup-tab-btn" onclick="switchMockupTab('rekap', this)">
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
                                    <div class="text-muted" style="font-size: 0.65rem;">TERBIT</div>
                                    <div class="fw-bold text-white small" id="mock-terbit">05:48</div>
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
                                    <div class="fw-bold text-white small" id="mock-maghrib">17:52</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 rounded-2 bg-dark bg-opacity-50 border border-secondary border-opacity-25">
                                    <div class="text-muted" style="font-size: 0.65rem;">ISYA</div>
                                    <div class="fw-bold text-white small" id="mock-isya">19:03</div>
                                </div>
                            </div>
                        </div>

                        <!-- Running Text Preview -->
                        <div class="p-2 rounded-2 bg-black bg-opacity-40 border border-secondary border-opacity-25 small text-truncate text-white-50">
                            <i class="bi bi-megaphone-fill text-warning me-1"></i>
                            <span>SAF: Luruskan dan rapatkan shaf shalat, luruskan dan rapatkan pembukuan amanah umat.</span>
                        </div>
                    </div>

                    <!-- SCREEN 2: KAS & TRANSPARANSI -->
                    <div id="screen-kas" class="p-4 d-none" style="background: #0B1916;">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-secondary border-opacity-25">
                            <span class="small text-muted fw-bold text-uppercase">Posisi Kas Masjid (Ilustrasi)</span>
                            <span class="badge bg-success-subtle text-success small">Realtime Mutex</span>
                        </div>
                        <div class="mb-3">
                            <div class="text-white-50 small">Total Saldo Konsolidasi:</div>
                            <h3 class="fw-900 text-white mb-0">{{ \App\Helpers\FormatHelper::formatRupiah($balance ?? 48750000) }}</h3>
                        </div>
                        <div class="p-2 rounded-3 bg-dark bg-opacity-50 border border-secondary border-opacity-25 mb-2 small d-flex justify-content-between">
                            <span><i class="bi bi-wallet text-success me-1"></i> Kas Operasional</span>
                            <strong class="text-white">Rp 24.500.000</strong>
                        </div>
                        <div class="p-2 rounded-3 bg-dark bg-opacity-50 border border-secondary border-opacity-25 mb-2 small d-flex justify-content-between">
                            <span><i class="bi bi-heart text-warning me-1"></i> Kas Yatim &amp; Dhuafa</span>
                            <strong class="text-white">Rp 12.250.000</strong>
                        </div>
                        <div class="p-2 rounded-3 bg-dark bg-opacity-50 border border-secondary border-opacity-25 small d-flex justify-content-between">
                            <span><i class="bi bi-building text-info me-1"></i> Kas Renovasi</span>
                            <strong class="text-white">Rp 12.000.000</strong>
                        </div>
                    </div>

                    <!-- SCREEN 3: REKAP CETAK A4 -->
                    <div id="screen-rekap" class="p-4 d-none" style="background: #0B1916;">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-secondary border-opacity-25">
                            <span class="small text-muted fw-bold text-uppercase">Rekap Kas Jumat Format A4</span>
                            <span class="badge bg-warning-subtle text-warning small">Siap Cetak 1 Lembar</span>
                        </div>
                        <p class="small text-white-50 mb-3" style="line-height: 1.5;">
                            Tata letak dirancang presisi untuk dicetak langsung pada selembar kertas A4 tanpa terpotong, memuat ringkasan saldo awal pekan, mutasi penerimaan infaq tromol, belanja operasional, dan kolom tanda tangan DKM.
                        </p>
                        <a href="{{ route('reports.rekap_jumat') }}" target="_blank" class="btn btn-warning btn-sm w-100 rounded-pill fw-bold text-dark">
                            <i class="bi bi-printer me-1"></i> Buka Format Siap Cetak A4 &rarr;
                        </a>
                    </div>
                </div>

                <div class="floating-note">
                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                    <div>
                        <b>Mutasi tercatat otomatis dalam transaksi basis data atomik.</b>
                        <small>Takmir tidak perlu lagi rumus pembukuan rumit.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. PRINCIPLES STRIP -->
<div class="principles-strip">
    <div class="container">
        <div class="principles-container">
            <span><i class="bi bi-arrow-right-circle"></i> LURUS (TRANSPARANSI JAMAAH)</span>
            <span><i class="bi bi-shield-check"></i> RAPAT (AKUNTABILITAS ATOMIK)</span>
            <span><i class="bi bi-clock-history"></i> TERATUR (DISIPLIN WAKTU &amp; TV)</span>
            <span><i class="bi bi-code-slash"></i> OPEN SOURCE &bull; LISENSI MIT</span>
        </div>
    </div>
</div>

<!-- 3. SECTION KHUSUS: FILOSOFI SAF -->
<section class="filosofi-section">
    <div class="container">
        <div class="text-center mb-4">
            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-2 fw-bold text-uppercase" style="letter-spacing: 0.08em; font-size: 0.75rem;">
                Filosofi Spiritual &amp; Tata Kelola
            </span>
            <h2 class="display-6 fw-900 text-white" style="letter-spacing: -0.03em;">Mengapa Bernama SAF?</h2>
            <p class="text-white-50 mx-auto lead" style="max-width: 680px; font-size: 1.1rem;">
                Dari kesempurnaan barisan shalat berjamaah menuju tata kelola rumah ibadah yang amanah, bersih, dan profesional.
            </p>
        </div>

        <!-- Hadits Kutipan Barisan Shaf -->
        <div class="hadits-quote-box">
            <div class="arabic-text">
                سَوُّوا صُفُوفَكُمْ، فَإِنَّ تَسْوِيَةَ الصَّفِّ مِنْ تَمَامِ الصَّلَاةِ
            </div>
            <div class="hadits-translation">
                &ldquo;Luruskan dan rapatkan shaf-shaf kalian, karena sesungguhnya lurus dan rapatnya shaf adalah bagian dari kesempurnaan shalat.&rdquo;
            </div>
            <div class="hadits-narrator">
                — H.R. Bukhari No. 723 &amp; Muslim No. 433
            </div>
        </div>

        <!-- Tiga Pilar Filosofi SAF Grid -->
        <div class="row g-4">
            <!-- Pilar 1: LURUS -->
            <div class="col-lg-4">
                <div class="pillar-card">
                    <span class="pillar-num">01</span>
                    <div class="pillar-icon" style="background: rgba(16, 185, 129, 0.15); color: #34D399;">
                        <i class="bi bi-arrow-right-circle-fill"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success small rounded-pill px-3 py-1 fw-bold text-uppercase mb-2">
                        الإِسْتِوَاءُ &bull; Al-Istiwa'
                    </span>
                    <h3 class="fw-800 text-white mb-2">1. LURUS</h3>
                    <h6 class="text-success small fw-bold mb-3">Transparansi Mutlak &amp; Kejujuran Terbuka</h6>
                    <p class="text-white-50 small mb-4" style="line-height: 1.7;">
                        Shaf yang lurus melambangkan niat yang tulus dan hati yang bersih di hadapan Allah. Pengurus masjid wajib mengelola dana titipan umat secara jujur, lurus, dan transparan tanpa ada yang disembunyikan.
                    </p>
                    <div class="p-3 rounded-3 bg-black bg-opacity-30 border border-secondary border-opacity-25 small text-white-50">
                        <strong class="text-white d-block mb-1"><i class="bi bi-check2 text-success me-1"></i> Penerapan Sistem:</strong>
                        Portal transparansi publik real-time (dapat dicek jamaah tanpa login), grafik mutasi bulanan, dan rekap cetak A4 yang ditandatangani DKM setiap Jumat.
                    </div>
                </div>
            </div>

            <!-- Pilar 2: RAPAT -->
            <div class="col-lg-4">
                <div class="pillar-card">
                    <span class="pillar-num">02</span>
                    <div class="pillar-icon" style="background: rgba(59, 130, 246, 0.15); color: #60A5FA;">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <span class="badge bg-primary-subtle text-primary small rounded-pill px-3 py-1 fw-bold text-uppercase mb-2">
                        التَّرَاصُّ &bull; At-Taraash
                    </span>
                    <h3 class="fw-800 text-white mb-2">2. RAPAT</h3>
                    <h6 class="text-primary small fw-bold mb-3">Akuntabilitas Atomik &amp; Tanpa Celah Kebocoran</h6>
                    <p class="text-white-50 small mb-4" style="line-height: 1.7;">
                        Shaf yang rapat menutup celah agar setan tidak dapat masuk mengganggu. Dalam pembukuan masjid, tidak boleh ada celah kebocoran dana atau selisih satu rupiah pun antara fisik kas dan catatan buku.
                    </p>
                    <div class="p-3 rounded-3 bg-black bg-opacity-30 border border-secondary border-opacity-25 small text-white-50">
                        <strong class="text-white d-block mb-1"><i class="bi bi-check2 text-primary me-1"></i> Penerapan Sistem:</strong>
                        Mutasi kas dibungkus transaksi database atomik (DB Mutex). Dilengkapi pemisahan buku kas multi-wadah (Operasional, Pembangunan, Yatim, ZISWAF) agar dana tidak bercampur.
                    </div>
                </div>
            </div>

            <!-- Pilar 3: TERATUR -->
            <div class="col-lg-4">
                <div class="pillar-card">
                    <span class="pillar-num">03</span>
                    <div class="pillar-icon" style="background: rgba(245, 158, 11, 0.15); color: #FBBF24;">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning small rounded-pill px-3 py-1 fw-bold text-uppercase mb-2">
                        النِّظَامُ &bull; An-Nizham
                    </span>
                    <h3 class="fw-800 text-white mb-2">3. TERATUR</h3>
                    <h6 class="text-warning small fw-bold mb-3">Disiplin Waktu Ibadah &amp; Keselarasan Operasional</h6>
                    <p class="text-white-50 small mb-4" style="line-height: 1.7;">
                        Shaf yang teratur mencerminkan keserempakan makmum mengikuti imam secara disiplin. Operasional masjid harus memiliki ritme yang terjadwal rapi dan tertata waktu demi kenyamanan jamaah.
                    </p>
                    <div class="p-3 rounded-3 bg-black bg-opacity-30 border border-secondary border-opacity-25 small text-white-50">
                        <strong class="text-white d-block mb-1"><i class="bi bi-check2 text-warning me-1"></i> Penerapan Sistem:</strong>
                        Display TV dinding otomatis dengan hisab astronomis resmi Kemenag RI, timer hitung mundur iqamah, serta pengingat WhatsApp H-2 otomatis bagi muballigh &amp; khatib Jumat.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. BENTO GRID SECTION: KEMAMPUAN UTAMA -->
<section class="py-5" style="background: #FFFFFF;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-2 fw-bold text-uppercase" style="letter-spacing: 0.05em;">
                Kemampuan Sistem
            </span>
            <h2 class="display-6 fw-900 text-dark" style="letter-spacing: -0.03em;">Bukan Sekadar Catatan Kas, Ini Sistem Operasi Masjid</h2>
            <p class="text-muted mx-auto lead" style="max-width: 650px; font-size: 1.1rem;">
                Semua instrumen digital yang dibutuhkan pengurus masjid dirancang menyatu, ringan, mandiri, dan siap pakai tanpa memerlukan infrastruktur mahal.
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
                        <p class="text-muted mb-4" style="line-height: 1.65;">
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
                        <p class="text-muted mb-4" style="line-height: 1.65;">
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

<!-- 5. DUA PILIHAN PEMANFAATAN: MANDIRI ATAU PENDAMPINGAN (MODEL SAS) -->
<section class="py-5" style="background: #F8FAFC; border-top: 1px solid #E2E8F0; border-bottom: 1px solid #E2E8F0;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge rounded-pill bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 mb-2 fw-bold text-uppercase" style="letter-spacing: 0.05em;">
                Pilihan Implementasi
            </span>
            <h2 class="display-6 fw-900 text-dark">Dua Jalur Pemanfaatan: Bebas Digunakan &amp; Mandiri</h2>
            <p class="text-muted mx-auto lead" style="max-width: 620px; font-size: 1.1rem;">
                Pilih jalur yang paling sesuai dengan kesiapan teknis dan infrastruktur takmir di masjid Anda.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
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

<!-- 6. TANYA JAWAB UMUM (FAQ) -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge rounded-pill bg-secondary-subtle text-secondary px-3 py-1 mb-2 fw-bold text-uppercase" style="letter-spacing: 0.05em;">
                Tanya Jawab DKM
            </span>
            <h2 class="display-6 fw-900 text-dark">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-muted mx-auto lead" style="max-width: 600px; font-size: 1.1rem;">Penjelasan praktis seputar implementasi dan operasional sistem di masjid Anda.</p>
        </div>

        <div class="row g-4 justify-content-center">
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

<!-- 7. FINAL CALL TO ACTION BANNER -->
<section class="py-5 position-relative overflow-hidden" style="background: radial-gradient(circle at 50% 50%, #064E3B 0%, #022C22 100%); color: white;">
    <div class="container text-center position-relative py-3">
        <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-3 fw-bold text-uppercase" style="letter-spacing: 0.05em;">
            Lurus &bull; Rapat &bull; Teratur
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

<!-- 8. MODAL DEMO 1-KLIK (SANDBOX INTERAKTIF SEPERTI MODEL SAS) -->
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
