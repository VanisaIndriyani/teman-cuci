<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\AppSetting;
use App\Models\Faq;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->take(3)->get();
        $videoUrl = AppSetting::where('key', 'video_url')->first()?->value;

        // Pastikan URL YouTube dalam format embed
        if ($videoUrl) {
            if (str_contains($videoUrl, 'watch?v=')) {
                $parts = explode('watch?v=', $videoUrl);
                $videoId = explode('&', $parts[1])[0];
                $videoUrl = "https://www.youtube.com/embed/" . $videoId;
            } elseif (str_contains($videoUrl, 'youtu.be/')) {
                $parts = explode('youtu.be/', $videoUrl);
                $videoId = explode('?', $parts[1])[0];
                $videoUrl = "https://www.youtube.com/embed/" . $videoId;
            }
        }

        return view('user.home', compact('articles', 'videoUrl'));
    }

    public function about()
    {
        $aboutUs = AppSetting::where('key', 'about_us')->first()?->value;
        return view('user.about', compact('aboutUs'));
    }

    public function guide()
    {
        $guide = AppSetting::where('key', 'guide')->first()?->value;
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();
        return view('user.guide', compact('guide', 'faqs'));
    }
}
