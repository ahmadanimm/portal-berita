@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold">Dashboard Admin</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
    <div class="bg-white text-gray-800 p-4 rounded shadow">
        <h2 class="text-lg font-semibold">Total Pengguna</h2>
        <p class="text-3xl">{{ $userCount }}</p>
    </div>
    <div class="bg-white text-gray-800 p-4 rounded shadow">
        <h2 class="text-lg font-semibold">Pelanggan Premium</h2>
        <p class="text-3xl">{{ $premiumUsers }}</p>
    </div>
</div>

<div class="bg-white text-gray-800 p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Artikel Terbaru</h2>
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Judul</th>
                <th class="p-2 text-left">Kategori</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($latestArticles as $article)
            <tr class="border-b">
                <td class="p-2">{{ $article->title }}</td>
                <td class="p-2">{{ $article->category->name ?? '-' }}</td>
                <td class="p-2">
                    @if($article->is_premium)
                        <span class="text-yellow-600 font-semibold">Premium</span>
                    @else
                        <span class="text-green-600">Gratis</span>
                    @endif
                </td>
                <td class="p-2">{{ $article->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
