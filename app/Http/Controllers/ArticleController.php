<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('category');

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->latest()->paginate(10); // <--- pakai paginate

        return view('admin.articles.index', compact('articles'));
    }


    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.articles.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
            'body' => 'required|string',
        ]);

        $validated['is_premium'] = $request->has('is_premium');
        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
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
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                \Storage::disk('public')->delete($article->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $validated['slug'] = \Str::slug($validated['title']);
        $validated['is_premium'] = $request->has('is_premium');

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diupdate!');
    }


    public function destroy(Request $request, $id)
    {
        if ($request->has('selected_ids')) {
            $ids = explode(',', $request->input('selected_ids'));

            $articles = \App\Models\Article::whereIn('id', $ids)->get();
            foreach ($articles as $article) {
                if ($article->thumbnail) {
                    \Storage::disk('public')->delete($article->thumbnail);
                }
            }

            \App\Models\Article::whereIn('id', $ids)->delete();
            return redirect()->route('admin.articles.index')->with('success', 'Artikel yang dipilih berhasil dihapus.');
        }

        $article = \App\Models\Article::findOrFail($id);
        if ($article->thumbnail) {
            \Storage::disk('public')->delete($article->thumbnail);
        }
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }


    public function bulkDelete(Request $request)
    {
        $ids = explode(',', $request->input('selected_ids'));

        // Hapus thumbnail dari storage jika ada
        $articles = \App\Models\Article::whereIn('id', $ids)->get();
        foreach ($articles as $article) {
            if ($article->thumbnail) {
                \Storage::disk('public')->delete($article->thumbnail);
            }
        }

        // Hapus dari database
        \App\Models\Article::whereIn('id', $ids)->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel yang dipilih berhasil dihapus.');
    }




}
