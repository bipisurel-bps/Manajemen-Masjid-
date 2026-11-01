@extends('layouts.app')
@section('title', 'Jadwal Khatib Jumat')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 class="section-title"><i class="bi bi-calendar-week me-2"></i>Jadwal Khatib Jumat</h2>
        <p class="section-subtitle">Jadwal khatib shalat Jumat di {{ \App\Models\Setting::get('masjid_name', 'Al-Masjid') }}</p>
    </div>

    @php
        $groupedSchedules = [];
        if (isset($khatibSchedules)) {
            foreach ($khatibSchedules as $s) {
                $monthKey = \Carbon\Carbon::parse($s->date)->translatedFormat('F Y');
                $groupedSchedules[$monthKey][] = $s;
            }
        }
    @endphp

    @forelse($groupedSchedules as $monthLabel => $schedules)
    <div class="mb-4">
        <h5 class="fw-700 mb-3 text-primary d-flex align-items-center gap-2">
            <span class="badge-masjid badge-income">{{ count($schedules) }}x</span>
            {{ $monthLabel }}
        </h5>
        <div class="row g-3">
            @foreach($schedules as $s)
            @php
                $date = \Carbon\Carbon::parse($s->date);
                $isPast = $date->isPast();
                $dayName = $date->translatedFormat('l');
                $dayNumber = $date->format('d');
            @endphp
            <div class="col-md-6 col-lg-4">
                <div class="card-masjid {{ $isPast ? 'opacity-75' : '' }}" style="{{ $isPast ? '' : 'border-left: 4px solid var(--primary);' }}">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="text-center flex-shrink-0" style="{{ $isPast ? 'opacity:0.5;' : '' }}">
                                <div class="stat-icon {{ $isPast ? 'expense' : 'income' }}" style="width:56px;height:56px;">
                                    <span class="fw-800" style="font-size:1.125rem;">{{ $dayNumber }}</span>
                                </div>
                                <small class="d-block mt-1 text-muted fw-600" style="font-size:0.75rem;">{{ $dayName }}</small>
                            </div>
                            <div>
                                <h6 class="fw-700 mb-1">{{ $s->khatib_name }}</h6>
                                @if($s->theme)
                                <div class="d-flex align-items-center gap-1 text-muted small mb-1">
                                    <i class="bi bi-bookmark"></i>
                                    <span>{{ $s->theme }}</span>
                                </div>
                                @endif
                                @if($s->notes)
                                <p class="text-muted small mb-0">{{ $s->notes }}</p>
                                @endif
                                @if($isPast)
                                <span class="badge-masjid badge-inactive mt-2" style="font-size:0.65rem;">Selesai</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @empty
    <div class="empty-state">
        <i class="bi bi-calendar-x"></i>
        <p class="fw-600 mb-1">Belum ada jadwal khatib</p>
        <p class="small">Jadwal khatib Jumat akan ditampilkan di sini</p>
    </div>
    @endforelse
</div>
@endsection
