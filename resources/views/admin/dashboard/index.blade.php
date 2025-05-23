<x-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Card Jumlah Pengajuan Peminjaman -->
        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pengajuan Peminjaman</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pengajuanPeminjaman ?? 24 }}</p>
                </div>
                <div class="bg-blue-100 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-sm text-green-600">
                    <span class="font-medium">+5%</span> dari bulan lalu
                </p>
            </div>
        </div>

        <!-- Card Jumlah Pengajuan Pengembalian -->
        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pengajuan Pengembalian</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pengajuanPengembalian ?? 18 }}</p>
                </div>
                <div class="bg-purple-100 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-sm text-green-600">
                    <span class="font-medium">+3%</span> dari bulan lalu
                </p>
            </div>
        </div>

        <!-- Card Jumlah Peminjaman -->
        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Peminjaman</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $peminjaman ?? 42 }}</p>
                </div>
                <div class="bg-green-100 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-sm text-green-600">
                    <span class="font-medium">+8%</span> dari bulan lalu
                </p>
            </div>
        </div>

        <!-- Card Jumlah Pengembalian -->
        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pengembalian</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pengembalian ?? 36 }}</p>
                </div>
                <div class="bg-red-100 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-sm text-green-600">
                    <span class="font-medium">+6%</span> dari bulan lalu
                </p>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas 30 Hari Terakhir</h2>
        <div class="h-80">
            <canvas id="activityChart"></canvas>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h2>
        </div>
        <div class="divide-y divide-gray-200">
            <div class="px-6 py-4">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-2 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Pengajuan Peminjaman Ruang Rapat</p>
                        <p class="text-sm text-gray-500">Diajukan oleh Ahmad - 2 jam yang lalu</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4">
                <div class="flex items-center">
                    <div class="bg-green-100 p-2 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Peminjaman Ruang Aula Disetujui</p>
                        <p class="text-sm text-gray-500">Disetujui oleh Admin - 3 jam yang lalu</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4">
                <div class="flex items-center">
                    <div class="bg-purple-100 p-2 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Pengajuan Pengembalian Ruang Lab</p>
                        <p class="text-sm text-gray-500">Diajukan oleh Budi - 5 jam yang lalu</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4">
                <div class="flex items-center">
                    <div class="bg-red-100 p-2 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Pengembalian Ruang Kelas Disetujui</p>
                        <p class="text-sm text-gray-500">Disetujui oleh Admin - 6 jam yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data untuk 30 hari terakhir
            const dates = [];
            const today = new Date();

            for (let i = 29; i >= 0; i--) {
                const date = new Date();
                date.setDate(today.getDate() - i);
                dates.push(date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' }));
            }

            // Data dummy untuk chart
            const pengajuanPeminjamanData = Array.from({length: 30}, () => Math.floor(Math.random() * 5) + 1);
            const pengajuanPengembalianData = Array.from({length: 30}, () => Math.floor(Math.random() * 5) + 1);
            const peminjamanData = Array.from({length: 30}, () => Math.floor(Math.random() * 8) + 2);
            const pengembalianData = Array.from({length: 30}, () => Math.floor(Math.random() * 8) + 2);

            // Inisialisasi chart
            const ctx = document.getElementById('activityChart').getContext('2d');
            const activityChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dates,
                    datasets: [
                        {
                            label: 'Pengajuan Peminjaman',
                            data: pengajuanPeminjamanData,
                            borderColor: '#3B82F6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Pengajuan Pengembalian',
                            data: pengajuanPengembalianData,
                            borderColor: '#8B5CF6',
                            backgroundColor: 'rgba(139, 92, 246, 0.1)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Peminjaman',
                            data: peminjamanData,
                            borderColor: '#10B981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Pengembalian',
                            data: pengembalianData,
                            borderColor: '#EF4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [2, 4],
                                drawBorder: false
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-layout>
