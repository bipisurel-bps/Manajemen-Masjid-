<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="description" content="Sistem Informasi Keuangan Masjid - Transparan, Akuntabel, Amanah">

    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0D9488">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Al-Ikhlas">
    <link rel="apple-touch-icon" href="/icon-192.png">
    <link rel="apple-touch-icon" sizes="512x512" href="/icon-512.png">
    <meta name="mobile-web-app-capable" content="yes">
    <title>@yield('title', 'Masjid') - {{ \App\Models\Setting::get('masjid_name', 'Masjid Al-Ikhlas') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #0D9488;
            --primary-dark: #0F766E;
            --primary-light: #CCFBF1;
            --primary-50: #F0FDFA;
            --gold: #D97706;
            --gold-light: #FFFBEB;
            --gold-dark: #92400E;
            --income: #059669;
            --income-bg: #ECFDF5;
            --expense: #DC2626;
            --expense-bg: #FEF2F2;
            --bg: #F8FAFC;
            --card: #FFFFFF;
            --text: #1E293B;
            --text-muted: #64748B;
            --border: #E2E8F0;
            --radius: 14px;
            --radius-sm: 10px;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow: 0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.06), 0 2px 4px rgba(0,0,0,0.04);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.08), 0 4px 10px rgba(0,0,0,0.04);
            --transition: 0.2s ease;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ── Navbar ── */
        .navbar-main {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 0.75rem 0;
            position: sticky;
            top: 0;
            z-index: 1030;
            backdrop-filter: blur(12px);
            background: rgba(255,255,255,0.95);
        }
        .navbar-brand-custom {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--text);
            font-weight: 700;
            font-size: 1.125rem;
        }
        .navbar-brand-custom:hover { color: var(--primary); }
        .brand-icon {
            width: 40px;
            height: 40px;
            background: var(--primary);
            color: #fff;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        .nav-link-custom {
            color: var(--text-muted);
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-sm);
            transition: var(--transition);
            text-decoration: none;
        }
        .nav-link-custom:hover,
        .nav-link-custom.active {
            color: var(--primary);
            background: var(--primary-50);
        }
        .nav-link-custom i { margin-right: 0.375rem; }

        /* ── Buttons ── */
        .btn-primary-masjid {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 0.625rem 1.5rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-primary-masjid:hover {
            background: var(--primary-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        .btn-outline-masjid {
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255,255,255,0.8);
            padding: 0.625rem 1.5rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-outline-masjid:hover {
            background: #fff;
            color: var(--primary);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        .btn-gold-masjid {
            background: var(--gold);
            color: #fff;
            border: none;
            padding: 0.625rem 1.5rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-gold-masjid:hover {
            background: var(--gold-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        .btn-masjid-outline {
            background: #fff;
            color: var(--primary);
            border: 1.5px solid var(--primary);
            padding: 0.625rem 1.5rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-masjid-outline:hover {
            background: var(--primary-50);
            color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }
        .btn-sm-masjid {
            padding: 0.375rem 1rem;
            font-size: 0.875rem;
        }

        /* ── Cards ── */
        .card-masjid {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }
        .card-masjid:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }
        .card-masjid .card-body { padding: 1.5rem; }

        /* ── Stat Card ── */
        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            transition: var(--transition);
            border-left: 4px solid transparent;
        }
        .stat-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }
        .stat-card.income { border-left-color: var(--income); }
        .stat-card.expense { border-left-color: var(--expense); }
        .stat-card.balance { border-left-color: var(--gold); }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .stat-icon.income { background: var(--income-bg); color: var(--income); }
        .stat-icon.expense { background: var(--expense-bg); color: var(--expense); }
        .stat-icon.balance { background: var(--gold-light); color: var(--gold); }
        .stat-icon.neutral { background: #EFF6FF; color: #3B82F6; }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }
        .stat-label {
            font-size: 0.8125rem;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* ── Table ── */
        .table-masjid {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .table-masjid thead th {
            background: var(--bg);
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.875rem 1.25rem;
            border-bottom: 2px solid var(--border);
        }
        .table-masjid tbody td {
            padding: 0.875rem 1.25rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        .table-masjid tbody tr:hover {
            background: var(--primary-50);
        }
        .table-masjid tbody tr:last-child td {
            border-bottom: none;
        }

        /* ── Badges ── */
        .badge-masjid {
            padding: 0.25rem 0.75rem;
            border-radius: 100px;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 0.02em;
        }
        .badge-income { background: var(--income-bg); color: var(--income); }
        .badge-expense { background: var(--expense-bg); color: var(--expense); }

        /* ── Footer ── */
        .footer-main {
            background: #fff;
            border-top: 1px solid var(--border);
            padding: 3rem 0 1.5rem;
            margin-top: auto;
        }
        .footer-heading {
            font-weight: 700;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text);
            margin-bottom: 1rem;
        }
        .footer-link {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            display: block;
            padding: 0.25rem 0;
            transition: var(--transition);
        }
        .footer-link:hover { color: var(--primary); }
        .footer-link i { width: 20px; }

        /* ── Flash Messages ── */
        .flash-message {
            border-radius: var(--radius-sm);
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            animation: slideDown 0.3s ease;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .flash-success { background: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; }
        .flash-error { background: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; }
        .flash-info { background: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; }

        /* ── Section Headers ── */
        .section-title {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 0.5rem;
        }
        .section-subtitle {
            color: var(--text-muted);
            font-size: 1rem;
            max-width: 600px;
        }

        /* ── Misc ── */
        .text-income { color: var(--income); }
        .text-expense { color: var(--expense); }
        .text-gold { color: var(--gold); }
        .bg-soft-primary { background: var(--primary-50); }

        .filter-bar {
            background: #fff;
            border-radius: var(--radius-md);
            padding: 1.25rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
        }
        .filter-bar .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 0.3rem;
        }

        .badge-active { background: var(--income-bg); color: var(--income); }
        .badge-inactive { background: #F1F5F9; color: var(--text-muted); }

        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
            color: var(--text-muted);
        }
        .empty-state i { font-size: 3rem; margin-bottom: 0.75rem; opacity: 0.4; }

        .fw-600 { font-weight: 600; }
        .fw-700 { font-weight: 700; }
        .fw-800 { font-weight: 800; }

        @media (max-width: 767.98px) {
            .stat-value { font-size: 1.25rem; }
            .section-title { font-size: 1.5rem; }
        }

        /* ── PWA Standalone: Hide nav except Login ── */
        @media (display-mode: standalone) {
            .navbar-brand-custom,
            .brand-icon,
            .nav-link-custom {
                display: none !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Navbar -->
<nav class="navbar-main">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('home') }}" class="navbar-brand-custom">
                <div class="brand-icon">
                    <i class="bi bi-moon-stars-fill"></i>
                </div>
                <span>{{ \App\Models\Setting::get('masjid_name', 'Masjid Al-Ikhlas') }}</span>
            </a>
            <div class="d-flex align-items-center gap-1">
                <a href="{{ route('home') }}" class="nav-link-custom {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i> Beranda
                </a>
                <a href="{{ route('transparency.index') }}" class="nav-link-custom {{ request()->routeIs('transparency.*') ? 'active' : '' }}">
                    <i class="bi bi-shield-check"></i> Transparansi
                </a>
                <a href="{{ route('reports.public') }}" class="nav-link-custom {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-bar-graph"></i> Laporan
                </a>
                <a href="{{ route('schedules.khatib') }}" class="nav-link-custom {{ request()->routeIs('schedules.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-week"></i> Jadwal
                </a>
                <a href="{{ route('display.index') }}" target="_blank" class="nav-link-custom">
                    <i class="bi bi-tv"></i> Layar TV
                </a>
                <a href="{{ route('contact') }}" class="nav-link-custom {{ request()->routeIs('contact') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i> Kontak
                </a>
                <a href="{{ route('login') }}" class="btn-primary-masjid btn-sm-masjid ms-2">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Flash Messages -->
<div class="container mt-3">
    @if(session('success'))
    <div class="flash-message flash-success">
        <i class="bi bi-check-circle-fill fs-5"></i>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="flash-message flash-error">
        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
        {{ session('error') }}
    </div>
    @endif
    @if(session('info'))
    <div class="flash-message flash-info">
        <i class="bi bi-info-circle-fill fs-5"></i>
        {{ session('info') }}
    </div>
    @endif
</div>

<!-- Main Content -->
<main class="flex-grow-1">
    @yield('content')
</main>

<!-- Footer -->
<footer class="footer-main">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="footer-heading">Tentang</div>
                <p class="text-muted small">
                    {{ \App\Models\Setting::get('masjid_name', 'Masjid Al-Ikhlas') }} berkomitmen mengelola keuangan masjid secara transparan, akuntabel, dan amanah untuk kemaslahatan umat.
                </p>
                <div class="d-flex gap-3 mt-2">
                    @if(\App\Models\Setting::get('social_facebook'))
                    <a href="{{ \App\Models\Setting::get('social_facebook') }}" class="footer-link" target="_blank"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if(\App\Models\Setting::get('social_instagram'))
                    <a href="{{ \App\Models\Setting::get('social_instagram') }}" class="footer-link" target="_blank"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if(\App\Models\Setting::get('social_youtube'))
                    <a href="{{ \App\Models\Setting::get('social_youtube') }}" class="footer-link" target="_blank"><i class="bi bi-youtube"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-heading">Kontak</div>
                @if(\App\Models\Setting::get('masjid_address'))
                <div class="footer-link"><i class="bi bi-geo-alt"></i> {{ \App\Models\Setting::get('masjid_address') }}</div>
                @endif
                @if(\App\Models\Setting::get('masjid_phone'))
                <div class="footer-link"><i class="bi bi-telephone"></i> {{ \App\Models\Setting::get('masjid_phone') }}</div>
                @endif
                @if(\App\Models\Setting::get('masjid_email'))
                <div class="footer-link"><i class="bi bi-envelope"></i> {{ \App\Models\Setting::get('masjid_email') }}</div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="footer-heading">Tautan</div>
                <a href="{{ route('home') }}" class="footer-link"><i class="bi bi-chevron-right"></i> Beranda</a>
                <a href="{{ route('reports.public') }}" class="footer-link"><i class="bi bi-chevron-right"></i> Laporan Keuangan</a>
                <a href="{{ route('schedules.khatib') }}" class="footer-link"><i class="bi bi-chevron-right"></i> Jadwal Kegiatan</a>
                <a href="{{ route('contact') }}" class="footer-link"><i class="bi bi-chevron-right"></i> Hubungi Kami</a>
            </div>
        </div>
        <hr class="my-4" style="border-color: var(--border);">
        <div class="text-center text-muted small">
            &copy; {{ date('Y') }} {{ \App\Models\Setting::get('masjid_name', 'Masjid Al-Ikhlas') }}. Hak Cipta Dilindungi.
        </div>
    </div>
</footer>

@stack('scripts')
<script>
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js').catch(() => {});
}
</script>
</body>
</html>
