<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'subscribed_until' => 'datetime',
    ];

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function savedArticles()
    {
        return $this->belongsToMany(Article::class, 'article_user_saved')->withTimestamps();
    }

    public function likedArticles()
    {
        return $this->belongsToMany(Article::class, 'article_user_likes')->withTimestamps();
    }

    public function dislikedArticles()
    {
        return $this->belongsToMany(Article::class, 'article_user_dislike')->withTimestamps();
    }

    public function bookmarkedArticles()
    {
        return $this->belongsToMany(Article::class, 'article_user_saved');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
