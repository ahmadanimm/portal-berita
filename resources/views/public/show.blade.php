@extends('layouts.main')

@section('content')
    <article class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-2">{{ $article->title }}</h1>
        <p class="text-sm text-gray-500 mb-4">
            Diposting pada {{ $article->created_at->format('d M Y') }}
        </p>

        @if($article->is_premium && !$canAccess)
            {{-- Untuk non-premium, tampilkan sebagian --}}
            <div class="text-gray-700 mb-4">
                {!! Str::limit(strip_tags($article->body), 200) !!}
            </div>

            <div class="bg-yellow-100 text-yellow-800 p-4 rounded mt-4">
                <p class="mb-2"><strong>Konten Premium</strong></p>
                <p>Berlangganan untuk membaca artikel lengkap ini.</p>

                @guest
                    <a href="{{ route('register') }}" class="text-indigo-600 font-semibold underline mt-2 inline-block">Daftar sekarang</a>
                @else
                    <form method="POST" action="{{ route('subscribe') }}" class="mt-2">
                        @csrf
                        <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                            Berlangganan Sekarang
                        </button>
                    </form>
                @endguest
            </div>
        @else
            {{-- Tampilkan isi lengkap --}}
            <div class="text-gray-700">
                {!! $article->body !!}
            </div>
        @endif
    </article>
@endsection
