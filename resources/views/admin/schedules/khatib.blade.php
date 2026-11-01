@extends('layouts.admin')
@section('title', 'Jadwal Khatib Jumat')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-800 mb-1" style="font-size:1.5rem;">Jadwal Khatib Jumat</h3>
        <p class="text-muted small mb-0">Kelola jadwal khatib shalat Jumat & konfirmasi otomatis via WhatsApp</p>
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
                    <th>Tema Khutbah</th>
                    <th>WhatsApp / Konfirmasi</th>
                    <th>Catatan</th>
                    <th class="text-center" style="width:130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($khatibSchedules ?? $schedules ?? [] as $s)
                @php
                    $date = \Carbon\Carbon::parse($s->date);
                    $isPast = $date->isPast() && !$date->isToday();
                    $isToday = $date->isToday();
                    $waUrl = $s->getWhatsAppUrl();
                @endphp
                <tr class="{{ $isToday ? 'fw-700' : '' }}" style="{{ $isToday ? 'background: var(--primary-50);' : '' }}">
                    <td class="fw-600">
                        {{ $date->translatedFormat('d M Y') }}
                        @if($isToday)
                            <span class="badge bg-success ms-1">Hari Ini</span>
                        @elseif(!$isPast && $date->diffInDays(now()) <= 2)
                            <span class="badge bg-warning text-dark ms-1">H-{{ (int) $date->diffInDays(now()) }}</span>
                        @endif
                    </td>
                    <td>{{ $date->translatedFormat('l') }}</td>
                    <td class="fw-700 text-dark">{{ $s->khatib_name }}</td>
                    <td class="text-muted">{{ $s->theme ?: '-' }}</td>
                    <td>
                        @if($waUrl)
                            <a href="{{ $waUrl }}" target="_blank" class="btn btn-sm btn-success d-inline-flex align-items-center gap-1 py-1 px-2 shadow-sm" style="font-size: 11px; border-radius: 6px;">
                                <i class="bi bi-whatsapp"></i> Konfirmasi WA
                            </a>
                            @if($s->phone)
                                <div class="text-muted mt-1" style="font-size: 10px;">{{ $s->phone }}</div>
                            @endif
                        @else
                            <span class="text-muted small fst-italic">No WA belum ada</span>
                        @endif
                    </td>
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
                    <td colspan="7">
                        <div class="empty-state py-4 text-center">
                            <i class="bi bi-calendar-x fs-1 text-muted"></i>
                            <p class="fw-600 mt-2 mb-0">Belum ada jadwal khatib</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($schedules) && method_exists($schedules, 'hasPages') && $schedules->hasPages())
    <div class="p-3 border-top">
        {{ $schedules->links() }}
    </div>
    @endif
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
                        <label class="form-label fw-semibold">Tanggal Jumat</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Khatib</label>
                        <input type="text" name="khatib_name" list="khatibList" class="form-control" placeholder="Contoh: Ustadz Abdullah, Lc." required>
                        <datalist id="khatibList">
                            @foreach($khatibs ?? [] as $k)
                                <option value="{{ $k->name }}">{{ $k->phone ? "($k->phone)" : '' }}</option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor WhatsApp Khatib</label>
                        <input type="text" name="phone" class="form-control" placeholder="Contoh: 081234567890">
                        <small class="text-muted">Digunakan untuk konfirmasi jadwal H-2 via WhatsApp otomatis.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tema Khutbah</label>
                        <input type="text" name="theme" class="form-control" placeholder="Tema/judul khutbah (opsional)">
                    </div>
                    <div>
                        <label class="form-label fw-semibold">Catatan</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Catatan tambahan (akomodasi, penjemputan, dll)..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn-masjid-outline btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-masjid btn-sm">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modals -->
@foreach($khatibSchedules ?? $schedules ?? [] as $s)
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
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="date" class="form-control" value="{{ \Carbon\Carbon::parse($s->date)->format('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Khatib</label>
                        <input type="text" name="khatib_name" class="form-control" value="{{ $s->khatib_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor WhatsApp Khatib</label>
                        <input type="text" name="phone" class="form-control" value="{{ $s->phone }}" placeholder="Contoh: 081234567890">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tema Khutbah</label>
                        <input type="text" name="theme" class="form-control" value="{{ $s->theme }}">
                    </div>
                    <div>
                        <label class="form-label fw-semibold">Catatan</label>
                        <textarea name="notes" class="form-control" rows="2">{{ $s->notes }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn-masjid-outline btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-masjid btn-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
