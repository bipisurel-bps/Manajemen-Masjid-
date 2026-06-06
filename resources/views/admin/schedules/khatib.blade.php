@extends('layouts.admin')
@section('title', 'Jadwal Khatib Jumat')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-800 mb-1" style="font-size:1.5rem;">Jadwal Khatib Jumat</h3>
        <p class="text-muted small mb-0">Kelola jadwal khatib shalat Jumat</p>
    </div>
    <button class="btn-masjid" data-bs-toggle="modal" data-bs-target="#modalAdd">
        <i class="bi bi-plus-lg"></i> Tambah Jadwal
    </button>
</div>

<div class="card-masjid overflow-hidden">
    <div class="table-responsive">
        <table class="table-masjid">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Hari</th>
                    <th>Nama Khatib</th>
                    <th>Tema/No HP</th>
                    <th>Catatan</th>
                    <th class="text-center" style="width:100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($khatibSchedules ?? [] as $s)
                @php
                    $date = \Carbon\Carbon::parse($s->date);
                    $isPast = $date->isPast();
                    $isToday = $date->isToday();
                @endphp
                <tr class="{{ $isToday ? 'fw-700' : '' }}" style="{{ $isToday ? 'background: var(--primary-50);' : '' }}">
                    <td class="fw-600">{{ $date->translatedFormat('d M Y') }}</td>
                    <td>{{ $date->translatedFormat('l') }}</td>
                    <td class="fw-700">{{ $s->khatib_name }}</td>
                    <td class="text-muted">{{ $s->theme ?: $s->phone ?? '-' }}</td>
                    <td class="text-muted"><small>{{ $s->notes ?: '-' }}</small></td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <button class="btn-icon-only btn-icon-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $s->id }}" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('admin.schedules.khatib.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
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
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="bi bi-calendar-x"></i>
                            <p class="fw-600">Belum ada jadwal khatib</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header" style="background: var(--primary); color: #fff; border-radius: 14px 14px 0 0; padding: 1rem 1.25rem;">
                <h6 class="modal-title fw-700"><i class="bi bi-plus-circle me-1"></i>Tambah Jadwal Khatib</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.schedules.khatib.store') }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Khatib</label>
                        <input type="text" name="khatib_name" class="form-control" placeholder="Nama khatib" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tema / No HP</label>
                        <input type="text" name="theme" class="form-control" placeholder="Tema khutbah atau nomor HP">
                    </div>
                    <div>
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Catatan tambahan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn-masjid-outline btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-masjid btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modals -->
@foreach($khatibSchedules ?? [] as $s)
<div class="modal fade" id="modalEdit{{ $s->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header" style="background: var(--primary); color: #fff; border-radius: 14px 14px 0 0; padding: 1rem 1.25rem;">
                <h6 class="modal-title fw-700"><i class="bi bi-pencil me-1"></i>Edit Jadwal Khatib</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.schedules.khatib.update', $s->id) }}">
                @csrf @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="date" class="form-control" value="{{ \Carbon\Carbon::parse($s->date)->format('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Khatib</label>
                        <input type="text" name="khatib_name" class="form-control" value="{{ $s->khatib_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tema / No HP</label>
                        <input type="text" name="theme" class="form-control" value="{{ $s->theme }}">
                    </div>
                    <div>
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="2">{{ $s->notes }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn-masjid-outline btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-masjid btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
