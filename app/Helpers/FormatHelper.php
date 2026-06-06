<?php

namespace App\Helpers;

use Carbon\Carbon;

class FormatHelper
{
    public static function formatRupiah(float|int $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }

    public static function formatDate($date, string $format = 'd F Y'): string
    {
        if (!$date) {
            return '-';
        }

        if (is_string($date)) {
            $date = Carbon::parse($date);
        }

        if (!$date instanceof Carbon) {
            return '-';
        }

        Carbon::setLocale('id');

        return $date->translatedFormat($format);
    }

    public static function formatDateShort($date): string
    {
        return self::formatDate($date, 'd M Y');
    }

    public static function formatDateTime($date): string
    {
        return self::formatDate($date, 'd F Y H:i');
    }

    public static function monthName(int $month): string
    {
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        return $months[$month] ?? '';
    }
}
