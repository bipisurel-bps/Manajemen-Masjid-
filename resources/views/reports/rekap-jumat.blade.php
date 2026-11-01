<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Kas Jumat - {{ $masjidName }} ({{ $friday->translatedFormat('d M Y') }})</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #0D9488;
            --primary-dark: #0F766E;
            --income: #059669;
            --expense: #DC2626;
            --bg: #F8FAFC;
            --border: #CBD5E1;
        }
        body {
            background-color: #F1F5F9;
            color: #0F172A;
            font-size: 13px;
            line-height: 1.4;
            padding: 20px 0;
        }
        .page-container {
            max-width: 820px;
            margin: 0 auto;
            background: #fff;
            padding: 30px 35px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        .kop-surat {
            border-bottom: 3px double #0F172A;
            padding-bottom: 12px;
            margin-bottom: 16px;
        }
        .kop-logo {
            width: 58px;
            height: 58px;
            background: var(--primary);
            color: #fff;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }
        .rekap-box {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 10px 14px;
            background: #F8FAFC;
        }
        .table-rekap {
            width: 100%;
            margin-bottom: 12px;
            border-collapse: collapse;
            font-size: 12px;
        }
        .table-rekap th {
            background-color: #F1F5F9;
            color: #1E293B;
            font-weight: 700;
            padding: 6px 10px;
            border: 1px solid #CBD5E1;
        }
        .table-rekap td {
            padding: 5px 10px;
            border: 1px solid #E2E8F0;
        }
        .ttd-box {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            page-break-inside: avoid;
        }
        .ttd-col {
            text-align: center;
            width: 200px;
        }
        .ttd-space {
            height: 60px;
        }
        @media print {
            body {
                background: #fff !important;
                padding: 0 !important;
            }
            .page-container {
                box-shadow: none !important;
                padding: 0 !important;
                max-width: 100% !important;
                width: 100% !important;
            }
            .d-print-none {
                display: none !important;
            }
            @page {
                size: A4 portrait;
                margin: 12mm 15mm;
            }
        }
    </style>
</head>
<body>

<!-- Control Bar (Disembunyikan saat Print) -->
<div class="container d-print-none mb-3" style="max-width: 820px;">
    <div class="card border-0 shadow-sm rounded-3 p-3 bg-white">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <a href="{{ route('reports.public') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali ke Laporan
                </a>
            </div>
            <form action="{{ route('reports.rekap_jumat') }}" method="GET" class="d-flex align-items-center gap-2">
                <label for="date" class="small fw-semibold text-muted text-nowrap">Pilih Tanggal Jumat:</label>
                <input type="date" name="date" id="date" class="form-control form-control-sm" value="{{ $friday->format('Y-m-d') }}" onchange="this.form.submit()">
            </form>
            <button class="btn btn-primary btn-sm px-3" onclick="window.print()" style="background: var(--primary); border: none;">
                <i class="bi bi-printer-fill me-1"></i> Cetak / Simpan PDF (A4)
            </button>
        </div>
    </div>
</div>

<!-- Kertas Dokumen Cetak A4 -->
<div class="page-container">
    <!-- Kop Surat -->
    <div class="kop-surat d-flex align-items-center gap-3">
        <div class="kop-logo">
            <i class="bi bi-bank2"></i>
        </div>
        <div class="flex-grow-1 text-center pe-4">
            <h4 class="fw-bold mb-0 text-uppercase" style="letter-spacing: 0.05em; color: var(--primary-dark);">{{ $masjidName }}</h4>
            <div class="text-muted small">{{ $masjidAddress }}</div>
            <div class="fw-bold text-dark mt-1" style="font-size: 13px; letter-spacing: 0.03em;">
                LAPORAN KAS MINGGUAN JELANG SHALAT JUMAT
            </div>
            <div class="text-muted" style="font-size: 11px;">
                Periode: {{ $startDate->translatedFormat('d F Y') }} s.d. {{ $friday->translatedFormat('d F Y') }}
            </div>
        </div>
    </div>

    <!-- Ringkasan Saldo 4 Kotak -->
    <div class="row g-2 mb-3">
        <div class="col-3">
            <div class="rekap-box">
                <div class="text-muted" style="font-size: 10px; font-weight: 600;">SALDO AWAL PEKAN</div>
                <div class="fw-bold fs-6 mt-1">Rp {{ number_format($saldoAwal, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="col-3">
            <div class="rekap-box" style="border-left: 3px solid var(--income);">
                <div class="text-muted" style="font-size: 10px; font-weight: 600;">PEMASUKAN PEKAN INI</div>
                <div class="fw-bold fs-6 mt-1 text-success">+ Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="col-3">
            <div class="rekap-box" style="border-left: 3px solid var(--expense);">
                <div class="text-muted" style="font-size: 10px; font-weight: 600;">PENGELUARAN PEKAN INI</div>
                <div class="fw-bold fs-6 mt-1 text-danger">- Rp {{ number_format($totalExpense, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="col-3">
            <div class="rekap-box bg-light" style="border-left: 3px solid var(--primary);">
                <div class="text-muted" style="font-size: 10px; font-weight: 600;">SALDO AKHIR (KAS JUMAT)</div>
                <div class="fw-bold fs-6 mt-1" style="color: var(--primary-dark);">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <!-- Rincian Pemasukan & Pengeluaran -->
    <div class="row g-3 mb-2">
        <!-- Pemasukan -->
        <div class="col-6">
            <div class="fw-bold text-success mb-1" style="font-size: 12px;">
                <i class="bi bi-arrow-down-left-circle me-1"></i> Rincian Pemasukan Pekan Ini
            </div>
            <table class="table-rekap">
                <thead>
                    <tr>
                        <th style="width: 25%;">Tgl</th>
                        <th>Keterangan</th>
                        <th class="text-end" style="width: 32%;">Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($incomes as $inc)
                    <tr>
                        <td class="text-muted">{{ \Carbon\Carbon::parse($inc->transaction_date)->format('d/m') }}</td>
                        <td>
                            <strong>{{ $inc->category->name ?? 'Infaq' }}</strong>
                            @if($inc->description)<br><span class="text-muted" style="font-size: 10px;">{{ $inc->description }}</span>@endif
                        </td>
                        <td class="text-end fw-semibold text-success">{{ number_format($inc->amount, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-2" style="font-size: 11px;">Tidak ada transaksi pemasukan</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="fw-bold bg-light">
                        <td colspan="2" class="text-end">Subtotal:</td>
                        <td class="text-end text-success">{{ number_format($totalIncome, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Pengeluaran -->
        <div class="col-6">
            <div class="fw-bold text-danger mb-1" style="font-size: 12px;">
                <i class="bi bi-arrow-up-right-circle me-1"></i> Rincian Pengeluaran Pekan Ini
            </div>
            <table class="table-rekap">
                <thead>
                    <tr>
                        <th style="width: 25%;">Tgl</th>
                        <th>Keterangan</th>
                        <th class="text-end" style="width: 32%;">Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $exp)
                    <tr>
                        <td class="text-muted">{{ \Carbon\Carbon::parse($exp->transaction_date)->format('d/m') }}</td>
                        <td>
                            <strong>{{ $exp->category->name ?? 'Operasional' }}</strong>
                            @if($exp->description)<br><span class="text-muted" style="font-size: 10px;">{{ $exp->description }}</span>@endif
                        </td>
                        <td class="text-end fw-semibold text-danger">{{ number_format($exp->amount, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-2" style="font-size: 11px;">Tidak ada transaksi pengeluaran</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="fw-bold bg-light">
                        <td colspan="2" class="text-end">Subtotal:</td>
                        <td class="text-end text-danger">{{ number_format($totalExpense, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Saldo per Buku Kas & Jadwal Khatib -->
    <div class="row g-2 mb-2">
        <div class="col-7">
            <div class="fw-bold text-dark mb-1" style="font-size: 11px;">
                <i class="bi bi-journal-bookmark me-1"></i> Posisi Saldo Kumulatif per Buku Kas
            </div>
            <table class="table-rekap mb-0">
                <thead>
                    <tr>
                        <th>Nama Buku Kas</th>
                        <th class="text-end" style="width: 35%;">Saldo Akhir (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cashBooks as $cb)
                    <tr>
                        <td>{{ $cb->name }}</td>
                        <td class="text-end fw-semibold">Rp {{ number_format($cb->balance(), 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-5">
            <div class="fw-bold text-dark mb-1" style="font-size: 11px;">
                <i class="bi bi-calendar2-check me-1"></i> Petugas Shalat Jumat Ini
            </div>
            <div class="border rounded p-2" style="font-size: 11px; background: #FAF5FF; border-color: #E9D5FF !important;">
                @if($khatibSchedule)
                    <div><strong>Khatib:</strong> {{ $khatibSchedule->khatib_name }}</div>
                    @if($khatibSchedule->theme)
                        <div class="mt-1"><strong>Tema:</strong> {{ $khatibSchedule->theme }}</div>
                    @endif
                    @if($khatibSchedule->notes)
                        <div class="text-muted mt-1" style="font-size: 10px;">Catatan: {{ $khatibSchedule->notes }}</div>
                    @endif
                @else
                    <div class="text-muted fst-italic">Jadwal khatib belum diinput untuk Jumat ini.</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Lembar Tanda Tangan -->
    <div class="ttd-box">
        <div class="ttd-col">
            <div class="text-muted" style="font-size: 11px;">Mengetahui,</div>
            <div class="fw-bold">Ketua DKM / Takmir</div>
            <div class="ttd-space"></div>
            <div class="fw-bold" style="text-decoration: underline;">( ..................................... )</div>
        </div>
        <div class="ttd-col text-muted" style="font-size: 10px; display: flex; flex-direction: column; justify-content: center;">
            <div>Dicetak otomatis oleh Sistem Manajemen Masjid</div>
            <div>{{ $masjidName }}</div>
            <div>{{ now()->translatedFormat('d F Y, H:i') }} WIB</div>
        </div>
        <div class="ttd-col">
            <div class="text-muted" style="font-size: 11px;">Dibuat Oleh,</div>
            <div class="fw-bold">Bendahara Masjid</div>
            <div class="ttd-space"></div>
            <div class="fw-bold" style="text-decoration: underline;">( ..................................... )</div>
        </div>
    </div>
</div>

</body>
</html>
