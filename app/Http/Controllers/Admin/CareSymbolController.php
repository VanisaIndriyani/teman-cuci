<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareSymbolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\CareSymbol::with('category');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('description_short', 'like', "%$search%")
                  ->orWhere('description_long', 'like', "%$search%");
        }

        $symbols = $query->paginate(12);
        $categories = \App\Models\SymbolCategory::all();
        return view('admin.symbols.index', compact('symbols', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:symbol_categories,id',
            'name' => 'required|string|max:255',
            'image_path' => 'required|string',
            'description_short' => 'required|string',
            'description_long' => 'nullable|string',
        ]);

        \App\Models\CareSymbol::create($data);

        return back()->with('success', 'Simbol berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $symbol = \App\Models\CareSymbol::findOrFail($id);
        $data = $request->validate([
            'category_id' => 'required|exists:symbol_categories,id',
            'name' => 'required|string|max:255',
            'image_path' => 'required|string',
            'description_short' => 'required|string',
            'description_long' => 'nullable|string',
        ]);

        $symbol->update($data);

        return back()->with('success', 'Simbol berhasil diperbarui');
    }

    public function destroy($id)
    {
        $symbol = \App\Models\CareSymbol::findOrFail($id);
        $symbol->delete();
        return back()->with('success', 'Simbol berhasil dihapus');
    }
}
