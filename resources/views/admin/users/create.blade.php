@extends('layouts.admin')
@section('title', isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">
        <div class="mb-4">
            <a href="{{ route('admin.users.index') }}" class="text-muted small text-decoration-none">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card-masjid">
            <div class="card-header d-flex align-items-center gap-2">
                <div class="stat-icon neutral" style="width:32px;height:32px;font-size:0.875rem;">
                    <i class="bi bi-person-plus"></i>
                </div>
                <h5 class="mb-0 fw-700">{{ isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}</h5>
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

                <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}">
                    @csrf
                    @if(isset($user)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $user->name ?? '') }}" placeholder="Nama lengkap" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control"
                            value="{{ old('username', $user->username ?? '') }}" placeholder="Username" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $user->email ?? '') }}" placeholder="email@contoh.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="operator" {{ old('role', $user->role ?? '') === 'operator' ? 'selected' : '' }}>Operator</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password {{ isset($user) ? '(Kosongkan jika tidak ingin mengubah)' : '' }}</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="{{ isset($user) ? 'Password baru...' : 'Minimal 8 karakter' }}"
                            {{ isset($user) ? '' : 'required' }}>
                    </div>

                    @if(isset($user))
                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Ulangi password baru">
                    </div>
                    @else
                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Ulangi password" required>
                    </div>
                    @endif

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-masjid">
                            <i class="bi bi-check-lg"></i> Simpan
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn-masjid-outline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
