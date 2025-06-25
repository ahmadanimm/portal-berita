@extends('layouts.admin')

@section('page-title')
    <a href="{{ route('admin.articles.index') }}" class="text-gray-500 hover:underline">Manajemen Berita</a>
    <span class="text-gray-400"> / </span>
    <span class="text-black">Edit Berita</span>
@endsection

@section('content')
<form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data"
      class="bg-white text-gray-800 p-6 rounded-lg shadow space-y-5">
    @csrf
    @method('PUT')

    <div>
        <label class="block mb-1 font-semibold text-sm">Judul</label>
        <input type="text" name="title" value="{{ old('title', $article->title) }}"
               class="w-full border border-gray-300 rounded px-3 py-2 text-sm" required>
    </div>

    <div>
        <label class="inline-flex items-center text-sm">
            <input type="checkbox" name="is_premium" class="mr-2" 
                   {{ old('is_premium', $article->is_premium) ? 'checked' : '' }}>
            Premium
        </label>
    </div>

    <div>
        <label class="block mb-1 font-semibold text-sm">Kategori</label>
        <select name="category_id" class="w-full border border-gray-300 rounded px-3 py-2 text-sm">
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        {{ $category->id == old('category_id', $article->category_id) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block mb-1 font-semibold text-sm">Thumbnail Saat Ini:</label>
        <img id="thumbnailPreview" src="{{ asset('storage/'.$article->thumbnail) }}"
             class="w-24 h-24 object-cover rounded border" alt="Thumbnail">
    </div>

    <div>
        <label class="block mb-1 font-semibold text-sm">Ganti Thumbnail (Max. 2 MB)</label>
        <input type="file" name="thumbnail" id="thumbnailInput"
               class="w-full border border-gray-300 rounded px-3 py-2 text-sm" accept="image/*">
    </div>

    <div>
        <label class="block mb-1 font-semibold text-sm">Isi Artikel</label>
        <textarea name="body" rows="6"
                  class="w-full border border-gray-300 rounded px-3 py-2 text-sm" required>{{ old('body', $article->body) }}</textarea>
    </div>

    <div class="flex items-center gap-2">
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow text-sm transition">
            Update
        </button>
        <a href="{{ route('admin.articles.index') }}"
           class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md shadow text-sm transition">
            Batal
        </a>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('thumbnailInput');
    const preview = document.getElementById('thumbnailPreview');

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
