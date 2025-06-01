<header class="py-4">
  <div class="container mx-auto flex justify-between items-center px-4 max-w-7xl">
    <!-- Kiri: Logo (lebih besar) -->
    <a href="{{ url('/') }}">
      <img src="{{ asset('assets/images/logo 170x50.png') }}" 
           alt="Logo Ruang Kabar" 
           class="w-[170px] h-[50px] object-contain" />
    </a>

    <!-- Kanan: Tombol Beranda (siku, seperti Edit Profil) -->
    <a href="{{ route('home') }}"
       class="flex items-center gap-2 text-indigo-700 bg-indigo-100 hover:bg-indigo-200 px-5 py-2 rounded font-semibold transition">
      <i class="bi bi-house-door-fill text-lg"></i>
      Beranda
    </a>
  </div>
</header>

<div class="w-screen border-b-4 border-gray-200 mt-1 ml-[-50vw] left-1/2 relative"></div>




