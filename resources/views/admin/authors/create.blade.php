@extends('layouts.admin')

@section('page-title')
    <a href="{{ route('admin.authors.index') }}" class="text-gray-500 hover:underline">Authors</a>
    <span class="text-gray-400"> / </span>
    <span class="text-black">Tambah Author</span>
@endsection

@section('content')

<form action="{{ route('admin.authors.store') }}" method="POST" enctype="multipart/form-data" class="bg-white text-black p-6 rounded shadow space-y-4">
    @csrf

    <div>
        <label for="name" class="block mb-1 font-semibold">Nama</label>
        <input type="text" name="name" id="name" required
            class="w-full border border-gray-300 rounded px-3 py-2" />
    </div>

    <div>
        <label for="avatar" class="block mb-1 font-semibold">Avatar</label>
        <input type="file" name="avatar" id="avatar"
            class="w-full border border-gray-300 rounded px-3 py-2" />
    </div>

    <div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Simpan
        </button>
        <a href="{{ route('admin.authors.index') }}" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
            Batal
        </a>
    </div>
</form>
@endsection
