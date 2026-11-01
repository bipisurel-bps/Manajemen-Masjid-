<?php

namespace Database\Seeders;

use App\Models\PengajianSchedule;
use Illuminate\Database\Seeder;

class PengajianScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $schedules = [
            [
                'title' => 'Pengajian Rutin Malam Selasa',
                'day_of_week' => 'Senin',
                'date' => null,
                'time' => '20:00',
                'ustadz_name' => 'Ust. Ahmad Fauzi',
                'location' => 'Masjid',
                'type' => 'rutin',
                'notes' => 'Membahas kitab Riyadhus Shalihin',
            ],
            [
                'title' => 'Pengajian Ibu-Ibu',
                'day_of_week' => 'Kamis',
                'date' => null,
                'time' => '09:00',
                'ustadz_name' => 'Ustdz. Fatimah Zahra',
                'location' => 'Masjid',
                'type' => 'rutin',
                'notes' => 'Pengajian khusus ibu-ibu, membahas fiqih wanita',
            ],
            [
                'title' => 'Kajian Tafsir Al-Quran',
                'day_of_week' => 'Sabtu',
                'date' => null,
                'time' => '16:00',
                'ustadz_name' => 'Ust. Muhammad Rizki',
                'location' => 'Masjid',
                'type' => 'rutin',
                'notes' => 'Tafsir surat Al-Kahfi',
            ],
            [
                'title' => 'Tabliq Akbar Menyambut Idul Adha',
                'day_of_week' => null,
                'date' => '2026-06-07',
                'time' => '08:30',
                'ustadz_name' => 'Ust. Yusuf Mansur',
                'location' => 'Halaman Masjid',
                'type' => 'khusus',
                'notes' => 'Terbuka untuk umum, mohon membawa alas duduk',
            ],
            [
                'title' => 'Kajian Akhir Bulan',
                'day_of_week' => null,
                'date' => '2026-06-28',
                'time' => '19:00',
                'ustadz_name' => 'Ust. Ali Imron',
                'location' => 'Aula Masjid',
                'type' => 'khusus',
                'notes' => 'Tema: Persiapan Tahun Baru Hijriyah',
            ],
        ];

        foreach ($schedules as $schedule) {
            PengajianSchedule::create($schedule);
        }
    }
}
