@extends('layouts.app')
@section('title', 'Registrasi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <!-- Logo -->
            <div class="text-center mb-4">
                <div class="brand-icon mx-auto mb-3" style="width:64px;height:64px;font-size:1.75rem;">
                    <i class="bi bi-moon-stars-fill"></i>
                </div>
                <h4 class="fw-800 mb-1">{{ \App\Models\Setting::get('masjid_name', 'Masjid Al-Ikhlas') }}</h4>
                <p class="text-muted small">Daftar akun admin baru</p>
            </div>

            <!-- Card -->
            <div class="card-masjid overflow-hidden" style="max-width:440px;margin:0 auto;">
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

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                placeholder="Nama lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}"
                                placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                placeholder="email@contoh.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Minimal 8 karakter" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Ulangi password" required>
                        </div>
                        <button type="submit" class="btn-primary-masjid w-100 btn-lg">
                            <i class="bi bi-person-plus"></i> Daftar
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">Sudah punya akun?</small>
                        <a href="{{ route('login') }}" class="btn-masjid-outline btn-sm ms-2">Login</a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('home') }}" class="text-muted small text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
