<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WashingStep;
use Illuminate\Http\Request;

class WashingStepController extends Controller
{
    public function index(Request $request)
    {
        $query = WashingStep::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('method_code', 'like', "%$search%")
                  ->orWhere('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%")
                  ->orWhere('tip', 'like', "%$search%");
        }

        $steps = $query->orderBy('method_code')->orderBy('step_order')->paginate(10);
        return view('admin.washing_steps.index', compact('steps'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'method_code' => 'required',
            'step_order' => 'required|integer',
            'title' => 'required',
            'description' => 'required',
            'tip' => 'nullable',
        ]);

        WashingStep::create($data);
        return back()->with('success', 'Langkah pencucian berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $step = WashingStep::findOrFail($id);
        $data = $request->validate([
            'method_code' => 'required',
            'step_order' => 'required|integer',
            'title' => 'required',
            'description' => 'required',
            'tip' => 'nullable',
        ]);

        $step->update($data);
        return back()->with('success', 'Langkah pencucian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        WashingStep::findOrFail($id)->delete();
        return back()->with('success', 'Langkah pencucian berhasil dihapus.');
    }
}
