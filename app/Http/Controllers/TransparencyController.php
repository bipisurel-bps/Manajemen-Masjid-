<?php

namespace App\Http\Controllers;

use App\Models\CashBook;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransparencyController extends Controller
{
    public function index(Request $request)
    {
        $masjidName = Setting::get('masjid_name', 'SAF');
        $masjidAddress = Setting::get('masjid_address', '');
        $masjidPhone = Setting::get('masjid_phone', '');
        $masjidWhatsapp = Setting::get('masjid_whatsapp', '');
        $bankName = Setting::get('bank_name', '');
        $bankAccount = Setting::get('bank_account', '');
        $bankHolder = Setting::get('bank_holder', '');
        $qrisImage = Setting::get('qris_image', '/images/qris-sample.svg');

        // Total akumulasi keuangan
        $totalIncome = (float) Transaction::where('type', 'income')->sum('amount');
        $totalExpense = (float) Transaction::where('type', 'expense')->sum('amount');
        $totalBalance = $totalIncome - $totalExpense;

        // Saldo per Buku Kas aktif
        $cashBooks = CashBook::where('is_active', true)->withCount('transactions')->get();

        // Data 12 Bulan tahun berjalan untuk visualisasi Chart.js
        $currentYear = now()->year;
        $monthlyIncome = [];
        $monthlyExpense = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyIncome[$m] = (float) Transaction::where('type', 'income')
                ->whereYear('transaction_date', $currentYear)
                ->whereMonth('transaction_date', $m)
                ->sum('amount');
            $monthlyExpense[$m] = (float) Transaction::where('type', 'expense')
                ->whereYear('transaction_date', $currentYear)
                ->whereMonth('transaction_date', $m)
                ->sum('amount');
        }

        // Transaksi terbaru untuk transparansi jamaah
        $recentTransactions = Transaction::with(['cashBook', 'category'])
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        return view('transparency.index', compact(
            'masjidName',
            'masjidAddress',
            'masjidPhone',
            'masjidWhatsapp',
            'bankName',
            'bankAccount',
            'bankHolder',
            'qrisImage',
            'totalIncome',
            'totalExpense',
            'totalBalance',
            'cashBooks',
            'currentYear',
            'monthlyIncome',
            'monthlyExpense',
            'recentTransactions'
        ));
    }
}
