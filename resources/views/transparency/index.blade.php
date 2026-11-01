@extends('layouts.app')
@section('title', 'Portal Transparansi Kas Jamaah')

@section('content')
<!-- Hero Transparansi -->
<div class="py-5" style="background: linear-gradient(135deg, #0D9488 0%, #0F766E 50%, #115E59 100%); color: #fff;">
    <div class="container text-center">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill small fw-semibold mb-3" style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25);">
            <i class="bi bi-shield-check"></i> Transparansi & Akuntabilitas Terbuka
        </div>
        <h1 class="display-5 fw-800 mb-2">Portal Transparansi Kas Jamaah</h1>
        <p class="lead opacity-90 mx-auto" style="max-width: 650px;">
            Setiap infaq, sedekah, dan pengeluaran operasional di {{ $masjidName }} tercatat secara terbuka dan dapat dipantau oleh seluruh jamaah kapan saja.
        </p>

        <!-- Saldo Kas Total -->
        <div class="mt-4 p-4 rounded-4 shadow mx-auto" style="max-width: 480px; background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
            <div class="small text-uppercase fw-bold letter-spacing-1" style="color: #99F6E4;">Total Saldo Kas Masjid Saat Ini</div>
            <div class="display-6 fw-900 mt-1 text-white">Rp {{ number_format($totalBalance, 0, ',', '.') }}</div>
            <div class="d-flex justify-content-center gap-3 mt-3 pt-3 border-top border-light border-opacity-25 small">
                <div><i class="bi bi-arrow-down-left text-success"></i> Masuk: <strong>Rp {{ number_format($totalIncome, 0, ',', '.') }}</strong></div>
                <div><i class="bi bi-arrow-up-right text-danger"></i> Keluar: <strong>Rp {{ number_format($totalExpense, 0, ',', '.') }}</strong></div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Quick Actions -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-800 mb-1">Rincian Saldo per Pos Buku Kas</h4>
            <p class="text-muted small mb-0">Alokasi dana kas masjid sesuai peruntukan amanah umat</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('reports.rekap_jumat') }}" class="btn btn-outline-primary btn-sm fw-semibold" target="_blank" style="border-color: var(--primary); color: var(--primary);">
                <i class="bi bi-printer me-1"></i> Cetak Rekap Kas Jumat (A4)
            </a>
            <a href="{{ route('reports.public') }}" class="btn btn-primary btn-sm fw-semibold" style="background: var(--primary); border: none;">
                <i class="bi bi-file-earmark-text me-1"></i> Laporan Lengkap
            </a>
        </div>
    </div>

    <!-- Cards per Buku Kas -->
    <div class="row g-3 mb-5">
        @foreach($cashBooks as $cb)
        @php
            $cbBalance = $cb->balance();
            $percentage = $totalBalance > 0 ? max(0, min(100, round(($cbBalance / $totalBalance) * 100))) : 0;
        @endphp
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 p-4" style="background: #fff; border: 1px solid #E2E8F0 !important;">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="fw-bold fs-6 text-dark">{{ $cb->name }}</div>
                    <span class="badge rounded-pill bg-light text-primary fw-bold">{{ $percentage }}%</span>
                </div>
                <div class="fs-4 fw-900 mt-1" style="color: var(--primary-dark);">
                    Rp {{ number_format($cbBalance, 0, ',', '.') }}
                </div>
                <div class="progress mt-3" style="height: 6px; background-color: #F1F5F9;">
                    <div class="progress-bar" style="width: {{ $percentage }}%; background-color: var(--primary);"></div>
                </div>
                <div class="d-flex justify-content-between text-muted small mt-2">
                    <span>{{ $cb->transactions_count }} transaksi</span>
                    <span>Status: Aktif</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Grafik Bulanan Chart.js & Kotak QRIS Infaq -->
    <div class="row g-4 mb-5">
        <!-- Grafik Kas Bulanan -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100" style="background: #fff; border: 1px solid #E2E8F0 !important;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-800 mb-0">Tren Arus Kas Bulanan ({{ $currentYear }})</h5>
                        <p class="text-muted small mb-0">Perbandingan pemasukan & pengeluaran sepanjang tahun</p>
                    </div>
                    <span class="badge bg-light text-dark fw-bold border">Tahun {{ $currentYear }}</span>
                </div>
                <div style="position: relative; height: 320px;">
                    <canvas id="transparencyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- QRIS & Rekening Infaq Digital -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center" style="background: #fff; border: 1px solid #E2E8F0 !important;">
                <div class="d-inline-block mx-auto mb-2 px-3 py-1 rounded-pill bg-danger bg-opacity-10 text-danger fw-bold small">
                    <i class="bi bi-qr-code-scan me-1"></i> Infaq Non-Tunai
                </div>
                <h5 class="fw-800 mb-1">Scan QRIS Infaq Masjid</h5>
                <p class="text-muted small mb-3">Mendukung Gopay, OVO, Dana, ShopeePay, BCA, Mandiri, BSI, dan seluruh M-Banking.</p>

                <!-- Gambar QRIS -->
                <div class="p-2 border rounded-3 bg-light d-inline-block mx-auto mb-3 shadow-sm" style="max-width: 240px;">
                    <img src="{{ $qrisImage }}" alt="QRIS Infaq {{ $masjidName }}" class="img-fluid rounded" style="max-height: 250px;">
                </div>

                <!-- Nomor Rekening Bank -->
                @if($bankAccount)
                <div class="p-3 rounded-3 text-start mt-2" style="background: #F8FAFC; border: 1px solid #E2E8F0;">
                    <div class="text-muted small">Transfer Rekening Resmi:</div>
                    <div class="fw-bold text-dark">{{ $bankName ?: 'Rekening Operasional Masjid' }}</div>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <span class="fs-5 fw-900 text-primary font-monospace" id="accNumber">{{ $bankAccount }}</span>
                        <button class="btn btn-sm btn-outline-secondary py-1 px-2" onclick="navigator.clipboard.writeText('{{ $bankAccount }}'); alert('Nomor rekening berhasil disalin!');" title="Salin">
                            <i class="bi bi-clipboard"></i> Salin
                        </button>
                    </div>
                    @if($bankHolder)
                    <div class="text-muted small mt-1">a.n. <strong>{{ $bankHolder }}</strong></div>
                    @endif
                </div>
                @else
                <div class="p-3 rounded-3 text-center mt-2 bg-light border text-muted small">
                    <i class="bi bi-info-circle text-primary me-1"></i> Rekening donasi resmi dapat diatur secara mandiri oleh pengurus masjid di panel admin.
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- 10 Transaksi Terbaru -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" style="background: #fff; border: 1px solid #E2E8F0 !important;">
        <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-800 mb-0">10 Mutasi Transaksi Terbaru</h5>
                <p class="text-muted small mb-0">Catatan penerimaan dan penyaluran kas terkini</p>
            </div>
            <a href="{{ route('reports.public') }}" class="btn btn-outline-secondary btn-sm fw-semibold">
                Lihat Seluruh Transaksi <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead style="background: #F8FAFC; color: #475569;">
                    <tr>
                        <th class="ps-4">Tanggal</th>
                        <th>Pos Buku Kas</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th class="text-end pe-4">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTransactions as $tx)
                    <tr>
                        <td class="ps-4 fw-semibold text-muted">
                            {{ \Carbon\Carbon::parse($tx->transaction_date)->translatedFormat('d M Y') }}
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $tx->cashBook->name ?? '-' }}</span>
                        </td>
                        <td class="fw-bold">
                            {{ $tx->category->name ?? '-' }}
                        </td>
                        <td class="text-muted">
                            {{ $tx->description ?: '-' }}
                        </td>
                        <td class="text-end pe-4 fw-bold {{ $tx->type === 'income' ? 'text-success' : 'text-danger' }}">
                            {{ $tx->type === 'income' ? '+' : '-' }} Rp {{ number_format($tx->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada catatan mutasi transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function initTransparencyChart() {
    if (typeof Chart === 'undefined') {
        document.addEventListener('app:ready', initTransparencyChart, { once: true });
        return;
    }

    const ctx = document.getElementById('transparencyChart');
    if (!ctx) return;

    const labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const incomeData = @json(array_values($monthlyIncome));
    const expenseData = @json(array_values($monthlyExpense));

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Pemasukan (Infaq/Donasi)',
                    data: incomeData,
                    backgroundColor: '#059669',
                    borderRadius: 6,
                },
                {
                    label: 'Pengeluaran (Operasional)',
                    data: expenseData,
                    backgroundColor: '#DC2626',
                    borderRadius: 6,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: v => 'Rp ' + (v / 1000000).toFixed(1) + 'M'
                    }
                }
            }
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTransparencyChart);
} else {
    initTransparencyChart();
}
</script>
@endpush
