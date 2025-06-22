<div class="bg-[#F9F9F9] min-h-screen py-12">
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#757575] leading-tight">
            {{ __('Pencatatan Barang Rusak/Hapus') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Form Penghapusan -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-[#13988A] mb-4">Formulir Penghapusan</h3>

                @if (session()->has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form wire:submit.prevent="store">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Pilih Barang -->
                        <div>
                            <label class="block text-sm font-medium text-[#757575]">Pilih Barang</label>
                            <select wire:model="barang_id"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:ring-[#13988A] focus:border-[#13988A] sm:text-sm rounded-md">
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $item)
                                    <option value="{{ $item->id }}">{{ $item->kode_barang }} - {{ $item->nama }} (Stok: {{ $item->jumlah }})</option>
                                @endforeach
                            </select>
                            @error('barang_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Jumlah Hapus -->
                        <div>
                            <label class="block text-sm font-medium text-[#757575]">Jumlah Dihapus</label>
                            <input type="number" wire:model="jumlah_dihapus"
                                class="mt-1 focus:ring-[#13988A] focus:border-[#13988A] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                min="1">
                            @error('jumlah_dihapus') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Alasan -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-[#757575]">Alasan</label>
                        <textarea wire:model="alasan" rows="3"
                            class="mt-1 focus:ring-[#13988A] focus:border-[#13988A] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Contoh: Barang rusak karena terjatuh"></textarea>
                        @error('alasan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                            class="bg-[#F88E86] hover:bg-[#E63946] text-white font-bold py-2 px-4 rounded disabled:opacity-50 transition">
                            Catat Penghapusan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Riwayat Penghapusan -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-[#13988A] mb-4">Riwayat Penghapusan Terakhir</h3>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-[#F88E86] text-white">
                                <th class="px-4 py-2 text-left">Tanggal</th>
                                <th class="px-4 py-2 text-left">Barang</th>
                                <th class="px-4 py-2 text-left">Lokasi</th>
                                <th class="px-4 py-2">Jumlah</th>
                                <th class="px-4 py-2 text-left">Alasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat as $item)
                                <tr class="hover:bg-[#F9F9F9] text-[#757575]">
                                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM YYYY') }}</td>
                                    <td class="border px-4 py-2">{{ $item->barang->nama ?? 'N/A' }} ({{ $item->barang->kode_barang ?? 'N/A' }})</td>
                                    <td class="border px-4 py-2">{{ $item->barang->lokasi->nama_lokasi ?? 'N/A' }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $item->jumlah_dihapus }}</td>
                                    <td class="border px-4 py-2">{{ $item->alasan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center border px-4 py-2 text-[#757575]">Belum ada riwayat penghapusan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $riwayat->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
