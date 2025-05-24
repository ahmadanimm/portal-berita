<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;


Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard user biasa
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::get('stats', [StatsController::class, 'index'])->name('stats');
});

// Route publik
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/berita/{slug}', [PublicController::class, 'show'])->name('berita.show');
Route::get('/kategori/{slug}', [PublicController::class, 'category'])->name('kategori.show');
Route::get('/cari', [PublicController::class, 'search'])->name('search');

require __DIR__.'/auth.php';
