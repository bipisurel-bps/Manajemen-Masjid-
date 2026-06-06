@extends('layouts.app')
@section('title', 'Laporan Per Kategori')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 class="section-title"><i class="bi bi-pie-chart me-2"></i>Laporan Per Kategori</h2>
        <p class="section-subtitle">Distribusi keuangan berdasarkan kategori</p>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar mb-4">
        <form method="GET" action="{{ route('reports.category') }}" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Buku Kas</label>
                <select name="cash_book_id" class="form-select">
                    <option value="">-- Semua Buku Kas --</option>
                    @foreach($cashBooks ?? [] as $cb)
                        <option value="{{ $cb->id }}" {{ request('cash_book_id') == $cb->id ? 'selected' : '' }}>
                            {{ $cb->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Jenis</label>
                <select name="type" class="form-select">
                    <option value="">-- Semua --</option>
                    <option value="income" {{ request('type') == 'income' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Tahun</label>
                <select name="year" class="form-select">
                    @foreach($years ?? [date('Y')] as $y)
                        <option value="{{ $y }}" {{ request('year', date('Y')) == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Bulan</label>
                <select name="month" class="form-select">
                    <option value="">-- Semua --</option>
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ \App\Helpers\FormatHelper::monthName($m) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn-primary-masjid w-100">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>
            <div class="col-md-1">
                <a href="{{ route('reports.category') }}" class="btn-masjid-outline w-100">
                    <i class="bi bi-arrow-repeat"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Category Cards -->
    <div class="row g-4">
        @php
            $grandTotal = 0;
            if (isset($categories)) {
                $grandTotal = $categories->sum('total');
            }
        @endphp

        @forelse($categories ?? [] as $cat)
        @php
            $percentage = $grandTotal > 0 ? round(($cat->total / $grandTotal) * 100, 1) : 0;
            $isIncome = ($cat->type ?? 'income') === 'income';
            $barColor = $isIncome ? 'var(--income)' : 'var(--expense)';
        @endphp
        <div class="col-md-6 col-lg-4">
            <div class="card-masjid h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="stat-icon {{ $isIncome ? 'income' : 'expense' }}" style="width:48px;height:48px;">
                            <i class="bi bi-{{ $isIncome ? 'arrow-down-circle-fill' : 'arrow-up-circle-fill' }}"></i>
                        </div>
                        <span class="badge-masjid {{ $isIncome ? 'badge-income' : 'badge-expense' }}">
                            {{ $percentage }}%
                        </span>
                    </div>
                    <h6 class="fw-700 mb-1">{{ $cat->name }}</h6>
                    @if($cat->cash_book_name ?? false)
                    <p class="text-muted small mb-3">{{ $cat->cash_book_name }}</p>
                    @endif
                    <div class="stat-value {{ $isIncome ? 'text-income' : 'text-expense' }}" style="font-size:1.25rem;">
                        {{ \App\Helpers\FormatHelper::formatRupiah($cat->total) }}
                    </div>

                    <!-- Progress Bar -->
                    <div class="mt-3" style="height:6px;background:var(--bg);border-radius:100px;overflow:hidden;">
                        <div style="width:{{ $percentage }}%;height:100%;background:{{ $barColor }};border-radius:100px;transition:width 0.6s ease;"></div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="bi bi-pie-chart"></i>
                <p class="fw-600">Belum ada data kategori</p>
                <p class="small">Coba ubah filter atau tahun yang dipilih</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
