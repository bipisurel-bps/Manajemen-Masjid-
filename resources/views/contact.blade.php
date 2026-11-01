@extends('layouts.app')
@section('title', 'Kontak & Bantuan Pengembang — SAF Open Source (safmasjid.web.id)')

@section('content')
<div class="py-5" style="background: linear-gradient(180deg, #F0FDF4 0%, #F8FAFC 100%);">
    <div class="container py-3">
        <!-- Breadcrumb & Header -->
        <div class="text-center max-w-700 mx-auto mb-5">
            <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-3 fw-bold text-uppercase" style="letter-spacing: 0.06em; font-size: 0.75rem;">
                <i class="bi bi-code-slash me-1"></i> Open Source Project &bull; Lisensi MIT &bull; safmasjid.web.id
            </span>
            <h1 class="display-6 fw-900 text-dark mb-3" style="letter-spacing: -0.03em;">
                Kontak &amp; Dukungan Pengembang SAF
            </h1>
            <p class="text-muted lead" style="font-size: 1.1rem; line-height: 1.6;">
                <strong>SAF</strong> (Sistem Administrasi &amp; Finansial Masjid) adalah platform sistem operasi manajemen masjid sumber terbuka (<em>open-source</em>) yang disediakan secara gratis untuk kemaslahatan masjid di seluruh Indonesia.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Card 1: Kontak Resmi Pengembang (Satu-satunya Kontak) -->
            <div class="col-lg-6">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-4 p-md-5 bg-white border">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-success bg-opacity-10 text-success mb-4" style="width: 56px; height: 56px; font-size: 1.75rem;">
                        <i class="bi bi-envelope-at-fill"></i>
                    </div>
                    <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.05em;">Satu-Satunya Kontak Resmi</span>
                    <h3 class="fw-800 text-dark mt-1 mb-3">Jadda Developer</h3>
                    <p class="text-muted mb-4" style="line-height: 1.65;">
                        Untuk pertanyaan teknis, konsultasi kebutuhan masjid, pendampingan instalasi mandiri, atau saran fitur, Anda dapat menghubungi pengembang langsung melalui email:
                    </p>

                    <div class="p-3 rounded-3 mb-4 d-flex align-items-center justify-content-between" style="background: #F0FDF4; border: 1px solid #BBF7D0;">
                        <div class="d-flex align-items-center gap-2 overflow-hidden">
                            <i class="bi bi-envelope-check-fill text-success fs-5"></i>
                            <span class="fw-bold text-dark font-monospace text-truncate">jaddadeveloper@gmail.com</span>
                        </div>
                        <button class="btn btn-sm btn-outline-success rounded-pill px-3 py-1 fw-semibold flex-shrink-0" onclick="navigator.clipboard.writeText('jaddadeveloper@gmail.com'); alert('Email jaddadeveloper@gmail.com berhasil disalin!');">
                            <i class="bi bi-clipboard me-1"></i> Salin
                        </button>
                    </div>

                    <div class="mt-auto pt-3 border-top">
                        <a href="mailto:jaddadeveloper@gmail.com?subject=Konsultasi%20Sistem%20SAF%20Masjid" class="btn btn-success btn-lg rounded-pill w-100 fw-bold shadow-sm">
                            <i class="bi bi-send-fill me-2"></i> Kirim Email ke Jadda Developer
                        </a>
                        <small class="text-muted d-block text-center mt-2">
                            Responsif &bull; Konsultasi gratis untuk takmir &amp; pengurus DKM
                        </small>
                    </div>
                </div>
            </div>

            <!-- Card 2: Source Code Bebas di GitHub -->
            <div class="col-lg-6">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-4 p-md-5 bg-white border">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-dark bg-opacity-10 text-dark mb-4" style="width: 56px; height: 56px; font-size: 1.75rem;">
                        <i class="bi bi-github"></i>
                    </div>
                    <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.05em;">Repositori Sumber Terbuka</span>
                    <h3 class="fw-800 text-dark mt-1 mb-3">Unduh Source Code Bebas</h3>
                    <p class="text-muted mb-4" style="line-height: 1.65;">
                        Aplikasi ini <strong>100% gratis</strong> dengan lisensi terbuka <strong>MIT</strong>. Anda bebas mengunduh kode, memodifikasi, dan memasangnya di server sekretariat masjid sendiri tanpa biaya royalti.
                    </p>

                    <div class="p-3 rounded-3 mb-4" style="background: #F8FAFC; border: 1px solid #E2E8F0;">
                        <div class="small text-muted mb-1">Clone Repository via Git:</div>
                        <code class="d-block text-dark fw-bold user-select-all" style="font-size: 0.85rem;">git clone https://github.com/bipisurel-bps/Manajemen-Masjid-.git</code>
                    </div>

                    <div class="mt-auto pt-3 border-top d-flex flex-column gap-2">
                        <a href="https://github.com/bipisurel-bps/Manajemen-Masjid-" target="_blank" rel="noopener noreferrer" class="btn btn-dark btn-lg rounded-pill w-100 fw-bold shadow-sm">
                            <i class="bi bi-github me-2"></i> Buka di GitHub (bipisurel-bps) <i class="bi bi-box-arrow-up-right ms-1 small"></i>
                        </a>
                        <a href="{{ route('demo.login', 'admin') }}" class="btn btn-outline-warning text-dark btn-lg rounded-pill w-100 fw-bold">
                            <i class="bi bi-play-circle-fill me-2 text-warning"></i> Coba Demo Aplikasi Dulu
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Tiga Pilar Filosofi SAF -->
        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white border h-100 shadow-sm">
                    <div class="d-flex align-items-center gap-2 mb-2 text-success fw-bold">
                        <i class="bi bi-arrow-right-circle-fill"></i>
                        <span>1. LURUS (Transparansi)</span>
                    </div>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">
                        Shaf yang lurus melambangkan kejujuran mutlak. Laporan keuangan terbuka secara real-time untuk jamaah melalui portal publik dan rekap kas siap cetak A4.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white border h-100 shadow-sm">
                    <div class="d-flex align-items-center gap-2 mb-2 text-primary fw-bold">
                        <i class="bi bi-shield-check"></i>
                        <span>2. RAPAT (Akuntabilitas)</span>
                    </div>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">
                        Shaf yang rapat menutup celah kebocoran. Seluruh transaksi kas dibungkus mutasi atomik database mutex dan pemisahan buku kas multi-wadah terisolasi.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-white border h-100 shadow-sm">
                    <div class="d-flex align-items-center gap-2 mb-2 text-warning text-dark fw-bold">
                        <i class="bi bi-clock-history"></i>
                        <span>3. TERATUR (Disiplin Waktu)</span>
                    </div>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">
                        Ketertiban makmum bersama imam. Waktu shalat akurat hisab astronomis Kemenag, hitung mundur iqamah display TV, dan pengingat WhatsApp H-2 otomatis muballigh.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
