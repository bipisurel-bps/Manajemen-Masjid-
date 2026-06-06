@extends('layouts.app')
@section('title', 'Login')

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
                <p class="text-muted small">Login untuk mengakses panel admin</p>
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

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="username" class="form-control" value="{{ old('username') }}"
                                    placeholder="Masukkan username" required autofocus>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Masukkan password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn-primary-masjid w-100 btn-lg">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">Belum punya akun?</small>
                        <a href="{{ route('register') }}" class="btn-masjid-outline btn-sm ms-2">Daftar</a>
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
