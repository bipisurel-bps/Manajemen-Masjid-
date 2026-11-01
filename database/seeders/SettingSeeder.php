<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'masjid_name', 'value' => 'SAF', 'type' => 'text', 'label' => 'Nama Platform', 'group' => 'general'],
            ['key' => 'masjid_tagline', 'value' => 'Tertib, Amanah, Bersama, Berkelanjutan — Sistem Operasi Manajemen Masjid Open Source', 'type' => 'text', 'label' => 'Tagline', 'group' => 'general'],
            ['key' => 'masjid_description', 'value' => 'SAF adalah sistem operasi manajemen masjid open source berlisensi MIT. Mengadopsi filosofi saf salat berjamaah: Tertib administrasi & kegiatan, Amanah pengelolaan dana dan aset, Bersama menghubungkan pengurus dan jamaah, serta Berkelanjutan menjaga riwayat data antar-generasi.', 'type' => 'textarea', 'label' => 'Deskripsi', 'group' => 'general'],
            // Contact (Hanya jaddadeveloper@gmail.com untuk platform open-source)
            ['key' => 'masjid_address', 'value' => '', 'type' => 'textarea', 'label' => 'Alamat Masjid (Dikonfigurasi Mandiri oleh Takmir)', 'group' => 'contact'],
            ['key' => 'masjid_phone', 'value' => '', 'type' => 'text', 'label' => 'Telepon / WhatsApp Pengurus (Dikonfigurasi Mandiri)', 'group' => 'contact'],
            ['key' => 'masjid_whatsapp', 'value' => '', 'type' => 'text', 'label' => 'WhatsApp Pengurus', 'group' => 'contact'],
            ['key' => 'masjid_email', 'value' => 'jaddadeveloper@gmail.com', 'type' => 'email', 'label' => 'Email Pengembang Resmi', 'group' => 'contact'],
            ['key' => 'masjid_hours', 'value' => '', 'type' => 'text', 'label' => 'Jam Operasional', 'group' => 'contact'],
            // Bank (Dikosongkan agar tidak membingungkan; diisi mandiri oleh DKM)
            ['key' => 'bank_name', 'value' => '', 'type' => 'text', 'label' => 'Nama Bank Resmi Masjid', 'group' => 'general'],
            ['key' => 'bank_account', 'value' => '', 'type' => 'text', 'label' => 'No. Rekening Resmi Masjid', 'group' => 'general'],
            ['key' => 'bank_holder', 'value' => '', 'type' => 'text', 'label' => 'Atas Nama Rekening', 'group' => 'general'],
            // Appearance
            ['key' => 'primary_color', 'value' => '#065F46', 'type' => 'text', 'label' => 'Warna Utama', 'group' => 'appearance'],
            ['key' => 'hero_title', 'value' => 'SAF — Sistem Operasi yang Menata Masjid Secara Tertib, Amanah & Berkelanjutan', 'type' => 'text', 'label' => 'Judul Hero', 'group' => 'appearance'],
            ['key' => 'hero_subtitle', 'value' => 'Filosofi SAF: Tertib Administrasi • Amanah Keuangan • Bersama Jamaah • Berkelanjutan Antar-Generasi', 'type' => 'text', 'label' => 'Subtitle Hero', 'group' => 'appearance'],
            // Display TV & Prayer Times
            ['key' => 'masjid_latitude', 'value' => '-6.2088', 'type' => 'text', 'label' => 'Latitude Koordinat Masjid', 'group' => 'display'],
            ['key' => 'masjid_longitude', 'value' => '106.8456', 'type' => 'text', 'label' => 'Longitude Koordinat Masjid', 'group' => 'display'],
            ['key' => 'iqomah_countdown_minutes', 'value' => '10', 'type' => 'text', 'label' => 'Hitung Mundur Iqomah (Menit)', 'group' => 'display'],
            ['key' => 'running_text_announcement', 'value' => 'SAF Masjid — Tertib, Amanah, Bersama, Berkelanjutan. Unduh source code gratis di GitHub (bipisurel-bps) atau hubungi jaddadeveloper@gmail.com.', 'type' => 'textarea', 'label' => 'Pengumuman Running Text TV', 'group' => 'display'],
            ['key' => 'qris_image', 'value' => '/images/qris-sample.svg', 'type' => 'text', 'label' => 'URL / Gambar QRIS Infaq Masjid', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
