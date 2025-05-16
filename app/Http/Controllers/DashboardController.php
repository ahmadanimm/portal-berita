<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load(['subscriptions' => function ($query) {
            $query->orderBy('starts_at', 'desc');
        }]);

        return view('dashboard', compact('user'));
    }

}
