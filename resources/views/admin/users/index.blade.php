@extends('layouts.admin')

@section('page-title', 'Manajemen User')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800"></h2>
        <form method="GET" action="{{ route('admin.users.index') }}" class="relative w-64">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama atau email..."
                oninput="delayedSubmit(this.form)"
                class="bg-gray-100 border border-blue-400 text-gray-800 text-sm rounded-full px-4 py-1 pl-10 pr-8 focus:outline-none focus:ring w-full"
            />
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-blue-400">
                <i class="fas fa-search"></i>
            </span>
            @if(request('search'))
                <a href="{{ route('admin.users.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-400">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white text-sm text-gray-800 border border-gray-200 rounded">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-200 text-left">
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Terdaftar Sejak</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-2">
                            <button
                                type="button"
                                onclick="showDeleteModal({{ $user->id }})"
                                class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs shadow"
                            >
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500 italic">Tidak ada user ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-between items-center mt-4 text-sm text-gray-700">
        <div>
            Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} pengguna
        </div>
        <div>
            {{ $users->onEachSide(1)->links('pagination::tailwind') }}
        </div>
    </div>
</div>

<form id="deleteUserForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<div id="deleteUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center w-96">
        <h2 class="text-gray-800 font-semibold text-lg mb-2">Konfirmasi Hapus</h2>
        <p class="text-sm text-gray-600 mb-4">Apakah Anda yakin ingin menghapus user ini?</p>
        <div class="flex justify-center gap-4">
            <button onclick="submitDeleteUser()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</button>
            <button onclick="closeDeleteUserModal()" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
        </div>
    </div>
</div>

<script>
    function showDeleteModal(userId) {
        const form = document.getElementById('deleteUserForm');
        form.action = `/admin/users/${userId}`;
        document.getElementById('deleteUserModal').classList.remove('hidden');
    }

    function closeDeleteUserModal() {
        document.getElementById('deleteUserModal').classList.add('hidden');
    }

    function submitDeleteUser() {
        document.getElementById('deleteUserForm').submit();
    }

    function delayedSubmit(form) {
        clearTimeout(window.searchDelay);
        window.searchDelay = setTimeout(() => form.submit(), 500);
    }
</script>

@endsection
