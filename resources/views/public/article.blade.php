{{-- resources/views/public/article.blade.php --}}
@extends('layouts.app')

@section('content')
@include('partials.navbar')

{{-- Hero Section (konten artikel lainnya tetap di dalam div aslinya) --}}
<div class="bg-white pt-6">
  {{-- Tanggal dan Kategori --}}
  <div class="text-center text-sm text-gray-500">
    {{ $article->created_at->format('M d, Y') }} · {{ $article->category->name }}
  </div>

  {{-- Judul --}}
  <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mt-2">
    {{ $article->title }}
  </h1>

{{-- Author --}}
<div class="flex justify-center items-center mt-3 space-x-3">
  <img src="{{ asset('storage/' . $article->author->avatar) }}" alt="{{ $article->author->name }}" class="w-8 h-8 rounded-full object-cover">
  <div>
    <div class="text-sm text-gray-700 font-medium" style="margin-bottom: 1px;">{{ $article->author->name }}</div>
    <div class="text-xs text-gray-500" style="font-size: 10px;">
      {{ $article->author->articles->count() }} Artikel
    </div>
  </div>
  <div class="flex items-center text-yellow-500 text-xs ml-6">
    ★★★★★
    <span class="text-gray-500 ml-1">(12,490)</span>
  </div>
</div>
</div> <div class="h-[400px] overflow-hidden mt-6" style="width: 100vw; margin-left: calc(50% - 50vw);">
  <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
</div>


{{-- Konten --}}
@php
    $body = strip_tags($article->body);
@endphp

<div class="container mt-6 mx-auto max-w-7xl">
    <div class="flex flex-col lg:flex-row gap-3">

        {{-- Konten utama --}}
        <main class="w-full lg:w-7/12 overflow-hidden">
            <div class="px-6 pt-6 pb-6">
                <p class="text-gray-700 text-base md:text-lg leading-loose tracking-wider text-justify">
                    {{ strip_tags($article->body) }}
                </p>
            </div>
        </main>

        {{-- Sidebar: Artikel lain dari penulis --}}
        <aside class="w-full lg:w-2/5">
            <div class="p-6">
                <h3 class="font-semibold mb-6 text-2xl">More From Author</h3>

                @forelse ($moreFromAuthor as $item)
                    <a href="{{ route('article.show', $item->slug) }}"
                       class="flex items-center gap-3 mb-5 p-2 bg-gray-50 rounded-md shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-1">
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="w-28 h-20 object-cover rounded-md flex-shrink-0">
                        <div>
                            <span class="inline-block bg-indigo-700 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2">
                                {{ $item->category->name ?? 'Uncategorized' }}
                            </span>
                            <time class="text-gray-600 text-xs mb-2 block">{{ $item->created_at->format('d/m/Y, H:i') }} WIB</time>
                            <span class="block bg-blue-600 w-[20px] h-[2px] mb-2 rounded"></span>
                            <h4 class="font-semibold text-sm">{{ $item->title }}</h4>
                        </div>
                    </a>
                @empty
                    <p class="text-sm text-gray-600">Tidak ada artikel lain dari penulis ini.</p>
                @endforelse
            </div>
        </aside>

    </div>
</div>


{{-- Section for Likes, Dislikes, Saves --}}
<div class="mt-8 px-6 pb-8">
    <div class="flex items-center justify-start gap-6 bg-blue-700 text-white rounded-lg py-3 px-6 w-fit shadow-md">

        @php
            $isLiked = auth()->check() && $article->likedByUsers->contains(auth()->id());
            $isDisliked = auth()->check() && $article->dislikedByUsers->contains(auth()->id());
        @endphp

        <div class="flex items-center justify-start gap-6 text-white">
            <form id="likeForm" action="{{ route('articles.like', $article->id) }}" method="POST" style="display: none;">
                @csrf
            </form>

            <button
                class="flex items-center gap-2 text-lg transition-colors hover:text-blue-200 {{ $isLiked ? 'text-yellow-300' : 'text-white' }}"
                onclick="@auth document.getElementById('likeForm').submit(); @else showLikeModal(); @endauth"
            >
                <i class="fa-solid fa-thumbs-up"></i> 
                <span>{{ $article->likedByUsers()->count() }}</span>
            </button>
        </div>

        {{-- MODAL UNTUK LIKE --}}
        <div id="likeModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
            <h2 class="text-gray-800 font-semibold mb-2">PERHATIAN!</h2>
            <p class="text-sm text-gray-600 mb-4">Silakan login terlebih dahulu untuk menyukai artikel ini.</p>
            <div class="flex justify-center gap-3">
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</a>
            </div>
            <button onclick="closeLikeModal()" class="text-sm text-gray-500 mt-4 hover:underline">Tutup</button>
        </div>
        </div>

        <script>
            function showLikeModal() {
                document.getElementById('likeModal').classList.remove('hidden');
            }

            function closeLikeModal() {
                document.getElementById('likeModal').classList.add('hidden');
            }
        </script>

        <span class="h-6 w-px bg-blue-500"></span> 

        <form id="dislikeForm" action="{{ route('articles.dislike', $article->id) }}" method="POST" style="display: none;">
            @csrf
        </form>

        <button
            class="flex items-center gap-2 text-lg transition-colors hover:text-blue-200 {{ $isDisliked ? 'text-yellow-300' : 'text-white' }}"
            onclick="@auth document.getElementById('dislikeForm').submit(); @else showDislikeModal(); @endauth"
        >
            <i class="fa-solid fa-thumbs-down"></i> 
            <span>{{ $article->dislikedByUsers()->count() }}</span>
        </button>

        {{-- MODAL DISLIKE --}}
        <div id="dislikeModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
            <h2 class="text-gray-800 font-semibold mb-2">PERHATIAN!</h2>
            <p class="text-sm text-gray-600 mb-4">Silakan login terlebih dahulu untuk tidak menyukai artikel ini.</p>
            <div class="flex justify-center gap-3">
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</a>
            </div>
            <button onclick="closeDislikeModal()" class="text-sm text-gray-500 mt-4 hover:underline">Tutup</button>
        </div>
        </div>

        <script>
            function showDislikeModal() {
                document.getElementById('dislikeModal').classList.remove('hidden');
            }

            function closeDislikeModal() {
                document.getElementById('dislikeModal').classList.add('hidden');
            }
        </script>


        <span class="h-6 w-px bg-blue-500"></span> 

        @php
            $isBookmarked = auth()->check() && $article->bookmarkedByUsers->contains(auth()->id());
        @endphp

        <form id="bookmarkForm" action="{{ route('articles.bookmark', $article->id) }}" method="POST" style="display: none;">
            @csrf
        </form>

        <button
            class="flex items-center gap-2 text-lg hover:text-blue-200 transition-colors {{ $isBookmarked ? 'text-yellow-300' : '' }}"
            onclick="@auth document.getElementById('bookmarkForm').submit(); @else showBookmarkModal(); @endauth"
        >
            <i class="fa-solid fa-bookmark"></i> 
            <span>{{ $article->bookmarkedByUsers()->count() }}</span>
        </button>

        {{-- MODAL BOOKMARK --}}
        <div id="bookmarkModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center w-80">
            <h2 class="text-gray-800 font-semibold mb-2">PERHATIAN!</h2>
            <p class="text-sm text-gray-600 mb-4">Silakan login terlebih dahulu untuk menyimpan artikel ini.</p>
            <div class="flex justify-center gap-3">
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</a>
            </div>
            <button onclick="closeBookmarkModal()" class="text-sm text-gray-500 mt-4 hover:underline">Tutup</button>
        </div>
        </div>

        <script>
        function showBookmarkModal() {
            document.getElementById('bookmarkModal').classList.remove('hidden');
        }

        function closeBookmarkModal() {
            document.getElementById('bookmarkModal').classList.add('hidden');
        }
        </script>

        <span class="h-6 w-px bg-blue-500"></span> 

        {{-- Rating --}}
<div x-data="{
    rating: 0,
    sendRating(value) {
        this.rating = value;
        this.$refs.form.submit();
    }
}" class="flex items-center gap-2 text-sm text-gray-100">
    <span>Suka dengan artikel? Beri ulasan untuk penulis:</span>
    <div class="flex items-center gap-1">
        <template x-for="star in 5" :key="star">
            <button 
                type="button"
                @click="sendRating(star)"
                class="text-xl transition"
                :class="rating >= star ? 'text-yellow-400' : 'text-gray-300'"
            >★</button>
        </template>
    </div>

    {{-- Form tersembunyi --}}
    <form x-ref="form" action="{{ route('ratings.store', $article->id) }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="rating" :value="rating">
    </form>
</div>

    </div>

    {{-- Comments Section Container --}}
    <div class="mt-8 bg-gray-100 rounded-lg p-6 shadow-md">
        <h3 class="font-semibold text-2xl text-gray-800 mb-6 flex items-center gap-2">
            Komentar
            <span class="text-sm text-gray-500">({{ $article->comments->count() }})</span>
        </h3>
        {{-- Form Komentar --}}
        @auth
            <form action="{{ route('comments.store', $article->id) }}" method="POST" class="flex items-center gap-4 mb-8">
                @csrf
                <input 
                    type="text" 
                    name="content"
                    placeholder="Tulis Komentar"
                    class="flex-grow p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800"
                    required
                >
                <button type="submit" class="bg-white text-gray-600 p-3 rounded-full shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                    <i class="bi bi-send text-xl rotate-[45deg] inline-block"></i>
                </button>
            </form>
        @else
            <div class="mb-8">
                <p class="text-gray-600 text-sm">Silakan <a href="{{ route('login') }}" class="text-blue-600 hover:underline">login</a> untuk menulis komentar.</p>
            </div>
        @endauth

        {{-- Comment List --}}
        <div class="space-y-6">
            @forelse ($article->comments as $comment)
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0 bg-gray-200 flex items-center justify-center">
                        @if ($comment->user && $comment->user->profile_photo)
                            <img src="{{ asset('storage/profile_photos/' . $comment->user->profile_photo) }}"
                                alt="Foto Profil"
                                class="w-full h-full object-cover">
                        @else
                            <i class="bi bi-person-fill text-2xl text-gray-500"></i>
                        @endif
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-800">{{ $comment->user->name }}</div>
                        <div class="text-xs text-gray-500 mb-1 mt-1">{{ $comment->created_at->format('d/m/Y, H:i') }} WIB</div>
                        <p class="text-gray-700 text-sm leading-relaxed">{{ $comment->content }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 text-sm">Belum ada komentar.</p>
            @endforelse
        </div>
    </div>

</div>


@endsection
