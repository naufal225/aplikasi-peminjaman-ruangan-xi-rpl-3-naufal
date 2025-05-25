<x-layout-user>
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6 transition-colors duration-200">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('user.ruangan.index') }}" class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar
                    </a>

                    <!-- Status Badge -->

                    {{-- @if($ruangan->status === 'tersedia')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                            <svg class="w-2 h-2 mr-2" fill="currentColor" viewBox="0 0 8 8">
                                <circle cx="4" cy="4" r="3"/>
                            </svg>
                            Tersedia
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                            <svg class="w-2 h-2 mr-2" fill="currentColor" viewBox="0 0 8 8">
                                <circle cx="4" cy="4" r="3"/>
                            </svg>
                            Tidak Tersedia
                        </span>
                    @endif --}}
                </div>

                @if($ruangan->status === 'tersedia')
                    <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Ajukan Peminjaman
                    </button>
                @endif
            </div>

            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $ruangan->nama_ruangan }}</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Image Gallery -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-colors duration-200">
                    <div class="relative h-64 md:h-80 bg-gradient-to-br from-blue-400 to-blue-600 dark:from-blue-600 dark:to-blue-800">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-white opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>

                        <!-- Image placeholder overlay -->
                        <div class="absolute bottom-4 left-4 right-4">
                            <div class="bg-black bg-opacity-50 rounded-lg p-3">
                                <p class="text-white text-sm">📷 Foto ruangan akan segera tersedia</p>
                            </div>
                        </div>
                    </div>

                    <!-- Thumbnail placeholders -->
                    {{-- <div class="p-4">
                        <div class="grid grid-cols-4 gap-2">
                            @for($i = 0; $i < 4; $i++)
                                <div class="aspect-square bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endfor
                        </div>
                    </div> --}}
                </div>

                <!-- Description -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-200">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Deskripsi Ruangan</h2>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        {{ $ruangan->nama_ruangan }} adalah ruangan yang berlokasi di {{ $ruangan->lokasi }} dengan kapasitas maksimal {{ $ruangan->kapasitas }} orang.
                        {{-- Ruangan ini dilengkapi dengan berbagai fasilitas modern yang mendukung berbagai kegiatan pembelajaran, rapat, dan acara lainnya. --}}
                    </p>
                </div>

                <!-- Facilities -->
                {{-- <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-200">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Fasilitas Tersedia</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Proyektor</span>
                        </div>

                        <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">WiFi Gratis</span>
                        </div>

                        <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Papan Tulis</span>
                        </div>

                        <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">AC</span>
                        </div>

                        <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Sound System</span>
                        </div>

                        <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Meja & Kursi</span>
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Info -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Ruangan</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Kapasitas</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $ruangan->kapasitas }} orang</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Lokasi</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $ruangan->lokasi }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Status</span>
                            <span class="font-medium {{ $ruangan->status === 'tersedia' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ ucfirst($ruangan->status) }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-600 dark:text-gray-400">ID Ruangan</span>
                            <span class="font-medium text-gray-900 dark:text-white">#{{ $ruangan->ruangan_id }}</span>
                        </div>
                    </div>
                </div>

                <!-- Booking Rules -->
                {{-- <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Aturan Peminjaman</h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-400">Peminjaman minimal 1 jam</span>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-400">Booking maksimal 7 hari sebelumnya</span>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-400">Jaga kebersihan ruangan</span>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-400">Kembalikan fasilitas pada posisi semula</span>
                        </div>
                    </div>
                </div> --}}

                <!-- Contact Info -->
                {{-- <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Butuh Bantuan?</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-400">+62 123 456 789</span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-400">admin@sekolah.ac.id</span>
                        </div>
                    </div>
                </div> --}}
            </div>
             <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}"
                        min="{{ date('Y-m-d') }}"
                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 bg-white text-gray-900 rounded-md p-3"
                        required>
                    @error('tanggal')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-900">Informasi Ketersediaan</h3>
                <div id="availabilityInfo" class="mt-2 p-4 bg-gray-50 rounded-md">
                    <p class="text-sm text-gray-500">Silakan pilih ruangan dan tanggal untuk melihat ketersediaan.</p>
                </div>
            </div>
        </div>
    </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ruanganSelect = {{ $ruangan->ruangan_id }}
            const tanggalInput = document.getElementById('tanggal');
            const availabilityInfo = document.getElementById('availabilityInfo');
            const waktuMulaiInput = document.getElementById('waktu_mulai');
            const durasiInput = document.getElementById('durasi_pinjam');

            // Check availability when ruangan or tanggal changes
            ruanganSelect.addEventListener('change', checkAvailability);
            tanggalInput.addEventListener('change', checkAvailability);

            function checkAvailability() {
    const ruanganId = ruanganSelect.value;
    const tanggal = tanggalInput.value;

    if (ruanganId && tanggal) {
        availabilityInfo.innerHTML = '<p class="text-sm text-gray-500">Memeriksa ketersediaan...</p>';

        fetch(`/user/peminjaman/check-availability?ruangan_id=${ruanganId}&tanggal=${tanggal}`)
            .then(response => response.json())
            .then(data => {

                if (data.error) {
                    availabilityInfo.innerHTML = `<p class="text-sm text-red-500">${data.error}</p>`;
                    return;
                }

                const bookings = data.bookings;

                console.log(bookings)

                // Misal slot jam yang dicek adalah:
                const slots = [
    { start: '07:00', end: '08:00' },
    { start: '08:00', end: '09:00' },
    { start: '09:00', end: '10:00' },
    { start: '10:00', end: '11:00' },
    { start: '11:00', end: '12:00' },
    { start: '12:00', end: '13:00' },
    { start: '13:00', end: '14:00' },
    { start: '14:00', end: '15:00' },
    { start: '15:00', end: '16:00' },
    { start: '16:00', end: '17:00' }
];

                // Fungsi bantu untuk cek apakah slot bertabrakan dengan booking
                function isBooked(slotStart, slotEnd) {
                    for (const booking of bookings) {
                        const waktuMulai = booking.waktu_mulai.substring(0, 5); // Ambil "HH:mm"
                        const waktuSelesai = booking.waktu_selesai.substring(11, 16); // Ambil "HH:mm" dari "YYYY-MM-DD HH:mm:ss"

                        if (!(slotEnd <= waktuMulai || slotStart >= waktuSelesai)) {
                            return true; // Ada tabrakan waktu
                        }
                    }
                    return false;
                }

                // Bangun HTML slot sesuai ketersediaan
                let availabilityHTML = `<h4 class="font-medium text-gray-900 mb-2">Jadwal Ruangan pada ${formatDate(tanggal)}</h4><div class="space-y-2">`;

                slots.forEach(slot => {
                    const booked = isBooked(slot.start, slot.end);
                    availabilityHTML += `
                        <div class="flex items-center">
                            <span class="inline-block w-16 text-sm text-gray-500">${slot.start}-${slot.end}</span>
                            <span class="inline-block px-2 py-1 text-xs rounded-full ${booked ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'}">${booked ? 'Terpakai' : 'Tersedia'}</span>
                        </div>
                    `;
                });

                availabilityHTML += '</div><p class="mt-2 text-sm text-gray-500">Pilih waktu yang tersedia untuk melakukan peminjaman.</p>';

                availabilityInfo.innerHTML = availabilityHTML;
            })
            .catch(err => {
                availabilityInfo.innerHTML = '<p class="text-sm text-red-500">Gagal memeriksa ketersediaan.</p>';
                console.error(err);
            });
    }
}

            function formatDate(dateString) {
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                return new Date(dateString).toLocaleDateString('id-ID', options);
            }

            // Show estimated end time based on start time and duration
            waktuMulaiInput.addEventListener('change', updateEndTime);
            durasiInput.addEventListener('change', updateEndTime);

            function updateEndTime() {
                const waktuMulai = waktuMulaiInput.value;
                const durasi = parseInt(durasiInput.value);

                if (waktuMulai && durasi) {
                    const [hours, minutes] = waktuMulai.split(':').map(Number);
                    let endHours = hours + durasi;
                    const endMinutes = minutes;

                    // Format end time
                    const formattedEndHours = String(endHours % 24).padStart(2, '0');
                    const formattedEndMinutes = String(endMinutes).padStart(2, '0');

                    // Display end time (in a real application, you might want to show this to the user)
                    console.log(`Waktu selesai: ${formattedEndHours}:${formattedEndMinutes}`);
                }
            }
        });
    </script>
</x-layout-user>
