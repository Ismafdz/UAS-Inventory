<?php

namespace App\Livewire\Mutasi;

use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\RiwayatMutasi;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;

    // Properti untuk form
    #[Rule('required|exists:barang,id', as: 'Barang')]
    public $barang_id;
    
    #[Rule('required|exists:lokasi,id', as: 'Lokasi Tujuan')]
    public $tujuan_lokasi_id;

    #[Rule('required|integer|min:1', as: 'Jumlah Mutasi')]
    public $jumlah_mutasi;
    
    // Properti helper untuk menampilkan detail barang yang dipilih
    public $selectedBarang;

    // Lifecycle hook, dieksekusi setiap kali properti $barang_id berubah
    public function updatedBarangId($value)
    {
        $this->selectedBarang = Barang::with('lokasi')->find($value);
        if ($this->selectedBarang) {
            // Otomatis isi jumlah mutasi dengan seluruh stok yang ada
            $this->jumlah_mutasi = $this->selectedBarang->jumlah;
        }
    }
    
    public function store()
    {
        $this->validate();
        
        // Validasi: Pastikan tidak mutasi ke lokasi yang sama
        if ($this->selectedBarang && $this->selectedBarang->lokasi_id == $this->tujuan_lokasi_id) {
            session()->flash('error', 'Lokasi tujuan tidak boleh sama dengan lokasi asal.');
            return;
        }

        // Validasi: Jumlah mutasi tidak boleh melebihi stok yang ada
        if ($this->jumlah_mutasi > $this->selectedBarang->jumlah) {
            session()->flash('error', 'Jumlah mutasi tidak boleh melebihi stok yang ada.');
            return;
        }

        // Gunakan transaction untuk memastikan semua query berhasil atau tidak sama sekali
        DB::transaction(function () {
            $barangAsal = Barang::find($this->barang_id);

            // 1. Buat catatan riwayat mutasi
            RiwayatMutasi::create([
                'barang_id' => $this->barang_id,
                'asal_lokasi_id' => $barangAsal->lokasi_id,
                'tujuan_lokasi_id' => $this->tujuan_lokasi_id,
                'jumlah_mutasi' => $this->jumlah_mutasi,
                'tanggal' => now(),
            ]);

            // 2. Kurangi stok di barang asal
            $barangAsal->decrement('jumlah', $this->jumlah_mutasi);

            // 3. Cari barang dengan kode yang sama di lokasi tujuan
            $barangDiTujuan = Barang::where('kode_barang', $barangAsal->kode_barang)
                                    ->where('lokasi_id', $this->tujuan_lokasi_id)
                                    ->first();
            
            // Jika sudah ada, tambah jumlahnya. Jika belum, buat record barang baru.
            if ($barangDiTujuan) {
                $barangDiTujuan->increment('jumlah', $this->jumlah_mutasi);
            } else {
                Barang::create([
                    'nama' => $barangAsal->nama,
                    'kode_barang' => $barangAsal->kode_barang,
                    'kategori_id' => $barangAsal->kategori_id,
                    'lokasi_id' => $this->tujuan_lokasi_id,
                    'jumlah' => $this->jumlah_mutasi,
                ]);
            }
        });

        session()->flash('success', 'Mutasi barang berhasil dicatat.');
        $this->reset(['barang_id', 'tujuan_lokasi_id', 'jumlah_mutasi', 'selectedBarang']);
    }

    public function render()
    {
        return view('livewire.mutasi.index', [
            'barangs' => Barang::where('jumlah', '>', 0)->orderBy('nama')->get(),
            'lokasis' => Lokasi::orderBy('nama_lokasi')->get(),
            'riwayat' => RiwayatMutasi::with(['barang.kategori', 'asalLokasi', 'tujuanLokasi'])->latest()->paginate(10)
        ]);
    }
}
