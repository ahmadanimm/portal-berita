@extends('layouts.main')

@section('hero')
<section class="bg-gray-100 py-10 text-center">
    <h1 class="text-3xl font-bold text-gray-800">Kategori: {{ $category->name }}</h1>
</section>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($articles as $article)
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <img src="{{ asset($article['thumbnail']) }}" alt="thumbnail" class="w-full h-40 object-cover">
        <div class="p-4">
            <time class="text-sm text-gray-500 block mb-1">{{ $article['date'] }}</time>
            <h3 class="text-lg font-bold">{{ $article['title'] }}</h3>
        </div>
    </div>
    @endforeach
</div>
@endsection
