{{--
    File: resources/views/livewire/kategori/create.blade.php
    Versi: Final (Refactored)
    Deskripsi: Modal untuk menambah atau mengedit kategori.
--}}
<div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        
        <!-- Latar belakang overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" aria-hidden="true" wire:click="closeModal()"></div>
        
        <!-- Spacer untuk memposisikan modal -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <!-- Konten Modal -->
        <div class="inline-block align-bottom bg-softBg rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form wire:submit.prevent="store">
                <div class="px-6 pt-6 pb-4">
                    <h3 class="text-xl font-bold text-tealAccent mb-6" id="modal-title">
                        {{ $kategoriId ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label for="nama_kategori" class="block text-sm font-medium text-textGray">Nama Kategori</label>
                            <input id="nama_kategori" type="text" wire:model.lazy="nama_kategori" class="mt-1 block w-full form-input rounded-md shadow-sm border-gray-300 focus:border-tealAccent focus:ring focus:ring-tealAccent focus:ring-opacity-50" placeholder="Contoh: Alat Tulis Kantor">
                            @error('nama_kategori') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-softBg px-6 py-4 flex justify-end space-x-3 border-t border-gray-200">
                    <button type="submit" class="px-5 py-2 bg-tealAccent hover:bg-opacity-85 text-white font-bold rounded-md shadow-sm transition">Simpan</button>
                    <button wire:click="closeModal()" type="button" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-textGray font-semibold rounded-md shadow-sm transition">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
