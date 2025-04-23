@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="flex flex-col w-full mt-8 space-y-6">
    <form action="{{ route('login') }}" method="POST" class="space-y-4 w-full" onsubmit="return validateForm();">
        @csrf
    
        <!-- Input NIK -->
        <div class="relative">
            <input 
                type="text" 
                name="nik" 
                id="nik"
                placeholder="Masukkan NIK Anda" 
                value="{{ old('nik') }}" 
                class="border border-gray-300 p-3 pl-12 rounded-lg bg-gray-100 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
                required 
                oninvalid="this.setCustomValidity('Harap Isi Kolom NIK Terlebih Dahulu')" 
                oninput="this.setCustomValidity('')" 
            >
            <div class="absolute left-4 top-1/2 -translate-y-1/2">
                <img src="{{ asset('icon/ktp.svg') }}" alt="icon" class="w-5 h-5 text-gray-400">
            </div>
        </div>  
        @error('nik')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <!-- Input Password -->
        <div class="relative">
            <input 
                type="password" 
                name="password" 
                id="password" 
                placeholder="Masukkan Kata Sandi" 
                class="border border-gray-300 p-3 pl-12 pr-12 rounded-lg bg-gray-100 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                oninvalid="this.setCustomValidity('Harap Isi Kolom Terlebih Dahulu')" 
                oninput="this.setCustomValidity('')" 
                required
            >
            <div class="absolute left-4 top-1/2 -translate-y-1/2">
                <img src="{{ asset('icon/lock.svg') }}" alt="icon" class="w-5 h-5 text-gray-400">
            </div>
            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 focus:outline-none">
                <iconify-icon id="eyeIcon" icon="mdi:eye-outline" width="20" height="20" class="text-black"></iconify-icon>
            </button>
        </div>
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        @if ($errors->has('error'))
            <p class="text-red-500 text-sm mt-2">{{ $errors->first('error') }}</p>
        @endif

        <!-- Tombol Login -->
        <button 
            type="submit" 
            class="bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold px-4 py-3 rounded-lg w-full">
            Masuk
        </button>
    </form>

    <!-- Link ke halaman daftar -->
    <div class="text-center">
        <p class="mt-4 text-sm text-gray-700">Belum punya akun?</p>
        <a href="{{ route('register.view') }}" class="text-blue-500 font-bold hover:underline">Daftar di sini</a>
    </div>
</div>

<!-- JS: Toggle Password + Validasi Form Kosong -->
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

    function validateForm() {
    console.log('Fungsi validateForm dijalankan');
    const nik = document.getElementById('nik').value.trim();
    const password = document.getElementById('password').value.trim();

    if (!nik && !password) {
        alert("Harap isi NIK dan Kata Sandi Anda terlebih dahulu.");
        return false;
    } else if (!nik) {
        alert("Harap isi NIK Anda.");
        return false;
    } else if (!password) {
        alert("Harap isi Kata Sandi Anda.");
        return false;
    }
    return true;
}

</script>

@endsection
