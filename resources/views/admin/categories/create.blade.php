@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah Kategori</h1>

<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow text-black space-y-4">

    @csrf

    <!-- Nama -->
    <div>
        <label class="block font-semibold mb-1">Nama Kategori</label>
        <input type="text" name="name" value="{{ old('name') }}"
               required class="w-full border border-gray-300 rounded px-3 py-2">
    </div>

    <!-- Ikon -->
    <div>
        <div>
            <label class="block font-semibold mb-1">Upload Ikon (Gambar)</label>
            <input type="file" name="icon" accept="image/*"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

    </div>


    <!-- Tombol -->
    <div class="flex justify-start mt-6 space-x-2">
        <!-- Tombol Simpan -->
        <x-primary-button type="submit">
            Simpan
        </x-primary-button>

        <!-- Tombol Batal -->
        <a href="{{ route('admin.categories.index') }}">
            <x-primary-button class="bg-gray-600 hover:bg-gray-700">
                Batal
            </x-primary-button>
        </a>
    </div>


</form>
@endsection
