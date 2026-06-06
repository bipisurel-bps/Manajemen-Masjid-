<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\CashBook;
use App\Models\Category;
use App\Helpers\FormatHelper;
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
}
