<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-[#13988A] leading-tight">
                {{ __('Mutasi Barang Antar Lokasi') }}
            </h2>
        </x-slot>

        <div class="py-12 bg-[#F9F9F9]">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-[#757575] mb-4">Formulir Mutasi</h3>

                        {{-- Notifikasi Sukses --}}
                        @if (session()->has('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Notifikasi Error --}}
                        @if (session()->has('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="store">
                            <div class="grid md:grid-cols-3 gap-4">

                                {{-- Pilih Barang --}}
                                <div>
                                    <label class="block text-sm font-medium text-[#757575]">Pilih Barang</label>
                                    <select wire:model="barang_id" class="form-select">
                                        <option value="">-- Pilih Barang --</option>
                                        @foreach($barangs as $item)
                                            <option value="{{ $item->id }}">{{ $item->kode_barang }} - {{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('barang_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                {{-- Jumlah Mutasi --}}
                                <div>
                                    <label class="block text-sm font-medium text-[#757575]">Jumlah Mutasi</label>
                                    <input type="number" wire:model="jumlah_mutasi" class="form-input" min="1">
                                    @error('jumlah_mutasi') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                {{-- Lokasi Tujuan --}}
                                <div>
                                    <label class="block text-sm font-medium text-[#757575]">Lokasi Tujuan</label>
                                    <select wire:model="tujuan_lokasi_id" class="form-select">
                                        <option value="">-- Pilih Lokasi --</option>
                                        @foreach($lokasis as $lokasi)
                                            <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                                        @endforeach
                                    </select>
                                    @error('tujuan_lokasi_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                            </div>

                            <div class="mt-4">
                                <button type="submit"
                                    class="bg-[#13988A] hover:bg-[#0f7a71] text-white font-bold py-2 px-4 rounded">
                                    Proses Mutasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-[#757575] mb-4">Riwayat Mutasi</h3>

                        <table class="w-full table-auto">
                            <thead class="bg-[#F88E86] text-white">
                                <tr>
                                    <th class="px-4 py-2 text-left">Tanggal</th>
                                    <th class="px-4 py-2 text-left">Barang</th>
                                    <th class="px-4 py-2 text-center">Jumlah</th>
                                    <th class="px-4 py-2 text-left">Dari</th>
                                    <th class="px-4 py-2 text-left">Ke</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayat as $item)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $item->tanggal }}</td>
                                        <td class="px-4 py-2">{{ $item->barang?->nama ?? '-' }}</td>
                                        <td class="px-4 py-2 text-center">{{ $item->jumlah_mutasi }}</td>
                                        <td class="px-4 py-2">{{ $item->asalLokasi?->nama_lokasi ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $item->tujuanLokasi?->nama_lokasi ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center p-4">Belum ada data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="mt-4">
                            {{ $riwayat->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
