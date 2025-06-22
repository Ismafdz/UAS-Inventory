<x-app-layout>
    <x-slot name="title">Laporan Inventaris</x-slot>

    <div class="space-y-6">

        {{-- Total per Lokasi --}}
        <div class="bg-white p-6 rounded-xl shadow border border-[#e0e0e0]">
            <h3 class="text-lg font-bold text-textGray mb-4">Laporan Total per Lokasi</h3>
            <table class="table-auto w-full text-textGray">
                <thead>
                    <tr class="bg-softBg">
                        <th class="px-4 py-3 text-left">Nama Lokasi</th>
                        <th class="px-4 py-3 text-left">Gedung</th>
                        <th class="px-4 py-3">Total Jenis</th>
                        <th class="px-4 py-3">Total Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($totalPerLokasi as $laporan)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $laporan->nama_lokasi }}</td>
                            <td class="px-4 py-2">{{ $laporan->gedung }}</td>
                            <td class="px-4 py-2 text-center">{{ $laporan->total_item_unik }}</td>
                            <td class="px-4 py-2 text-center">{{ $laporan->total_jumlah_barang ?? 0 }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center px-4 py-2">Tidak ada data lokasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Daftar Barang Aktif --}}
        <div class="bg-white p-6 rounded-xl shadow border border-[#e0e0e0]">
            <h3 class="text-lg font-bold text-textGray mb-4">Daftar Barang Aktif (Stok > 0)</h3>
            <table class="table-auto w-full text-textGray">
                <thead>
                    <tr class="bg-softBg">
                        <th class="px-4 py-3 text-left">Kode</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left">Lokasi</th>
                        <th class="px-4 py-3">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangAktif as $barang)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $barang->kode_barang }}</td>
                            <td class="px-4 py-2">{{ $barang->nama }}</td>
                            <td class="px-4 py-2">{{ $barang->kategori->nama_kategori ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $barang->lokasi->nama_lokasi ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-center">{{ $barang->jumlah }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center px-4 py-2">Tidak ada barang aktif.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
