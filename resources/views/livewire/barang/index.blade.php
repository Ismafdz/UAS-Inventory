<div> <!-- <--- PEMBUNGKUS UTAMA UNTUK LIVEWIRE -->

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-[#13988A] leading-tight">
                Manajemen Barang
            </h2>
        </x-slot>

        <!-- Notifikasi -->
        @if (session()->has('success'))
            <div class="mb-4 rounded-md bg-tealAccent/90 p-4 text-white shadow-lg">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-4 rounded-md bg-softPink/90 p-4 text-white shadow-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tombol Tambah -->
        <div class="mb-6">
            <button wire:click="create"
                class="transform rounded-md bg-softPink px-6 py-2 font-semibold text-white shadow transition hover:scale-105 hover:bg-tealAccent focus:outline-none focus:ring-2 focus:ring-tealAccent focus:ring-opacity-50">
                + Tambah Barang
            </button>
        </div>

        <!-- Modal Tambah -->
        @if($isOpen)
            @include('livewire.barang.create')
        @endif

        <!-- Tabel Data -->
        <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white p-6 shadow-md">
            <table class="w-full table-auto text-textGray">
                <thead>
                    <tr class="bg-softBg text-left">
                        <th class="px-4 py-3 font-medium">No.</th>
                        <th class="px-4 py-3 font-medium">Kode</th>
                        <th class="px-4 py-3 font-medium">Nama Barang</th>
                        <th class="px-4 py-3 font-medium">Kategori</th>
                        <th class="px-4 py-3 font-medium">Lokasi</th>
                        <th class="px-4 py-3 text-center font-medium">Jumlah</th>
                        <th class="px-4 py-3 text-center font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $index => $barang)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-3 text-center">{{ $barangs->firstItem() + $index }}</td>
                            <td class="px-4 py-3">{{ $barang->kode_barang }}</td>
                            <td class="px-4 py-3 font-semibold text-gray-700">{{ $barang->nama }}</td>
                            <td class="px-4 py-3">{{ $barang->kategori->nama_kategori ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $barang->lokasi->nama_lokasi ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-center">{{ $barang->jumlah }}</td>
                            <td class="space-x-2 px-4 py-3 text-center">
                                <button wire:click="edit({{ $barang->id }})"
                                    class="rounded bg-yellow-400 px-3 py-1 text-sm text-white shadow transition hover:bg-yellow-500">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $barang->id }})"
                                    wire:confirm="Apakah Anda yakin ingin menghapus barang ini?"
                                    class="rounded bg-red-500 px-3 py-1 text-sm text-white shadow transition hover:bg-red-600">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-5 text-center text-gray-400">
                                Tidak ada data barang yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $barangs->links() }}
            </div>
        </div>
    </x-app-layout>

</div> <!-- <--- AKHIR PEMBUNGKUS UTAMA -->
