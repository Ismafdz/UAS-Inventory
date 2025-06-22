{{--
    File: resources/views/livewire/barang/create.blade.php
    Versi: Bersih (dibuat dari awal)
    Deskripsi: Modal untuk menambah atau mengedit data barang, dengan styling yang konsisten
               sesuai tailwind.config.js dan praktik terbaik.
--}}
<div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <!-- 1. Overlay Latar Belakang -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" aria-hidden="true" wire:click="closeModal()"></div>

        <!-- 2. Spacer untuk Memposisikan Modal di Tengah -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- 3. Konten Modal Utama -->
        <div class="inline-block align-bottom bg-softBg rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form wire:submit.prevent="store">
                {{-- Header dan Isi Form --}}
                <div class="px-6 pt-6 pb-4">
                    {{-- Judul Modal --}}
                    <h3 class="text-xl font-bold text-tealAccent mb-6" id="modal-title">
                        {{ $barangId ? 'Edit Barang' : 'Tambah Barang Baru' }}
                    </h3>

                    {{-- Kontainer untuk semua input form --}}
                    <div class="space-y-4">

                        <div>
                            <label for="kode_barang" class="block text-sm font-medium text-textGray">Kode Barang</label>
                            <input id="kode_barang" type="text" wire:model.lazy="kode_barang" class="mt-1 block w-full form-input rounded-md shadow-sm border-gray-300 focus:border-tealAccent focus:ring focus:ring-tealAccent focus:ring-opacity-50" placeholder="Contoh: BRG-001">
                            @error('kode_barang') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="nama" class="block text-sm font-medium text-textGray">Nama Barang</label>
                            <input id="nama" type="text" wire:model.lazy="nama" class="mt-1 block w-full form-input rounded-md shadow-sm border-gray-300 focus:border-tealAccent focus:ring focus:ring-tealAccent focus:ring-opacity-50" placeholder="Contoh: Laptop Dell XPS 15">
                            @error('nama') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="kategori_id" class="block text-sm font-medium text-textGray">Kategori</label>
                            <select id="kategori_id" wire:model.lazy="kategori_id" class="mt-1 block w-full form-select rounded-md shadow-sm border-gray-300 focus:border-tealAccent focus:ring focus:ring-tealAccent focus:ring-opacity-50">
                                <option value="">Pilih Kategori...</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="lokasi_id" class="block text-sm font-medium text-textGray">Lokasi</label>
                            <select id="lokasi_id" wire:model.lazy="lokasi_id" class="mt-1 block w-full form-select rounded-md shadow-sm border-gray-300 focus:border-tealAccent focus:ring focus:ring-tealAccent focus:ring-opacity-50">
                                <option value="">Pilih Lokasi...</option>
                                @foreach($lokasis as $lokasi)
                                    <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }} - {{ $lokasi->gedung }}</option>
                                @endforeach
                            </select>
                            @error('lokasi_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="jumlah" class="block text-sm font-medium text-textGray">Jumlah</label>
                            <input id="jumlah" type="number" wire:model.lazy="jumlah" class="mt-1 block w-full form-input rounded-md shadow-sm border-gray-300 focus:border-tealAccent focus:ring focus:ring-tealAccent focus:ring-opacity-50" min="0" placeholder="0">
                            @error('jumlah') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                    </div>
                </div>

                <!-- 4. Area Tombol Aksi (Footer Modal) -->
                <div class="bg-softBg px-6 py-4 flex justify-end space-x-3 border-t border-gray-200">
                    <button type="submit"
                        class="px-5 py-2 bg-tealAccent hover:bg-opacity-85 text-white font-bold rounded-md shadow-sm transition duration-150 ease-in-out">
                        Simpan
                    </button>
                    <button wire:click="closeModal()" type="button"
                        class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-textGray font-semibold rounded-md shadow-sm transition duration-150 ease-in-out">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
