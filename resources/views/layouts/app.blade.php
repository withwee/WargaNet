<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Warganet')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    
    @stack('styles')
<body class="bg-sky-100 font-[Poppins]">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Main content --}}
        <main class="flex-1 p-6 ml-64">
        {{-- Header --}}
            <header class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold capitalize text-gray-800">
                    @php
                        $routeName = Route::currentRouteName();
                        $routeTitles = [
                            'iuran.cari' => 'Bayar Iuran',
                            'iuran.store' => '',
                            'iuran.bayar' => 'Bayar Iuran',
                            'pay.index' => 'Bayar Iuran',
                            'pay.bayar' => 'Bayar Iuran',
                            // Add other route mappings as needed
                        ];
                        $title = $routeTitles[$routeName] ?? ucfirst(str_replace(['-', '.'], ' ', $routeName));
                    @endphp
                    {{ $title }}
                </h1>

                <div class="flex items-center gap-3">
                    <a href="{{ route('profile.show') }}" class="flex items-center gap-2">
                        <span class="font-semibold text-gray-800">{{ $user->name ?? 'Guest' }}</span>
                        <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('images/profile.png') }}" 
                        alt="Profile Photo" 
                        class="w-10 h-10 rounded-full border-2 border-white shadow-md object-cover">

                    </a>
                </div>
            </header>

            {{-- Page content --}}
            <section>
                @yield('content')
            </section>
        </main>
    </div>
    @stack('scripts')
</body>
</html>
