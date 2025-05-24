@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Kategori</h1>

<form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow text-black space-y-4">
    @csrf
    @method('PUT')

    <!-- Nama -->
    <div>
        <label class="block font-semibold mb-1">Nama Kategori</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" required
               class="w-full border border-gray-300 rounded px-3 py-2">
    </div>

    <!-- Upload Ikon Baru -->
    <div>
        <label class="block font-semibold mb-1">Ganti Ikon (Opsional)</label>
        <input type="file" name="icon" accept="image/*"
               class="w-full border border-gray-300 rounded px-3 py-2">
        @if ($category->icon)
            <p class="text-sm text-gray-600 mt-1">Ikon saat ini:</p>
            <img src="{{ asset('storage/' . $category->icon) }}" alt="ikon" class="w-12 h-12 object-cover mt-1">
        @endif
    </div>

    <!-- Tombol -->
    <div class="flex justify-start mt-6 space-x-2">
        <x-primary-button type="submit">
            Simpan
        </x-primary-button>
        <a href="{{ route('admin.categories.index') }}">
            <x-primary-button class="bg-gray-600 hover:bg-gray-700">
                Batal
            </x-primary-button>
        </a>
    </div>
</form>
@endsection
