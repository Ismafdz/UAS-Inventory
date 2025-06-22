{{--
    File: resources/views/livewire/kategori/index.blade.php
    Versi: Final (Refactored)
    Deskripsi: Tampilan utama untuk manajemen kategori. Modal dipisahkan ke file 'create'.
--}}
<div> <!-- 1. Pembungkus utama untuk Livewire -->

    <x-app-layout> <!-- 2. Menggunakan layout yang benar -->
        <x-slot name="title">
            Manajemen Kategori
        </x-slot>

        <!-- Notifikasi -->
        @if (session()->has('success'))
            <div class="mb-4 rounded-md bg-tealAccent/90 p-4 text-white shadow-lg">{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
            <div class="mb-4 rounded-md bg-softPink/90 p-4 text-white shadow-lg">{{ session('error') }}</div>
        @endif

        <!-- Tombol Tambah -->
        <div class="mb-6">
            <button wire:click="create" class="transform rounded-md bg-softPink px-6 py-2 font-semibold text-white shadow transition hover:scale-105 hover:bg-tealAccent focus:outline-none focus:ring-2 focus:ring-tealAccent focus:ring-opacity-50">
                + Tambah Kategori
            </button>
        </div>

        <!-- 3. Panggil Modal Create (lebih bersih) -->
        @if($isOpen)
            @include('livewire.kategori.create')
        @endif

        <!-- Tabel Kategori -->
        <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white p-6 shadow-md">
            <table class="w-full table-auto text-textGray">
                <thead>
                    <tr class="bg-softBg text-left">
                        <th class="px-4 py-3 font-medium">No.</th>
                        <th class="px-4 py-3 font-medium">Nama Kategori</th>
                        <th class="px-4 py-3 text-center font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $index => $kategori)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-3 text-center">{{ $kategoris->firstItem() + $index }}</td>
                            <td class="px-4 py-3 font-semibold text-gray-700">{{ $kategori->nama_kategori }}</td>
                            <td class="space-x-2 px-4 py-3 text-center">
                                <button wire:click="edit({{ $kategori->id }})" class="rounded bg-yellow-400 px-3 py-1 text-sm text-white shadow transition hover:bg-yellow-500">Edit</button>
                                <!-- 4. Menggunakan wire:confirm yang lebih modern -->
                                <button wire:click="delete({{ $kategori->id }})" wire:confirm="Apakah Anda yakin ingin menghapus kategori ini?" class="rounded bg-red-500 px-3 py-1 text-sm text-white shadow transition hover:bg-red-600">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-5 text-center text-gray-400">Tidak ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-6">{{ $kategoris->links() }}</div>
        </div>
</x-app-layout>

</div>
