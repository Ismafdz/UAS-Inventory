<x-app-layout>
    <div>
    {{-- Ini akan ditangkap oleh @yield('title') di layout Anda --}}
    @section('title', 'Dashboard')

    {{-- Data sekarang datang dari properti public di class Dashboard, bukan dari blok @php --}}
    <div class="space-y-6">

        <div class="p-6 bg-white rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-gray-800">
                Selamat Datang Kembali, {{ $userName }}!
            </h1>
            <p class="mt-1 text-gray-600">
                Berikut adalah ringkasan aktivitas inventaris Anda hari ini.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <p class="text-sm font-medium text-gray-500">Total Barang</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalBarang }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <p class="text-sm font-medium text-gray-500">Total Kategori</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalKategori }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <p class="text-sm font-medium text-gray-500">Total Lokasi</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalLokasi }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-5">
            <div class="lg:col-span-3 p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Jumlah Barang per Kategori</h3>
                <div class="h-64" wire:ignore>
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
            <div class="lg:col-span-2 p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Barang Baru Ditambahkan</h3>
                <ul class="space-y-4">
                    @forelse($barangTerbaru as $barang)
                        <li class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-800">{{ $barang->nama_barang }}</p>
                                <p class="text-sm text-gray-500">{{ $barang->kategori->nama_kategori ?? 'N/A' }}</p>
                            </div>
                            <span class="font-semibold text-gray-700">{{ $barang->jumlah }}</span>
                        </li>
                    @empty
                        <li class="text-center text-gray-500">Belum ada barang baru.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            const chartData = @json($chartData);
            
            if (document.getElementById('categoryChart')) {
                const ctx = document.getElementById('categoryChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: JSON.parse(chartData.labels),
                        datasets: [{
                            label: 'Jumlah Barang',
                            data: JSON.parse(chartData.data),
                            backgroundColor: '#F88E86',
                            borderRadius: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
                        plugins: { legend: { display: false } }
                    }
                });
            }
        });
    </script>
    @endpush
</div>
    </x-app-layout>