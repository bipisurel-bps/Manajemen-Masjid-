<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        $groups = [
            'general' => 'Umum',
            'contact' => 'Kontak',
            'appearance' => 'Tampilan',
            'display' => 'Display Layar TV & Jadwal Shalat',
        ];
        return view('admin.settings.index', compact('settings', 'groups'));
    }

    public function update(Request $request)
    {
        $settings = Setting::all();

        foreach ($settings as $setting) {
            $setting->value = $request->input("settings.{$setting->id}", $setting->value);
            $setting->save();
        }

        Setting::bustCache();
        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}
