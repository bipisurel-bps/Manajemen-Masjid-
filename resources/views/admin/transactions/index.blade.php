@extends('layouts.admin')
@section('title', 'Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-800 mb-1" style="font-size:1.5rem;">Transaksi</h3>
        <p class="text-muted small mb-0">Kelola pemasukan dan pengeluaran</p>
    </div>
    <a href="{{ route('admin.transactions.create') }}" class="btn-masjid">
        <i class="bi bi-plus-lg"></i> Tambah Transaksi
    </a>
</div>

<!-- Filter Bar -->
<div class="filter-bar mb-4">
    <form method="GET" class="row g-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label">Buku Kas</label>
            <select name="cash_book_id" class="form-select">
                <option value="">-- Semua --</option>
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
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
        </div>
        <div class="col-md-2">
            <label class="form-label">Tanggal Sampai</label>
            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn-masjid w-100">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </div>
        <div class="col-md-1">
            <a href="{{ route('admin.transactions.index') }}" class="btn-masjid-outline w-100">
                <i class="bi bi-arrow-repeat"></i>
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
                    <th>Tanggal</th>
                    <th>Buku Kas</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th>Deskripsi</th>
                    <th class="text-end">Jumlah</th>
                    <th class="text-center" style="width:100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions ?? [] as $t)
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
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('admin.transactions.edit', $t->id) }}" class="btn-icon-only btn-icon-edit" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.transactions.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus transaksi ini?')">
                                @csrf @method('DELETE')
                                <button class="btn-icon-only btn-icon-delete" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
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
    @if(isset($transactions) && $transactions->hasPages())
    <div class="card-footer bg-white border-top d-flex justify-content-center py-3">
        {{ $transactions->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
