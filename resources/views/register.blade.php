@extends('layouts.auth')

@section('title', 'Register')

@section('content')


<form action="{{ route('register.submit') }}" method="POST" class="space-y-4 mt-2">
    @csrf

    <div class="relative">
        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
            <img src="icon/user.svg" alt="icon" class="w-6">
        </div>
        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required class="border p-2 pl-10 bg-gray-200 w-full">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="relative">
        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
            <img src="icon/email.svg" alt="icon" class="w-6">
        </div>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="border p-2 pl-10 bg-gray-200 w-full">
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="relative">
        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
            <img src="icon/ktp.svg" alt="icon" class="w-6">
        </div>
        <input type="text" name="nik" placeholder="Nomor Induk Kependudukan" value="{{ old('nik') }}" required class="border p-2 pl-10 bg-gray-200 w-full">
        @error('nik')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="relative">
        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
            <img src="icon/keluarga.svg" alt="icon" class="w-6">
        </div>
        <input type="text" name="no_kk" placeholder="Nomor Kartu Keluarga" value="{{ old('no_kk') }}" required class="border p-2 bg-gray-200 pl-10 w-full">
        @error('no_kk')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2">
        <p class="text-xs">Jumlah Anggota Keluarga ( Termasuk diri sendiri )</p>

        <div class="flex items-center gap-2">
            <div class="relative">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <img src="icon/keluargacwo.svg" alt="icon" class="w-6">
                </div>
                <input type="number" id="jumlah_LK" name="jumlah_LK" placeholder="Laki-Laki" value="{{ old('jumlah_LK') }}" required class="border p-2 pl-10 bg-gray-200 w-full">
                @error('jumlah_LK')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
            </div>
            <div class="relative">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <img src="icon/keluargacwe.svg" alt="icon" class="w-6">
                </div>
                <input type="number" id="jumlah_PR" name="jumlah_PR" placeholder="Perempuan" value="{{ old('jumlah_PR') }}" required class="border p-2 pl-10 bg-gray-200 w-full">
                @error('jumlah_PR')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
            </div>
        </div>
    </div>

    <div class="relative">
        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
            <img src="icon/phone.svg" alt="icon" class="w-6">
        </div>
        <input type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}" required class="border p-2 pl-10 bg-gray-200 w-full">
        @error('phone')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="relative">
        <input type="password" name="password" id="password" placeholder="Password" required class="border p-2 pl-10 pr-10 bg-gray-200 w-full">
        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
            <img src="icon/lock.svg" alt="icon">
        </div>
        <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 focus:outline-none">
            <iconify-icon id="eyeIcon" icon="mdi:eye-outline" width="20" height="20" class="text-black"></iconify-icon>
        </button>
    </div>

    <div class="relative">
    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required class="border p-2 pl-10 pr-10 bg-gray-200 w-full">
    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
        <img src="icon/lock.svg" alt="icon">
    </div>
    <button type="button" onclick="toggleConfirmPassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 focus:outline-none">
        <iconify-icon id="confirmEyeIcon" icon="mdi:eye-outline" width="20" height="20" class="text-black"></iconify-icon>
    </button>
    @error('password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


    <button type="submit" class="bg-blue-600 w-full text-white px-4 py-2">Register</button>
</form>

<div class="text-center">
    <p class="mt-4">Sudah punya akun?</p>
    <a href="{{ route('login.view') }}" class="text-blue-500 font-bold">Login di sini</a>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.setAttribute('icon', 'mdi:eye-off-outline');
        } else {
            passwordInput.type = 'password';
            eyeIcon.setAttribute('icon', 'mdi:eye-outline');
        }
    }

    function toggleConfirmPassword() {
        const confirmInput = document.getElementById('password_confirmation');
        const confirmIcon = document.getElementById('confirmEyeIcon');
        if (confirmInput.type === 'password') {
            confirmInput.type = 'text';
            confirmIcon.setAttribute('icon', 'mdi:eye-off-outline');
        } else {
            confirmInput.type = 'password';
            confirmIcon.setAttribute('icon', 'mdi:eye-outline');
        }
    }
</script>

@endsection