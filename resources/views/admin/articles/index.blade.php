@extends('layouts.main')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Artikel</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('articles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Artikel</a>

<table class="min-w-full bg-white border">
    <thead>
        <tr>
            <th class="border px-4 py-2">Judul</th>
            <th class="border px-4 py-2">Kategori</th>
            <th class="border px-4 py-2">Penulis</th>
            <th class="border px-4 py-2">Premium</th>
            <th class="border px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td class="border px-4 py-2">{{ $article->title }}</td>
            <td class="border px-4 py-2">{{ $article->category->name }}</td>
            <td class="border px-4 py-2">{{ $article->author->name }}</td>
            <td class="border px-4 py-2 text-center">
                @if($article->is_premium)
                    <span class="text-yellow-600 font-semibold">Ya</span>
                @else
                    <span>Tidak</span>
                @endif
            </td>
            <td class="border px-4 py-2">
                <a href="{{ route('articles.edit', $article->id) }}" class="text-blue-500 hover:underline mr-2">Edit</a>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $articles->links() }}
</div>
@endsection
