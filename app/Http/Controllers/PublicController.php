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
        $headline = Article::latest()->where('is_premium', false)->first();
        $latest = Article::latest()->take(5)->get();
        $popular = Article::inRandomOrder()->take(5)->get(); // dummy populer

        return view('public.index', compact('headline', 'latest', 'popular'));
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
        $category = \App\Models\Category::where('slug', $slug)->firstOrFail();

        $canAccess = true;

        if ($category->is_premium) {
            $user = auth()->user();
            $canAccess = $user && $user->is_subscribed && $user->subscribed_until && $user->subscribed_until->isFuture();
        }

        if (!$canAccess) {
            return redirect()->route('home')->with('error', 'Kategori ini hanya untuk pengguna berlangganan.');
        }

        $articles = $category->articles()->latest()->paginate(10);

        return view('public.category', compact('category', 'articles'));
    }


    public function search(Request $request)
    {
        $query = $request->input('q');

        $articles = Article::where('is_premium', false)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                ->orWhere('body', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(10);

        return view('public.search', compact('articles', 'query'));
    }



}
