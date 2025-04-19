@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- FORM TAMBAH PENGUMUMAN --}}
    <h1 class="text-2xl font-bold">Buat Pengumuman</h1>
    <form method="POST" action="{{ route('pengumuman.store') }}" class="bg-white p-6 rounded-xl space-y-4 shadow">
        @csrf
        <div>
            <label class="font-semibold">Ketik judul pengumuman yang mau dibuat disini</label>
            <input type="text" name="judulPengumuman" placeholder="Masukkan judul"
                class="w-full p-2 rounded-xl border border-gray-300" required>
        </div>

        <div>
            <label class="font-semibold">Ketik isi pengumuman yang mau dibuat disini</label>
            <textarea name="isiPengumuman" placeholder="Masukkan isi pengumuman"
                class="w-full p-2 rounded-xl border border-gray-300" required></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-xl hover:bg-blue-600 transition">
            Publikasikan
        </button>
    </form>

    {{-- DAFTAR PENGUMUMAN --}}
    <h2 class="text-2xl font-bold">Daftar Pengumuman</h2>
    <div class="space-y-4">
        @foreach ($pengumumans as $pengumuman)
            <div class="bg-white p-4 rounded-xl shadow space-y-3">

                {{-- View Mode --}}
                <div id="view-mode-{{ $pengumuman->id }}" class="space-y-3">
                    <h3 class="font-bold text-2xl">{{ $pengumuman->judulPengumuman }}</h3>
                    <p>{{ $pengumuman->isiPengumuman }}</p>
                </div>

                {{-- Edit Mode (hidden by default) --}}
                <form method="POST" action="{{ route('pengumuman.update', $pengumuman->id) }}"
                      id="edit-form-{{ $pengumuman->id }}" class="space-y-2 hidden">
                    @csrf
                    @method('PUT')

                    <input type="text" name="judulPengumuman" value="{{ $pengumuman->judulPengumuman }}"
                        class="w-full font-bold text-lg p-2 border rounded-xl" required>
                    <textarea name="isiPengumuman" class="w-full p-2 border rounded-xl" required>{{ $pengumuman->isiPengumuman }}</textarea>

                    {{-- Tombol Simpan & Hapus --}}
                    <div class="flex items-center justify-between">
                        {{-- Tanggal --}}
                        <div class="bg-blue-500 p-2 rounded-3xl text-white text-sm font-bold">
                            {{ $pengumuman->created_at->format('d M Y, H:i') }}
                        </div>

                        <div class="flex items-center gap-3">
                            {{-- Tombol Simpan --}}
                            <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded-xl hover:bg-yellow-600 transition">
                                Simpan
                            </button>

                            {{-- Tombol Batal --}}
                            <button type="button" data-id="{{ $pengumuman->id }}"
                                class="text-gray-500 hover:text-gray-600 transition">
                                Batal
                            </button>
                        </div>
                    </div>
                </form>

                {{-- Flex: Tanggal + Aksi --}}
                <div id="action-row-{{ $pengumuman->id }}" class="flex items-center justify-between">
                    {{-- Tanggal --}}
                    <div class="bg-blue-500 px-4 py-1 rounded-3xl text-white text-sm font-semibold">
                        {{ $pengumuman->created_at->format('d M Y, H:i') }}
                    </div>

                    {{-- Aksi --}}
                    <div class="flex items-center gap-3 mt-2">
                        {{-- Edit --}}
                        <button data-id="{{ $pengumuman->id }}"
                            class="text-yellow-500 hover:text-yellow-600 transition">
                            <iconify-icon icon="mdi:pencil" width="24" height="24"></iconify-icon>
                        </button>

                        {{-- Delete --}}
                        <form method="POST" action="{{ route('pengumuman.destroy', $pengumuman->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                class="text-red-500 hover:text-red-600 transition">
                                <iconify-icon icon="mdi:delete" width="24" height="24"></iconify-icon>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</div>

{{-- Script toggle --}}
<script>
    function toggleEdit(id) {
        const view = document.getElementById('view-mode-' + id);
        const form = document.getElementById('edit-form-' + id);
        const actionRow = document.getElementById('action-row-' + id);

        view.classList.toggle('hidden');
        form.classList.toggle('hidden');
        actionRow.classList.toggle('hidden');
    }
</script>
@endsection
