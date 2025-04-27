@extends('layouts.app')

@section("content")
   <div class="container mx-auto">

        <!-- Card -->
        <div class="bg-white rounded-2xl p-8 shadow-md">
            <div class="flex items-start gap-8">
                <!-- Left Profile -->
                <div class="flex flex-col items-center">
                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://i.ibb.co/f4TmxW5/sasuke.png' }}" alt="Profile" class="w-32 h-32 rounded-full object-cover mb-4">
                    <h2 class="text-lg font-bold text-center">{{ $user->name }}</h2>
                </div>

                <!-- Right Details -->
                <div class="flex-1">
                    <a href="{{ route('profile.show') }}" class="text-sm text-gray-500 mb-4 inline-block">&lt; Kembali</a>
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
                            <div class="flex gap-16 mt-2">
                                <div>
                                    <h4 class="text-sm font-bold">Laki-laki</h4>
                                    <p class="text-gray-500">{{ $user->jumlah_laki ?? '-' }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold">Perempuan</h4>
                                    <p class="text-gray-500">{{ $user->jumlah_perempuan ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 text-center">
                        <a href="{{ route('profile.edit') }}" class="border border-blue-400 text-blue-400 rounded-lg px-6 py-2 hover:bg-blue-50 transition">
                         Edit Profile
                            </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
