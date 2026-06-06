<?php

namespace App\Http\Controllers;

use App\Models\PengajianSchedule;
use Illuminate\Http\Request;

class PengajianScheduleController extends Controller
{
    public function public()
    {
        $rutin = PengajianSchedule::where('type', 'rutin')->orderBy('day_of_week')->get();
        $khusus = PengajianSchedule::where('type', 'khusus')->orderBy('date', 'desc')->get();

        return view('schedules.pengajian-public', compact('rutin', 'khusus'));
    }

    public function index()
    {
        $schedules = PengajianSchedule::orderBy('date', 'desc')
            ->orderBy('time', 'asc')
            ->paginate(20);

        return view('admin.schedules.pengajian', compact('schedules'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'day_of_week' => 'nullable|string|max:20',
            'date' => 'nullable|date',
            'time' => 'required',
            'ustadz_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:rutin,khusus',
            'notes' => 'nullable|string',
        ]);

        PengajianSchedule::create($data);

        return back()->with('success', 'Jadwal pengajian berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $schedule = PengajianSchedule::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'day_of_week' => 'nullable|string|max:20',
            'date' => 'nullable|date',
            'time' => 'required',
            'ustadz_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:rutin,khusus',
            'notes' => 'nullable|string',
        ]);

        $schedule->update($data);

        return back()->with('success', 'Jadwal pengajian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        PengajianSchedule::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal pengajian berhasil dihapus.');
    }
}
