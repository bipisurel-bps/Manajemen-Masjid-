@extends('layouts.admin')
@section('title', isset($cashBook) ? 'Edit Buku Kas' : 'Tambah Buku Kas')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">
        <div class="mb-4">
            <a href="{{ route('admin.cashbooks.index') }}" class="text-muted small text-decoration-none">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card-masjid">
            <div class="card-header d-flex align-items-center gap-2">
                <div class="stat-icon income" style="width:32px;height:32px;font-size:0.875rem;">
                    <i class="bi bi-journal-bookmark"></i>
                </div>
                <h5 class="mb-0 fw-700">{{ isset($cashBook) ? 'Edit Buku Kas' : 'Tambah Buku Kas Baru' }}</h5>
            </div>
            <div class="card-body p-4">
                @if($errors->any())
                <div class="flash-message flash-error mb-3">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>
                        @foreach($errors->all() as $e)
                            <div>{{ $e }}</div>
                        @endforeach
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ isset($cashBook) ? route('admin.cashbooks.update', $cashBook->id) : route('admin.cashbooks.store') }}">
                    @csrf
                    @if(isset($cashBook)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Nama Buku Kas</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $cashBook->name ?? '') }}"
                            placeholder="Contoh: Kas Umum" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3"
                            placeholder="Deskripsi buku kas...">{{ old('description', $cashBook->description ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" value="1"
                                id="is_active"
                                {{ old('is_active', $cashBook->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-600 small" for="is_active">Aktif</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-masjid">
                            <i class="bi bi-check-lg"></i> Simpan
                        </button>
                        <a href="{{ route('admin.cashbooks.index') }}" class="btn-masjid-outline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
