<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RbfRule;
use Illuminate\Http\Request;

class RbfRuleController extends Controller
{
    public function index(Request $request)
    {
        $query = RbfRule::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('rule_code', 'like', "%$search%")
                  ->orWhere('fabric', 'like', "%$search%")
                  ->orWhere('color', 'like', "%$search%")
                  ->orWhere('motif', 'like', "%$search%")
                  ->orWhere('dirt_level', 'like', "%$search%")
                  ->orWhere('condition_desc', 'like', "%$search%")
                  ->orWhere('reason', 'like', "%$search%");
        }

        $rules = $query->orderBy('rule_code')->paginate(10);
        return view('admin.rbf.index', compact('rules'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'rule_code' => 'required|unique:rbf_rules',
            'fabric' => 'nullable',
            'color' => 'nullable',
            'motif' => 'nullable',
            'dirt_level' => 'nullable',
            'condition_desc' => 'nullable',
            'eliminated_method' => 'required',
            'reason' => 'nullable',
        ]);

        $data['is_active'] = true;

        RbfRule::create($data);
        return back()->with('success', 'Aturan RBF berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $rule = RbfRule::findOrFail($id);
        $data = $request->validate([
            'rule_code' => 'required|unique:rbf_rules,rule_code,' . $id,
            'fabric' => 'nullable',
            'color' => 'nullable',
            'motif' => 'nullable',
            'dirt_level' => 'nullable',
            'condition_desc' => 'nullable',
            'eliminated_method' => 'required',
            'reason' => 'nullable',
        ]);

        $data['is_active'] = $request->has('is_active');

        $rule->update($data);
        return back()->with('success', 'Aturan RBF berhasil diperbarui.');
    }

    public function destroy($id)
    {
        RbfRule::findOrFail($id)->delete();
        return back()->with('success', 'Aturan RBF berhasil dihapus.');
    }
}
