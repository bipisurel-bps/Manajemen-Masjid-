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

        return view('home', compact('totalIncome', 'totalExpense', 'balance', 'recentTransactions', 'cashBooks'));
    }

    public function contact()
    {
        return view('contact');
    }
}
