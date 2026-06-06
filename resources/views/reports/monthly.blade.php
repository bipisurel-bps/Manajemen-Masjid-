@extends('layouts.app')
@section('title', 'Laporan Bulanan')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 class="section-title"><i class="bi bi-calendar3 me-2"></i>Laporan Bulanan</h2>
        <p class="section-subtitle">Ringkasan keuangan per bulan</p>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar mb-4">
        <form method="GET" action="{{ route('reports.monthly') }}" class="row g-3 align-items-end">
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
                <button type="submit" class="btn-primary-masjid w-100">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('reports.monthly') }}" class="btn-masjid-outline w-100">
                    <i class="bi bi-arrow-repeat"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="card-masjid overflow-hidden">
        <div class="table-responsive">
            <table class="table-masjid">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th class="text-end">Pemasukan</th>
                        <th class="text-end">Pengeluaran</th>
                        <th class="text-end">Selisih</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $currentMonth = (int) date('m');
                        $currentYear = (int) date('Y');
                        $requestYear = (int) request('year', $currentYear);
                    @endphp
                    @forelse($monthlyData ?? [] as $data)
                    @php
                        $isCurrent = $requestYear == $currentYear && $data['month'] == $currentMonth;
                        $diff = ($data['income'] ?? 0) - ($data['expense'] ?? 0);
                    @endphp
                    <tr class="{{ $isCurrent ? 'fw-700' : '' }}" style="{{ $isCurrent ? 'background: var(--primary-50);' : '' }}">
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($isCurrent)
                                <span class="badge-masjid badge-income" style="font-size:0.65rem;">Bulan Ini</span>
                                @endif
                                <span class="{{ $isCurrent ? 'text-primary fw-700' : '' }}">
                                    {{ $data['month'] }} {{ $year }}
                                </span>
                            </div>
                        </td>
                        <td class="text-end text-income fw-700">{{ \App\Helpers\FormatHelper::formatRupiah($data['income'] ?? 0) }}</td>
                        <td class="text-end text-expense fw-700">{{ \App\Helpers\FormatHelper::formatRupiah($data['expense'] ?? 0) }}</td>
                        <td class="text-end fw-700 {{ $diff >= 0 ? 'text-income' : 'text-expense' }}">
                            {{ \App\Helpers\FormatHelper::formatRupiah($diff) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p class="fw-600">Belum ada data bulanan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if(!empty($monthlyData))
                <tfoot>
                    <tr>
                        <td class="fw-800">TOTAL</td>
                        <td class="text-end fw-800 text-income">
                            {{ \App\Helpers\FormatHelper::formatRupiah(collect($monthlyData)->sum('income')) }}
                        </td>
                        <td class="text-end fw-800 text-expense">
                            {{ \App\Helpers\FormatHelper::formatRupiah(collect($monthlyData)->sum('expense')) }}
                        </td>
                        <td class="text-end fw-800">
                            {{ \App\Helpers\FormatHelper::formatRupiah(collect($monthlyData)->sum('income') - collect($monthlyData)->sum('expense')) }}
                        </td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection
