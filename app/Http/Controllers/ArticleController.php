<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'author'])->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'is_premium' => 'nullable|boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = Auth::id();
        $validated['is_premium'] = $request->has('is_premium');

        Article::create($validated);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dibuat!');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'is_premium' => 'nullable|boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Hapus file lama jika ada
            if ($article->thumbnail) {
                \Storage::disk('public')->delete($article->thumbnail);
            }
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_premium'] = $request->has('is_premium');

        $article->update($validated);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diupdate!');
    }

    public function destroy(Article $article)
    {
        if ($article->thumbnail) {
            \Storage::disk('public')->delete($article->thumbnail);
        }
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
