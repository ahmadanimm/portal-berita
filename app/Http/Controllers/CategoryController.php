<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $categories = Category::all(); 
        $category = Category::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        $query = Article::where('category_id', $category->id);

        // Sembunyikan artikel premium jika belum berlangganan
        if (!$user || !$user->is_subscribed) {
            $query->where('is_premium', false);
        }

        $articles = $query->latest()->paginate(12);

        return view('public.category', compact('category', 'articles', 'categories'));
    }
}
