@extends('layouts.main')

@section('content')
  <h2 class="text-xl font-bold mb-4">Hasil Pencarian untuk: "{{ $query }}"</h2>

  @forelse ($articles as $article)
    <div class="mb-4 border-b pb-3">
      <h3 class="text-lg font-semibold">{{ $article->title }}</h3>
      <p class="text-sm text-gray-600">{{ \Str::limit($article->body, 150) }}</p>
    </div>
  @empty
    <p>Tidak ada hasil ditemukan.</p>
  @endforelse

  <div class="mt-6">
    {{ $articles->links() }}
  </div>
@endsection
