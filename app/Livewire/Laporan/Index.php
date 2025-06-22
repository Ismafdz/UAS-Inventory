<?php

namespace App\Livewire\Laporan;

use App\Models\Barang;
use App\Models\Lokasi;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        // Ambil semua barang yang jumlahnya lebih dari 0, diurutkan berdasarkan lokasi lalu nama
        $barangAktif = Barang::with(['kategori', 'lokasi'])
                            ->where('jumlah', '>', 0)
                            ->orderBy('lokasi_id')
                            ->orderBy('nama')
                            ->get();

        // Ambil semua lokasi, hitung berapa jenis barang unik yang ada di sana,
        // dan jumlahkan total semua stok barang di lokasi tersebut.
        $totalPerLokasi = Lokasi::withCount(['barang as total_item_unik'])
                                ->withSum('barang as total_jumlah_barang', 'jumlah')
                                ->orderBy('nama_lokasi')
                                ->get();

        return view('livewire.laporan.index', [
            'barangAktif' => $barangAktif,
            'totalPerLokasi' => $totalPerLokasi,
        ]);
    }
}
