<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CashBook;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $kasUmum = CashBook::where('slug', 'kas-umum')->first();
        $kasPembangunan = CashBook::where('slug', 'kas-pembangunan')->first();
        $kasRemaja = CashBook::where('slug', 'kas-remaja')->first();

        // Kas Umum - Income
        $incomeUmum = ['Infaq Jumat', 'Infaq Ramadhan', 'Sedekah', 'Wakaf', 'Donasi Umum'];
        foreach ($incomeUmum as $name) {
            Category::create(['cash_book_id' => $kasUmum->id, 'name' => $name, 'type' => 'income']);
        }

        // Kas Umum - Expense
        $expenseUmum = ['Listrik & Air', 'Kebersihan', 'Perbaikan Ringan', 'Konsumsi', 'ATK'];
        foreach ($expenseUmum as $name) {
            Category::create(['cash_book_id' => $kasUmum->id, 'name' => $name, 'type' => 'expense']);
        }

        // Kas Pembangunan - Income
        $incomePembangunan = ['Donasi Pembangunan', 'Wakaf Tanah'];
        foreach ($incomePembangunan as $name) {
            Category::create(['cash_book_id' => $kasPembangunan->id, 'name' => $name, 'type' => 'income']);
        }

        // Kas Pembangunan - Expense
        $expensePembangunan = ['Material', 'Tukang', 'Arsitek', 'Perizinan'];
        foreach ($expensePembangunan as $name) {
            Category::create(['cash_book_id' => $kasPembangunan->id, 'name' => $name, 'type' => 'expense']);
        }

        // Kas Remaja - Income
        $incomeRemaja = ['Iuran Anggota', 'Donasi'];
        foreach ($incomeRemaja as $name) {
            Category::create(['cash_book_id' => $kasRemaja->id, 'name' => $name, 'type' => 'income']);
        }

        // Kas Remaja - Expense
        $expenseRemaja = ['Konsumsi Pengajian', 'Transportasi', 'Perlengkapan'];
        foreach ($expenseRemaja as $name) {
            Category::create(['cash_book_id' => $kasRemaja->id, 'name' => $name, 'type' => 'expense']);
        }
    }
}
