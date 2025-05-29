<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;


class PublicController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $headline = Article::latest()->where('is_premium', false)->first();
        $latest = Article::latest()->take(5)->get();
        $popular = Article::inRandomOrder()->take(5)->get(); // dummy populer

        return view('public.index', compact('headline', 'latest', 'popular', 'categories'));
    }

    public function show($slug)
    {
        $article = \App\Models\Article::where('slug', $slug)->firstOrFail();

        $canAccess = true;

        if ($article->is_premium) {
            $user = auth()->user();

            $canAccess = $user
                && $user->is_subscribed
                && $user->subscribed_until
                && $user->subscribed_until->isFuture();
        }

        return view('public.show', compact('article', 'canAccess'));
    }


    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // Dummy articles sementara
        $articles = [
            [
                'title' => 'Judul Berita Dummy 1',
                'thumbnail' => 'assets/images/banner.png',
                'date' => '01/06/2025, 12:00 WIB',
            ],
            [
                'title' => 'Judul Berita Dummy 2',
                'thumbnail' => 'assets/images/banner.png',
                'date' => '01/06/2025, 14:30 WIB',
            ],
        ];

        return view('public.category', compact('category', 'articles'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $articles = Article::where('title', 'like', '%' . $query . '%')
                    ->orWhere('body', 'like', '%' . $query . '%')
                    ->paginate(10);

        return view('public.search', compact('articles', 'query'));
    }




}
