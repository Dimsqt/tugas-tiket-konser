<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concert Tickets CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen text-gray-800">
    <nav class="bg-indigo-600 shadow mb-8">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('concerts.index') }}" class="text-white font-bold text-xl">Concert CRUD</a>
        </div>
    </nav>
    <div class="container mx-auto px-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
