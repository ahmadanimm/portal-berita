@extends('layouts.admin')

@section('page-title', 'Manajemen Penulis')

@section('page-action')
    <a href="{{ route('admin.authors.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
        + Tambah Penulis
    </a>
@endsection

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">

        <form id="bulk-delete-form" method="POST" action="{{ route('admin.authors.destroy', ['author' => 0]) }}" onsubmit="return confirm('Yakin ingin menghapus author terpilih?');">
            @csrf
            @method('DELETE')
            <input type="hidden" name="selected_ids" id="selected-ids">
            <div id="selected-count" class="hidden text-gray-700 mb-1"></div>
            <button type="submit" id="delete-selected" class="hidden bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded text-sm shadow">
                <i class="fas fa-trash mr-1"></i> Hapus item yang di pilih
            </button>
        </form>

        <form method="GET" action="{{ route('admin.authors.index') }}" class="relative w-64">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari"
                oninput="delayedSubmit(this.form)"
                class="bg-gray-100 border border-blue-400 text-gray-800 text-sm rounded-full px-4 py-1 pl-10 pr-8 focus:outline-none focus:ring w-full"
            />
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-blue-400">
                <i class="fas fa-search"></i>
            </span>
            @if(request('search'))
                <a href="{{ route('admin.authors.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-400">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white text-sm text-gray-800 border border-gray-200 rounded">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-200 text-left">
                    <th class="px-4 py-2">
                        <input type="checkbox" id="select-all">
                    </th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Avatar</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($authors as $author)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">
                            <input type="checkbox" class="select-item" value="{{ $author->id }}">
                        </td>
                        <td class="px-4 py-2">{{ $author->name }}</td>
                        <td class="px-4 py-2">
                            @if($author->avatar)
                                <img src="{{ asset('storage/' . $author->avatar) }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
                            @else
                                <span class="text-gray-500 italic">Tidak ada avatar</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.authors.edit', $author->id) }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-xs shadow">
                                <i class="fas fa-pen mr-1"></i>Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500 italic">Tidak ada penulis.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-between items-center mt-4 text-sm text-gray-700">
        <div class="pr-6">
            Menampilkan {{ $authors->firstItem() }} - {{ $authors->lastItem() }} dari {{ $authors->total() }} Berita
        </div>
        <div>
            {{ $authors->onEachSide(1)->links('pagination::tailwind') }}
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
            selectedCountText.innerText = `${selected.length} selected`;
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
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateSelectedDisplay();
    });

    checkboxes.forEach(cb => cb.addEventListener('change', updateSelectedDisplay));

    function delayedSubmit(form) {
        clearTimeout(window.searchDelay);
        window.searchDelay = setTimeout(() => form.submit(), 500);
    }

    document.getElementById('bulk-delete-form').addEventListener('submit', setSelectedIds);
</script>
@endsection
