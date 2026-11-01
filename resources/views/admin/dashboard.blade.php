@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-800 mb-1" style="font-size:1.5rem;">Dashboard</h3>
        <p class="text-muted small mb-0">Ringkasan keuangan {{ \App\Models\Setting::get('masjid_name', 'Masjid Al-Ikhlas') }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.transactions.create') }}" class="btn-masjid">
            <i class="bi bi-plus-lg"></i> Tambah Transaksi
        </a>
        <a href="{{ route('reports.public') }}" class="btn-masjid-outline" target="_blank">
            <i class="bi bi-eye"></i> Lihat Laporan
        </a>
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card-admin">
            <div class="stat-icon income">
                <i class="bi bi-arrow-down-circle-fill"></i>
            </div>
            <div>
                <div class="stat-label-admin">Total Pemasukan</div>
                <div class="stat-value-admin text-income">{{ \App\Helpers\FormatHelper::formatRupiah($totalIncome ?? 0) }}</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card-admin">
            <div class="stat-icon expense">
                <i class="bi bi-arrow-up-circle-fill"></i>
            </div>
            <div>
                <div class="stat-label-admin">Total Pengeluaran</div>
                <div class="stat-value-admin text-expense">{{ \App\Helpers\FormatHelper::formatRupiah($totalExpense ?? 0) }}</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card-admin">
            <div class="stat-icon balance">
                <i class="bi bi-wallet-fill"></i>
            </div>
            <div>
                <div class="stat-label-admin">Saldo</div>
                <div class="stat-value-admin text-gold">{{ \App\Helpers\FormatHelper::formatRupiah($balance ?? 0) }}</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card-admin">
            <div class="stat-icon neutral">
                <i class="bi bi-list-check"></i>
            </div>
            <div>
                <div class="stat-label-admin">Total Transaksi</div>
                <div class="stat-value-admin" style="color:#3B82F6;">{{ number_format($transactionCount ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card-masjid">
            <div class="card-header d-flex align-items-center gap-2">
                <div class="stat-icon income" style="width:32px;height:32px;font-size:0.875rem;">
                    <i class="bi bi-graph-up"></i>
                </div>
                <h6 class="mb-0 fw-700">Pemasukan {{ $currentYear ?? date('Y') }}</h6>
            </div>
            <div class="card-body">
                <canvas id="incomeChart" height="220"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-masjid">
            <div class="card-header d-flex align-items-center gap-2">
                <div class="stat-icon expense" style="width:32px;height:32px;font-size:0.875rem;">
                    <i class="bi bi-graph-down"></i>
                </div>
                <h6 class="mb-0 fw-700">Pengeluaran {{ $currentYear ?? date('Y') }}</h6>
            </div>
            <div class="card-body">
                <canvas id="expenseChart" height="220"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="card-masjid overflow-hidden">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-clock-history fs-5" style="color: var(--primary);"></i>
            <h6 class="mb-0 fw-700">Transaksi Terbaru</h6>
        </div>
        <a href="{{ route('admin.transactions.index') }}" class="btn-masjid btn-sm">
            <i class="bi bi-list"></i> Semua
        </a>
    </div>
    <div class="table-responsive">
        <table class="table-masjid">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Buku Kas</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th>Deskripsi</th>
                    <th class="text-end">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions ?? [] as $t)
                <tr>
                    <td class="fw-600">{{ \Carbon\Carbon::parse($t->transaction_date)->translatedFormat('d M Y') }}</td>
                    <td>{{ $t->cashBook->name ?? '-' }}</td>
                    <td>{{ $t->category->name ?? '-' }}</td>
                    <td>
                        <span class="badge-masjid {{ $t->type === 'income' ? 'badge-income' : 'badge-expense' }}">
                            {{ $t->type === 'income' ? 'Masuk' : 'Keluar' }}
                        </span>
                    </td>
                    <td class="text-muted">{{ $t->description ?: '-' }}</td>
                    <td class="text-end fw-700 {{ $t->type === 'income' ? 'text-income' : 'text-expense' }}">
                        {{ \App\Helpers\FormatHelper::formatRupiah($t->amount) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
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
@endsection

@push('scripts')
<script>
    function renderCharts() {
        if (typeof Chart === 'undefined') {
            document.addEventListener('app:ready', renderCharts, { once: true });
            return;
        }

        const monthLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        const incomeData = @json(array_values($monthlyIncome ?? []));
        const expenseData = @json(array_values($monthlyExpense ?? []));

        const incomeEl = document.getElementById('incomeChart');
        if (incomeEl) {
            new Chart(incomeEl, {
                type: 'bar',
                data: {
                    labels: monthLabels,
                    datasets: [{
                        label: 'Pemasukan',
                        data: incomeData,
                        backgroundColor: '#059669',
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#E2E8F0' },
                            ticks: { callback: v => (v/1000000).toFixed(0) + 'M' }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });
        }

        const expenseEl = document.getElementById('expenseChart');
        if (expenseEl) {
            new Chart(expenseEl, {
                type: 'bar',
                data: {
                    labels: monthLabels,
                    datasets: [{
                        label: 'Pengeluaran',
                        data: expenseData,
                        backgroundColor: '#DC2626',
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#E2E8F0' },
                            ticks: { callback: v => (v/1000000).toFixed(0) + 'M' }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', renderCharts);
    } else {
        renderCharts();
    }
</script>
@endpush
