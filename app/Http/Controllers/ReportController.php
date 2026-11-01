<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\CashBook;
use App\Models\Category;
use App\Models\KhatibSchedule;
use App\Models\Setting;
use App\Helpers\FormatHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function public(Request $request)
    {
        $cashBooks = CashBook::where('is_active', true)->orderBy('name')->get();

        // Build query
        $incomeQuery = Transaction::with(['category', 'cashBook'])->where('type', 'income');
        $expenseQuery = Transaction::with(['category', 'cashBook'])->where('type', 'expense');

        if ($request->filled('cash_book_id')) {
            $incomeQuery->where('cash_book_id', $request->cash_book_id);
            $expenseQuery->where('cash_book_id', $request->cash_book_id);
        }

        if ($request->filled('month') && $request->filled('year')) {
            $incomeQuery->whereMonth('transaction_date', $request->month)
                ->whereYear('transaction_date', $request->year);
            $expenseQuery->whereMonth('transaction_date', $request->month)
                ->whereYear('transaction_date', $request->year);
        }

        $incomes = $incomeQuery->orderBy('transaction_date', 'desc')->get();
        $expenses = $expenseQuery->orderBy('transaction_date', 'desc')->get();

        $totalIncome = $incomes->sum('amount');
        $totalExpense = $expenses->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('reports.public', compact(
            'cashBooks', 'incomes', 'expenses', 'totalIncome', 'totalExpense', 'balance'
        ));
    }

    public function monthlyReport(Request $request)
    {
        $year = $request->input('year', now()->year);
        $cashBookId = $request->input('cash_book_id');

        $query = Transaction::whereYear('transaction_date', $year);
        if ($cashBookId) {
            $query->where('cash_book_id', $cashBookId);
        }

        $monthlyData = [];
        for ($m = 1; $m <= 12; $m++) {
            $incomeQuery = clone $query;
            $expenseQuery = clone $query;
            $monthlyData[$m] = [
                'month' => FormatHelper::monthName($m),
                'income' => $incomeQuery->where('type', 'income')->whereMonth('transaction_date', $m)->sum('amount'),
                'expense' => $expenseQuery->where('type', 'expense')->whereMonth('transaction_date', $m)->sum('amount'),
            ];
        }

        $cashBooks = CashBook::where('is_active', true)->orderBy('name')->get();

        return view('reports.monthly', compact('monthlyData', 'year', 'cashBooks', 'cashBookId'));
    }

    public function categoryReport(Request $request)
    {
        $cashBookId = $request->input('cash_book_id');
        $type = $request->input('type', 'income');

        $categories = Category::with(['cashBook'])
            ->when($cashBookId, fn($q) => $q->where('cash_book_id', $cashBookId))
            ->where('type', $type)
            ->orderBy('name')
            ->get();

        foreach ($categories as $category) {
            $category->total = Transaction::where('category_id', $category->id)
                ->where('type', $type)
                ->sum('amount');
        }

        $cashBooks = CashBook::where('is_active', true)->orderBy('name')->get();

        return view('reports.category', compact('categories', 'type', 'cashBooks', 'cashBookId'));
    }

    /**
     * Rekapitulasi Kas Mingguan Siap Cetak (A4 Print-Ready) untuk Shalat Jumat.
     */
    public function rekapJumat(Request $request)
    {
        if ($request->filled('date')) {
            $friday = Carbon::parse($request->date)->startOfDay();
        } else {
            $now = Carbon::now();
            $friday = $now->isFriday() ? $now->startOfDay() : $now->next(Carbon::FRIDAY)->startOfDay();
        }

        // Rentang 7 hari: Sabtu pekan lalu s/d Jumat target
        $startDate = (clone $friday)->subDays(6)->startOfDay();
        $endDate = (clone $friday)->endOfDay();

        // 1. Saldo Awal (sebelum tanggal mulai pekan ini)
        $prevIncome = (float) Transaction::where('transaction_date', '<', $startDate->toDateString())
            ->where('type', 'income')
            ->sum('amount');
        $prevExpense = (float) Transaction::where('transaction_date', '<', $startDate->toDateString())
            ->where('type', 'expense')
            ->sum('amount');
        $saldoAwal = $prevIncome - $prevExpense;

        // 2. Transaksi pekan ini
        $transactions = Transaction::with(['cashBook', 'category'])
            ->whereBetween('transaction_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->orderBy('transaction_date', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $incomes = $transactions->where('type', 'income');
        $expenses = $transactions->where('type', 'expense');

        $totalIncome = (float) $incomes->sum('amount');
        $totalExpense = (float) $expenses->sum('amount');
        $saldoAkhir = $saldoAwal + $totalIncome - $totalExpense;

        // 3. Saldo Kumulatif per Buku Kas
        $cashBooks = CashBook::where('is_active', true)->orderBy('name')->get();

        // 4. Jadwal Khatib Jumat ini (jika ada)
        $khatibSchedule = KhatibSchedule::whereDate('date', $friday->toDateString())->first();

        // 5. Informasi Masjid
        $masjidName = Setting::get('masjid_name', 'Masjid Al-Ikhlas');
        $masjidAddress = Setting::get('masjid_address', 'Jl. Kebaikan No. 123');

        return view('reports.rekap-jumat', compact(
            'friday',
            'startDate',
            'endDate',
            'saldoAwal',
            'transactions',
            'incomes',
            'expenses',
            'totalIncome',
            'totalExpense',
            'saldoAkhir',
            'cashBooks',
            'khatibSchedule',
            'masjidName',
            'masjidAddress'
        ));
    }
}
