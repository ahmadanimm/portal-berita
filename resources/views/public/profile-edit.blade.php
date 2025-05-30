@extends('layouts.app')

@section('content')
@include('partials.navbar-profile')

<div class="max-w-7xl mx-auto px-4 py-10">
  <!-- Edit Profile section -->
  <div class="flex flex-col md:flex-row items-start md:gap-6 mb-10">
    <!-- Avatar -->
    <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center text-5xl">
      @if (Auth::user()->profile_photo)
        <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" alt="Foto Profil" class="w-full h-full object-cover">
      @else
        <i class="bi bi-person-fill text-gray-500"></i>
      @endif
    </div>

    <!-- Form Edit Profile -->
    <div class="flex-1 mt-6 md:mt-0">
      <h2 class="text-2xl font-bold mb-6">Edit Profil</h2>

      @if (session('success'))
        <div class="mb-4 text-green-600 font-semibold">{{ session('success') }}</div>
      @endif

      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Foto Profil -->
        <div>
          <label class="block font-medium mb-1 text-sm">Foto Profil</label>
          <input type="file" name="profile_photo" accept="image/*"
            class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Nama -->
        <div>
          <label class="block font-medium mb-1 text-sm">Nama</label>
          <input type="text" name="name" value="{{ Auth::user()->name }}"
            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Password -->
        <div>
          <label class="block font-medium mb-1 text-sm">Password Baru (opsional)</label>
          <input type="password" name="password" placeholder="Password baru"
            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
          <input type="password" name="password_confirmation" placeholder="Konfirmasi password"
            class="mt-3 w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-wrap gap-3">
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded font-semibold hover:bg-blue-700 text-sm">
            Simpan Perubahan
          </button>
          <a href="{{ url()->previous() }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded font-semibold hover:bg-gray-300 text-sm">
            Batal
          </a>
        </div>
        </form>

        <!-- Tombol Hapus Akun (dipisahkan lebih jauh) -->
        <form action="{{ route('profile.delete') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun secara permanen?')"
        class="mt-24">
        @csrf
        <button type="submit"
            class="bg-red-600 text-white px-4 py-2 rounded font-semibold hover:bg-red-700 text-sm">
            Hapus Akun
        </button>
        </form>

    </div>
  </div>
</div>
@endsection
