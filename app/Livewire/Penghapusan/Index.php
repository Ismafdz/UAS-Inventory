<?php

namespace App\Livewire\Penghapusan;

use App\Models\Barang;
use App\Models\Penghapusan; // Model harus punya: protected $table = 'penghapusan';
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;

    #[Rule('required|exists:barang,id', as: 'Barang')]
    public $barang_id;

    #[Rule('required|integer|min:1', as: 'Jumlah Dihapus')]
    public $jumlah_dihapus;

    #[Rule('required|min:5', as: 'Alasan')]
    public $alasan;

    public $selectedBarang;

    public function updatedBarangId($value)
    {
        $this->selectedBarang = Barang::find($value);
        if ($this->selectedBarang) {
            $this->jumlah_dihapus = 1;
        }
    }

    public function store()
    {
        $this->validate();

        $this->selectedBarang = Barang::find($this->barang_id);

        if (!$this->selectedBarang || $this->jumlah_dihapus > $this->selectedBarang->jumlah) {
            session()->flash('error', 'Jumlah yang dihapus tidak boleh melebihi stok yang tersedia.');
            return;
        }

        DB::transaction(function () {
            Penghapusan::create([
                'barang_id' => $this->barang_id,
                'jumlah_dihapus' => $this->jumlah_dihapus,
                'alasan' => $this->alasan,
                'tanggal' => now(),
            ]);

            $this->selectedBarang->decrement('jumlah', $this->jumlah_dihapus);
        });

        session()->flash('success', 'Penghapusan barang berhasil dicatat.');
        $this->reset(['barang_id', 'jumlah_dihapus', 'alasan', 'selectedBarang']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.penghapusan.index', [
            'barangs' => Barang::where('jumlah', '>', 0)->orderBy('nama')->get(),
            'riwayat' => Penghapusan::with('barang.lokasi')->latest()->paginate(10),
        ]);
    }
}
