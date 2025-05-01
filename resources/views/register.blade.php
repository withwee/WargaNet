<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar | WargaNet</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="min-h-screen flex flex-col md:flex-row">
<!-- Kiri: Background Gambar -->
<div class="hidden md:flex md:w-1/2 relative overflow-hidden rounded-r-3xl">

    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ asset('images/Background.png') }}');">
    </div>

    <!-- Konten utama -->
    <div class="z-30 flex flex-col justify-center items-end w-full h-full pr-6 gap-4 relative">

        <!-- Link Masuk -->
        <a href="/login">
            @if (Request::is('login'))
                <span class="text-black text-xl font-bold">Masuk</span>
            @else
                <span class="text-black text-xl font-normal">Masuk</span>
            @endif
        </a>

        <!-- Tombol Daftar bergaya seperti gambar -->
        <a href="/register">
            @if (Request::is('register'))
                <button class="bg-white text-blue-600 text-xl font-bold px-8 py-3 rounded-l-full shadow-md">
                    Daftar
                </button>
            @else
                <span class="bg-white text-blue-600 text-xl font-bold px-8 py-3 rounded-l-full shadow-md inline-block">
                    Daftar
                </span>
            @endif
        </a>
    </div>

    <!-- Copyright -->
    <p class="z-30 text-xs text-white absolute bottom-4 left-4 drop-shadow-sm">Copyright © 2025 WargaNet</p>
</div>



<!-- Kanan: Form -->
<div class="w-full md:w-1/2 bg-white flex flex-col justify-center items-center px-4 md:px-16 py-8">
    <!-- Logo -->
    <div class="w-full max-w-md text-center mb-6">
        <h1 class="text-3xl md:text-4xl mb-2 drop-shadow-lg">
            <span class="font-extrabold" style="color: #2C79FF;">Warga</span><span class="font-normal" style="color: #2C79FF;">Net</span>
        </h1>
        <p class="text-gray-600 mt-2">Buat akun baru untuk mengakses semua fitur</p>
    </div>


        <!-- Notifikasi -->
        @if(session('success'))
            <div class="w-full max-w-md bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Register -->
        <form action="{{ route('register.submit') }}" method="POST" class="w-full max-w-md space-y-4">
            @csrf

            <!-- Error Messages -->
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Nama Lengkap -->
            <div class="space-y-1">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Nama Lengkap" required autofocus>
                </div>
            </div>

            <!-- Email -->
            <div class="space-y-1">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Email" required>
                </div>
            </div>
            <!-- Nomor Induk Kependudukan (NIK) -->
<div class="space-y-1">
    <label for="nik" class="block text-sm font-medium text-gray-700">Nomor Induk Kependudukan</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-id-card text-gray-400"></i>
        </div>
        <input type="text" id="nik" name="nik" value="{{ old('nik') }}"
               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
               placeholder="Nomor Induk Kependudukan" required>
    </div>
</div>

<!-- Nomor Kartu Keluarga -->
<div class="space-y-1">
    <label for="no_kk" class="block text-sm font-medium text-gray-700">Nomor Kartu Keluarga</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-users text-gray-400"></i>
        </div>
        <input type="text" id="no_kk" name="no_kk" value="{{ old('no_kk') }}"
               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
               placeholder="Nomor Kartu Keluarga" required>
    </div>
</div>

           <!-- Jumlah Anggota Keluarga -->
<div class="space-y-1">
    <label class="block text-sm font-medium text-gray-700">Jumlah Anggota Keluarga <span class="text-gray-500">(Termasuk Diri Sendiri)</span></label>
    <div class="flex space-x-4">
        <!-- Laki-Laki -->
        <div class="w-1/2 relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-mars text-gray-400"></i>
            </div>
            <input type="number" id="jumlah_LK" name="jumlah_LK" min="0" value="{{ old('jumlah_LK', 0) }}"
                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Jumlah Laki-laki" required>
        </div>

        <!-- Perempuan -->
        <div class="w-1/2 relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-venus text-gray-400"></i>
            </div>
            <input type="number" id="jumlah_PR" name="jumlah_PR" min="0" value="{{ old('jumlah_PR', 0) }}"
                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Jumlah Perempuan" required>
        </div>
    </div>
</div>

<!-- Nomor Telepon -->
<div class="space-y-1">
    <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-phone text-gray-400"></i>
        </div>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
               placeholder="Contoh: 081234567890" required>
    </div>
</div>

            <!-- Password -->
            <div class="space-y-1">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="password" name="password"
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Password" required>
                </div>
            </div>

            <!-- Konfirmasi Password -->
            <div class="space-y-1">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Konfirmasi Password" required>
                </div>
            </div>

            <!-- Tombol Daftar -->
            <div class="pt-2">
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Daftar
                </button>
            </div>

            <!-- Link Login -->
            <div class="text-center text-sm pt-2">
                <span class="text-gray-600">Sudah punya akun?</span>
                <a href="{{ route('login.view') }}" class="font-medium text-blue-600 hover:text-blue-500 ml-1">
                    Masuk disini
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Script untuk handling error dan kalkulasi jumlah keluarga -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ===== Fokus otomatis ke field pertama yang error =====
        const errorFields = document.querySelectorAll('.is-invalid');
        if (errorFields.length > 0) {
            errorFields[0].focus();
        }

        // ===== Tambahkan kelas error pada input yang error =====
        @if($errors->any())
            @foreach($errors->keys() as $key)
                const {{ $key }}Field = document.getElementById('{{ $key }}');
                if ({{ $key }}Field) {
                    {{ $key }}Field.classList.add('border-red-300', 'text-red-900', 'placeholder-red-300');
                    {{ $key }}Field.classList.remove('border-gray-300');
                }
            @endforeach
        @endif
    });
</script>
</body>
</html>
