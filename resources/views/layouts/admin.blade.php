<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Kebun Raya' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex flex-col md:flex-row">

        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/80 z-40 md:hidden"></div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-primary-900 text-white transition-transform duration-300 ease-in-out md:relative md:translate-x-0 shadow-2xl flex flex-col justify-between">
            <div>
                <div class="h-20 flex items-center px-6 border-b border-white/10 bg-primary-950/50">
                    <a href="/" class="flex items-center space-x-3">
                        <img src="{{ asset('assets/images/LogoKebunRaya.jpeg') }}" alt="Logo"
                            class="h-10 w-10 rounded-full border-2 border-primary-400"
                            onerror="this.style.display='none'">
                        <div>
                            <span class="block font-bold text-lg leading-tight">Kebun Raya</span>
                            <span class="block text-[10px] text-primary-300 uppercase tracking-wider">Admin Panel</span>
                        </div>
                    </a>
                </div>

                <nav class="p-4 space-y-2 mt-4">

                    <a href="{{ route('dashboard') }}" wire:navigate
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group bg-primary-800 text-white shadow-lg shadow-primary-900/50 border border-primary-700">
                        <svg class="w-5 h-5 mr-3 text-primary-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('berita') }}" wire:navigate
                        class="flex items-center px-4 py-3 rounded-xl text-primary-100 hover:bg-white/10 hover:text-white transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-3 text-primary-400 group-hover:text-white transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                        <span class="font-medium">Kelola Post</span>
                    </a>

                    <a href="#"
                        class="flex items-center px-4 py-3 rounded-xl text-primary-100 hover:bg-white/10 hover:text-white transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-3 text-primary-400 group-hover:text-white transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="font-medium">Repositori Flora</span>
                    </a>

                    <a href="{{ route('mitra') }}" wire:navigate
                        class="flex items-center px-4 py-3 rounded-xl text-primary-100 hover:bg-white/10 hover:text-white transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-3 text-primary-400 group-hover:text-white transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="font-medium">Mitra</span>
                    </a>

                    <div class="py-2">
                        <div class="border-t border-white/10"></div>
                    </div>

                    <a href="{{ route('pengaturan') }}" wire:navigate
                        class="flex items-center px-4 py-3 rounded-xl text-primary-100 hover:bg-white/10 hover:text-white transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-3 text-primary-400 group-hover:text-white transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">Pengaturan</span>
                    </a>

                </nav>
            </div>

            <div class="p-4 border-t border-white/10 bg-primary-950/30">
                <div class="flex items-center gap-3">
                    <img class="h-10 w-10 rounded-full border-2 border-primary-500"
                        src="https://ui-avatars.com/api/?name=Admin+Kebun&background=0D9488&color=fff" alt="">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">Administrator</p>
                        <p class="text-xs text-primary-400 truncate">admin@up.ac.id</p>
                    </div>
                    <button class="text-primary-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto h-screen relative">

            <div
                class="md:hidden bg-white/90 backdrop-blur-md border-b border-gray-200 p-4 sticky top-0 z-30 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/images/LogoKebunRaya.jpeg') }}" class="h-8 w-8 rounded-full">
                    <span class="font-bold text-gray-800">Kebun Raya</span>
                </div>
                <button @click="sidebarOpen = true"
                    class="text-gray-600 focus:outline-none bg-gray-100 p-2 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <div class="p-6 md:p-10">
                {{ $slot }}
            </div>

        </main>
    </div>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    @livewireScripts
</body>

</html>
