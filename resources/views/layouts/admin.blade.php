<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>@yield('title', 'Admin') - {{ \App\Models\Setting::get('masjid_name', 'SAF') }}</title>

    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#064E3B">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="SAF Masjid">
    <link rel="apple-touch-icon" href="/icon-192.png">
    <link rel="apple-touch-icon" sizes="512x512" href="/icon-512.png">
    <meta name="mobile-web-app-capable" content="yes">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #0D9488;
            --primary-dark: #0F766E;
            --primary-light: #CCFBF1;
            --primary-50: #F0FDFA;
            --gold: #D97706;
            --gold-light: #FFFBEB;
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
            --transition: 0.2s ease;
            --sidebar-width: 260px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: var(--sidebar-width);
            background: #fff;
            border-right: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            z-index: 1040;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--text);
            font-weight: 700;
            font-size: 1rem;
        }
        .sidebar-brand:hover { color: var(--primary); }
        .sidebar-brand-icon {
            width: 38px; height: 38px;
            background: var(--primary);
            color: #fff;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.125rem;
            flex-shrink: 0;
        }
        .sidebar-nav {
            padding: 1rem 0.75rem;
            flex: 1;
        }
        .sidebar-heading {
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            padding: 0.5rem 0.75rem;
            margin-top: 0.5rem;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 0.75rem;
            border-radius: var(--radius-sm);
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            transition: var(--transition);
            margin-bottom: 2px;
        }
        .sidebar-link:hover {
            background: var(--primary-50);
            color: var(--primary);
        }
        .sidebar-link.active {
            background: var(--primary);
            color: #fff;
        }
        .sidebar-link i { font-size: 1.125rem; width: 22px; text-align: center; }
        .sidebar-link .badge-count {
            margin-left: auto;
            background: rgba(255,255,255,0.3);
            color: inherit;
            font-size: 0.75rem;
            padding: 0.15rem 0.5rem;
            border-radius: 100px;
        }
        .sidebar-link.active .badge-count { background: rgba(255,255,255,0.3); }
        .sidebar-footer {
            padding: 0.75rem;
            border-top: 1px solid var(--border);
        }

        /* ── Topbar ── */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 1030;
            margin-left: var(--sidebar-width);
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0 1.5rem;
        }
        .topbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            height: 54px;
        }
        .topbar-title {
            font-weight: 600;
            font-size: 0.9375rem;
            color: var(--text);
        }
        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .user-avatar {
            width: 36px; height: 36px;
            border-radius: var(--radius-sm);
            background: var(--primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.875rem;
        }
        .user-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: var(--text);
            font-weight: 500;
            font-size: 0.875rem;
        }
        .user-dropdown-toggle:hover { color: var(--primary); }

        /* ── Main Content ── */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 1.5rem;
            min-height: calc(100vh - 54px);
        }
        .content-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ── Cards ── */
        .card-masjid {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }
        .card-masjid:hover { box-shadow: var(--shadow-md); }
        .card-masjid .card-header {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 1rem 1.25rem;
            font-weight: 600;
            border-radius: var(--radius) var(--radius) 0 0;
        }
        .card-masjid .card-body { padding: 1.25rem; }

        /* ── Stat Card ── */
        .stat-card-admin {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem 1.5rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .stat-card-admin:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }
        .stat-card-admin .stat-icon {
            width: 52px; height: 52px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        .stat-card-admin .stat-icon.income { background: var(--income-bg); color: var(--income); }
        .stat-card-admin .stat-icon.expense { background: var(--expense-bg); color: var(--expense); }
        .stat-card-admin .stat-icon.balance { background: var(--gold-light); color: var(--gold); }
        .stat-card-admin .stat-icon.neutral { background: #EFF6FF; color: #3B82F6; }
        .stat-card-admin .stat-value-admin {
            font-size: 1.375rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }
        .stat-card-admin .stat-label-admin {
            font-size: 0.8125rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ── Table ── */
        .table-masjid {
            width: 100%;
            border-collapse: collapse;
        }
        .table-masjid thead th {
            background: var(--bg);
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.75rem 1.25rem;
            border-bottom: 2px solid var(--border);
            white-space: nowrap;
        }
        .table-masjid tbody td {
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
            font-size: 0.875rem;
        }
        .table-masjid tbody tr:hover { background: var(--primary-50); }
        .table-masjid tbody tr:last-child td { border-bottom: none; }
        .table-masjid tfoot td {
            padding: 0.75rem 1.25rem;
            font-weight: 700;
            background: var(--primary-50);
            border-top: 2px solid var(--primary);
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
        .badge-active { background: var(--income-bg); color: var(--income); }
        .badge-inactive { background: #F1F5F9; color: var(--text-muted); }

        /* ── Buttons ── */
        .btn-masjid {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.875rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }
        .btn-masjid:hover {
            background: var(--primary-dark);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        .btn-masjid-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 0.5rem 1.25rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.875rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            text-decoration: none;
        }
        .btn-masjid-outline:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        .btn-icon-only {
            width: 36px; height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.875rem;
            transition: var(--transition);
            border: none;
        }
        .btn-icon-edit {
            background: #FEF3C7;
            color: #92400E;
            text-decoration: none;
        }
        .btn-icon-edit:hover { background: #FDE68A; }
        .btn-icon-delete {
            background: #FEE2E2;
            color: #991B1B;
        }
        .btn-icon-delete:hover { background: #FECACA; }

        /* ── Flash Messages ── */
        .flash-message {
            border-radius: var(--radius-sm);
            padding: 0.875rem 1.25rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            font-size: 0.875rem;
            animation: slideDown 0.3s ease;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .flash-success { background: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; }
        .flash-error { background: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; }
        .flash-info { background: #EFF6FF; color: #1E40AF; border: 1px solid #BFDBFE; }

        /* ── Form ── */
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
        }
        .form-label {
            font-weight: 600;
            font-size: 0.8125rem;
            color: var(--text);
            margin-bottom: 0.375rem;
        }
        .input-group-text {
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ── Modal ── */
        .modal-header-masjid {
            background: var(--primary);
            color: #fff;
            padding: 1rem 1.25rem;
            border-radius: var(--radius) var(--radius) 0 0;
        }

        /* ── Filter Bar ── */
        .filter-bar {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }

        /* ── Misc ── */
        .text-income { color: var(--income); }
        .text-expense { color: var(--expense); }
        .fw-600 { font-weight: 600; }
        .fw-700 { font-weight: 700; }
        .fw-800 { font-weight: 800; }
        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
            color: var(--text-muted);
        }
        .empty-state i { font-size: 3rem; margin-bottom: 0.75rem; opacity: 0.4; }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }
            .sidebar.show { transform: translateX(0); }
            .sidebar-overlay {
                display: none;
                position: fixed; inset: 0;
                background: rgba(0,0,0,0.3);
                z-index: 1039;
            }
            .sidebar-overlay.show { display: block; }
            .main-content, .topbar { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <i class="bi bi-moon-stars-fill"></i>
        </div>
        {{ \App\Models\Setting::get('masjid_name', 'SAF') }}
    </a>

    <nav class="sidebar-nav">
        <div class="sidebar-heading">Menu Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="sidebar-heading">Keuangan</div>
        <a href="{{ route('admin.transactions.index') }}" class="sidebar-link {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
            <i class="bi bi-arrow-left-right"></i> Transaksi
        </a>
        <a href="{{ route('admin.cashbooks.index') }}" class="sidebar-link {{ request()->routeIs('admin.cashbooks.*') ? 'active' : '' }}">
            <i class="bi bi-journal-bookmark"></i> Buku Kas
        </a>
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Kategori
        </a>
        <a href="{{ route('reports.rekap_jumat') }}" target="_blank" class="sidebar-link">
            <i class="bi bi-printer"></i> Rekap Kas Jumat
        </a>

        <div class="sidebar-heading">Publik & Display</div>
        <a href="{{ route('display.index') }}" target="_blank" class="sidebar-link">
            <i class="bi bi-tv"></i> Display TV Masjid
        </a>
        <a href="{{ route('transparency.index') }}" target="_blank" class="sidebar-link">
            <i class="bi bi-shield-check"></i> Transparansi Jamaah
        </a>

        <div class="sidebar-heading">Lainnya</div>
        <a href="{{ route('admin.schedules.khatib.index') }}" class="sidebar-link {{ request()->routeIs('admin.schedules.khatib.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-week"></i> Jadwal Khatib
        </a>
        <a href="{{ route('admin.schedules.pengajian.index') }}" class="sidebar-link {{ request()->routeIs('admin.schedules.pengajian.*') ? 'active' : '' }}">
            <i class="bi bi-book"></i> Jadwal Pengajian
        </a>
        <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Pengguna
        </a>
        <a href="{{ route('admin.profile.index') }}" class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> Profil
        </a>
        <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Pengaturan
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
            <i class="bi bi-box-arrow-up-right"></i> Lihat Website
        </a>
        <hr class="my-2">
        <form action="{{ route('logout') }}" method="POST" class="mb-0">
            @csrf
            <button type="submit" class="sidebar-link border-0 bg-transparent w-100 text-start" style="color: var(--expense);">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>
        <div class="p-2 mt-2 rounded bg-light border text-center" style="font-size: 0.72rem; line-height: 1.3;">
            <span class="text-muted">Developed by</span><br>
            <a href="mailto:jaddadeveloper@gmail.com" class="fw-bold text-decoration-none" style="color: var(--primary);">jaddadeveloper</a><br>
            <span class="text-muted">jaddadeveloper@gmail.com</span>
        </div>
    </div>
</aside>

<!-- Topbar -->
<div class="topbar">
    <div class="topbar-inner">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm d-lg-none" onclick="toggleSidebar()" style="color: var(--text-muted); padding: 0;">
                <i class="bi bi-list fs-5"></i>
            </button>
            <span class="topbar-title">@yield('title', 'Dashboard')</span>
        </div>
        <div class="topbar-actions">
            <span class="text-muted small d-none d-md-inline">
                {{ \App\Helpers\FormatHelper::formatDate(now()) }}
            </span>
            <div class="dropdown">
                <a href="#" class="user-dropdown-toggle dropdown-toggle" data-bs-toggle="dropdown">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <span class="d-none d-md-inline">{{ auth()->user()->name ?? 'Admin' }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 p-1" style="min-width: 180px;">
                    <div class="px-3 py-2">
                        <div class="fw-600 small">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="text-muted" style="font-size: 0.75rem;">{{ auth()->user()->email ?? '' }}</div>
                        <div class="mt-1">
                            <span class="badge bg-{{ (auth()->user()->role ?? '') === 'superadmin' ? 'warning text-dark' : 'info' }} rounded-pill small">
                                {{ auth()->user()->role ?? 'admin' }}
                            </span>
                        </div>
                    </div>
                    <hr class="my-1">
                    <a href="{{ route('admin.settings.index') }}" class="dropdown-item rounded-2 py-2">
                        <i class="bi bi-gear me-2"></i> Pengaturan
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item rounded-2 py-2 text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
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

    <div class="content-container">
        @yield('content')
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }
</script>
@stack('scripts')
<script>
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js').catch(() => {});
}
</script>
</body>
</html>
