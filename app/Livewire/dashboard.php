<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $totalBarang;
    public $totalKategori;
    public $totalLokasi;
    public $barangTerbaru;
    public $chartData;
    public $userName;

    public function mount()
    {
        $this->userName = Auth::user()->name;
        $this->totalBarang = Barang::count();
        $this->totalKategori = Kategori::count();
        $this->totalLokasi = Lokasi::count();
        $this->barangTerbaru = Barang::with('kategori')->latest()->take(5)->get();
        
        $data = Kategori::withCount('barang')->get();
            
        $this->chartData = [
            'labels' => $data->pluck('nama_kategori')->toJson(),
            'data' => $data->pluck('barang_count')->toJson(),
        ];
    }

    public function render()
    {
        // View ini akan kita buat di Langkah 2
        return view('livewire.dashboard.index');
    }
}