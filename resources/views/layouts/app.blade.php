<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Warganet')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    
    @stack('styles')
</head>
<body class="ml-64">
    <x-sidebar/>
    <main class="w-full p-6 bg-sky-100 min-h-screen">
        <div class="flex justify-between items-center mb-6">
            <div class="flex gap-2">
                <h1 class="font-bold text-3xl"> {{ ucfirst(str_replace('-', ' ', Route::currentRouteName())) }}</h1>
               
            </div>
            <div class="flex items-center gap-4">
                <h1>{{ $user->name ?? 'Guest' }}</h1>
                <img src="{{ asset('images/profile.png') }}" alt="profile" class="w-10 h-10 rounded-full">
            </div>
        </div>

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
