@extends('layouts.admin')
@section('title', 'Profil')

@section('content')
<div class="row g-4">
    {{-- Update Profile --}}
    <div class="col-lg-6">
        <div class="card-masjid">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-person-fill" style="color: var(--primary); font-size: 1.25rem;"></i>
                <h6 class="mb-0 fw-700">Informasi Profil</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                                   placeholder="Nama lengkap" required>
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-at"></i></span>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                   id="username" name="username" value="{{ old('username', auth()->user()->username) }}"
                                   placeholder="Username" required>
                        </div>
                        @error('username')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                   placeholder="Email" required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <span class="form-label d-block">Role</span>
                        <span class="badge {{ auth()->user()->role === 'superadmin' ? 'bg-warning text-dark' : 'bg-info' }} rounded-pill">
                            <i class="bi {{ auth()->user()->role === 'superadmin' ? 'bi-shield-fill' : 'bi-shield' }} me-1"></i>
                            {{ auth()->user()->role === 'superadmin' ? 'Super Admin' : 'Admin' }}
                        </span>
                    </div>

                    <button type="submit" class="btn-masjid w-100">
                        <i class="bi bi-check-lg"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Change Password --}}
    <div class="col-lg-6">
        <div class="card-masjid">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-key-fill" style="color: var(--primary); font-size: 1.25rem;"></i>
                <h6 class="mb-0 fw-700">Ubah Password</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control"
                                   id="current_password" name="current_password"
                                   placeholder="Masukkan password saat ini" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password Baru <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                   id="new_password" name="new_password"
                                   placeholder="Minimal 6 karakter" required minlength="6">
                        </div>
                        @error('new_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                            <input type="password" class="form-control"
                                   id="new_password_confirmation" name="new_password_confirmation"
                                   placeholder="Ulangi password baru" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-masjid w-100">
                        <i class="bi bi-shield-check"></i> Perbarui Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
