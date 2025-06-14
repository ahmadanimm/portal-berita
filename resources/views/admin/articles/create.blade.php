@extends('layouts.admin')

@section('page-title')
    <a href="{{ route('admin.articles.index') }}" class="text-gray-500 hover:underline">Article News</a>
    <span class="text-gray-400"> / </span>
    <span class="text-black">Tambah Artikel</span>
@endsection

@section('content')

<form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="bg-white text-gray-800 p-6 rounded-lg shadow space-y-5">
    @csrf

    <!-- Judul -->
    <div>
        <label class="block mb-1 font-semibold text-sm">Judul</label>
        <input type="text" name="title" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" required>
    </div>

    <!-- Premium -->
    <div>
        <label class="inline-flex items-center text-sm">
            <input type="checkbox" name="is_premium" class="mr-2">
            Premium
        </label>
    </div>

    <!-- Kategori -->
    <div>
        <label class="block mb-1 font-semibold text-sm">Kategori</label>
        <select name="category_id" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Thumbnail -->
    <div>
        <label class="block mb-1 font-semibold text-sm">Thumbnail</label>
        <input type="file" name="thumbnail" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
    </div>

    <!-- Body -->
    <div>
        <label class="block mb-1 font-semibold text-sm">Isi Artikel</label>
        <textarea name="body" rows="6" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" required></textarea>
    </div>

    <!-- Tombol Simpan & Batal -->
    <div class="flex items-center gap-2">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow text-sm transition">
            Simpan
        </button>
        <a href="{{ route('admin.articles.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md shadow text-sm transition">
            Batal
        </a>
    </div>
</form>
@endsection
