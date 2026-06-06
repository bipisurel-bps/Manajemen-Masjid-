@extends('layouts.app')
@section('title', 'Laporan Keuangan')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 class="section-title"><i class="bi bi-file-earmark-bar-graph me-2"></i>Laporan Keuangan</h2>
        <p class="section-subtitle">Transparansi keuangan masjid untuk seluruh jamaah</p>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="stat-card income">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="stat-icon income">
                        <i class="bi bi-arrow-down-circle-fill"></i>
                    </div>
                </div>
                <div class="stat-label">Total Pemasukan</div>
                <div class="stat-value text-income">{{ \App\Helpers\FormatHelper::formatRupiah($totalIncome ?? 0) }}</div>
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
                <div class="stat-value text-expense">{{ \App\Helpers\FormatHelper::formatRupiah($totalExpense ?? 0) }}</div>
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
                <div class="stat-value text-gold">{{ \App\Helpers\FormatHelper::formatRupiah($balance ?? 0) }}</div>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="filter-bar mb-4">
        <form method="GET" action="{{ route('reports.public') }}" class="row g-3 align-items-end">
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
                <label class="form-label">Jenis</label>
                <select name="type" class="form-select">
                    <option value="">-- Semua --</option>
                    <option value="income" {{ request('type') == 'income' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn-primary-masjid w-100">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>
            <div class="col-md-1">
                <a href="{{ route('reports.public') }}" class="btn-masjid-outline w-100">
                    <i class="bi bi-arrow-repeat"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Income & Expense Tables -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card-masjid">
                <div class="card-header d-flex align-items-center gap-2" style="color: var(--income);">
                    <div class="stat-icon income" style="width:32px;height:32px;font-size:0.875rem;">
                        <i class="bi bi-arrow-down-circle-fill"></i>
                    </div>
                    <h5 class="mb-0 fw-700">Pemasukan</h5>
                    @if(isset($incomes))
                    <span class="ms-auto fw-700 text-income">{{ \App\Helpers\FormatHelper::formatRupiah($incomes->sum('amount')) }}</span>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table-masjid">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th class="text-end">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($incomes ?? [] as $t)
                            <tr>
                                <td class="fw-600">{{ \App\Helpers\FormatHelper::formatDate($t->transaction_date) }}</td>
                                <td>{{ $t->category->name ?? '-' }}</td>
                                <td class="text-muted">{{ $t->description ?: '-' }}</td>
                                <td class="text-end fw-700 text-income">{{ \App\Helpers\FormatHelper::formatRupiah($t->amount) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state py-3">
                                        <i class="bi bi-inbox" style="font-size:2rem;"></i>
                                        <p class="mb-0 small">Belum ada pemasukan</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card-masjid">
                <div class="card-header d-flex align-items-center gap-2" style="color: var(--expense);">
                    <div class="stat-icon expense" style="width:32px;height:32px;font-size:0.875rem;">
                        <i class="bi bi-arrow-up-circle-fill"></i>
                    </div>
                    <h5 class="mb-0 fw-700">Pengeluaran</h5>
                    @if(isset($expenses))
                    <span class="ms-auto fw-700 text-expense">{{ \App\Helpers\FormatHelper::formatRupiah($expenses->sum('amount')) }}</span>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table-masjid">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th class="text-end">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($expenses ?? [] as $t)
                            <tr>
                                <td class="fw-600">{{ \App\Helpers\FormatHelper::formatDate($t->transaction_date) }}</td>
                                <td>{{ $t->category->name ?? '-' }}</td>
                                <td class="text-muted">{{ $t->description ?: '-' }}</td>
                                <td class="text-end fw-700 text-expense">{{ \App\Helpers\FormatHelper::formatRupiah($t->amount) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state py-3">
                                        <i class="bi bi-inbox" style="font-size:2rem;"></i>
                                        <p class="mb-0 small">Belum ada pengeluaran</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('reports.monthly') }}" class="btn-masjid-outline">
            <i class="bi bi-calendar3"></i> Lihat Laporan Per Bulan
        </a>
        <a href="{{ route('reports.category') }}" class="btn-masjid-outline ms-2">
            <i class="bi bi-pie-chart"></i> Lihat Per Kategori
        </a>
    </div>
</div>
@endsection
