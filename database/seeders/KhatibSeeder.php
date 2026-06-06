<?php

namespace Database\Seeders;

use App\Models\Khatib;
use Illuminate\Database\Seeder;

class KhatibSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Ust. Ahmad Fauzi',
            'Ust. Muhammad Rizki',
            'Ust. Abdullah Syam',
            'Ust. Hasan Basri',
            'Ust. Ali Imron',
            'Ust. Yusuf Mansur',
        ];

        foreach ($names as $name) {
            Khatib::create(['name' => $name]);
        }
    }
}
