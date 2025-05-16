@extends('layouts.main')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah Artikel</h1>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label class="block font-semibold mb-1">Judul</label>
        <input type="text" name="title" class="w-full border px-3 py-2 rounded" value="{{ old('title') }}" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Kategori</label>
        <select name="category_id" class="w-full border px-3 py-2 rounded" required>
            <option value="">Pilih kategori</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Isi Artikel</label>
        <textarea name="body" class="w-full border px-3 py-2 rounded h-40" required>{{ old('body') }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Thumbnail (Gambar)</label>
        <input type="file" name="thumbnail" accept="image/*">
    </div>

    <div class="mb-4">
        <label class="inline-flex items-center">
            <input type="checkbox" name="is_premium" class="form-checkbox" @if(old('is_premium')) checked @endif>
            <span class="ml-2">Konten Premium</span>
        </label>
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
    <a href="{{ route('articles.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
</form>
@endsection
