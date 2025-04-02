<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Warganet')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
<body >
    <main class="w-full p-6 bg-sky-100 min-h-screen">
        <div class="flex justify-between items-center mb-6">
            <div class="flex gap-2">
                <h1 class="font-bold text-3xl"> {{ ucfirst(str_replace('-', ' ', Route::currentRouteName())) }}</h1>
                <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 cursor-pointer rounded">Logout</button>
        </form>
            </div>
            <div class="flex items-center gap-4">
                <h1>{{ $user->name ?? 'Guest' }}</h1>
                <img src="{{ asset('images/profile.png') }}" alt="profile" class="w-10 h-10 rounded-full">
            </div>
        </div>

        @yield('content')
    </main>
</body>
</html>
