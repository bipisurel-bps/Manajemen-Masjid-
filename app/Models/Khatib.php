<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Khatib extends Model
{
    protected $fillable = ['name', 'phone', 'notes'];

    /**
     * Generate URL WhatsApp konfirmasi H-2 atau jadwal.
     */
    public function getWhatsAppUrl(?string $scheduleDate = null, ?string $theme = null): ?string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->phone ?? '');
        if (empty($phone)) {
            return null;
        }

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        $dateStr = $scheduleDate ? \Carbon\Carbon::parse($scheduleDate)->translatedFormat('l, d F Y') : 'Jumat mendatang';
        $masjidName = Setting::get('masjid_name', 'SAF');
        $masjidAddress = Setting::get('masjid_address', 'Masjid');
        $themeStr = $theme ?: 'Menyesuaikan';

        $message = "Assalamu'alaikum Warahmatullahi Wabarakatuh,\n\n"
            . "Yth. Ustadz {$this->name},\n\n"
            . "Mengingatkan jadwal khutbah Shalat Jumat di {$masjidName} pada:\n"
            . "📅 Tanggal: {$dateStr}\n"
            . "⏰ Waktu: 11.45 WIB s.d. selesai\n"
            . "🕌 Lokasi: {$masjidAddress}\n"
            . "📖 Tema: {$themeStr}\n\n"
            . "Mohon konfirmasi kesediaan Ustadz. Jazakallahu khairan katsiran.\n\n"
            . "Wassalamu'alaikum Warahmatullahi Wabarakatuh.\n"
            . "- Pengurus DKM {$masjidName}";

        return "https://wa.me/{$phone}?text=" . rawurlencode($message);
    }
}
