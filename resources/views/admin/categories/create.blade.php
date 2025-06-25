@extends('layouts.admin')

@section('page-title')
    <a href="{{ route('admin.categories.index') }}" class="text-gray-500 hover:underline">Manajemen Kategori</a>
    <span class="text-gray-400"> / </span>
    <span class="text-black">Tambah Kategori</span>
@endsection

@section('content')

<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow text-black space-y-4">
    @csrf

    <div>
        <label class="block font-semibold mb-1">Nama Kategori</label>
        <input type="text" name="name" value="{{ old('name') }}"
               required class="w-full border border-gray-300 rounded px-3 py-2">
    </div>

    <div>
        <label class="block font-semibold mb-1">Upload Ikon / Gambar (Max. 2 MB)</label>
        <input type="file" name="icon" accept="image/*"
               class="w-full border border-gray-300 rounded px-3 py-2">
    </div>

    <div class="mt-6">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Simpan
        </button>
        <a href="{{ route('admin.categories.index') }}" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
            Batal
        </a>
    </div>
</form>
@endsection
