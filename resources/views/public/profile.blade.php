@extends('layouts.app')

@section('content')

@include('partials.navbar-profile')

<div class="max-w-7xl ml-12 mr-12 mt-10 mx-auto px-4 py-10">
  <!-- Profile section -->
  <div class="flex flex-col md:flex-row items-center md:items-start md:gap-6 mb-10">
  <!-- Avatar -->
    <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center text-5xl">
    @if (Auth::user()->profile_photo)
        <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" alt="Foto Profil" class="w-full h-full object-cover">
    @else
        <i class="bi bi-person-fill text-gray-500"></i>
    @endif
    </div>

    <!-- User info -->
    <div class="flex-1 text-center md:text-left mt-4 md:mt-0">
      <h1 class="text-2xl md:text-3xl font-bold flex items-center justify-center md:justify-start gap-2">
        {{ Auth::user()->name }} 
        <i class="bi bi-patch-check-fill text-blue-600"></i>
      </h1>
      <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>

      <div class="mt-4 flex justify-center md:justify-start gap-3">
        <a href="{{ route('profile.edit') }}" class="bg-blue-600 text-white px-4 py-2 rounded font-semibold hover:bg-blue-700">Edit profile</a>
        <a href="#" class="bg-blue-100 text-blue-700 px-4 py-2 rounded font-semibold hover:bg-blue-200">Berlangganan</a>
      </div>
    </div>
  </div>

  <!-- Tabs -->
  <div class="flex flex-wrap justify-center md:justify-start gap-4 border-b pb-4 mb-6">
    <button class="flex items-center gap-2 px-4 py-2 border-2 border-blue-600 rounded-full font-semibold text-sm text-blue-600">
      <i class="bi bi-bookmark-fill"></i> Konten yang disimpan
    </button>
    <button class="flex items-center gap-2 px-4 py-2 border rounded-full font-semibold text-sm text-gray-600 hover:bg-gray-100">
      <i class="bi bi-hand-thumbs-up-fill"></i> Konten yang disukai
    </button>
    <button class="flex items-center gap-2 px-4 py-2 border rounded-full font-semibold text-sm text-gray-600 hover:bg-gray-100">
      <i class="bi bi-clock-history"></i> Riwayat berlangganan
    </button>
  </div>

  <!-- Saved Articles -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach ($savedArticles as $article)
      <div class="bg-white border rounded-xl p-2 shadow-sm">
        <div class="relative">
          <img src="{{ asset('storage/' . $article->thumbnail) }}" class="w-full h-44 object-cover rounded-md">
          <span class="absolute top-2 left-2 bg-white text-black text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
            {{ $article->category->name }}
          </span>
        </div>
        <div class="mt-3 px-2">
          <h3 class="font-semibold text-sm mb-2 leading-tight">{{ Str::limit($article->title, 80) }}</h3>
          <div class="w-10 h-1 bg-blue-500 mb-1"></div>
          <p class="text-xs text-gray-600">{{ $article->created_at->format('d/m/Y, H:i') }} WIB</p>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
