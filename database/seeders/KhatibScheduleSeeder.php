<?php

namespace Database\Seeders;

use App\Models\KhatibSchedule;
use Illuminate\Database\Seeder;

class KhatibScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $schedules = [
            ['date' => '2026-06-05', 'khatib_name' => 'Ust. Ahmad Fauzi', 'theme' => 'Keutamaan Bulan Dzulhijjah', 'notes' => ''],
            ['date' => '2026-06-12', 'khatib_name' => 'Ust. Muhammad Rizki', 'theme' => 'Istiqomah dalam Ibadah', 'notes' => 'Mohon hadir 15 menit sebelum shalat'],
            ['date' => '2026-06-19', 'khatib_name' => 'Ust. Abdullah Syam', 'theme' => 'Membangun Keluarga Sakinah', 'notes' => ''],
            ['date' => '2026-06-26', 'khatib_name' => 'Ust. Hasan Basri', 'theme' => 'Ilmu dan Amal', 'notes' => ''],
        ];

        foreach ($schedules as $schedule) {
            KhatibSchedule::create($schedule);
        }
    }
}
