<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(9);
        $categories = ArticleCategory::all();
        return view('user.articles.index', compact('articles', 'categories'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->increment('views');
        $related = Article::where('id', '!=', $article->id)->take(3)->get();
        return view('user.articles.show', compact('article', 'related'));
    }
}
