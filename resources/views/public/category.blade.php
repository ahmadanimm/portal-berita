@extends('layouts.app')

@include('partials.navbar')

@section('header')
<h2 class="text-3xl font-bold mb-10 text-center">
  Explore Our <br>
  <span class="text-black">{{ $category->name }} News</span>
</h2>
@endsection

@section('content')
<section class="py-10 bg-white text-center">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4 md:px-10">
    @foreach ($articles as $article)
      <div class="bg-white rounded-xl shadow-md border p-2">
        <div class="bg-white p-2 rounded-lg overflow-hidden">
          <div class="relative">
            <img src="{{ asset('storage/' . $article->thumbnail) }}" 
                 alt="{{ $article->title }}" 
                 class="w-full h-44 object-cover rounded-md">
            <span class="absolute top-2 left-2 bg-white text-black text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
              {{ $category->name }}
            </span>
          </div>
        </div>
        <div class="p-4 text-left">
          <h3 class="font-semibold text-sm mb-3 leading-snug">{{ Str::limit($article->title, 80) }}</h3>
          <div class="w-10 h-1 bg-blue-500 mb-2"></div>
          <p class="text-xs text-gray-600">{{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y, H:i') }} WIB</p>
        </div>
      </div>
    @endforeach
  </div>

  <div class="mt-6">
    {{ $articles->links() }}
  </div>
</section>
@endsection
