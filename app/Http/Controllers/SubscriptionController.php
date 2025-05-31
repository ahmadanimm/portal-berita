<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscription.index'); // View berlangganan
    }

    public function subscribe($type)
    {
        $user = Auth::user();

        // Cegah uji coba kedua
        if ($type === 'trial' && $user->trial_used) {
            return redirect()->route('profile')->with('error', 'Uji coba hanya dapat digunakan sekali.');
        }

        $durations = [
            'trial' => 7,
            '1month' => 30,
            '2months' => 60,
            '3months' => 90,
        ];

        $user->is_subscribed = true;
        $user->subscription_type = $type;
        $user->subscription_start = now();
        $user->subscription_end = now()->addDays($durations[$type]);

        if ($type === 'trial') {
            $user->trial_used = true;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Berlangganan berhasil!');
    }

    public function unsubscribe()
    {
        $user = Auth::user();
        $user->is_subscribed = false;
        $user->subscription_type = null;
        $user->subscription_start = null;
        $user->subscription_end = null;
        $user->save();

        return redirect()->route('profile')->with('success', 'Berlangganan telah dihentikan.');
    }

    public function startTrial(Request $request)
    {
        $user = Auth::user();

        if ($user->trial_used) {
            return redirect('/profil')->with('error', 'Uji coba hanya dapat digunakan sekali.');
        }

        $user->trial_used = true;
        $user->is_subscribed = true;
        $user->save();

        return redirect('/profil')->with('success', 'Uji coba 7 hari berhasil diaktifkan.');
    }

}

