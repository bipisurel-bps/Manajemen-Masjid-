@extends('layouts.app')
@section('title', 'Kontak')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 class="section-title"><i class="bi bi-telephone me-2"></i>Hubungi Kami</h2>
        <p class="section-subtitle">Informasi kontak {{ \App\Models\Setting::get('masjid_name', 'Al-Masjid') }}</p>
    </div>

    <div class="row g-4">
        <!-- Contact Info Cards -->
        <div class="col-lg-5">
            <div class="card-masjid mb-3">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start gap-3">
                        <div class="stat-icon income">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-700 mb-1">Alamat</h6>
                            <p class="text-muted small mb-0">
                                {{ \App\Models\Setting::get('masjid_address', 'Alamat belum diatur') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-masjid mb-3">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start gap-3">
                        <div class="stat-icon neutral">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-700 mb-1">Telepon</h6>
                            <p class="text-muted small mb-0">
                                {{ \App\Models\Setting::get('masjid_phone', 'Nomor belum diatur') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-masjid mb-3">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start gap-3">
                        <div class="stat-icon balance">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-700 mb-1">Email</h6>
                            <p class="text-muted small mb-0">
                                {{ \App\Models\Setting::get('masjid_email', 'Email belum diatur') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            @if(\App\Models\Setting::get('bank_name'))
            <div class="card-masjid">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start gap-3">
                        <div class="stat-icon income"">
                            <i class="bi bi-bank"></i>
                        </div>
                        <div>
                            <h6 class="fw-700 mb-1">Info Rekening</h6>
                            <p class="text-muted small mb-0">
                                {{ \App\Models\Setting::get('bank_name') }}<br>
                                {{ \App\Models\Setting::get('bank_account') }}<br>
                                a.n. {{ \App\Models\Setting::get('bank_holder') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Contact Form -->
        <div class="col-lg-7">
            <div class="card-masjid">
                <div class="card-header d-flex align-items-center gap-2" style="color: var(--primary);">
                    <i class="bi bi-send-fill fs-5"></i>
                    <h5 class="mb-0 fw-700">Kirim Pesan</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="#">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" placeholder="Nama Anda" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="email@contoh.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Subjek</label>
                                <input type="text" class="form-control" name="subject" placeholder="Subjek pesan">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Pesan</label>
                                <textarea class="form-control" name="message" rows="4" placeholder="Tulis pesan Anda..." required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-primary-masjid">
                                    <i class="bi bi-send"></i> Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 bg-soft-primary rounded-4 p-4">
        <h5 class="fw-700 mb-2"><i class="bi bi-clock me-1"></i>Jam Operasional Masjid</h5>
        <p class="text-muted mb-1">Setiap Hari: 04:00 - 22:00 WIB</p>
        <p class="text-muted mb-0">Kantor: Senin - Jumat, 08:00 - 16:00 WIB</p>
    </div>

    <!-- Developer & Technical Support Card -->
    <div class="mt-4 p-4 rounded-4 bg-white border shadow-sm text-center">
        <h6 class="fw-bold mb-1" style="color: var(--primary);"><i class="bi bi-code-slash me-1"></i> Pengembang & Layanan Teknis Aplikasi</h6>
        <p class="text-muted small mb-3">Aplikasi Sistem Informasi Manajemen Masjid ini di-develop oleh <strong>Jadda Developer</strong> untuk transparansi dan kemudahan tata kelola operasional masjid.</p>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a href="mailto:jaddadeveloper@gmail.com" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                <i class="bi bi-envelope-at me-1"></i> jaddadeveloper@gmail.com
            </a>
            <a href="https://almasjid.web.id" class="btn btn-outline-success btn-sm rounded-pill px-3">
                <i class="bi bi-globe me-1"></i> almasjid.web.id
            </a>
            <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="bi bi-github me-1"></i> GitHub Repository
            </a>
        </div>
    </div>
</div>
@endsection
