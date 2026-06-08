<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SawWeight;
use Illuminate\Http\Request;

class SawWeightController extends Controller
{
    public function index(Request $request)
    {
        $query = SawWeight::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('criterion_code', 'like', "%$search%")
                  ->orWhere('criterion_name', 'like', "%$search%");
        }

        $weights = $query->get();
        $totalWeight = $weights->sum('weight');
        return view('admin.saw.index', compact('weights', 'totalWeight'));
    }

    public function update(Request $request, SawWeight $saw)
    {
        $request->validate([
            'weight' => 'required|numeric|min:0|max:1',
        ]);

        $saw->update(['weight' => $request->weight]);

        return back()->with('success', 'Bobot criteria berhasil diperbarui.');
    }
}
