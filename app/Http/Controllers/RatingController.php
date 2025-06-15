<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, $articleId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Cegah user kasih rating dua kali
        $existing = Rating::where('user_id', Auth::id())
                          ->where('article_id', $articleId)
                          ->first();

        if ($existing) {
            $existing->update(['rating' => $request->rating]);
        } else {
            Rating::create([
                'user_id'    => Auth::id(),
                'article_id' => $articleId,
                'rating'     => $request->rating,
            ]);
        }

        return redirect()->back()->with('success', 'Rating berhasil dikirim.');
    }
}

