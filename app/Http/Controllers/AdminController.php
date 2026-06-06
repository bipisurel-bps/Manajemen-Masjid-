<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\CashBook;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;
        $transactionCount = Transaction::count();

        $recentTransactions = Transaction::with(['cashBook', 'category', 'creator'])
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Monthly chart data for current year
        $currentYear = now()->year;
        $monthlyIncome = [];
        $monthlyExpense = [];

        for ($m = 1; $m <= 12; $m++) {
            $monthlyIncome[$m] = Transaction::where('type', 'income')
                ->whereYear('transaction_date', $currentYear)
                ->whereMonth('transaction_date', $m)
                ->sum('amount');

            $monthlyExpense[$m] = Transaction::where('type', 'expense')
                ->whereYear('transaction_date', $currentYear)
                ->whereMonth('transaction_date', $m)
                ->sum('amount');
        }

        return view('admin.dashboard', compact(
            'totalIncome', 'totalExpense', 'balance', 'transactionCount',
            'recentTransactions', 'monthlyIncome', 'monthlyExpense', 'currentYear'
        ));
    }
}
