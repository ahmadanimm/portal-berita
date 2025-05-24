@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Categories</h1>
    <a href="{{ route('admin.categories.create') }}"
        class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded shadow mb-4 inline-block text-sm">
        + Kategori Baru
    </a>

</div>

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.categories.index') }}" method="GET" class="mb-4">
    <input type="text" name="search" value="{{ request('search') }}"
        placeholder="Cari kategori..."
        class="px-4 py-2 border border-orange-400 rounded w-1/3 text-black" />
    <button type="submit"
            class="ml-2 bg-orange-500 hover:bg-orange-600 text-white px-3 py-2 rounded text-sm shadow">
        Cari
    </button>
</form>

<div class="bg-white p-4 rounded shadow text-black">

    <table class="w-full text-sm">
        <thead>
            <tr class="border-b">
                <th class="text-left p-2">Nama</th>
                <th class="text-left p-2">Slug</th>
                <th class="text-left p-2">Ikon</th>
                <th class="text-left p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $cat)
            <tr class="border-b">
                <td class="p-2">{{ $cat->name }}</td>
                <td class="p-2">{{ $cat->slug }}</td>
                <td class="p-2">{{ $cat->icon }}</td>
                <td class="p-2">
                    @if($cat->icon)
                        <img src="{{ asset('storage/' . $cat->icon) }}" alt="Ikon" class="w-6 h-6 object-cover">
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="p-2">
                    <a href="{{ route('admin.categories.edit', $cat->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 ml-2 hover:underline" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
