<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Article::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%$search%")
                  ->orWhere('content', 'like', "%$search%");
        }

        $articles = $query->latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = \App\Models\ArticleCategory::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
            'categories' => 'nullable|array',
        ]);

        $data['author_id'] = auth()->guard('admin')->id();
        $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
        
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/articles');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            $image->move($destinationPath, $name);
            $data['thumbnail'] = '/uploads/articles/' . $name;
        }

        if ($data['status'] == 'published') {
            $data['published_at'] = now();
        }

        $article = \App\Models\Article::create($data);

        if (isset($data['categories'])) {
            $article->categories()->sync($data['categories']);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dibuat');
    }

    public function edit($id)
    {
        $article = \App\Models\Article::findOrFail($id);
        $categories = \App\Models\ArticleCategory::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $article = \App\Models\Article::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
            'categories' => 'nullable|array',
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
        
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($article->thumbnail && file_exists(public_path($article->thumbnail))) {
                @unlink(public_path($article->thumbnail));
            }

            $image = $request->file('thumbnail');
            $name = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('/uploads/articles');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            $image->move($destinationPath, $name);
            $data['thumbnail'] = '/uploads/articles/' . $name;
        }

        if ($data['status'] == 'published' && !$article->published_at) {
            $data['published_at'] = now();
        }

        $article->update($data);

        if (isset($data['categories'])) {
            $article->categories()->sync($data['categories']);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui');
    }

    public function destroy($id)
    {
        $article = \App\Models\Article::findOrFail($id);
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus');
    }
}
