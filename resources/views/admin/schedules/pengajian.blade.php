@extends('layouts.admin')
@section('title', 'Jadwal Pengajian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-800 mb-1" style="font-size:1.5rem;">Jadwal Pengajian</h3>
        <p class="text-muted small mb-0">Kelola pengajian rutin & khusus</p>
    </div>
    <button class="btn-masjid" data-bs-toggle="modal" data-bs-target="#modalAdd">
        <i class="bi bi-plus-lg"></i> Tambah Pengajian
    </button>
</div>

<div class="card-masjid overflow-hidden">
    <div class="table-responsive">
        <table class="table-masjid">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Jenis</th>
                    <th>Hari/Tanggal</th>
                    <th>Waktu</th>
                    <th>Ustadz</th>
                    <th>Lokasi</th>
                    <th class="text-center" style="width:100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengajianSchedules ?? [] as $s)
                <tr>
                    <td class="fw-700">{{ $s->title }}</td>
                    <td>
                        <span class="badge-masjid {{ $s->type === 'rutin' ? 'badge-income' : 'badge-active' }}" style="{{ $s->type === 'khusus' ? 'background: var(--gold-light); color: var(--gold);' : '' }}">
                            {{ ucfirst($s->type) }}
                        </span>
                    </td>
                    <td>{{ $s->type === 'rutin' ? ($s->day_of_week ?? '-') : \Carbon\Carbon::parse($s->date)->translatedFormat('d M Y') }}</td>
                    <td>{{ $s->time ? substr($s->time, 0, 5) : '-' }}</td>
                    <td>{{ $s->ustadz_name ?: '-' }}</td>
                    <td>{{ $s->location ?: '-' }}</td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <button class="btn-icon-only btn-icon-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $s->id }}" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('admin.schedules.pengajian.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
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
                            <i class="bi bi-book"></i>
                            <p class="fw-600">Belum ada jadwal pengajian</p>
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
                <h6 class="modal-title fw-700"><i class="bi bi-plus-circle me-1"></i>Tambah Pengajian</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.schedules.pengajian.store') }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="title" class="form-control" placeholder="Judul pengajian" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis</label>
                        <select name="type" class="form-select" id="pengajianType" required>
                            <option value="rutin">Rutin</option>
                            <option value="khusus">Khusus</option>
                        </select>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6" id="dayField">
                            <label class="form-label">Hari</label>
                            <select name="day_of_week" class="form-select">
                                <option value="">-- Pilih Hari --</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <div class="col-md-6" id="dateField" style="display:none;">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Waktu</label>
                            <input type="time" name="time" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="location" class="form-control" placeholder="Lokasi">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ustadz</label>
                        <input type="text" name="ustadz_name" class="form-control" placeholder="Nama ustadz">
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
@foreach($pengajianSchedules ?? [] as $s)
<div class="modal fade" id="modalEdit{{ $s->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header" style="background: var(--primary); color: #fff; border-radius: 14px 14px 0 0; padding: 1rem 1.25rem;">
                <h6 class="modal-title fw-700"><i class="bi bi-pencil me-1"></i>Edit Pengajian</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.schedules.pengajian.update', $s->id) }}">
                @csrf @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="title" class="form-control" value="{{ $s->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis</label>
                        <select name="type" class="form-select pengajian-edit-type" data-id="{{ $s->id }}" required>
                            <option value="rutin" {{ $s->type === 'rutin' ? 'selected' : '' }}>Rutin</option>
                            <option value="khusus" {{ $s->type === 'khusus' ? 'selected' : '' }}>Khusus</option>
                        </select>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6" id="editDayField{{ $s->id }}" style="{{ $s->type === 'khusus' ? 'display:none;' : '' }}">
                            <label class="form-label">Hari</label>
                            <select name="day_of_week" class="form-select">
                                <option value="">-- Pilih --</option>
                                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $day)
                                    <option value="{{ $day }}" {{ $s->day_of_week == $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6" id="editDateField{{ $s->id }}" style="{{ $s->type === 'rutin' ? 'display:none;' : '' }}">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="date" class="form-control" value="{{ $s->date ? \Carbon\Carbon::parse($s->date)->format('Y-m-d') : '' }}">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Waktu</label>
                            <input type="time" name="time" class="form-control" value="{{ $s->time ? substr($s->time, 0, 5) : '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="location" class="form-control" value="{{ $s->location }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ustadz</label>
                        <input type="text" name="ustadz_name" class="form-control" value="{{ $s->ustadz_name }}">
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

@push('scripts')
<script>
    // Toggle day/date for add form
    document.getElementById('pengajianType').addEventListener('change', function() {
        const isRutin = this.value === 'rutin';
        document.getElementById('dayField').style.display = isRutin ? '' : 'none';
        document.getElementById('dateField').style.display = isRutin ? 'none' : '';
    });

    // Toggle day/date for edit forms
    document.querySelectorAll('.pengajian-edit-type').forEach(select => {
        select.addEventListener('change', function() {
            const id = this.dataset.id;
            const isRutin = this.value === 'rutin';
            document.getElementById('editDayField' + id).style.display = isRutin ? '' : 'none';
            document.getElementById('editDateField' + id).style.display = isRutin ? 'none' : '';
        });
    });
</script>
@endpush
