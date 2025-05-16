<nav class="bg-white shadow mb-6">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">Portal Berita</a>

        <div class="flex items-center space-x-6">

            <form action="{{ route('search') }}" method="GET" class="flex items-center space-x-2">
                <input type="text" name="q" placeholder="Cari berita..."
                    class="px-3 py-1 border rounded text-sm focus:outline-none focus:ring" />
                <button type="submit" class="text-sm text-indigo-600 hover:underline">Cari</button>
            </form>

            <!-- Dropdown Kategori dengan Alpine.js -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="text-gray-700 hover:text-indigo-600 font-medium">
                    Kategori
                </button>
                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-cloak
                    class="absolute right-0 bg-white shadow rounded mt-2 w-48 z-10"
                >
                    @foreach($nav_categories as $cat)
                        <a href="{{ route('kategori.show', $cat->slug) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ $cat->name }}
                            @if($cat->is_premium)
                                <span class="text-yellow-500 ml-1 font-semibold">★</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Login / Admin -->
            @auth
                <a href="{{ route('admin.articles.index') }}" class="text-gray-700 hover:text-indigo-600">Admin</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600">Register</a>
            @endauth
        </div>
    </div>
</nav>
