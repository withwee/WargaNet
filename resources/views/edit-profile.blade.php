@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit Profile</h1>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl p-8 shadow-md">
        @csrf
        @method('PUT')

        <!-- Photo Upload -->
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="photo">Foto Profile</label>
            <input type="file" name="photo" id="photo" class="border rounded p-2 w-full">
            @if($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" alt="Current Photo" class="w-20 h-20 rounded-full mt-4">
            @endif
        </div>

        <!-- Name -->
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="border rounded p-2 w-full" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="border rounded p-2 w-full" required>
        </div>

        <!-- NIK -->
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="nik">Nomor Induk Kependudukan (NIK)</label>
            <input type="text" name="nik" id="nik" value="{{ old('nik', $user->nik) }}" class="border rounded p-2 w-full" required>
        </div>

        <!-- No KK -->
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="no_kk">Nomor Kartu Keluarga</label>
            <input type="text" name="no_kk" id="no_kk" value="{{ old('no_kk', $user->no_kk) }}" class="border rounded p-2 w-full" required>
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2" for="phone">Nomor Handphone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="border rounded p-2 w-full" required>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white rounded-lg px-6 py-2 hover:bg-blue-600 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
