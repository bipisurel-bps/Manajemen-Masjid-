@extends('layouts.admin')
@section('title', 'Buku Kas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-800 mb-1" style="font-size:1.5rem;">Buku Kas</h3>
        <p class="text-muted small mb-0">Kelola buku kas masjid</p>
    </div>
    <a href="{{ route('admin.cashbooks.create') }}" class="btn-masjid">
        <i class="bi bi-plus-lg"></i> Tambah Buku Kas
    </a>
</div>

<div class="card-masjid overflow-hidden">
    <div class="table-responsive">
        <table class="table-masjid">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Deskripsi</th>
                    <th class="text-end">Pemasukan</th>
                    <th class="text-end">Pengeluaran</th>
                    <th class="text-end">Saldo</th>
                    <th>Status</th>
                    <th class="text-center" style="width:100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cashBooks ?? [] as $cb)
                <tr>
                    <td class="fw-700">{{ $cb->name }}</td>
                    <td><code style="font-size:0.8rem;">{{ $cb->slug }}</code></td>
                    <td class="text-muted"><small>{{ $cb->description ?: '-' }}</small></td>
                    <td class="text-end text-income fw-700">{{ \App\Helpers\FormatHelper::formatRupiah($cb->totalIncome()) }}</td>
                    <td class="text-end text-expense fw-700">{{ \App\Helpers\FormatHelper::formatRupiah($cb->totalExpense()) }}</td>
                    <td class="text-end fw-800">{{ \App\Helpers\FormatHelper::formatRupiah($cb->balance()) }}</td>
                    <td>
                        <span class="badge-masjid {{ $cb->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $cb->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('admin.cashbooks.edit', $cb->id) }}" class="btn-icon-only btn-icon-edit" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.cashbooks.destroy', $cb->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus buku kas ini?')">
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
                    <td colspan="8">
                        <div class="empty-state">
                            <i class="bi bi-journal-bookmark"></i>
                            <p class="fw-600">Belum ada buku kas</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
