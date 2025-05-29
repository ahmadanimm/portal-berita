<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;


Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard user biasa
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');

    Route::get('/cari', [PublicController::class, 'search'])->name('search');

    // Profile user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Subscribe / unsubscribe
    Route::post('/subscribe', [\App\Http\Controllers\SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::post('/unsubscribe', [\App\Http\Controllers\SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');
});

// Group khusus route admin, dengan middleware 'auth', 'verified', dan 'admin'
Route::middleware(['auth', 'verified', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('articles', ArticleController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('authors', AuthorController::class);
    Route::delete('authors/delete-selected', [AuthorController::class, 'destroy'])->name('admin.authors.destroy');
    Route::delete('/authors/bulk-delete', [AuthorController::class, 'bulkDelete'])->name('authors.bulkDelete');
    Route::delete('categories/bulk-delete', [\App\Http\Controllers\Admin\CategoryController::class, 'bulkDelete'])->name('categories.bulkDelete');
    Route::delete('/articles/bulk-delete', [ArticleController::class, 'bulkDelete'])->name('articles.bulkDelete');
    Route::get('stats', [StatsController::class, 'index'])->name('stats');
});

// Route publik
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/berita/{slug}', [PublicController::class, 'show'])->name('berita.show');
Route::get('/kategori/{slug}', [PublicController::class, 'category'])->name('kategori.show');
Route::get('/cari', [PublicController::class, 'search'])->name('search');

require __DIR__.'/auth.php';
