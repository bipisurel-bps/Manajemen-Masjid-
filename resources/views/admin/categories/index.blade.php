@extends('layouts.admin')
@section('title', 'Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-800 mb-1" style="font-size:1.5rem;">Kategori</h3>
        <p class="text-muted small mb-0">Kelola kategori pemasukan & pengeluaran</p>
    </div>
</div>

@if(isset($cashBooks) && $cashBooks->count() > 1)
<!-- Cash Book Tabs -->
<ul class="nav nav-pills mb-4 gap-2" id="cashbookTabs" role="tablist">
    @foreach($cashBooks as $i => $cb)
    <li class="nav-item" role="presentation">
        <button class="nav-link fw-600 {{ $i === 0 ? 'active' : '' }}" id="tab-{{ $cb->id }}"
            data-bs-toggle="pill" data-bs-target="#panel-{{ $cb->id }}" type="button" role="tab"
            style="border-radius: var(--radius-sm); {{ $i === 0 ? 'background: var(--primary); color: #fff;' : 'background: #fff; border: 1px solid var(--border); color: var(--text-muted);' }}">
            <i class="bi bi-journal-bookmark me-1"></i> {{ $cb->name }}
        </button>
    </li>
    @endforeach
</ul>
@endif

<div class="tab-content">
    @forelse($cashBooks ?? [] as $i => $cb)
    <div class="tab-pane fade {{ $i === 0 ? 'show active' : '' }}" id="panel-{{ $cb->id }}" role="tabpanel">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card-masjid">
                    <div class="card-header d-flex justify-content-between align-items-center" style="color: var(--income);">
                        <div class="d-flex align-items-center gap-2">
                            <div class="stat-icon income" style="width:28px;height:28px;font-size:0.75rem;">
                                <i class="bi bi-arrow-down-circle-fill"></i>
                            </div>
                            <h6 class="mb-0 fw-700">Pemasukan</h6>
                        </div>
                        <button class="btn-masjid btn-sm" data-bs-toggle="modal" data-bs-target="#addCatModal{{ $cb->id }}" onclick="setCatType('income')">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @php $incomeCats = $cb->categories->where('type', 'income'); @endphp
                            @forelse($incomeCats as $cat)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4 border-0 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge-masjid badge-income">IN</span>
                                    <span class="fw-600">{{ $cat->name }}</span>
                                </div>
                                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-icon-only btn-icon-delete" style="width:28px;height:28px;font-size:0.75rem;">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </form>
                            </li>
                            @empty
                            <li class="list-group-item py-4 text-center text-muted small border-0">
                                <i class="bi bi-inbox d-block mb-1" style="font-size:1.25rem;opacity:0.3;"></i>
                                Belum ada kategori pemasukan
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card-masjid">
                    <div class="card-header d-flex justify-content-between align-items-center" style="color: var(--expense);">
                        <div class="d-flex align-items-center gap-2">
                            <div class="stat-icon expense" style="width:28px;height:28px;font-size:0.75rem;">
                                <i class="bi bi-arrow-up-circle-fill"></i>
                            </div>
                            <h6 class="mb-0 fw-700">Pengeluaran</h6>
                        </div>
                        <button class="btn-masjid btn-sm" data-bs-toggle="modal" data-bs-target="#addCatModal{{ $cb->id }}" onclick="setCatType('expense')">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @php $expenseCats = $cb->categories->where('type', 'expense'); @endphp
                            @forelse($expenseCats as $cat)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4 border-0 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge-masjid badge-expense">OUT</span>
                                    <span class="fw-600">{{ $cat->name }}</span>
                                </div>
                                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-icon-only btn-icon-delete" style="width:28px;height:28px;font-size:0.75rem;">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </form>
                            </li>
                            @empty
                            <li class="list-group-item py-4 text-center text-muted small border-0">
                                <i class="bi bi-inbox d-block mb-1" style="font-size:1.25rem;opacity:0.3;"></i>
                                Belum ada kategori pengeluaran
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Category Modal -->
        <div class="modal fade" id="addCatModal{{ $cb->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-lg">
                    <div class="modal-header" style="background: var(--primary); color: #fff; border-radius: 14px 14px 0 0; padding: 1rem 1.25rem;">
                        <h6 class="modal-title fw-700"><i class="bi bi-plus-circle me-1"></i>Tambah Kategori - {{ $cb->name }}</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <input type="hidden" name="cash_book_id" value="{{ $cb->id }}">
                        <div class="modal-body p-4">
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" name="name" class="form-control" placeholder="Nama kategori" required>
                            </div>
                            <div>
                                <label class="form-label">Jenis</label>
                                <select name="type" class="form-select" id="catType{{ $cb->id }}" required>
                                    <option value="income">Pemasukan</option>
                                    <option value="expense">Pengeluaran</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn-masjid-outline btn-sm" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-masjid btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <i class="bi bi-tags"></i>
        <p class="fw-600">Belum ada buku kas</p>
        <a href="{{ route('admin.cashbooks.create') }}" class="btn-masjid btn-sm mt-2">Tambah Buku Kas</a>
    </div>
    @endforelse
</div>
@endsection

@push('scripts')
<script>
    // Style the active tab pill
    document.querySelectorAll('#cashbookTabs .nav-link').forEach(btn => {
        btn.addEventListener('shown.bs.tab', function(e) {
            // Remove active styling from all
            document.querySelectorAll('#cashbookTabs .nav-link').forEach(b => {
                b.style.background = '#fff';
                b.style.color = 'var(--text-muted)';
                b.style.border = '1px solid var(--border)';
            });
            // Style the active one
            e.target.style.background = 'var(--primary)';
            e.target.style.color = '#fff';
            e.target.style.border = 'none';
        });
    });

    function setCatType(type) {
        // Store for the modal that's about to open
        setTimeout(() => {
            const activePane = document.querySelector('.tab-pane.show.active');
            if (activePane) {
                const select = activePane.querySelector('[id^="catType"]');
                if (select) select.value = type;
            }
        }, 50);
    }
</script>
@endpush
