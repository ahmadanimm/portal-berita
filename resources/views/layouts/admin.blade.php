<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-white text-gray-900 font-sans">
    <div class="flex min-h-screen">

        <aside class="w-64 bg-blue-900 text-white p-6 flex flex-col justify-between">
            <div>
                <div class="mb-6 ml-4">
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('assets/images/logoadmin1.png') }}" alt="Admin Logo" class="w-40 hover:opacity-80 transition">
                    </a>
                </div>

                <div class="mb-6 border-b border-gray-200"></div>

                <nav class="space-y-2 text-sm">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-3 py-2 rounded hover:bg-blue-800 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-800 font-semibold' : '' }}">
                        <i class="fas fa-house mr-2 text-blue-300"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.articles.index') }}"
                       class="flex items-center px-3 py-2 rounded hover:bg-blue-800 transition {{ request()->routeIs('admin.articles.*') ? 'bg-blue-800 font-semibold' : '' }}">
                        <i class="fas fa-newspaper mr-2 text-blue-300"></i> Manajemen Berita
                    </a>
                    <a href="{{ route('admin.authors.index') }}"
                       class="flex items-center px-3 py-2 rounded hover:bg-blue-800 transition {{ request()->routeIs('admin.authors.*') ? 'bg-blue-800 font-semibold' : '' }}">
                        <i class="fas fa-user-pen mr-2 text-blue-300"></i> Manajemen Penulis
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center px-3 py-2 rounded hover:bg-blue-800 transition {{ request()->routeIs('admin.categories.*') ? 'bg-blue-800 font-semibold' : '' }}">
                        <i class="fas fa-layer-group mr-2 text-blue-300"></i> Manajemen Kategori
                    </a>
                </nav>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded border border-blue-300 text-blue-100 hover:bg-blue-700 hover:text-white text-sm transition">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </aside>

        <main class="flex-1 p-6 bg-gray-50 text-gray-900 mt-4">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold">
                    {!! trim($__env->yieldContent('page-title', 'Manajemen Berita')) !!}
                </h1>
                @hasSection('page-action')
                    <div>
                        @yield('page-action')
                    </div>
                @endif
            </div>

            @yield('content')
        </main>

    </div>
    
    @stack('scripts')

</body>
</html>
