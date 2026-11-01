<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\CashBook;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['cashBook', 'category', 'creator']);

        if ($request->filled('cash_book_id')) {
            $query->where('cash_book_id', $request->cash_book_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('transaction_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('transaction_date', '<=', $request->date_to);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        $cashBooks = CashBook::where('is_active', true)->orderBy('name')->get();

        return view('admin.transactions.index', compact('transactions', 'cashBooks'));
    }

    public function create()
    {
        $cashBooks = CashBook::where('is_active', true)->orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.transactions.form', compact('cashBooks', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cash_book_id' => 'required|exists:cash_books,id',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:500',
            'transaction_date' => 'required|date',
        ]);

        $data['created_by'] = Auth::id();
        $data['amount'] = (float) str_replace(['Rp', '.', ' '], '', $data['amount']);

        DB::transaction(function () use ($data) {
            $transaction = Transaction::create($data);

            // Verifikasi integritas saldo secara runtime
            $cashBook = CashBook::findOrFail($data['cash_book_id']);
            $verifiedBalance = $cashBook->verifyBalance();

            Log::info("Transaksi {$transaction->id} dicatat secara atomik. Saldo terverifikasi Buku Kas #{$cashBook->id}: {$verifiedBalance}");
        });

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan secara atomik.');
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $cashBooks = CashBook::where('is_active', true)->orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.transactions.form', compact('transaction', 'cashBooks', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $data = $request->validate([
            'cash_book_id' => 'required|exists:cash_books,id',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:500',
            'transaction_date' => 'required|date',
        ]);

        $data['amount'] = (float) str_replace(['Rp', '.', ' '], '', $data['amount']);

        DB::transaction(function () use ($transaction, $data) {
            $oldCashBookId = $transaction->cash_book_id;
            $transaction->update($data);

            // Verifikasi integritas saldo buku kas baru
            $cashBook = CashBook::findOrFail($data['cash_book_id']);
            $cashBook->verifyBalance();

            // Jika buku kas berpindah, verifikasi buku kas lama
            if ($oldCashBookId !== $data['cash_book_id']) {
                $oldCashBook = CashBook::find($oldCashBookId);
                if ($oldCashBook) {
                    $oldCashBook->verifyBalance();
                }
            }
        });

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui secara atomik.');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        DB::transaction(function () use ($transaction) {
            $cashBookId = $transaction->cash_book_id;
            $transaction->delete();

            $cashBook = CashBook::find($cashBookId);
            if ($cashBook) {
                $cashBook->verifyBalance();
            }
        });

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil dihapus secara atomik.');
    }
}
