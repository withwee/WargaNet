<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</head>
<body>
    <main class="h-screen w-full flex  items-center justify-end"
    style="background-image: linear-gradient(rgba(44, 121, 255, 0.35), rgba(44, 121, 255, 0.35)), url('images/Background.png'); background-size: cover; background-repeat: no-repeat; background-position: center;">
    <div class="w-full h-screen  relative flex items-center justify-end">
    <div class="flex flex-col relative items-center gap-4">
    <a href="/admin">
            <button class="border w-40 py-3 font-bold bg-white text-blue-500 rounded-bl-3xl rounded-tl-3xl transition">
                Masuk
            </button>
    </a>
</div>

        <p class="absolute bottom-10 right-56 text-white">Copyright ©{{ date('Y') }} WargaNet</p>
    </div>

    <div class="bg-white h-screen items-center justify-center flex flex-col w-full">

    <div class="w-96">
        <div class="flex flex-col justify-center items-center gap-2">

            <h1 class="text-[#2C79FF] font-extrabold text-xl">Admin</h1>
            <div class="flex items-center justify-center gap-0.5 text-5xl text-[#2C79FF]">
            <h1 class="font-extrabold">Warga</h1>
            <h1>Net</h1>
        </div>
        </div>

    <div class="flex flex-col w-full mt-4">
    <form action="{{ route('admin') }}" method="POST" class="space-y-4 w-full ">
        @csrf
    
        <div class="relative">
    <input type="text" name="name" placeholder="Username" value="{{ old('name') }}" required class="border p-2 pl-10 bg-gray-200 w-full">
    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
        <img src="icon/ktp.svg" alt="icon">
    </div>
</div>  
@error('name')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror

<div class="relative">
    <input type="password" name="password" id="password" placeholder="Password" required class="border p-2 pl-10 pr-10 bg-gray-200 w-full">
    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
        <img src="icon/lock.svg" alt="icon">
    </div>
    <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 focus:outline-none">
        <iconify-icon id="eyeIcon" icon="mdi:eye-outline" width="20" height="20" class="text-black"></iconify-icon>
    </button>
</div>
@error('password')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror

@if ($errors->has('error'))
    <p class="text-red-500 text-sm mt-2">{{ $errors->first('error') }}</p>
@endif
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 w-full">Login</button>
    </form>

</div>
</div>

</div>
</main>
<script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.setAttribute('icon', 'mdi:eye-off-outline');
            } else {
                passwordField.type = 'password';
                eyeIcon.setAttribute('icon', 'mdi:eye-outline');
            }
        }
    </script>
</body>
</html>