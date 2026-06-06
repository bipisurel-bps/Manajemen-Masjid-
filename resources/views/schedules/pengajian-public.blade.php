@extends('layouts.app')
@section('title', 'Jadwal Pengajian')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 class="section-title"><i class="bi bi-book me-2"></i>Jadwal Pengajian</h2>
        <p class="section-subtitle">Jadwal pengajian rutin dan khusus di {{ \App\Models\Setting::get('masjid_name', 'Masjid Al-Ikhlas') }}</p>
    </div>

    @php
        $rutin = isset($pengajianSchedules) ? $pengajianSchedules->where('type', 'rutin') : collect();
        $khusus = isset($pengajianSchedules) ? $pengajianSchedules->where('type', 'khusus') : collect();
    @endphp

    <!-- Rutin -->
    <div class="mb-5">
        <div class="d-flex align-items-center gap-2 mb-4">
            <div class="stat-icon income" style="width:40px;height:40px;font-size:1.125rem;">
                <i class="bi bi-arrow-repeat"></i>
            </div>
            <h3 class="fw-800 mb-0" style="font-size:1.375rem;">Pengajian Rutin</h3>
            <span class="badge-masjid badge-income ms-2">{{ $rutin->count() }}x</span>
        </div>

        @if($rutin->count() > 0)
        <div class="row g-4">
            @foreach($rutin as $s)
            <div class="col-md-6">
                <div class="card-masjid h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="stat-icon income" style="width:48px;height:48px;">
                                <i class="bi bi-book-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-700 mb-1">{{ $s->title }}</h6>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @if($s->day_of_week)
                                    <span class="badge-masjid badge-income">
                                        <i class="bi bi-calendar-check me-1"></i> {{ $s->day_of_week }}
                                    </span>
                                    @endif
                                    @if($s->time)
                                    <span class="badge-masjid" style="background:#EFF6FF;color:#3B82F6;">
                                        <i class="bi bi-clock me-1"></i> {{ substr($s->time, 0, 5) }} WIB
                                    </span>
                                    @endif
                                    @if($s->location)
                                    <span class="badge-masjid" style="background:#FFF7ED;color:#C2410C;">
                                        <i class="bi bi-geo-alt me-1"></i> {{ $s->location }}
                                    </span>
                                    @endif
                                </div>
                                @if($s->ustadz_name)
                                <p class="small text-muted mt-2 mb-0">
                                    <i class="bi bi-person me-1"></i> {{ $s->ustadz_name }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="bi bi-book" style="font-size:2rem;"></i>
            <p class="small mb-0">Belum ada jadwal pengajian rutin</p>
        </div>
        @endif
    </div>

    <!-- Khusus -->
    <div class="mb-5">
        <div class="d-flex align-items-center gap-2 mb-4">
            <div class="stat-icon balance" style="width:40px;height:40px;font-size:1.125rem;">
                <i class="bi bi-star-fill"></i>
            </div>
            <h3 class="fw-800 mb-0" style="font-size:1.375rem;">Pengajian Khusus</h3>
            <span class="badge-masjid" style="background: var(--gold-light); color: var(--gold);">{{ $khusus->count() }}x</span>
        </div>

        @if($khusus->count() > 0)
        <div class="row g-4">
            @foreach($khusus as $s)
            <div class="col-md-6">
                <div class="card-masjid h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="stat-icon balance" style="width:48px;height:48px;">
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-700 mb-1">{{ $s->title }}</h6>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @if($s->date)
                                    <span class="badge-masjid" style="background: var(--gold-light); color: var(--gold);">
                                        <i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($s->date)->translatedFormat('d M Y') }}
                                    </span>
                                    @endif
                                    @if($s->time)
                                    <span class="badge-masjid" style="background:#EFF6FF;color:#3B82F6;">
                                        <i class="bi bi-clock me-1"></i> {{ substr($s->time, 0, 5) }} WIB
                                    </span>
                                    @endif
                                    @if($s->location)
                                    <span class="badge-masjid" style="background:#FFF7ED;color:#C2410C;">
                                        <i class="bi bi-geo-alt me-1"></i> {{ $s->location }}
                                    </span>
                                    @endif
                                </div>
                                @if($s->ustadz_name)
                                <p class="small text-muted mt-2 mb-0">
                                    <i class="bi bi-person me-1"></i> {{ $s->ustadz_name }}
                                </p>
                                @endif
                                @if($s->notes)
                                <p class="small text-muted mt-1 mb-0">{{ $s->notes }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="bi bi-star" style="font-size:2rem;"></i>
            <p class="small mb-0">Belum ada jadwal pengajian khusus</p>
        </div>
        @endif
    </div>
</div>
@endsection
