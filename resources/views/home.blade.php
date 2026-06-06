@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
@php
    $masjidName = \App\Models\Setting::get('masjid_name', 'Masjid Al-Ikhlas');
@endphp

<!-- Hero Section -->
<section style="background: linear-gradient(135deg, #0D9488 0%, #0F766E 50%, #115E59 100%); padding: 5rem 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 text-white">
                <div class="d-inline-block mb-3 px-3 py-1 rounded-pill fw-600 small" style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.2);">
                    <i class="bi bi-moon-stars-fill me-1"></i> Sistem Informasi Keuangan Masjid
                </div>
                <h1 class="display-4 fw-800 mb-3" style="letter-spacing: -0.02em; line-height: 1.15;">
                    {{ $masjidName }}
                </h1>
                <p class="lead mb-4 opacity-90" style="max-width: 540px;">
                    Laporan keuangan yang transparan, akuntabel, dan amanah untuk kemaslahatan umat. Setiap rupiah tercatat, setiap amanah terjaga.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('reports.public') }}" class="btn-outline-masjid btn-lg">
                        <i class="bi bi-file-earmark-bar-graph"></i> Laporan Keuangan
                    </a>
                    <a href="{{ route('login') }}" class="btn-gold-masjid btn-lg">
                        <i class="bi bi-box-arrow-in-right"></i> Login Admin
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-center">
                <div style="width: 240px; height: 240px; background: rgba(255,255,255,0.08); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255,255,255,0.12);">
                    <i class="bi bi-moon-stars-fill" style="font-size: 6rem; opacity: 0.6;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Cards -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card income">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="stat-icon income">
                            <i class="bi bi-arrow-down-circle-fill"></i>
                        </div>
                    </div>
                    <div class="stat-label">Total Pemasukan</div>
                    <div class="stat-value text-income">
                        {{ \App\Helpers\FormatHelper::formatRupiah($totalIncome ?? 0) }}
                    </div>
                    <div class="small text-muted mt-1">Dana masuk masjid</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card expense">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="stat-icon expense">
                            <i class="bi bi-arrow-up-circle-fill"></i>
                        </div>
                    </div>
                    <div class="stat-label">Total Pengeluaran</div>
                    <div class="stat-value text-expense">
                        {{ \App\Helpers\FormatHelper::formatRupiah($totalExpense ?? 0) }}
                    </div>
                    <div class="small text-muted mt-1">Dana keluar masjid</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card balance">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="stat-icon balance">
                            <i class="bi bi-wallet-fill"></i>
                        </div>
                    </div>
                    <div class="stat-label">Saldo</div>
                    <div class="stat-value text-gold">
                        {{ \App\Helpers\FormatHelper::formatRupiah($balance ?? 0) }}
                    </div>
                    <div class="small text-muted mt-1">Saldo terkini</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Transactions -->
@if(isset($recentTransactions) && $recentTransactions->count() > 0)
<section class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="section-title mb-1">Transaksi Terbaru</h2>
                <p class="section-subtitle">Aktivitas keuangan terbaru {{ $masjidName }}</p>
            </div>
            <a href="{{ route('reports.public') }}" class="d-none d-md-flex btn-primary-masjid">
                <i class="bi bi-arrow-right"></i> Lihat Semua
            </a>
        </div>

        <div class="card-masjid overflow-hidden">
            <div class="table-responsive">
                <table class="table-masjid">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Jenis</th>
                            <th class="text-end">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions->take(10) as $t)
                        <tr>
                            <td><span class="fw-600">{{ \App\Helpers\FormatHelper::formatDate($t->transaction_date) }}</span></td>
                            <td>{{ $t->category->name ?? '-' }}</td>
                            <td class="text-muted">{{ $t->description ?: '-' }}</td>
                            <td>
                                <span class="badge-masjid {{ $t->type === 'income' ? 'badge-income' : 'badge-expense' }}">
                                    <i class="bi bi-{{ $t->type === 'income' ? 'arrow-down' : 'arrow-up' }} me-1"></i>
                                    {{ $t->type === 'income' ? 'Masuk' : 'Keluar' }}
                                </span>
                            </td>
                            <td class="text-end fw-700 {{ $t->type === 'income' ? 'text-income' : 'text-expense' }}">
                                {{ \App\Helpers\FormatHelper::formatRupiah($t->amount) }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <p class="fw-600">Belum ada transaksi</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-3 d-md-none">
            <a href="{{ route('reports.public') }}" class="btn-primary-masjid">
                <i class="bi bi-arrow-right"></i> Lihat Semua
            </a>
        </div>
    </div>
</section>
@endif

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Prinsip Kami</h2>
            <p class="section-subtitle mx-auto">Tiga pilar pengelolaan keuangan {{ $masjidName }}</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-masjid text-center h-100">
                    <div class="card-body p-4">
                        <div class="stat-icon neutral mx-auto mb-3" style="width: 64px; height: 64px; font-size: 1.75rem;">
                            <i class="bi bi-eye-fill"></i>
                        </div>
                        <h5 class="fw-700 mb-2">Transparan</h5>
                        <p class="text-muted small mb-0">Setiap transaksi tercatat dan dapat diakses oleh seluruh jamaah melalui laporan publik.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-masjid text-center h-100">
                    <div class="card-body p-4">
                        <div class="stat-icon neutral mx-auto mb-3" style="width: 64px; height: 64px; font-size: 1.75rem;">
                            <i class="bi bi-clipboard-check-fill"></i>
                        </div>
                        <h5 class="fw-700 mb-2">Akuntabel</h5>
                        <p class="text-muted small mb-0">Pencatatan keuangan mengikuti standar akuntansi yang baik dan dapat dipertanggungjawabkan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-masjid text-center h-100">
                    <div class="card-body p-4">
                        <div class="stat-icon neutral mx-auto mb-3" style="width: 64px; height: 64px; font-size: 1.75rem;">
                            <i class="bi bi-shield-check-fill"></i>
                        </div>
                        <h5 class="fw-700 mb-2">Amanah</h5>
                        <p class="text-muted small mb-0">Pengelolaan dana umat dilakukan dengan penuh tanggung jawab sesuai syariat Islam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-soft-primary">
    <div class="container text-center">
        <h2 class="section-title mb-2">Ingin Berkontribusi?</h2>
        <p class="section-subtitle mx-auto mb-4">Dukung kegiatan {{ $masjidName }} melalui infaq dan sedekah Anda</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('reports.public') }}" class="btn-primary-masjid btn-lg">
                <i class="bi bi-file-earmark-bar-graph"></i> Lihat Laporan
            </a>
            <a href="{{ route('contact') }}" class="btn-masjid-outline btn-lg">
                <i class="bi bi-envelope"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection
