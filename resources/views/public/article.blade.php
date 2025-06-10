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
<div class="container mt-6 mx-auto max-w-7xl">
    <div class="flex flex-col lg:flex-row gap-3">

        <main class="w-full lg:w-7/12 overflow-hidden">
            <div class="px-6 pt-6 pb-0">
                <p class="text-gray-700 mb-6 text-base md:text-lg leading-relaxed text-justify">
                    Film horor ini bercerita tentang sebuah keluarga yang pindah ke rumah tua yang berhantu. Mereka harus menghadapi berbagai kejadian aneh dan menakutkan yang mengancam keselamatan mereka.
                </p>
            </div>

            <div class="relative pb-[56.25%] h-0 overflow-hidden rounded-lg mx-6">
                <img src="https://placehold.co/1280x720/000000/FFFFFF?text=Movie+Thumbnail+or+Video" alt="Movie Promotional Image" class="absolute inset-0 w-full h-full object-cover">
            </div>

            <div class="px-6 pt-6 pb-0">
                <p class="text-gray-700 mb-6 text-base md:text-lg leading-relaxed text-justify">
                    Suasana mencekam dan cerita yang menegangkan menjadikan film ini sangat dinantikan oleh para penggemar horor. Dengan sinematografi yang mengesankan dan plot yang menakutkan, film ini siap memberikan pengalaman horor yang tak terlupakan.
                </p>
            </div>
        </main>

        <aside class="w-full lg:w-2/5">
            <div class="p-6">
                <h3 class=" font-semibold mb-6 text-2xl">More From Author</h3>

                <article class="flex items-center gap-3 mb-5 p-2 bg-gray-50 rounded-md shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-1">
                    <img
                    src="{{ asset('assets/images/banner.png') }}"
                    alt="Populer 1"
                    class="w-28 h-20 object-cover rounded-md flex-shrink-0"
                    />
                    <div>
                    <span class="inline-block bg-indigo-700 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2">Foods</span>
                    <time class="text-gray-600 text-xs mb-2 block">27/04/2025, 18:00 WIB</time>
                    <span class="block bg-blue-600 w-[20px] h-[2px] mb-2 rounded"></span>
                    <h4 class="font-semibold text-sm">5 Resep Minuman Segar untuk Musim Panas</h4>
                    </div>
                </article>

                <article class="flex items-center gap-3 mb-5 p-2 bg-gray-50 rounded-md shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-1">
                    <img
                    src="{{ asset('assets/images/banner.png') }}"
                    alt="Populer 2"
                    class="w-28 h-20 object-cover rounded-md flex-shrink-0"
                    />
                    <div>
                    <span class="inline-block bg-indigo-700 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2">Business</span>
                    <time class="text-gray-600 text-xs mb-2 block">26/04/2025, 14:15 WIB</time>
                    <span class="block bg-blue-600 w-[20px] h-[2px] mb-2 rounded"></span>
                    <h4 class="font-semibold text-sm">Startup Lokal Raih Pendanaan Seri B</h4>
                    </div>
                </article>

                <article class="flex items-center gap-3 mb-5 p-2 bg-gray-50 rounded-md shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-1">
                    <img
                    src="{{ asset('assets/images/banner.png') }}"
                    alt="Populer 3"
                    class="w-28 h-20 object-cover rounded-md flex-shrink-0"
                    />
                    <div>
                    <span class="inline-block bg-indigo-700 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2">Entertainment</span>
                    <time class="text-gray-600 text-xs mb-2 block">25/04/2025, 19:30 WIB</time>
                    <span class="block bg-blue-600 w-[20px] h-[2px] mb-2 rounded"></span>
                    <h4 class="font-semibold text-sm">Film Indie Meraih Penghargaan Bergengsi</h4>
                    </div>
                </article>

                <article class="flex items-center gap-3 mb-5 p-2 bg-gray-50 rounded-md shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-1">
                    <img
                    src="{{ asset('assets/images/banner.png') }}"
                    alt="Populer 3"
                    class="w-28 h-20 object-cover rounded-md flex-shrink-0"
                    />
                    <div>
                    <span class="inline-block bg-indigo-700 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2">Entertainment</span>
                    <time class="text-gray-600 text-xs mb-2 block">25/04/2025, 19:30 WIB</time>
                    <span class="block bg-blue-600 w-[20px] h-[2px] mb-2 rounded"></span>
                    <h4 class="font-semibold text-sm">Film Indie Meraih Penghargaan Bergengsi</h4>
                    </div>
                </article>

                <article class="flex items-center gap-3 mb-5 p-2 bg-gray-50 rounded-md shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-1">
                    <img
                    src="{{ asset('assets/images/banner.png') }}"
                    alt="Populer 3"
                    class="w-28 h-20 object-cover rounded-md flex-shrink-0"
                    />
                    <div>
                    <span class="inline-block bg-indigo-700 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2">Entertainment</span>
                    <time class="text-gray-600 text-xs mb-2 block">25/04/2025, 19:30 WIB</time>
                    <span class="block bg-blue-600 w-[20px] h-[2px] mb-2 rounded"></span>
                    <h4 class="font-semibold text-sm">Film Indie Meraih Penghargaan Bergengsi</h4>
                    </div>
                </article>

            </div>
        </aside>

    </div>

    <div class="px-6 pt-0 pb-6"> 
        <p class="text-gray-700 text-lg leading-relaxed text-justify">
            Suasana mencekam dan cerita yang menegangkan menjadikan film ini sangat dinantikan oleh para penggemar horor. Dengan sinematografi yang mengesankan dan plot yang menakutkan, film ini siap memberikan pengalaman horor yang tak terlupakan. Suasana mencekam dan cerita yang menegangkan menjadikan film ini sangat dinantikan oleh para penggemar horor. Dengan sinematografi yang mengesankan dan plot yang menakutkan, film ini siap memberikan pengalaman horor yang tak terlupakan. Suasana mencekam dan cerita yang menegangkan menjadikan film ini sangat dinantikan oleh para penggemar horor. Dengan sinematografi yang mengesankan dan plot yang menakutkan, film ini siap memberikan pengalaman horor yang tak terlupakan.
        </p>
    </div>

</div>



{{-- Section for Likes, Dislikes, Saves --}}
<div class="mt-8 px-6 pb-8">
    <div class="flex items-center justify-start gap-6 bg-blue-700 text-white rounded-lg py-3 px-6 w-fit shadow-md">

        <button class="flex items-center gap-2 text-lg hover:text-blue-200 transition-colors">
            <i class="fa-solid fa-thumbs-up"></i> 
            <span>1</span>
        </button>
        <span class="h-6 w-px bg-blue-500"></span> 

        <button class="flex items-center gap-2 text-lg hover:text-blue-200 transition-colors">
            <i class="fa-solid fa-thumbs-down"></i> 
            <span>3</span>
        </button>
        <span class="h-6 w-px bg-blue-500"></span> 

        <button class="flex items-center gap-2 text-lg hover:text-blue-200 transition-colors">
            <i class="fa-solid fa-bookmark"></i> 
            <span>2</span>
        </button>

    </div>

    {{-- Comments Section Container --}}
    <div class="mt-8 bg-gray-100 rounded-lg p-6 shadow-md">
        <h3 class="font-semibold text-2xl text-gray-800 mb-6">Komentar</h3>

        <div class="flex items-center gap-4 mb-8">
            <input type="text" placeholder="Tulis Komentar" class="flex-grow p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
            <button class="bg-white text-gray-600 p-3 rounded-full shadow-sm hover:shadow-md transition-shadow flex-shrink-0">
                <i class="fa-solid fa-paper-plane text-xl"></i> 
            </button>
        </div>

        {{-- Comment List --}}
        <div class="space-y-6">

            <div class="flex items-start gap-4">

                <i class="fa-solid fa-circle-user text-4xl text-gray-500 flex-shrink-0"></i>
                <div>
                    <div class="text-sm font-semibold text-gray-800">Dimsum mentai</div>
                    <div class="text-xs text-gray-500 mb-2">29/04/2025, 23:00 WIB</div>
                    <p class="text-gray-700 text-sm leading-relaxed">Suasana mencekam dan cerita yang menegangkan menjadikan film ini sangat dinantikan oleh para penggemar horor. Dengan sinematografi yang mengesankan dan plot yang menakutkan.</p>
                    <div class="flex items-center gap-4 mt-2 text-gray-600 text-sm">
                        <button class="flex items-center gap-1 hover:text-blue-600 transition-colors">
                            <i class="fa-solid fa-thumbs-up"></i>
                            <span>1</span>
                        </button>
                        <button class="flex items-center gap-1 hover:text-red-600 transition-colors">
                            <i class="fa-solid fa-thumbs-down"></i>
                            <span>3</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex items-start gap-4">
                {{-- Perubahan: Menggunakan ikon Font Awesome sebagai avatar --}}
                <i class="fa-solid fa-circle-user text-4xl text-gray-500 flex-shrink-0"></i>
                <div>
                    <div class="text-sm font-semibold text-gray-800">Dimsum mentai</div>
                    <div class="text-xs text-gray-500 mb-2">29/04/2025, 23:00 WIB</div>
                    <p class="text-gray-700 text-sm leading-relaxed">Suasana mencekam dan cerita yang menegangkan menjadikan film ini sangat dinantikan oleh para penggemar horor. Dengan sinematografi yang mengesankan dan plot yang menakutkan.</p>
                    <div class="flex items-center gap-4 mt-2 text-gray-600 text-sm">
                        <button class="flex items-center gap-1 hover:text-blue-600 transition-colors">
                            <i class="fa-solid fa-thumbs-up"></i>
                            <span>1</span>
                        </button>
                        <button class="flex items-center gap-1 hover:text-red-600 transition-colors">
                            <i class="fa-solid fa-thumbs-down"></i>
                            <span>3</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
