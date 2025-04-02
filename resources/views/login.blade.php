@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="flex flex-col w-full mt-4">
    <form action="{{ route('login') }}" method="POST" class="space-y-4 w-full ">
        @csrf
    
        <div class="relative">
    <input type="text" name="nik" placeholder="NIK" value="{{ old('nik') }}" required class="border p-2 pl-10 bg-gray-200 w-full">
    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
        <img src="icon/ktp.svg" alt="icon">
    </div>
</div>  
@error('nik')
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


    <div class="text-center">
        <p class="mt-4">Belum punya akun?</p>
        <a href="{{ route('register.view') }}" class="text-blue-500 font-bold">Daftar di sini</a>
    </div>
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
</script>
@endsection
