<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Authentication')</title>

  <!-- Import CSS dan JS menggunakan Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Slot tambahan untuk custom style di halaman -->
  @yield('styles')

  <!-- Import JavaScript lokal dan Iconify untuk ikon -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>

<body>
<main class="h-auto w-full flex items-center justify-end"
      style="
        background-image: 
          linear-gradient(to bottom, rgba(44,121,255,0.2) 0%, rgba(44,121,255,0.35) 60%, rgba(44,121,255,0.5) 100%),
          url('{{ asset('images/Background.png') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      ">

  <!-- Tombol Kembali ke Landing Page -->
  <a href="/" class="flex items-center gap-1 border py-2 px-4 text-center z-50 font-bold rounded-full text-lg bg-white absolute top-5 left-5 text-blue-500 shadow-md hover:bg-blue-50 transition-all duration-300">
    <iconify-icon icon="mdi:arrow-left" width="36" height="24"></iconify-icon>
    <span>Kembali</span>
  </a>

  <!-- Area sebelah kanan untuk pilihan Login/Daftar -->
  <div class="w-full h-screen relative flex items-center justify-end">

  <div class="flex flex-col relative items-center gap-6">
    
  <!-- Tombol Masuk -->
  <a href="/login" class="w-56">
    @if (Request::is('login'))
    <button class="w-full py-4 text-2xl font-bold bg-white text-blue-500 rounded-l-full rounded-r-3xl transition-all duration-300">
        Masuk
      </button>
    @else
      <span class="block text-2xl font-bold text-white text-center">Masuk</span>
    @endif
  </a>

  <!-- Tombol Daftar -->
  <a href="/register" class="w-56">
    @if (Request::is('register'))
    <button class="w-full py-4 text-2xl font-bold bg-white text-blue-500 rounded-l-full rounded-r-3xl transition-all duration-300">
        Daftar
      </button>
    @else
      <span class="block text-2xl font-bold text-white text-center">Daftar</span>
    @endif
  </a>
</div>

    <!-- Copyright Center -->
    <p class="absolute font-medium text-2xl md:text-[22px] bottom-10 left-1/2 transform -translate-x-1/2 text-white">
      Copyright ©{{ date('Y') }} WargaNet
    </p>
  </div>

  <!-- Area Form Login / Register -->
  <div class="bg-white h-screen items-center justify-center flex flex-col w-full">

    <div class="w-96 h-fit">
      <!-- Slot untuk konten Login/Register -->
      @yield('content')
    </div>

  </div>

</main>
</body>
</html>
