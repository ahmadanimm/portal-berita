<header class="border-b border-gray-300 py-4">
  <div class="container mx-auto flex justify-between items-center px-4 max-w-7xl">
    <div class="flex items-center gap-8">
      <div class="logo">
        <img src="{{ asset('assets/images/logo web 333x133.png') }}" alt="Logo Ruang Kabar" class="w-[230px] h-[50px] object-contain" />
      </div>
      <div class="border-l border-gray-400 h-10"></div>
      <form method="GET" action="{{ route('search') }}" class="relative">
        <input
            type="text"
            name="query"
            value="{{ request('query') }}"
            placeholder="Cari tokoh, topik atau peristiwa"
            class="w-80 rounded-full border border-gray-300 pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600"
        />
        <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-700">
            <i class="bi bi-search"></i>
        </span>
      </form>
    </div>
    <div class="flex items-center gap-4">
      <button
        class="bg-indigo-700 text-white px-4 py-2 rounded-full font-semibold hover:bg-indigo-800 transition"
      >
        Berlangganan
      </button>
      @guest
        <!-- Saat belum login -->
        <a href="{{ route('login') }}"
        class="flex items-center gap-1 bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full font-semibold hover:bg-indigo-200 transition"
        >
            <i class="bi bi-person-circle text-lg"></i> Login
        </a>
      @endguest

      @auth
        <!-- Saat sudah login -->
        <div x-data="{ open: false }" class="relative">
            <button
                @click="open = !open"
                class="flex items-center gap-1 bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full font-semibold hover:bg-indigo-200 transition"
            >
                <i class="bi bi-person-circle text-lg"></i> {{ Auth::user()->name }}
            </button>

            <!-- Dropdown logout -->
            <div x-show="open"
                @click.outside="open = false"
                x-transition
                class="absolute right-0 mt-2 bg-white text-black rounded shadow-md z-50 w-40"
            >
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                        <i class="bi bi-box-arrow-right mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
      @endauth



    </div>
  </div>

  <div class="mt-4 border-b border-gray-200"></div>

  <div class="flex flex-wrap justify-center gap-3 py-4">
    @foreach ($categories as $category)
      <a href="{{ route('category.show', $category->slug) }}" 
        class="flex items-center gap-2 border border-gray-300 rounded-full px-4 py-2 text-sm hover:bg-indigo-100 transition">

        {{-- Ambil icon dari kolom icon --}}
        <img src="{{ asset('storage/' . $category->icon) }}" 
              alt="" 
              class="w-5 h-5 object-contain" />

        <span>{{ $category->name }}</span>
      </a>
    @endforeach
  </div>

<script src="https://unpkg.com/alpinejs" defer></script>

</header>
