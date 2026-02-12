<div class="p-6 space-y-8 bg-gray-100 min-h-screen">
    {{-- Statistik Card --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="p-6 rounded-xl shadow-md hover:scale-105 transition" style="background-color: #2563eb; color: white;">
            <h3 class="text-lg font-semibold">Jumlah Product</h3>
            <p class="text-3xl mt-2 font-bold">23</p>
        </div>
        <div class="p-6 rounded-xl shadow-md hover:scale-105 transition" style="background-color: #16a34a; color: white;">
            <h3 class="text-lg font-semibold">Jumlah Category</h3>
            <p class="text-3xl mt-2 font-bold">95</p>
        </div>
        <div class="p-6 rounded-xl shadow-md hover:scale-105 transition" style="background-color: #facc15; color: white;">
            <h3 class="text-lg font-semibold">Jumlah Kurir</h3>
            <p class="text-3xl mt-2 font-bold">15</p>
        </div>
        <div class="p-6 rounded-xl shadow-md hover:scale-105 transition" style="background-color: #ef4444; color: white;">
            <h3 class="text-lg font-semibold">Pesanan Masuk</h3>
            <p class="text-3xl mt-2 font-bold">10</p>
        </div>
    </div>

    {{-- Grafik Penjualan --}}
    <div class="p-6 rounded-xl shadow-md" style="background-color: rgba(191, 219, 254, 0.6);">
        <h3 class="text-xl font-bold text-gray-700 mb-4">Grafik Penjualan 7 Hari Terakhir</h3>
        <div class="w-full h-[400px] bg-blue-100 rounded-lg p-4">
            <canvas id="salesChart" class="w-full h-full bg-transparent"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    label: 'Penjualan',
                    data: [10, 15, 8, 12, 20, 18, 25],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#3b82f6',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush
