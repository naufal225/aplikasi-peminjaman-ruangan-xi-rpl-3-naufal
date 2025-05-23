<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Aplikasi Peminjaman Ruangan' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Heroicons (untuk ikon) -->
    <script src="https://unpkg.com/@heroicons/vue@1.0.4/dist/heroicons.min.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        <!-- Sidebar Mobile Overlay -->
        <div x-show="sidebarOpen"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
             x-cloak></div>

        <!-- Sidebar -->
        <aside x-bind:class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
               class="fixed inset-y-0 left-0 z-30 w-64 transform bg-white border-r border-gray-200 transition duration-300 ease-in-out lg:relative lg:translate-x-0 lg:flex lg:flex-shrink-0">
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-center h-16 px-6 bg-white border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Admin Panel</h2>
                </div>
                <nav class="flex-1 mt-5 px-4 overflow-y-auto">
                    <a href="{{ url('/') }}" class="flex items-center px-4 py-3 {{ request()->is('/') ? 'text-gray-800 bg-gray-100' : 'text-gray-600 hover:bg-gray-100' }} rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ url('/users') }}" class="flex items-center px-4 py-3 mt-2 {{ request()->is('users*') ? 'text-gray-800 bg-gray-100' : 'text-gray-600 hover:bg-gray-100' }} rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Kelola Data User</span>
                    </a>
                    <a href="{{ url('/ruangan') }}" class="flex items-center px-4 py-3 mt-2 {{ request()->is('ruangan*') ? 'text-gray-800 bg-gray-100' : 'text-gray-600 hover:bg-gray-100' }} rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span>Kelola Data Ruangan</span>
                    </a>
                    <a href="{{ url('/peminjaman-ruangan') }}" class="flex items-center px-4 py-3 mt-2 {{ request()->is('peminjaman-ruangan*') ? 'text-gray-800 bg-gray-100' : 'text-gray-600 hover:bg-gray-100' }} rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Peminjaman & Pengembalian</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex flex-col flex-1 w-0 overflow-hidden">
            <!-- Top Navigation -->
            <header class="z-10 py-4 bg-white shadow-sm">
                <div class="px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <h1 class="ml-4 lg:ml-0 text-xl font-bold text-gray-800">Aplikasi Peminjaman Ruangan</h1>
                    </div>
                    <div class="flex items-center">
                        <div class="relative">
                            @php
                                $user = Auth::user();
                                $name = $user ? $user->nama_lengkap : 'User';
                                $initials = '';
                                $words = explode(' ', $name);
                                foreach ($words as $w) {
                                    if(!empty($w)) {
                                        $initials .= $w[0];
                                    }
                                }
                                $initials = substr($initials, 0, 2);
                            @endphp

                            @if($user && $user->profile_photo_path)
                                <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $name }}">
                            @else
                                <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-medium">
                                    {{ $initials }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>