<?php

namespace App\Livewire\Lokasi;

use App\Models\Lokasi;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class Index extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $lokasiId;

    // Properti form dengan aturan validasi
    #[Rule('required|min:3', as: 'Nama Lokasi')]
    public $nama_lokasi;

    #[Rule('required|min:3', as: 'Gedung')]
    public $gedung;

    public function render()
    {
        return view('livewire.lokasi.index', [
            'lokasis' => Lokasi::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->lokasiId = null;
        $this->nama_lokasi = '';
        $this->gedung = '';
        $this->resetErrorBag(); // Menghapus pesan error sebelumnya
    }

    public function store()
    {
        $this->validate();

        Lokasi::updateOrCreate(['id' => $this->lokasiId], [
            'nama_lokasi' => $this->nama_lokasi,
            'gedung' => $this->gedung,
        ]);

        session()->flash('success', $this->lokasiId ? 'Lokasi berhasil diperbarui.' : 'Lokasi berhasil dibuat.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $this->lokasiId = $id;
        $this->nama_lokasi = $lokasi->nama_lokasi;
        $this->gedung = $lokasi->gedung;
        $this->openModal();
    }

    public function delete($id)
    {
        // Tambahkan validasi, jangan sampai lokasi terhapus jika masih ada barang di dalamnya
        $lokasi = Lokasi::withCount('barang')->findOrFail($id);
        if($lokasi->barang_count > 0){
            session()->flash('error', 'Gagal menghapus! Lokasi masih memiliki barang terkait.');
            return;
        }

        $lokasi->delete();
        session()->flash('success', 'Lokasi berhasil dihapus.');
    }
}
