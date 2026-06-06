<?php

namespace App\Http\Controllers;

use App\Models\CashBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashBookController extends Controller
{
    public function index()
    {
        $cashBooks = CashBook::with(['creator'])
            ->orderBy('name')
            ->get();

        return view('admin.cashbooks.index', compact('cashBooks'));
    }

    public function create()
    {
        return view('admin.cashbooks.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['slug'] = str()->slug($data['name']);
        $data['created_by'] = Auth::id();
        $data['is_active'] = $request->boolean('is_active', true);

        // Ensure unique slug
        $count = 0;
        $originalSlug = $data['slug'];
        while (CashBook::where('slug', $data['slug'])->exists()) {
            $count++;
            $data['slug'] = $originalSlug . '-' . $count;
        }

        CashBook::create($data);

        return redirect()->route('admin.cashbooks.index')
            ->with('success', 'Buku kas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $cashBook = CashBook::findOrFail($id);
        return view('admin.cashbooks.form', compact('cashBook'));
    }

    public function update(Request $request, $id)
    {
        $cashBook = CashBook::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
        ]);

        $data['slug'] = str()->slug($data['name']);
        $data['is_active'] = $request->boolean('is_active', true);

        // Ensure unique slug (ignore self)
        $count = 0;
        $originalSlug = $data['slug'];
        while (CashBook::where('slug', $data['slug'])->where('id', '!=', $id)->exists()) {
            $count++;
            $data['slug'] = $originalSlug . '-' . $count;
        }

        $cashBook->update($data);

        return redirect()->route('admin.cashbooks.index')
            ->with('success', 'Buku kas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $cashBook = CashBook::findOrFail($id);

        if ($cashBook->transactions()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus buku kas yang memiliki transaksi.');
        }

        $cashBook->delete();

        return redirect()->route('admin.cashbooks.index')
            ->with('success', 'Buku kas berhasil dihapus.');
    }
}
