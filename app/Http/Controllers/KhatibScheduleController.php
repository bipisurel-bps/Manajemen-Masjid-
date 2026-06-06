<?php

namespace App\Http\Controllers;

use App\Models\Khatib;
use App\Models\KhatibSchedule;
use Illuminate\Http\Request;

class KhatibScheduleController extends Controller
{
    public function public()
    {
        $schedules = KhatibSchedule::orderBy('date', 'desc')->get();
        return view('schedules.khatib-public', compact('schedules'));
    }

    public function index()
    {
        $schedules = KhatibSchedule::orderBy('date', 'desc')->paginate(20);
        $khatibs = Khatib::orderBy('name')->get();
        return view('admin.schedules.khatib', compact('schedules', 'khatibs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date|unique:khatib_schedules,date',
            'khatib_name' => 'required|string|max:255',
            'theme' => 'nullable|string|max:500',
            'notes' => 'nullable|string',
        ]);

        KhatibSchedule::create($data);

        return back()->with('success', 'Jadwal khatib berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $schedule = KhatibSchedule::findOrFail($id);

        $data = $request->validate([
            'date' => 'required|date|unique:khatib_schedules,date,' . $id,
            'khatib_name' => 'required|string|max:255',
            'theme' => 'nullable|string|max:500',
            'notes' => 'nullable|string',
        ]);

        $schedule->update($data);

        return back()->with('success', 'Jadwal khatib berhasil diperbarui.');
    }

    public function destroy($id)
    {
        KhatibSchedule::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal khatib berhasil dihapus.');
    }
}
