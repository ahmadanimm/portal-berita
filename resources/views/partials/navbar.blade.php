<header class="border-b border-white py-4">
  <div class="container mx-auto flex justify-between items-center px-4 max-w-7xl">
    <div class="flex items-center gap-8">
      <div class="logo">
        <a href="{{ url('/') }}">
          <img src="{{ asset('assets/images/logo 170x50.png') }}" alt="Logo Ruang Kabar" class="w-[170px] h-[50px] object-contain" />
        </a>
      </div>
      <div class="border-l-2 border-gray-400 h-11"></div>
      <form method="GET" action="{{ route('search') }}" class="relative" id="searchForm">

          <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 cursor-pointer" id="searchIcon">
              <i class="bi bi-search"></i>
          </span>

          <input
              type="text"
              name="query"
              id="searchInput"
              value="{{ request('query') }}"
              placeholder="Cari tokoh, topik atau peristiwa"
              class="w-80 rounded-full border border-gray-300 pl-10 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600"
              autocomplete="off"
          />

          <span
              id="clearSearch"
              class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 cursor-pointer {{ request('query') ? '' : 'hidden' }}"
          >
              <i class="bi bi-x-circle-fill"></i>
          </span>
      </form>

      <script>
        const input = document.getElementById('searchInput');
        const form = document.getElementById('searchForm');
        const searchIcon = document.getElementById('searchIcon');
        const clearBtn = document.getElementById('clearSearch');

        let typingTimer;
        const doneTypingInterval = 500;

        input.addEventListener('keyup', function () {
          clearTimeout(typingTimer);

          if (input.value.trim() === '') {
            clearBtn.classList.add('hidden');
            
            window.location.href = '/';
          } else {
            clearBtn.classList.remove('hidden');
            typingTimer = setTimeout(() => {
              form.submit();
            }, doneTypingInterval);
          }
        });

        input.addEventListener('keydown', function () {
          clearTimeout(typingTimer);
        });

        
        searchIcon?.addEventListener('click', () => {
          if (input.value.trim()) form.submit();
        });

        clearBtn?.addEventListener('click', () => {
          window.location.href = '/';
        });
      </script>
    </div>
    <div class="flex items-center gap-4">
      <a href="{{ route('subscription.index') }}" class="bg-blue-700 text-white px-4 py-2 rounded-full font-semibold hover:bg-blue-800 transition">Berlangganan</a>
      @guest
        
        <a href="{{ route('login') }}"
        class="flex items-center gap-1 bg-blue-100 text-blue-700 px-4 py-2 rounded-full font-semibold hover:bg-indigo-200 transition"
        >
            <i class="bi bi-person-circle text-lg"></i> Login
        </a>
      @endguest

      @auth
      <div x-data="{ open: false }" class="relative">
          <button
              @click="open = !open"
              class="flex items-center gap-1 bg-blue-100 text-blue-700 px-4 py-2 rounded-full font-semibold hover:bg-indigo-200 transition"
          >
              @if (Auth::user()->profile_photo)
                  <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" alt="Foto Profil" class="w-6 h-6 object-cover rounded-full mr-1">
              @else
                  <i class="bi bi-person-circle text-xl mr-1"></i>
              @endif
              {{ Auth::user()->name }}
          </button>

          <div x-show="open"
              @click.outside="open = false"
              x-transition
              class="absolute right-0 mt-2 bg-white text-black rounded shadow-md z-50 w-40"
          >
              <a href="{{ route('profile') }}"
                class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                <i class="bi bi-person-fill mr-2"></i> Profil
              </a>

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
    @foreach ($nav_categories as $category)
      <a href="{{ route('category.show', $category->slug) }}" 
        class="flex items-center gap-2 border border-gray-300 rounded-full px-4 py-2 text-sm hover:bg-blue-100 transition">

        <img src="{{ asset('storage/' . $category->icon) }}" 
              alt="" 
              class="w-5 h-5 object-contain" />

        <span>{{ $category->name }}</span>
      </a>
    @endforeach
  </div>

<script src="https://unpkg.com/alpinejs" defer></script>

</header>
