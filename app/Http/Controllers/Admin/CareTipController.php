<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareTip;
use Illuminate\Http\Request;

class CareTipController extends Controller
{
    public function index(Request $request)
    {
        $query = CareTip::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('method_code', 'like', "%$search%")
                  ->orWhere('fabric_filter', 'like', "%$search%")
                  ->orWhere('color_filter', 'like', "%$search%")
                  ->orWhere('motif_filter', 'like', "%$search%")
                  ->orWhere('tip_text', 'like', "%$search%");
        }

        $tips = $query->orderBy('method_code')->paginate(10);
        return view('admin.tips.index', compact('tips'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'method_code' => 'required',
            'fabric_filter' => 'nullable',
            'color_filter' => 'nullable',
            'motif_filter' => 'nullable',
            'tip_text' => 'required',
            'sort_order' => 'nullable|integer',
        ]);

        CareTip::create($data);
        return back()->with('success', 'Tips berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $tip = CareTip::findOrFail($id);
        $data = $request->validate([
            'method_code' => 'required',
            'fabric_filter' => 'nullable',
            'color_filter' => 'nullable',
            'motif_filter' => 'nullable',
            'tip_text' => 'required',
            'sort_order' => 'nullable|integer',
        ]);

        $tip->update($data);
        return back()->with('success', 'Tips berhasil diperbarui');
    }

    public function destroy($id)
    {
        CareTip::findOrFail($id)->delete();
        return back()->with('success', 'Tips berhasil dihapus');
    }
}
