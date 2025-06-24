@extends('layouts.admin')

@section('page-title')
    <a href="{{ route('admin.authors.index') }}" class="text-gray-500 hover:underline">Authors</a>
    <span class="text-gray-400"> / </span>
    <span class="text-black">Edit Author</span>
@endsection

@section('content')

<form action="{{ route('admin.authors.update', $author->id) }}" method="POST" enctype="multipart/form-data"
      class="bg-white text-black p-6 rounded shadow space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label for="name" class="block font-semibold mb-1">Nama</label>
        <input type="text" name="name" id="name" value="{{ old('name', $author->name) }}" required
               class="w-full border border-gray-300 rounded px-3 py-2" />
    </div>

    <div>
        <label class="block font-semibold mb-1">Avatar Saat Ini</label>
        <img id="avatarPreview" src="{{ asset('storage/' . $author->avatar) }}" 
             class="w-24 h-24 object-cover rounded border" alt="Avatar">
    </div>

    <div>
        <label for="avatar" class="block font-semibold mb-1">Ganti Avatar</label>
        <input type="file" name="avatar" id="avatar"
               class="w-full border border-gray-300 rounded px-3 py-2" accept="image/*" />
    </div>

    <div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Update
        </button>
        <a href="{{ route('admin.authors.index') }}"
           class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
            Batal
        </a>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('avatar');
    const preview = document.getElementById('avatarPreview');

    input.addEventListener('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endpush
