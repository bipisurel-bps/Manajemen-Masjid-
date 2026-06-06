<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CashBook;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $cashBooks = CashBook::with(['categories'])->orderBy('name')->get();
        return view('admin.categories.index', compact('cashBooks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cash_book_id' => 'required|exists:cash_books,id',
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
        ]);

        Category::create($data);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->transactions()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena memiliki transaksi.');
        }

        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
