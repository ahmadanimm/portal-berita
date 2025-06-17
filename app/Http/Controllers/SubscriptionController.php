<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription; // Pastikan ini diimpor!

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscription.index'); // View berlangganan
    }

    public function subscribe(Request $request, $type)
    {
        $user = Auth::user();

        // 1. **PENCEGAHAN DUPLIKASI UTAMA DI SINI**
        // Cek apakah pengguna sudah memiliki langganan aktif (termasuk trial)
        // Berdasarkan kolom di tabel users yang Anda update
        if ($user->is_subscribed && $user->subscription_end && $user->subscription_end->isFuture()) {
            return redirect()->route('profile')->with('error', 'Anda sudah memiliki langganan aktif hingga ' . $user->subscription_end->format('d M Y') . '.');
        }

        $planDetails = [
            'trial' => [
                'duration_days' => 7,
                'plan_name' => 'Uji Coba Gratis',
                'price' => 0,
            ],
            '1month' => [
                'duration_days' => 30,
                'plan_name' => 'Paket 1 Bulan',
                'price' => 90000,
            ],
            '2months' => [
                'duration_days' => 60,
                'plan_name' => 'Paket 2 Bulan',
                'price' => 170000,
            ],
            '3months' => [
                'duration_days' => 90,
                'plan_name' => 'Paket 3 Bulan',
                'price' => 250000,
            ],
        ];

        if (!isset($planDetails[$type])) {
            return redirect()->back()->with('error', 'Tipe langganan tidak valid.');
        }

        $selectedPlan = $planDetails[$type];
        $startsAt = Carbon::now();
        $endsAt = $startsAt->copy()->addDays($selectedPlan['duration_days']);

        try {
            if ($type === 'trial') {
                if ($user->trial_used) {
                    return redirect()->route('profile')->with('error', 'Uji coba hanya dapat digunakan sekali.');
                }
                // Update kolom di tabel users untuk uji coba
                $user->is_subscribed = true;
                $user->subscription_type = $type;
                $user->subscription_start = $startsAt;
                $user->subscription_end = $endsAt;
                $user->trial_used = true;
                $user->save();

                return redirect()->route('profile')->with('success', 'Uji coba 7 hari berhasil diaktifkan.');

            } else {
                // Logika untuk Langganan Berbayar
                Subscription::create([
                    'user_id' => $user->id,
                    'plan_name' => $selectedPlan['plan_name'],
                    'price' => $selectedPlan['price'],
                    'starts_at' => $startsAt,
                    'ends_at' => $endsAt,
                    'status' => 'active',
                ]);

                // Update kolom di tabel `users` untuk status langganan terkini
                $user->is_subscribed = true;
                $user->subscription_type = $type;
                $user->subscription_start = $startsAt;
                $user->subscription_end = $endsAt;
                $user->save();

                return redirect()->route('profile')->with('success', 'Berlangganan ' . $selectedPlan['plan_name'] . ' berhasil diaktifkan!');
            }

        } catch (\Exception $e) {
            \Log::error("Gagal memproses langganan ($type) untuk user ID {$user->id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengaktifkan langganan. Silakan coba lagi.');
        }
    }


    public function unsubscribe()
    {
        $user = Auth::user();
        $user->is_subscribed = false;
        $user->subscription_type = null;
        $user->subscription_start = null;
        $user->subscription_end = null;
        $user->save();

        // Opsional: Anda mungkin ingin menandai langganan aktif terakhir di tabel `subscriptions` sebagai 'cancelled'
        // $latestSubscription = $user->subscriptions()->where('status', 'active')->latest()->first();
        // if ($latestSubscription) {
        //     $latestSubscription->status = 'cancelled';
        //     $latestSubscription->save();
        // }

        return redirect()->route('profile')->with('success', 'Berlangganan telah dihentikan.');
    }

    // Method startTrial sekarang sudah tidak diperlukan secara terpisah jika diintegrasikan ke subscribe()
    // Jika Anda masih ingin memilikinya, pastikan memanggil subscribe('trial')
    public function startTrial(Request $request)
    {
        return $this->subscribe($request, 'trial');
    }
}