@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Article News</h1>
    <a href="{{ route('admin.articles.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
        + New Article
    </a>
</div>

<!-- Search -->
<form method="GET" action="{{ route('admin.articles.index') }}" class="mb-4">
    <input type="text" name="search" value="{{ request('search') }}"
           class="px-3 py-1 rounded border border-gray-300 w-64 text-black"
           placeholder="Cari artikel...">
    <button type="submit" class="ml-2 bg-gray-800 text-white px-3 py-1 rounded">Cari</button>
</form>

<!-- Table -->
<div class="bg-white text-black p-4 rounded shadow">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Judul</th>
                <th class="p-2 text-left">Kategori</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Thumbnail</th>
                <th class="p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($articles as $article)
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
                    <td class="p-2">
                        @if($article->thumbnail)
                            <img src="{{ asset('storage/'.$article->thumbnail) }}" class="w-12 h-12 object-cover rounded" />
                        @endif
                    </td>
                    <td class="p-2">
                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="p-2 text-center">Tidak ada artikel.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
