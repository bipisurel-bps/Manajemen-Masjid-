<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\CashBook;

class HomeController extends Controller
{
    public function index()
    {
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $recentTransactions = Transaction::with(['cashBook', 'category'])
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $cashBooks = CashBook::where('is_active', true)->count();
        $cashBookList = CashBook::where('is_active', true)->get();
        $totalTransactions = Transaction::count();
        $upcomingKhatib = \App\Models\KhatibSchedule::with('khatib')
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->first() ?? \App\Models\KhatibSchedule::with('khatib')->orderBy('date', 'desc')->first();
        $upcomingPengajian = \App\Models\PengajianSchedule::where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->first() ?? \App\Models\PengajianSchedule::orderBy('date', 'desc')->first();

        return view('home', compact(
            'totalIncome',
            'totalExpense',
            'balance',
            'recentTransactions',
            'cashBooks',
            'cashBookList',
            'totalTransactions',
            'upcomingKhatib',
            'upcomingPengajian'
        ));
    }

    public function contact()
    {
        return view('contact');
    }
}
