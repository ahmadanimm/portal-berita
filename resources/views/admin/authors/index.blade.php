@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-white">Authors</h1>
    <a href="{{ route('admin.authors.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
        + New Author
    </a>
</div>

<div class="bg-gray-900 p-4 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-4">
        <!-- Selected Count & Delete Button -->
        <form id="bulk-delete-form" method="POST" action="{{ route('admin.authors.destroy', ['author' => 0]) }}" onsubmit="return confirm('Yakin ingin menghapus author terpilih?');">
            @csrf
            @method('DELETE')
            <input type="hidden" name="selected_ids" id="selected-ids">
            <div id="selected-count" class="hidden text-white mb-1"></div>
            <button type="submit" id="delete-selected" class="hidden bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded text-sm">
                <i class="fas fa-trash mr-1"></i> Delete selected
            </button>
        </form>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('admin.authors.index') }}" class="relative w-64">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search"
                oninput="delayedSubmit(this.form)"
                class="bg-gray-800 border border-orange-500 text-white text-sm rounded-full px-4 py-1 pl-10 pr-8 focus:outline-none focus:ring w-full"
            />
            <span class="absolute left-3 top-1.5 text-orange-400">
                <i class="fas fa-search"></i>
            </span>
            @if(request('search'))
                <a href="{{ route('admin.authors.index') }}" class="absolute right-3 top-1.5 text-orange-400">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-800 text-white text-sm">
            <thead>
                <tr class="bg-gray-700 text-left">
                    <th class="px-4 py-2">
                        <input type="checkbox" id="select-all">
                    </th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Avatar</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach ($authors as $author)
                <tr>
                    <td class="px-4 py-2">
                        <input type="checkbox" class="select-item" value="{{ $author->id }}">
                    </td>
                    <td class="px-4 py-2">{{ $author->name }}</td>
                    <td class="px-4 py-2">
                        @if($author->avatar)
                            <img src="{{ asset('storage/' . $author->avatar) }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
                        @else
                            <span class="text-gray-400 italic">No avatar</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.authors.edit', $author->id) }}" class="text-orange-400 hover:underline">
                            <i class="fas fa-pen mr-1"></i>Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-between items-center mt-4 text-sm text-white">
        <div class="pr-6">
            Showing {{ $authors->firstItem() }} to {{ $authors->lastItem() }} of {{ $authors->total() }} results
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
