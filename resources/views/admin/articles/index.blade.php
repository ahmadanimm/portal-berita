@extends('layouts.admin')

@section('page-title', 'Article News')

@section('page-action')
    <a href="{{ route('admin.articles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
        + New Article
    </a>
@endsection

@section('content')
<div class="bg-white p-4 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <!-- Selected Count & Delete Button -->
        <form id="bulk-delete-form" method="POST" action="{{ route('admin.articles.destroy', ['article' => 0]) }}" onsubmit="return confirm('Yakin ingin menghapus artikel terpilih?');">
            @csrf
            @method('DELETE')
            <input type="hidden" name="selected_ids" id="selected-ids">
            <div id="selected-count" class="hidden text-gray-700 mb-1"></div>
            <button type="submit" id="delete-selected" class="hidden bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded text-sm shadow">
                <i class="fas fa-trash mr-1"></i> Delete selected
            </button>
        </form>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('admin.articles.index') }}" class="relative w-64">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search"
                oninput="delayedSubmit(this.form)"
                class="bg-gray-100 border border-blue-400 text-gray-800 text-sm rounded-full px-4 py-1 pl-10 pr-8 focus:outline-none focus:ring w-full"
            />
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-blue-400">
                <i class="fas fa-search"></i>
            </span>
            @if(request('search'))
                <a href="{{ route('admin.articles.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-400">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white text-gray-800 text-sm border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 border-b border-gray-200">
                        <input type="checkbox" id="select-all">
                    </th>
                    <th class="px-4 py-2 border-b border-gray-200">Judul</th>
                    <th class="px-4 py-2 border-b border-gray-200">Kategori</th>
                    <th class="px-4 py-2 border-b border-gray-200">Status</th>
                    <th class="px-4 py-2 border-b border-gray-200">Thumbnail</th>
                    <th class="px-4 py-2 border-b border-gray-200">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($articles as $article)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">
                            <input type="checkbox" class="select-item" value="{{ $article->id }}">
                        </td>
                        <td class="px-4 py-2">{{ $article->title }}</td>
                        <td class="px-4 py-2">{{ $article->category->name ?? '-' }}</td>
                        <td class="px-4 py-2">
                            @if($article->is_premium)
                                <span class="text-yellow-600 font-semibold">Premium</span>
                            @else
                                <span class="text-green-600 font-semibold">Gratis</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/'.$article->thumbnail) }}" class="w-20 h-12 object-cover rounded" />
                            @else
                                <span class="text-gray-500 italic">No image</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-xs shadow">
                                <i class="fas fa-pen mr-1"></i>Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-2 text-center text-gray-500">Tidak ada artikel.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-between items-center mt-4 text-sm text-gray-600">
        <div class="pr-6">
            Menampilkan {{ $articles->firstItem() }} - {{ $articles->lastItem() }} dari {{ $articles->total() }} artikel
        </div>
        <div>
            {{ $articles->onEachSide(1)->links('pagination::tailwind') }}
        </div>
    </div>
</div>

<script>
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.select-item');
    const selectedIdsInput = document.getElementById('selected-ids');
    const deleteButton = document.getElementById('delete-selected');
    const selectedCountText = document.getElementById('selected-count');

    function updateSelectedDisplay() {
        const selected = Array.from(checkboxes).filter(cb => cb.checked);
        if (selected.length > 0) {
            deleteButton.classList.remove('hidden');
            selectedCountText.classList.remove('hidden');
            selectedCountText.innerText = `${selected.length} terpilih`;
        } else {
            deleteButton.classList.add('hidden');
            selectedCountText.classList.add('hidden');
        }
    }

    function setSelectedIds() {
        const selected = Array.from(checkboxes).filter(cb => cb.checked).map(cb => cb.value);
        selectedIdsInput.value = selected.join(',');
    }

    selectAll.addEventListener('change', function () {
        checkboxes.forEach(cb => {
            cb.checked = this.checked;
        });
        updateSelectedDisplay();
    });

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateSelectedDisplay);
    });

    let timeout;
    function delayedSubmit(form) {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            form.submit();
        }, 500);
    }

    document.getElementById('bulk-delete-form').addEventListener('submit', function(e) {
        setSelectedIds();
    });
</script>
@endsection
