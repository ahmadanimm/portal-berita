<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'avatar', 'average_rating', 'ratings_count'];

    protected $casts = [
        'average_rating' => 'float', // <<< TAMBAHKAN INI
    ];

    // Relasi dari Author ke Article (seorang author bisa menulis banyak article)
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id'); // Pastikan ini 'author_id'
    }

    // Relasi ke rating yang diterima oleh artikel yang dia tulis
    public function receivedRatings()
    {
        return $this->hasManyThrough(
            Rating::class,    // Model target (Rating)
            Article::class,   // Model perantara (Article)
            'author_id',      // Foreign key di tabel articles yang merujuk ke authors.id
            'article_id',     // Foreign key di tabel ratings yang merujuk ke articles.id
            'id',             // Kunci lokal di tabel authors
            'id'              // Kunci lokal di tabel articles
        );
    }

    // Metode untuk menghitung dan memperbarui rating penulis
    public function updateAuthorRating(): void
    {
        $totalRatingSum = $this->receivedRatings()->sum('rating');
        $totalRatingCount = $this->receivedRatings()->count();

        $calculatedAverage = ($totalRatingCount > 0) ? round($totalRatingSum / $totalRatingCount, 1) : 0.0;

        $this->ratings_count = $totalRatingCount;
        $this->average_rating = $calculatedAverage;
        $this->save();
    }
}
