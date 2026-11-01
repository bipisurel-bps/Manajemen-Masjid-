<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class KhatibSchedule extends Model
{
    protected $fillable = ['date', 'khatib_name', 'phone', 'theme', 'notes'];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    /**
     * Generate URL WhatsApp konfirmasi jadwal otomatis untuk Takmir (H-2).
     */
    public function getWhatsAppUrl(): ?string
    {
        // Ambil nomor dari jadwal atau dari master data khatib
        $targetPhone = $this->phone;
        if (empty($targetPhone)) {
            $masterKhatib = Khatib::where('name', $this->khatib_name)->first();
            if ($masterKhatib && !empty($masterKhatib->phone)) {
                $targetPhone = $masterKhatib->phone;
            }
        }

        $cleanPhone = preg_replace('/[^0-9]/', '', $targetPhone ?? '');
        if (empty($cleanPhone)) {
            return null;
        }

        if (str_starts_with($cleanPhone, '0')) {
            $cleanPhone = '62' . substr($cleanPhone, 1);
        }

        $dateStr = Carbon::parse($this->date)->translatedFormat('l, d F Y');
        $masjidName = Setting::get('masjid_name', 'SAF');
        $masjidAddress = Setting::get('masjid_address', 'Masjid');
        $themeStr = $this->theme ?: 'Menyesuaikan';

        $message = "Assalamu'alaikum Warahmatullahi Wabarakatuh,\n\n"
            . "Yth. Ustadz {$this->khatib_name},\n\n"
            . "Mengingatkan jadwal khutbah Shalat Jumat di {$masjidName} pada:\n"
            . "📅 Hari/Tanggal: {$dateStr}\n"
            . "⏰ Waktu: 11.45 WIB s.d. selesai\n"
            . "🕌 Lokasi: {$masjidAddress}\n"
            . "📖 Tema Khutbah: {$themeStr}\n\n"
            . "Mohon konfirmasi kesediaan Ustadz untuk jadwal ini. Jazakallahu khairan katsiran.\n\n"
            . "Wassalamu'alaikum Warahmatullahi Wabarakatuh.\n"
            . "— Pengurus DKM {$masjidName}";

        return "https://wa.me/{$cleanPhone}?text=" . rawurlencode($message);
    }
}
