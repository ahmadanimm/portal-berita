<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function show(Author $author)
    {
        // Ubah dari paginate(8) menjadi get() untuk mengambil semua artikel
        $articles = $author->articles()->with('category')->latest()->get();

        return view('authors.show', [
            'author' => $author,
            'articles' => $articles
        ]);
    }
}