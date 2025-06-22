<?php

namespace App\Livewire\Barang;

use Livewire\Component;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // Properti untuk state modal
    public $isOpen = false;
    public $barangId;

    // Properti untuk binding form (data barang)
    public $nama, $kode_barang, $kategori_id, $lokasi_id, $jumlah;

    // Properti untuk menampung data dropdown
    public $kategoris = [];
    public $lokasis = [];

    protected $rules = [
        'nama' => 'required|string|min:3',
        'kode_barang' => 'required|string|unique:barang,kode_barang',
        'kategori_id' => 'required|exists:kategori,id',
        'lokasi_id' => 'required|exists:lokasi,id',
        'jumlah' => 'required|integer|min:0',
    ];

    /**
     * Fungsi yang dipanggil saat tombol "Tambah Barang" diklik.
     * Ini adalah titik kritis yang diperbaiki.
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openModal(); // Menggunakan fungsi terpisah agar lebih rapi
    }

    /**
     * Membuka modal dan memuat semua data yang dibutuhkan oleh modal.
     */
    public function openModal()
    {
        // PENTING: Muat data untuk dropdown SEBELUM modal ditampilkan.
        // Inilah kemungkinan besar penyebab error "blank putih".
        $this->kategoris = Kategori::orderBy('nama_kategori')->get();
        $this->lokasis = Lokasi::orderBy('nama_lokasi')->get();

        $this->isOpen = true;
    }

    /**
     * Menutup modal.
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * Mereset semua field form.
     */
    private function resetInputFields()
    {
        $this->reset(['nama', 'kode_barang', 'kategori_id', 'lokasi_id', 'jumlah', 'barangId']);
        $this->resetErrorBag();
    }

    /**
     * Menyimpan data baru atau memperbarui data yang sudah ada.
     */
    public function store()
    {
        // Modifikasi rules validasi jika sedang dalam mode edit
        $rules = $this->rules;
        if ($this->barangId) {
            $rules['kode_barang'] = 'required|string|unique:barang,kode_barang,' . $this->barangId;
        }
        
        $this->validate($rules);

        Barang::updateOrCreate(['id' => $this->barangId], [
            'nama' => $this->nama,
            'kode_barang' => $this->kode_barang,
            'kategori_id' => $this->kategori_id,
            'lokasi_id' => $this->lokasi_id,
            'jumlah' => $this->jumlah,
        ]);

        session()->flash('success', $this->barangId ? 'Barang berhasil diperbarui.' : 'Barang berhasil ditambahkan.');

        $this->closeModal();
    }

    /**
     * Memuat data barang ke dalam form untuk diedit.
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $this->barangId = $id;
        $this->nama = $barang->nama;
        $this->kode_barang = $barang->kode_barang;
        $this->kategori_id = $barang->kategori_id;
        $this->lokasi_id = $barang->lokasi_id;
        $this->jumlah = $barang->jumlah;

        $this->openModal(); // Panggil openModal yang sudah memuat data dropdown
    }
    
    /**
     * Menghapus data barang.
     */
    public function delete($id)
    {
        try {
            Barang::find($id)->delete();
            session()->flash('success', 'Barang berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus barang karena terkait dengan data lain.');
        }
    }


    /**
     * Merender view komponen.
     */
    public function render()
    {
        
        return view('livewire.barang.index', [
            'barangs' => Barang::with(['kategori', 'lokasi'])->latest()->paginate(10)
        ]);
    }
}
