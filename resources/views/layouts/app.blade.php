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
    <meta name="apple-mobile-web-app-title" content="Al-Masjid">
    <link rel="apple-touch-icon" href="/icon-192.png">
    <link rel="apple-touch-icon" sizes="512x512" href="/icon-512.png">
    <meta name="mobile-web-app-capable" content="yes">
    <title>@yield('title', 'Masjid') - {{ \App\Models\Setting::get('masjid_name', 'Al-Masjid') }}</title>
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

        .hover-shadow {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-shadow:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04) !important;
        }
        .prayer-card {
            transition: all 0.25s ease;
            border: 1px solid var(--border) !important;
        }
        .prayer-card:hover {
            transform: translateY(-2px);
            border-color: var(--primary) !important;
            background: #F0FDF4 !important;
        }

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
            <a href="{{ route('home') }}" class="navbar-brand-custom d-flex align-items-center gap-2 text-decoration-none">
                <div class="brand-icon shadow-sm">
                    <i class="bi bi-moon-stars-fill"></i>
                </div>
                <div class="d-flex flex-column" style="line-height: 1.1;">
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-800 text-dark" style="letter-spacing: -0.02em; font-size: 1.2rem;">AL-MASJID</span>
                        <span class="badge rounded-pill" style="background: rgba(16, 185, 129, 0.12); color: #059669; font-size: 0.65rem; font-weight: 700; border: 1px solid rgba(16, 185, 129, 0.25);">OPEN SOURCE</span>
                    </div>
                    <span class="text-muted" style="font-size: 0.7rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase;">Mosque Operating System</span>
                </div>
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
                <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" rel="noopener noreferrer" class="nav-link-custom text-dark d-none d-md-inline-flex align-items-center" title="Unduh Source Code Bebas di GitHub">
                    <i class="bi bi-github"></i> GitHub
                </a>
                <a href="{{ route('demo.login', 'admin') }}" class="btn btn-warning btn-sm text-dark fw-bold rounded-pill px-3 ms-2 shadow-sm">
                    <i class="bi bi-play-circle-fill me-1"></i> Coba Demo
                </a>
                <a href="{{ route('login') }}" class="btn-primary-masjid btn-sm-masjid ms-1">
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
            <div class="col-md-5">
                <div class="footer-heading">Tentang Al-Masjid</div>
                <p class="text-muted small" style="line-height: 1.65;">
                    Al-Masjid adalah sistem operasi manajemen masjid sumber terbuka (open-source) berlisensi MIT. Dirancang mandiri dan amanah untuk memudahkan Dewan Kemakmuran Masjid (DKM), bendahara, dan takmir di seluruh Indonesia dalam mengelola kas multi-wadah, display TV digital jadwal salat, dan transparansi jamaah.
                </p>
                <div class="d-flex align-items-center gap-2 mt-2">
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 small fw-bold">Open Source &bull; Lisensi MIT</span>
                    <span class="badge bg-light text-muted border px-2 py-1 small">100% Gratis</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-heading">Kontak &amp; Kode Sumber</div>
                <div class="footer-link mb-2">
                    <i class="bi bi-envelope-at text-success"></i> 
                    <a href="mailto:jaddadeveloper@gmail.com" class="text-dark fw-bold text-decoration-none">jaddadeveloper@gmail.com</a>
                </div>
                <div class="footer-link mb-2">
                    <i class="bi bi-github text-dark"></i>
                    <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" rel="noopener noreferrer" class="text-muted text-decoration-none">
                        bipisurel-bps/Manajemen-Masjid-
                    </a>
                </div>
                <div class="text-muted small mt-2" style="line-height: 1.5;">
                    Silakan unduh atau clone kode sumber bebas di GitHub untuk dipasang di komputer sekretariat masjid atau server lokal.
                </div>
            </div>
            <div class="col-md-3">
                <div class="footer-heading">Navigasi Utama</div>
                <a href="{{ route('home') }}" class="footer-link"><i class="bi bi-chevron-right"></i> Beranda</a>
                <a href="{{ route('demo.login', 'admin') }}" class="footer-link"><i class="bi bi-chevron-right"></i> Coba Demo Admin</a>
                <a href="{{ route('display.index') }}" target="_blank" class="footer-link"><i class="bi bi-chevron-right"></i> Mode Layar TV Masjid</a>
                <a href="{{ route('transparency.index') }}" class="footer-link"><i class="bi bi-chevron-right"></i> Portal Transparansi</a>
                <a href="{{ route('reports.rekap_jumat') }}" target="_blank" class="footer-link"><i class="bi bi-chevron-right"></i> Rekap Kas Jumat A4</a>
                <a href="{{ route('contact') }}" class="footer-link"><i class="bi bi-chevron-right"></i> Kontak Pengembang</a>
            </div>
        </div>
        <hr class="my-4" style="border-color: var(--border);">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start text-muted small mb-2 mb-md-0">
                &copy; {{ date('Y') }} Al-Masjid &bull; Open Source berlisensi MIT. Disediakan gratis untuk kemaslahatan masjid.
            </div>
            <div class="col-md-6 text-center text-md-end small">
                <span class="text-muted">Aplikasi ini di-develop oleh</span>
                <a href="mailto:jaddadeveloper@gmail.com" class="fw-bold text-decoration-none text-success">Jadda Developer</a>
                <span class="text-muted">(<a href="mailto:jaddadeveloper@gmail.com" class="text-muted text-decoration-none">jaddadeveloper@gmail.com</a>)</span>
            </div>
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
