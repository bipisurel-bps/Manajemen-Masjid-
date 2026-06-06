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
            ['key' => 'masjid_name', 'value' => 'Masjid Al-Ikhlas', 'type' => 'text', 'label' => 'Nama Masjid', 'group' => 'general'],
            ['key' => 'masjid_tagline', 'value' => 'Membangun Umat, Meraih Berkah', 'type' => 'text', 'label' => 'Tagline', 'group' => 'general'],
            ['key' => 'masjid_description', 'value' => 'Masjid Al-Ikhlas adalah pusat ibadah dan kegiatan keislaman yang mengedepankan transparansi, akuntabilitas, dan amanah dalam pengelolaan keuangan masjid.', 'type' => 'textarea', 'label' => 'Deskripsi', 'group' => 'general'],
            // Contact
            ['key' => 'masjid_address', 'value' => 'Jl. Kebaikan No. 123, RT 01 RW 02, Kelurahan Damai, Kecamatan Tentram, Jakarta Selatan 12345', 'type' => 'textarea', 'label' => 'Alamat', 'group' => 'contact'],
            ['key' => 'masjid_phone', 'value' => '021-12345678', 'type' => 'text', 'label' => 'Telepon', 'group' => 'contact'],
            ['key' => 'masjid_whatsapp', 'value' => '081234567890', 'type' => 'text', 'label' => 'WhatsApp', 'group' => 'contact'],
            ['key' => 'masjid_email', 'value' => 'info@masjidalikhlas.or.id', 'type' => 'email', 'label' => 'Email', 'group' => 'contact'],
            ['key' => 'masjid_hours', 'value' => 'Setiap Hari: 04:00 - 22:00 WIB', 'type' => 'text', 'label' => 'Jam Operasional', 'group' => 'contact'],
            // Bank
            ['key' => 'bank_name', 'value' => 'Bank Syariah Indonesia (BSI)', 'type' => 'text', 'label' => 'Nama Bank', 'group' => 'general'],
            ['key' => 'bank_account', 'value' => '7123456789', 'type' => 'text', 'label' => 'No. Rekening', 'group' => 'general'],
            ['key' => 'bank_holder', 'value' => 'Masjid Al-Ikhlas', 'type' => 'text', 'label' => 'Atas Nama', 'group' => 'general'],
            // Appearance
            ['key' => 'primary_color', 'value' => '#198754', 'type' => 'text', 'label' => 'Warna Utama', 'group' => 'appearance'],
            ['key' => 'hero_title', 'value' => 'Selamat Datang di Masjid Al-Ikhlas', 'type' => 'text', 'label' => 'Judul Hero', 'group' => 'appearance'],
            ['key' => 'hero_subtitle', 'value' => 'Laporan Keuangan Transparan • Jadwal Ibadah Terupdate • Manajemen Masjid Modern', 'type' => 'text', 'label' => 'Subtitle Hero', 'group' => 'appearance'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
