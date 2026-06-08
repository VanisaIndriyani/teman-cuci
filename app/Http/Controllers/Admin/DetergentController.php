<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetergentRecommendation;
use Illuminate\Http\Request;

class DetergentController extends Controller
{
    public function index(Request $request)
    {
        $query = DetergentRecommendation::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('method_code', 'like', "%$search%")
                  ->orWhere('fabric', 'like', "%$search%")
                  ->orWhere('detergent_name', 'like', "%$search%")
                  ->orWhere('detergent_type', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
        }

        $detergents = $query->orderBy('method_code')->paginate(10);
        return view('admin.detergents.index', compact('detergents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fabric' => 'nullable|string',
            'method_code' => 'required',
            'detergent_name' => 'required',
            'detergent_type' => 'nullable',
            'description' => 'required',
        ]);

        DetergentRecommendation::create($data);
        return back()->with('success', 'Deterjen berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'fabric' => 'nullable|string',
            'method_code' => 'required',
            'detergent_name' => 'required',
            'detergent_type' => 'nullable',
            'description' => 'required',
        ]);

        DetergentRecommendation::findOrFail($id)->update($data);
        return back()->with('success', 'Deterjen berhasil diperbarui');
    }

    public function destroy($id)
    {
        DetergentRecommendation::findOrFail($id)->delete();
        return back()->with('success', 'Deterjen berhasil dihapus');
    }
}
