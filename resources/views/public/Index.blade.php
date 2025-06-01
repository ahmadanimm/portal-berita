@extends('layouts.main')

@section('hero')
<section x-data="{ active: 0 }" class="relative h-[400px] w-full mb-12 overflow-hidden">

  @foreach ($latestPerCategory as $index => $category)
    @php $article = $category->articles->sortByDesc('created_at')->first(); @endphp
    @if ($article)
      <div
        x-show="active === {{ $index }}"
        class="absolute inset-0 transition-opacity duration-500"
        style="background-image: url('{{ asset('storage/' . $article->thumbnail) }}'); background-size: cover; background-position: center;"
      >
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

        <!-- Kontainer teks + tombol -->
        <div class="relative max-w-7xl mx-auto px-8 py-12 text-white flex flex-col justify-end h-full">
          <span class="inline-block bg-indigo-700 px-3 py-1 rounded text-xs font-semibold mb-3 max-w-max">
            {{ $category->name }}
          </span>

          <time class="text-sm mb-3 block">
            {{ $article->created_at->format('d/m/Y, H:i') }} WIB
          </time>

          <span class="block bg-blue-600 w-[20px] h-[2px] mb-4 rounded"></span>

          <h1 class="text-2xl font-bold leading-tight max-w-xl">
            {{ $article->title }}
          </h1>

          <!-- Tombol posisi tetap seperti kode asli -->
          <div class="absolute bottom-6 right-8 flex gap-3">
            <button
              @click="active = active === 0 ? {{ $latestPerCategory->count() - 1 }} : active - 1"
              class="bg-white bg-opacity-30 rounded-full w-10 h-10 flex items-center justify-center hover:bg-opacity-50 transition"
            >
              <i class="bi bi-chevron-left text-white text-xl"></i>
            </button>
            <button
              @click="active = active === {{ $latestPerCategory->count() - 1 }} ? 0 : active + 1"
              class="bg-white bg-opacity-30 rounded-full w-10 h-10 flex items-center justify-center hover:bg-opacity-50 transition"
            >
              <i class="bi bi-chevron-right text-white text-xl"></i>
            </button>
          </div>
        </div>
      </div>
    @endif
  @endforeach

</section>
@endsection

@section('content')
{{-- Berita Terkini dan Terpopuler --}}
<section class="flex flex-col md:flex-row md:justify-between gap-8 max-w-7xl mx-auto mb-16 px-4">
  {{-- Berita Terkini --}}
  <div class="md:w-1/2">
    <h3 class="text-indigo-700 font-semibold mb-8 text-xl">BERITA TERKINI</h3>

    {{-- News Cards --}}
    <article class="flex gap-4 mb-6">
      <img
        src="{{ asset('assets/images/banner.png') }}"
        alt="Vape"
        class="w-48 h-32 object-cover rounded-lg flex-shrink-0"
      />
      <div>
        <span class="inline-block bg-indigo-700 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2"
          >Health</span
        >
        <time class="text-gray-600 text-xs mb-2 block">29/04/2025, 21:00 WIB</time>
        <span class="block bg-blue-600 w-[20px] h-[2px] mb-3 rounded"></span>
        <h4 class="font-semibold text-sm">Polisi Ungkap Vape Ilegal Berisi Etomidate, Ketahui Bahayanya</h4>
      </div>
    </article>

    <article class="flex gap-4 mb-6">
      <img
        src="{{ asset('assets/images/banner.png') }}"
        alt="Berita 2"
        class="w-48 h-32 object-cover rounded-lg flex-shrink-0"
      />
      <div>
        <span class="inline-block bg-indigo-700 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2"
          >Politics</span
        >
        <time class="text-gray-600 text-xs mb-2 block">28/04/2025, 15:30 WIB</time>
        <span class="block bg-blue-600 w-[20px] h-[2px] mb-3 rounded"></span>
        <h4 class="font-semibold text-sm">Pemerintah Rilis Kebijakan Baru Soal Pajak UMKM</h4>
      </div>
    </article>

    <article class="flex gap-4 mb-6">
      <img
        src="{{ asset('assets/images/banner.png') }}"
        alt="Berita 3"
        class="w-48 h-32 object-cover rounded-lg flex-shrink-0"
      />
      <div>
        <span class="inline-block bg-indigo-700 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2"
          >Sport</span
        >
        <time class="text-gray-600 text-xs mb-2 block">28/04/2025, 10:00 WIB</time>
        <span class="block bg-blue-600 w-[20px] h-[2px] mb-3 rounded"></span>
        <h4 class="font-semibold text-sm">Timnas Indonesia U-23 Siap Tampil di Final AFC 2025</h4>
      </div>
    </article>
  </div>

  {{-- Terpopuler --}}
  <div class="md:w-1/2">
    <h3 class="text-indigo-700 font-semibold mb-6 text-xl">TERPOPULER</h3>

    <article class="flex items-center gap-3 mb-3 p-2 bg-gray-50 rounded-md shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-1">
        <img
        src="{{ asset('assets/images/banner.png') }}"
        alt="Populer 1"
        class="w-24 h-20 object-cover rounded-md flex-shrink-0"
        />
        <div>
        <span class="inline-block bg-indigo-700 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2">Foods</span>
        <time class="text-gray-600 text-xs mb-2 block">27/04/2025, 18:00 WIB</time>
        <span class="block bg-blue-600 w-[20px] h-[2px] mb-2 rounded"></span>
        <h4 class="font-semibold text-sm">5 Resep Minuman Segar untuk Musim Panas</h4>
        </div>
    </article>

    <article class="flex items-center gap-3 mb-3 p-2 bg-gray-50 rounded-md shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-1">
        <img
        src="{{ asset('assets/images/banner.png') }}"
        alt="Populer 2"
        class="w-24 h-20 object-cover rounded-md flex-shrink-0"
        />
        <div>
        <span class="inline-block bg-indigo-700 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2">Business</span>
        <time class="text-gray-600 text-xs mb-2 block">26/04/2025, 14:15 WIB</time>
        <span class="block bg-blue-600 w-[20px] h-[2px] mb-2 rounded"></span>
        <h4 class="font-semibold text-sm">Startup Lokal Raih Pendanaan Seri B</h4>
        </div>
    </article>

    <article class="flex items-center gap-3 mb-3 p-2 bg-gray-50 rounded-md shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-1">
        <img
        src="{{ asset('assets/images/banner.png') }}"
        alt="Populer 3"
        class="w-24 h-20 object-cover rounded-md flex-shrink-0"
        />
        <div>
        <span class="inline-block bg-indigo-700 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2">Entertainment</span>
        <time class="text-gray-600 text-xs mb-2 block">25/04/2025, 19:30 WIB</time>
        <span class="block bg-blue-600 w-[20px] h-[2px] mb-2 rounded"></span>
        <h4 class="font-semibold text-sm">Film Indie Meraih Penghargaan Bergengsi</h4>
        </div>
    </article>

    <article class="flex items-center gap-3 mb-3 p-2 bg-gray-50 rounded-md shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-1">
        <img
        src="{{ asset('assets/images/banner.png') }}"
        alt="Populer 3"
        class="w-24 h-20 object-cover rounded-md flex-shrink-0"
        />
        <div>
        <span class="inline-block bg-indigo-700 text-white px-2 py-0.5 rounded text-xs font-semibold mb-2">Entertainment</span>
        <time class="text-gray-600 text-xs mb-2 block">25/04/2025, 19:30 WIB</time>
        <span class="block bg-blue-600 w-[20px] h-[2px] mb-2 rounded"></span>
        <h4 class="font-semibold text-sm">Film Indie Meraih Penghargaan Bergengsi</h4>
        </div>
    </article>
    
  </div>

</section>


<section class="py-16 bg-white max-w-7xl mx-auto px-4">
  <div class="text-center mb-10">
    <div class="inline-block bg-blue-700 text-white px-4 py-1 rounded-full text-sm font-semibold mb-3">
      BEST AUTHORS
    </div>
    <h2 class="text-2xl md:text-3xl font-bold leading-snug">
      Explore All Masterpieces<br>Written by People
    </h2>
  </div>

  <div class="flex flex-wrap justify-center gap-6">
    @foreach ($topAuthors as $author)
      <div class="bg-gray-100 rounded-2xl p-6 w-40 text-center shadow-sm">
        <img src="{{ asset('storage/' . $author->avatar) }}" alt="{{ $author->name }}" class="w-16 h-16 rounded-full object-cover mx-auto mb-3">
        <h4 class="text-base font-semibold mb-1">{{ $author->name }}</h4>
        <p class="text-xs text-gray-600">{{ $author->articles_count }} News</p>
      </div>
    @endforeach
  </div>
</section>


@foreach ($categoriesWithArticles as $category)
  @if ($category->articles->count())
    <section class="bg-white p-6 rounded-lg shadow-sm mb-12">
      <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end mb-6 gap-3">
        <div>
          <h2 class="text-3xl font-bold text-gray-900 leading-tight">Latest For You</h2>
          <h2 class="text-3xl font-bold text-gray-900 leading-tight">in {{ $category->name }}</h2>
        </div>
        <a href="{{ route('category.show', $category->slug) }}" class="text-blue-600 font-semibold text-sm border border-blue-600 rounded-full px-4 py-1 hover:bg-blue-600 hover:text-white transition">Explore All</a>
      </div>

      <div class="flex flex-col lg:flex-row gap-6">
        {{-- Featured Article --}}
        @php $featured = $category->articles->first(); @endphp
        <a href="{{ route('article.show', $featured->slug) }}" class="relative block flex-[1.5] min-h-[360px] rounded-lg overflow-hidden shadow-md bg-gray-100 group">
          <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt="{{ $featured->title }}" class="w-full h-[360px] object-cover group-hover:scale-105 transition duration-300">
          <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent text-white p-5 pt-16">
            <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded mb-2 inline-block">Featured</span>
            <h3 class="text-2xl font-bold leading-snug">{{ $featured->title }}</h3>
            <p class="text-sm opacity-80">{{ $featured->created_at->format('M d, Y') }}</p>
          </div>
        </a>

        {{-- Side Articles --}}
        <div class="flex-1 flex flex-col gap-4">
          @foreach ($category->articles->skip(1) as $article)
            <a href="{{ route('article.show', $article->slug) }}" class="flex items-center gap-4 bg-gray-50 rounded-lg shadow-sm p-3 hover:-translate-y-1 hover:shadow-md transition">
              <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-28 h-20 object-cover rounded-md flex-shrink-0">
              <div>
                <h4 class="text-base font-semibold">{{ $article->title }}</h4>
                <p class="text-sm text-gray-600">{{ $article->created_at->format('M d, Y') }}</p>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </section>
  @endif
@endforeach

@endsection
