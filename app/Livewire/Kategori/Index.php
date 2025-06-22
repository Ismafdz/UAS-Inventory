<?php

namespace App\Livewire\Kategori;

use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class Index extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $kategoriId;

    #[Rule('required|min:3')]
    public $nama_kategori;

    public function render()
    {
        return view('livewire.kategori.index', [
            'kategoris' => Kategori::latest()->paginate(5)
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
        $this->kategoriId = null;
        $this->nama_kategori = '';
    }

    public function store()
    {
        $this->validate();

        Kategori::updateOrCreate(['id' => $this->kategoriId], [
            'nama_kategori' => $this->nama_kategori
        ]);

        session()->flash('success', $this->kategoriId ? 'Kategori berhasil diperbarui.' : 'Kategori berhasil dibuat.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        $this->kategoriId = $id;
        $this->nama_kategori = $kategori->nama_kategori;
        $this->openModal();
    }

    public function delete($id)
    {
        Kategori::find($id)->delete();
        session()->flash('success', 'Kategori berhasil dihapus.');
    }
}