<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\CashBook;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $kasUmum = CashBook::where('slug', 'kas-umum')->first();
        $kasPembangunan = CashBook::where('slug', 'kas-pembangunan')->first();
        $kasRemaja = CashBook::where('slug', 'kas-remaja')->first();

        $admin = User::where('username', 'bendahara')->first();
        $userId = $admin ? $admin->id : null;

        $transactions = [
            // Kas Umum - Income
            ['cash_book_id' => $kasUmum->id, 'category' => 'Infaq Jumat', 'type' => 'income', 'amount' => 2500000, 'desc' => 'Infaq Jumat pekan pertama', 'date' => '2026-06-05'],
            ['cash_book_id' => $kasUmum->id, 'category' => 'Infaq Jumat', 'type' => 'income', 'amount' => 2750000, 'desc' => 'Infaq Jumat pekan kedua', 'date' => '2026-06-12'],
            ['cash_book_id' => $kasUmum->id, 'category' => 'Donasi Umum', 'type' => 'income', 'amount' => 5000000, 'desc' => 'Donasi dari Haji Sutrisno', 'date' => '2026-06-10'],
            ['cash_book_id' => $kasUmum->id, 'category' => 'Sedekah', 'type' => 'income', 'amount' => 1000000, 'desc' => 'Sedekah anonim', 'date' => '2026-06-15'],

            // Kas Umum - Expense
            ['cash_book_id' => $kasUmum->id, 'category' => 'Listrik & Air', 'type' => 'expense', 'amount' => 850000, 'desc' => 'Tagihan listrik Juni', 'date' => '2026-06-01'],
            ['cash_book_id' => $kasUmum->id, 'category' => 'Kebersihan', 'type' => 'expense', 'amount' => 300000, 'desc' => 'Peralatan kebersihan', 'date' => '2026-06-03'],
            ['cash_book_id' => $kasUmum->id, 'category' => 'Konsumsi', 'type' => 'expense', 'amount' => 450000, 'desc' => 'Konsumsi rapat pengurus', 'date' => '2026-06-08'],
            ['cash_book_id' => $kasUmum->id, 'category' => 'ATK', 'type' => 'expense', 'amount' => 150000, 'desc' => 'Pembelian kertas dan tinta', 'date' => '2026-06-14'],

            // Kas Pembangunan - Income
            ['cash_book_id' => $kasPembangunan->id, 'category' => 'Donasi Pembangunan', 'type' => 'income', 'amount' => 15000000, 'desc' => 'Donasi dari keluarga H. Rahman', 'date' => '2026-06-02'],
            ['cash_book_id' => $kasPembangunan->id, 'category' => 'Donasi Pembangunan', 'type' => 'income', 'amount' => 5000000, 'desc' => 'Donasi anonim', 'date' => '2026-06-18'],

            // Kas Pembangunan - Expense
            ['cash_book_id' => $kasPembangunan->id, 'category' => 'Material', 'type' => 'expense', 'amount' => 8500000, 'desc' => 'Pembelian semen dan pasir', 'date' => '2026-06-04'],
            ['cash_book_id' => $kasPembangunan->id, 'category' => 'Tukang', 'type' => 'expense', 'amount' => 6000000, 'desc' => 'Upah tukang 2 minggu', 'date' => '2026-06-16'],
            ['cash_book_id' => $kasPembangunan->id, 'category' => 'Perizinan', 'type' => 'expense', 'amount' => 1500000, 'desc' => 'Biaya perizinan IMB', 'date' => '2026-06-20'],

            // Kas Remaja - Income
            ['cash_book_id' => $kasRemaja->id, 'category' => 'Iuran Anggota', 'type' => 'income', 'amount' => 600000, 'desc' => 'Iuran anggota bulan Juni', 'date' => '2026-06-03'],
            ['cash_book_id' => $kasRemaja->id, 'category' => 'Donasi', 'type' => 'income', 'amount' => 1200000, 'desc' => 'Donasi kegiatan', 'date' => '2026-06-11'],

            // Kas Remaja - Expense
            ['cash_book_id' => $kasRemaja->id, 'category' => 'Konsumsi Pengajian', 'type' => 'expense', 'amount' => 350000, 'desc' => 'Snack pengajian remaja', 'date' => '2026-06-06'],
            ['cash_book_id' => $kasRemaja->id, 'category' => 'Perlengkapan', 'type' => 'expense', 'amount' => 250000, 'desc' => 'Sound system portable', 'date' => '2026-06-13'],
            ['cash_book_id' => $kasRemaja->id, 'category' => 'Transportasi', 'type' => 'expense', 'amount' => 200000, 'desc' => 'Transportasi studi banding', 'date' => '2026-06-19'],
        ];

        foreach ($transactions as $t) {
            $category = Category::where('name', $t['category'])
                ->where('cash_book_id', $t['cash_book_id'])
                ->where('type', $t['type'])
                ->first();

            Transaction::create([
                'cash_book_id' => $t['cash_book_id'],
                'category_id' => $category ? $category->id : null,
                'type' => $t['type'],
                'amount' => $t['amount'],
                'description' => $t['desc'],
                'transaction_date' => $t['date'],
                'created_by' => $userId,
            ]);
        }
    }
}
