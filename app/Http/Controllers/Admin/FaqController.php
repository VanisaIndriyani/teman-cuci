<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Faq::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('question', 'like', "%$search%")
                  ->orWhere('answer', 'like', "%$search%");
        }

        $faqs = $query->orderBy('sort_order')->paginate(10);
        return view('admin.faq.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        $data['is_active'] = true;
        \App\Models\Faq::create($data);

        return back()->with('success', 'FAQ berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $faq = \App\Models\Faq::findOrFail($id);
        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        $data['is_active'] = $request->has('is_active');
        $faq->update($data);

        return back()->with('success', 'FAQ berhasil diperbarui');
    }

    public function destroy($id)
    {
        $faq = \App\Models\Faq::findOrFail($id);
        $faq->delete();
        return back()->with('success', 'FAQ berhasil dihapus');
    }
}
