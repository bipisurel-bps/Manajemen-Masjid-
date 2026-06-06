<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CashBookSeeder::class,
            CategorySeeder::class,
            KhatibSeeder::class,
            TransactionSeeder::class,
            KhatibScheduleSeeder::class,
            PengajianScheduleSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
