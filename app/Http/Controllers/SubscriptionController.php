<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $user = $request->user();

        $lastSubscription = $user->subscriptions()->latest('ends_at')->first();

        if ($lastSubscription && $lastSubscription->ends_at->isFuture()) {
            // Mulai langganan baru satu hari setelah langganan terakhir berakhir
            $start = $lastSubscription->ends_at->copy()->addDay();
        } else {
            $start = Carbon::now();
        }

        $end = $start->copy()->addDays(30);

        $user->is_subscribed = true;
        $user->subscribed_until = $end;
        $user->save();

        Subscription::create([
            'user_id' => $user->id,
            'starts_at' => $start,
            'ends_at' => $end,
        ]);

        return redirect()->back()->with('success', 'Berhasil berlangganan 30 hari!');
    }

    public function unsubscribe(Request $request)
    {
        $user = $request->user();

        $user->is_subscribed = false;
        $user->subscribed_until = null;
        $user->save();

        // Jangan ubah riwayat langganan yang sudah ada

        return redirect()->back()->with('success', 'Langganan berhasil dibatalkan.');
    }
}
