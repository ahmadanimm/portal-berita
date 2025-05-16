@extends('layouts.main')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Kategori: {{ $category->name }}</h1>

    @if($articles->count())
        <ul class="space-y-4">
            @foreach($articles as $article)
                <li class="bg-white p-4 rounded shadow">
                    <a href="{{ route('berita.show', $article->slug) }}" class="text-blue-600 hover:underline text-lg font-semibold">
                        {{ $article->title }}
                    </a>
                    <p class="text-gray-600">{{ Str::limit($article->body, 120) }}</p>
                </li>
            @endforeach
        </ul>

        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    @else
        <p>Belum ada artikel di kategori ini.</p>
    @endif
@endsection
