@extends('layouts.app')

@section("content")
<div class="container mx-auto p-4">

    <!-- Card -->
    <div class="bg-white rounded-2xl p-6 shadow-md">

        <!-- Grid layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2"> <!-- Gap diperkecil -->

            <!-- Left Profile -->
            <div class="relative flex flex-col items-center">

                <!-- Tombol Kembali -->
                <a href="{{ route('profile.show') }}" class="absolute top-0 left-0 text-sm text-gray-500 flex items-center mt-2 ml-2">
                    <span class="text-xl mr-1">&lt;</span> Kembali
                </a>

                <div class="flex flex-col items-center mt-12">
                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/profile.png') }}" 
                    alt="Profile" 
                    class="w-48 h-48 rounded-full object-cover mb-4 mt-12">
                    <h2 class="text-lg font-bold text-center">{{ $user->name }}</h2>
                </div>

            </div>

            <!-- Right Details (span 2 columns) -->
            <div class="md:col-span-2 flex flex-col justify-between">

                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-bold">Nama Lengkap</h3>
                        <p class="text-gray-500">{{ $user->name }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">Email</h3>
                        <p class="text-gray-500">{{ $user->email }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">Nomor Induk Kependudukan (NIK)</h3>
                        <p class="text-gray-500">{{ $user->nik }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">Nomor Kartu Keluarga</h3>
                        <p class="text-gray-500">{{ $user->no_kk }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">Nomor Handphone</h3>
                        <p class="text-gray-500">{{ $user->phone }}</p>
                    </div>

                    <hr class="my-4">

                    <div>
                        <h3 class="text-sm font-bold">Jumlah Anggota Keluarga</h3>
                        <div class="grid grid-cols-2 gap-4 mt-2 items-center">
                            <div class="flex flex-col">
                                <h4 class="text-sm font-bold">Laki-laki</h4>
                                <p class="text-gray-500">{{ $user->jumlah_LK ?? '-' }}</p>

                                <!-- Tombol Edit Profile -->
                                <a href="{{ route('profile.edit') }}" class="mt-4 border border-blue-400 text-blue-400 rounded-lg px-6 py-2 hover:bg-blue-50 transition w-max">
                                    Edit Profile
                                </a>
                            </div>

                            <div>
                                <h4 class="text-sm font-bold">Perempuan</h4>
                                <p class="text-gray-500">{{ $user->jumlah_PR ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection
