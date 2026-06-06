@extends('layouts.admin')
@section('title', 'Pengaturan')

@section('content')
<div class="d-flex align-items-center mb-4">
    <h3 class="fw-800 mb-0" style="font-size:1.5rem;">Pengaturan</h3>
    <span class="ms-3 badge-masjid badge-income">
        <i class="bi bi-info-circle me-1"></i> Langsung diterapkan
    </span>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            @method('PUT')

            @foreach ($groups as $groupKey => $groupLabel)
            <div class="card-masjid mb-4">
                <div class="card-header d-flex align-items-center gap-2">
                    @php
                        $groupIcons = [
                            'umum' => 'bi-gear',
                            'bank' => 'bi-bank',
                            'tampilan' => 'bi-palette',
                            'kontak' => 'bi-telephone',
                            'default' => 'bi-sliders',
                        ];
                        $icon = $groupIcons[$groupKey] ?? 'bi-sliders';
                    @endphp
                    <i class="bi {{ $icon }} fs-5" style="color: var(--primary);"></i>
                    <h6 class="mb-0 fw-700">{{ $groupLabel }}</h6>
                </div>
                <div class="card-body p-4">
                    @if (isset($settings[$groupKey]))
                        @foreach ($settings[$groupKey] as $setting)
                        <div class="mb-3">
                            <label class="form-label">{{ $setting->label }}</label>
                            @if ($setting->type === 'textarea')
                                <textarea name="settings[{{ $setting->id }}]" class="form-control" rows="3">{{ old("settings.{$setting->id}", $setting->value) }}</textarea>
                            @elseif ($setting->type === 'email')
                                <input type="email" name="settings[{{ $setting->id }}]" class="form-control" value="{{ old("settings.{$setting->id}", $setting->value) }}">
                            @else
                                <input type="text" name="settings[{{ $setting->id }}]" class="form-control" value="{{ old("settings.{$setting->id}", $setting->value) }}">
                            @endif
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @endforeach

            <button type="submit" class="btn-masjid btn-lg w-100">
                <i class="bi bi-save"></i> Simpan Semua Pengaturan
            </button>
        </form>
    </div>

    <div class="col-lg-5">
        <div class="card-masjid mb-4">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-info-circle fs-5" style="color: var(--primary);"></i>
                <h6 class="mb-0 fw-700">Informasi</h6>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-0">
                    Pengaturan ini akan langsung diterapkan di seluruh halaman publik. Tidak perlu restart server.
                </p>
            </div>
        </div>

        <div class="card-masjid mb-4">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-lightbulb fs-5" style="color: var(--gold);"></i>
                <h6 class="mb-0 fw-700">Tips</h6>
            </div>
            <div class="card-body">
                <ul class="small mb-0 ps-3" style="color: var(--text-color);">
                    <li class="mb-2">Ganti <strong class="text-primary">Nama Masjid</strong> untuk mengubah nama di seluruh halaman</li>
                    <li class="mb-2">Isi <strong class="text-primary">Info Bank</strong> untuk menampilkan rekening donasi</li>
                    <li class="mb-2">Warna utama menggunakan kode hex (<code>#RRGGBB</code>)</li>
                    <li>Kontak akan tampil di footer dan halaman kontak</li>
                </ul>
            </div>
        </div>

        <!-- Preview Card -->
        <div class="card-masjid" style="background: linear-gradient(135deg, var(--primary) 0%, #0F766E 100%); color: #fff;">
            <div class="card-body p-4 text-center">
                <i class="bi bi-eye-fill d-block mb-2" style="font-size:2rem;opacity:0.7;"></i>
                <h6 class="fw-700 mb-1">Pratinjau Publik</h6>
                <p class="small opacity-75 mb-3">Lihat perubahan di halaman publik</p>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm px-4" style="background: rgba(255,255,255,0.2); color: #fff; border-radius: var(--radius-sm); font-weight: 600;">
                    <i class="bi bi-house me-1"></i> Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
