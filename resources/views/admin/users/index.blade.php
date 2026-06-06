@extends('layouts.admin')
@section('title', 'Pengguna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-800 mb-1" style="font-size:1.5rem;">Pengguna</h3>
        <p class="text-muted small mb-0">Kelola akun admin masjid</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn-masjid">
        <i class="bi bi-plus-lg"></i> Tambah Pengguna
    </a>
</div>

<div class="card-masjid overflow-hidden">
    <div class="table-responsive">
        <table class="table-masjid">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-center" style="width:100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users ?? [] as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-circle" style="background:var(--primary-50);color:var(--primary);">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span class="fw-700">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td><code style="font-size:0.8rem;">{{ $user->username }}</code></td>
                    <td class="text-muted">{{ $user->email ?: '-' }}</td>
                    <td>
                        <span class="badge-masjid {{ $user->role === 'admin' ? 'badge-active' : 'badge-income' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-icon-only btn-icon-edit" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')">
                                @csrf @method('DELETE')
                                <button class="btn-icon-only btn-icon-delete" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-people"></i>
                            <p class="fw-600">Belum ada pengguna</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
