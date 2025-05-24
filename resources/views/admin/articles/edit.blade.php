@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Artikel</h1>

<form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="bg-white text-black p-6 rounded shadow space-y-4">
    @csrf
    @method('PUT')

    <!-- Judul -->
    <div>
        <label class="block mb-1 font-semibold">Judul</label>
        <input type="text" name="title" value="{{ old('title', $article->title) }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <!-- Premium -->
    <div>
        <label class="inline-flex items-center">
            <input type="checkbox" name="is_premium" class="mr-2"
                {{ old('is_premium', $article->is_premium) ? 'checked' : '' }}>
            Premium
        </label>
    </div>

    <!-- Kategori -->
    <div>
        <label class="block mb-1 font-semibold">Kategori</label>
        <select name="category_id" class="w-full border rounded px-3 py-2">
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $category->id == old('category_id', $article->category_id) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Thumbnail lama -->
    @if($article->thumbnail)
        <div>
            <label class="block mb-1 font-semibold">Thumbnail Saat Ini:</label>
            <img src="{{ asset('storage/'.$article->thumbnail) }}" class="w-24 h-24 object-cover rounded">
        </div>
    @endif

    <!-- Upload thumbnail baru -->
    <div>
        <label class="block mb-1 font-semibold">Ganti Thumbnail</label>
        <input type="file" name="thumbnail" class="w-full border rounded px-3 py-2">
    </div>

    <!-- Body -->
    <div>
        <label class="block mb-1 font-semibold">Isi Artikel</label>
        <textarea name="body" rows="6" class="w-full border rounded px-3 py-2" required>{{ old('body', $article->body) }}</textarea>
    </div>

    <!-- Tombol -->
    <div>
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('admin.articles.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
</form>
@endsection
