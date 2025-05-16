@extends('layouts.main')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Portal Berita</h1>

    <!-- Headline -->
    @if($headline)
        <div class="mb-6 p-4 bg-white rounded shadow">
            <h2 class="text-xl font-semibold mb-2">{{ $headline->title }}</h2>
            <p class="text-gray-600">{{ Str::limit($headline->body, 150) }}</p>
            <a href="{{ route('berita.show', $headline->slug) }}" class="text-blue-500 mt-2 inline-block">Baca selengkapnya</a>
        </div>
    @endif

    <!-- Berita Terbaru -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold mb-2">Berita Terbaru</h3>
        <ul class="space-y-2">
            @foreach($latest as $article)
                <li class="bg-white p-3 rounded shadow">
                    <a href="{{ route('berita.show', $article->slug) }}" class="text-blue-600 hover:underline font-semibold">
                        {{ $article->title }}
                    </a>

                    @if($article->is_premium)
                        <span class="ml-2 px-2 py-0.5 text-xs bg-yellow-400 text-white rounded-full">
                            Premium
                        </span>
                    @endif

                    <p class="text-sm text-gray-500">{{ Str::limit($article->body, 100) }}</p>
                </li>
            @endforeach 
        </ul>
    </div>

    <!-- Berita Populer -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold mb-2">Berita Populer</h3>
        <ul class="space-y-2">
            @foreach($latest as $article)
                <li class="bg-white p-3 rounded shadow">
                    <a href="{{ route('berita.show', $article->slug) }}" class="text-blue-600 hover:underline font-semibold">
                        {{ $article->title }}
                    </a>

                    @if($article->is_premium)
                        <span class="ml-2 px-2 py-0.5 text-xs bg-yellow-400 text-white rounded-full">
                            Premium
                        </span>
                    @endif

                    <p class="text-sm text-gray-500">{{ Str::limit($article->body, 100) }}</p>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
