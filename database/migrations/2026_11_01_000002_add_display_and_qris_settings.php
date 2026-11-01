<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

return new class extends Migration
{
    public function up(): void
    {
        $newSettings = [
            // Display TV & Prayer Times
            ['key' => 'masjid_latitude', 'value' => '-6.2088', 'type' => 'text', 'label' => 'Latitude Koordinat Masjid', 'group' => 'display'],
            ['key' => 'masjid_longitude', 'value' => '106.8456', 'type' => 'text', 'label' => 'Longitude Koordinat Masjid', 'group' => 'display'],
            ['key' => 'iqomah_countdown_minutes', 'value' => '10', 'type' => 'text', 'label' => 'Hitung Mundur Iqomah (Menit)', 'group' => 'display'],
            ['key' => 'running_text_announcement', 'value' => 'Mari makmurkan masjid dengan mendirikan shalat berjamaah awal waktu dan infaq terbaik untuk kemaslahatan umat.', 'type' => 'textarea', 'label' => 'Pengumuman Running Text TV', 'group' => 'display'],
            // Transparency & QRIS
            ['key' => 'qris_image', 'value' => '/images/qris-sample.svg', 'type' => 'text', 'label' => 'URL / Gambar QRIS Infaq Masjid', 'group' => 'general'],
        ];

        foreach ($newSettings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }
    }

    public function down(): void
    {
        Setting::whereIn('key', [
            'masjid_latitude',
            'masjid_longitude',
            'iqomah_countdown_minutes',
            'running_text_announcement',
            'qris_image'
        ])->delete();
    }
};
