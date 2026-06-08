<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareSymbol;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareSymbolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CareSymbol::with('category');

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
            'iso_code' => 'required|string|max:20|unique:care_symbols,iso_code',
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            'description_short' => 'required|string',
            'description_long' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0|max:32767',
        ]);

        $path = $request->file('image')->store('care-symbols', 'public');
        $data['image_path'] = Storage::url($path);
        unset($data['image']);

        CareSymbol::create($data);

        return back()->with('success', 'Simbol berhasil ditambahkan');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $symbol = CareSymbol::findOrFail($id);
        $data = $request->validate([
            'category_id' => 'required|exists:symbol_categories,id',
            'iso_code' => 'required|string|max:20|unique:care_symbols,iso_code,' . $symbol->id,
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'description_short' => 'required|string',
            'description_long' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0|max:32767',
        ]);

        if ($request->hasFile('image')) {
            if ($symbol->image_path && str_starts_with($symbol->image_path, '/storage/')) {
                $relative = ltrim(str_replace('/storage/', '', $symbol->image_path), '/');
                if ($relative !== '') {
                    Storage::disk('public')->delete($relative);
                }
            }

            $path = $request->file('image')->store('care-symbols', 'public');
            $data['image_path'] = Storage::url($path);
        } else {
            $data['image_path'] = $symbol->image_path;
        }

        unset($data['image']);
        $symbol->update($data);

        return back()->with('success', 'Simbol berhasil diperbarui');
    }

    public function destroy($id)
    {
        $symbol = CareSymbol::findOrFail($id);

        if ($symbol->image_path && str_starts_with($symbol->image_path, '/storage/')) {
            $relative = ltrim(str_replace('/storage/', '', $symbol->image_path), '/');
            if ($relative !== '') {
                Storage::disk('public')->delete($relative);
            }
        }

        $symbol->delete();
        return back()->with('success', 'Simbol berhasil dihapus');
    }
}
