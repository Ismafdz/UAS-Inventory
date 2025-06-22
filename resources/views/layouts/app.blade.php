<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title', config('app.name', 'Inventory App'))</title> {{-- Title yang lebih dinamis --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> {{-- Tambahkan viewport --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-black min-h-screen font-sans"> {{-- <-- KARAKTER < SUDAH DIHAPUS --}}

    <div class="flex">

        {{-- Sidebar --}}
        <div class="w-64 bg-white shadow-lg min-h-screen p-4 flex-shrink-0">
            <h1 class="text-2xl font-bold mb-6 text-[#333]">Inventory 📦</h1>
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-softPink hover:text-white transition">Dashboard</a>
                <a href="/kategori" class="block px-3 py-2 rounded hover:bg-softPink hover:text-white transition">Kategori</a>
                <a href="/lokasi" class="block px-3 py-2 rounded hover:bg-softPink hover:text-white transition">Lokasi</a>
                <a href="/barang" class="block px-3 py-2 rounded hover:bg-softPink hover:text-white transition">Barang</a>
                <a href="/mutasi" class="block px-3 py-2 rounded hover:bg-softPink hover:text-white transition">Mutasi</a>
                <a href="/laporan" class="block px-3 py-2 rounded hover:bg-softPink hover:text-white transition">Laporan</a>
                <a href="/penghapusan" class="block px-3 py-2 rounded hover:bg-softPink hover:text-white transition">Penghapusan</a>
            </nav>
        </div>

        {{-- Content --}}
        <div class="flex-1 p-6">
            <header class="mb-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-[#333]">@yield('title')</h2>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-softPink text-white px-4 py-2 rounded shadow hover:bg-tealAccent transition">
                        Logout
                    </button>
                </form>
            </header>

            {{-- Page Content --}}
            <main>
                {{ $slot }}
            </main>
        </div>

    </div>

    @livewireScripts
    @stack('scripts') {{-- Tambahkan ini untuk script chart.js --}}
</body>
</html>