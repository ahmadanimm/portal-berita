<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung user biasa (tidak termasuk admin)
        $userCount = User::where('role', '!=', 'admin')->count();

        // Hitung pelanggan premium (dengan subscription aktif, bukan admin)
        $premiumUsers = User::whereHas('subscriptions', function ($query) {
            $query->where('ends_at', '>', now());
        })->where('role', '!=', 'admin')->count();

        $totalUsers = \App\Models\User::count();
        $regularUsers = $totalUsers - $premiumUsers;

        // Ambil kategori dan hitung jumlah artikelnya
        $categories = Category::withCount('articles')->get();
        $categoryLabels = $categories->pluck('name');
        $categoryCounts = $categories->pluck('articles_count');

        return view('admin.dashboard', compact(
            'userCount',
            'premiumUsers',
            'regularUsers',
            'categories',
            'categoryLabels',
            'categoryCounts'
        ));
    }

}

