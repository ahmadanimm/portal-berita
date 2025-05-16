<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Portal Berita' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    @include('partials.navbar')
    <main class="max-w-7xl mx-auto mt-4">
        @yield('content')
    </main>
</body>
</html>
