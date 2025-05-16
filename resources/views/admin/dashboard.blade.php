<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto">
        <p>Selamat datang di Dashboard Admin.</p>

        <a href="{{ route('admin.stats') }}" class="text-indigo-600 underline mt-4 inline-block">
            Lihat Statistik Admin
        </a>
    </div>
</x-app-layout>
