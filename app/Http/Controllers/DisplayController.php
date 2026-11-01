<?php

namespace App\Http\Controllers;

use App\Models\CashBook;
use App\Models\KhatibSchedule;
use App\Models\PengajianSchedule;
use App\Models\Setting;
use App\Models\Transaction;
use Carbon\Carbon;

class DisplayController extends Controller
{
    public function index()
    {
        // 1. Settings Masjid & Koordinat untuk Hisab Sholat
        $masjidName = Setting::get('masjid_name', 'Masjid Al-Ikhlas');
        $masjidAddress = Setting::get('masjid_address', 'Jl. Kebaikan No. 123');
        $masjidTagline = Setting::get('masjid_tagline', 'Membangun Umat, Meraih Berkah');
        $latitude = (float) Setting::get('masjid_latitude', '-6.2088');
        $longitude = (float) Setting::get('masjid_longitude', '106.8456');
        $iqomahMinutes = (int) Setting::get('iqomah_countdown_minutes', '10');
        $runningText = Setting::get('running_text_announcement', 'Mari makmurkan masjid dengan shalat berjamaah awal waktu.');

        // 2. Posisi Keuangan Terkini
        $totalIncome = (float) Transaction::where('type', 'income')->sum('amount');
        $totalExpense = (float) Transaction::where('type', 'expense')->sum('amount');
        $totalBalance = $totalIncome - $totalExpense;
        $cashBooks = CashBook::where('is_active', true)->get();

        // 3. Jadwal Pengajian & Khatib Terdekat
        $today = Carbon::today()->toDateString();
        $upcomingPengajian = PengajianSchedule::where(function ($q) use ($today) {
            $q->where('type', 'rutin')->orWhere('date', '>=', $today);
        })->limit(3)->get();

        $upcomingFriday = Carbon::now()->isFriday() ? Carbon::now()->startOfDay() : Carbon::now()->next(Carbon::FRIDAY)->startOfDay();
        $fridayKhatib = KhatibSchedule::whereDate('date', $upcomingFriday->toDateString())->first();

        return view('display.index', compact(
            'masjidName',
            'masjidAddress',
            'masjidTagline',
            'latitude',
            'longitude',
            'iqomahMinutes',
            'runningText',
            'totalBalance',
            'cashBooks',
            'upcomingPengajian',
            'fridayKhatib',
            'upcomingFriday'
        ));
    }
}
