<?php
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
new class extends Component {
    public function logout(Logout $logout): void {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-nav-link>
                    <x-nav-link :href="route('kategori.index')" :active="request()->routeIs('kategori.index')">{{ __('Kategori') }}</x-nav-link>
                    <x-nav-link :href="route('lokasi.index')" :active="request()->routeIs('lokasi.index')">{{ __('Lokasi') }}</x-nav-link>
                    <x-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.index')">{{ __('Barang') }}</x-nav-link>
                    <x-nav-link :href="route('mutasi.index')" :active="request()->routeIs('mutasi.index')">{{ __('Mutasi Barang') }}</x-nav-link>
                    <x-nav-link :href="route('penghapusan.index')" :active="request()->routeIs('penghapusan.index')">{{ __('Penghapusan') }}</x-nav-link>
                    <x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.index')">{{ __('Laporan') }}</x-nav-link>
                </div>
            </div>
            <!-- Settings Dropdown Dihapus Total -->
        </div>
    </div>
</nav>
