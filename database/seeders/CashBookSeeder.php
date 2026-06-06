<?php

namespace Database\Seeders;

use App\Models\CashBook;
use Illuminate\Database\Seeder;

class CashBookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['name' => 'Kas Umum', 'slug' => 'kas-umum', 'description' => 'Kas operasional harian masjid'],
            ['name' => 'Kas Pembangunan', 'slug' => 'kas-pembangunan', 'description' => 'Kas pembangunan dan renovasi masjid'],
            ['name' => 'Kas Remaja Masjid', 'slug' => 'kas-remaja', 'description' => 'Kas kegiatan remaja masjid'],
        ];

        foreach ($books as $book) {
            CashBook::create($book);
        }
    }
}
