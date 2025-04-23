<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
<body>
<main class="h-screen w-full flex items-center justify-end"
      style="background-image: linear-gradient(rgba(44, 121, 255, 0.35), rgba(44, 121, 255, 0.35)), url('{{ asset('images/Background.png') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;">

    <div class="w-full h-screen relative flex items-center justify-end">
        <!-- Tombol hanya "Masuk" -->
        <div class="flex flex-col relative items-center gap-4">
            <a href="{{ route('admin') }}">
                @if (Request::is('admin'))
                    <button class="border w-40 py-3 font-bold bg-white text-blue-500 rounded-bl-3xl rounded-tl-3xl transition">
                        Masuk
                    </button>
                @else
                    <span class="font-bold text-black">Masuk</span>
                @endif
            </a>
        </div>

        <p class="absolute bottom-10 right-75 text-white">Copyright ©{{ date('Y') }} WargaNet</p>
    </div>

    <div class="bg-white h-screen items-center justify-center flex flex-col w-full">
        <div class="w-96">
            <div class="flex items-center justify-center gap-0.5 text-5xl text-[#2C79FF]">
                <h1 class="font-extrabold">Warga</h1>
                <h1>Net</h1>
            </div>

            @yield('content')
        </div>
    </div>
</main>
</body>
</html>
