@extends('layouts.admin')
@section('title', isset($transaction) ? 'Edit Transaksi' : 'Tambah Transaksi')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="mb-4">
            <a href="{{ route('admin.transactions.index') }}" class="text-muted small text-decoration-none">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card-masjid">
            <div class="card-header d-flex align-items-center gap-2">
                <div class="stat-icon balance" style="width:32px;height:32px;font-size:0.875rem;">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <h5 class="mb-0 fw-700">{{ isset($transaction) ? 'Edit Transaksi' : 'Tambah Transaksi Baru' }}</h5>
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

                <form method="POST" action="{{ isset($transaction) ? route('admin.transactions.update', $transaction->id) : route('admin.transactions.store') }}">
                    @csrf
                    @if(isset($transaction)) @method('PUT') @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Buku Kas</label>
                            <select name="cash_book_id" id="cash_book_id" class="form-select" required>
                                <option value="">-- Pilih Buku Kas --</option>
                                @foreach($cashBooks ?? [] as $cb)
                                    <option value="{{ $cb->id }}"
                                        {{ old('cash_book_id', $transaction->cash_book_id ?? '') == $cb->id ? 'selected' : '' }}>
                                        {{ $cb->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Transaksi</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="income" {{ old('type', $transaction->type ?? '') == 'income' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="expense" {{ old('type', $transaction->type ?? '') == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories ?? [] as $cat)
                                    <option value="{{ $cat->id }}"
                                        data-cash-book="{{ $cat->cash_book_id }}"
                                        data-type="{{ $cat->type }}"
                                        {{ old('category_id', $transaction->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Transaksi</label>
                            <input type="date" name="transaction_date" class="form-control"
                                value="{{ old('transaction_date', isset($transaction) ? $transaction->transaction_date->format('Y-m-d') : date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jumlah (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="amount" class="form-control"
                                    value="{{ old('amount', $transaction->amount ?? '') }}"
                                    placeholder="Jumlah" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="description" class="form-control"
                                value="{{ old('description', $transaction->description ?? '') }}"
                                placeholder="Deskripsi transaksi">
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn-masjid">
                            <i class="bi bi-check-lg"></i> Simpan
                        </button>
                        <a href="{{ route('admin.transactions.index') }}" class="btn-masjid-outline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function() {
    const cashBookSelect = document.getElementById('cash_book_id');
    const typeSelect = document.getElementById('type');
    const categorySelect = document.getElementById('category_id');

    // Backup all original options (inc. placeholder)
    const allOriginalOptions = Array.from(categorySelect.options).map(opt => ({
        value: opt.value,
        text: opt.text,
        cashBook: opt.dataset.cashBook || '',
        type: opt.dataset.type || '',
        selected: opt.selected
    }));

    function rebuildOptions() {
        const cashBookId = cashBookSelect.value;
        const typeVal = typeSelect.value;
        const currentVal = categorySelect.value;

        // Clear all options
        categorySelect.innerHTML = '';

        allOriginalOptions.forEach(orig => {
            if (!orig.value) {
                // Placeholder option — always show
                const opt = document.createElement('option');
                opt.value = '';
                opt.textContent = orig.text;
                categorySelect.appendChild(opt);
            } else if (
                (!cashBookId || orig.cashBook === cashBookId) &&
                (!typeVal || orig.type === typeVal)
            ) {
                const opt = document.createElement('option');
                opt.value = orig.value;
                opt.textContent = orig.text;
                if (orig.cashBook) opt.dataset.cashBook = orig.cashBook;
                if (orig.type) opt.dataset.type = orig.type;
                if (orig.value === currentVal) opt.selected = true;
                categorySelect.appendChild(opt);
            }
        });

        // Restore previous selection if still available
        if (currentVal && categorySelect.querySelector(`option[value="${currentVal}"]`)) {
            categorySelect.value = currentVal;
        }
    }

    cashBookSelect.addEventListener('change', rebuildOptions);
    typeSelect.addEventListener('change', rebuildOptions);
    rebuildOptions();
})();
</script>
@endpush
