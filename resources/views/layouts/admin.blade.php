<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 p-6 flex flex-col justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white mb-6">
                    {{ Auth::user()->name }} <span class="text-sm text-gray-400">(Admin)</span>
                </h1>


                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                        🏠 Dashboard
                    </a>
                    <a href="{{ route('admin.articles.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.articles.*') ? 'bg-gray-700' : '' }}">
                        📰 Article News
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700' : '' }}">
                        🗂️ Categories
                    </a>
                </nav>
            </div>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded bg-red-600 hover:bg-red-700 text-white text-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-900">
            @yield('content')
        </main>
    </div>
</body>
</html>
