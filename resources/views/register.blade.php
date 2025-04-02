@extends('layouts.auth')

@section('title', 'Register')

@section('content')

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
</script>
@endsection
