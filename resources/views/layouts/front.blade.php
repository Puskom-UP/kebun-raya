<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $site = \App\Models\SiteSetting::first();
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Kebun Raya Universitas Pahlawan Tuanku Tambusai - Pusat Konservasi, Penelitian, dan Edukasi Flora">
    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50 font-sans antialiased">

    <!-- Sticky Navbar -->
    <header x-data="{
        isScrolled: false,
        mobileOpen: false
    }" @scroll.window="isScrolled = (window.pageYOffset > 20)"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-in-out"
        :class="isScrolled
            ?
            'bg-white/90 backdrop-blur-md shadow-md py-2' :
            'bg-primary-900/30 backdrop-blur-md border-b border-white/10 py-4'">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-12 md:h-14">

                <a href="/" class="flex items-center space-x-3 group">
                    <img src="{{ asset('assets/images/LogoKebunRaya.jpeg') }}" alt="Logo"
                        class="h-10 w-10 rounded-full shadow-lg transition-transform duration-300 group-hover:scale-110"
                        onerror="this.style.display='none'">

                    <div class="hidden sm:block">
                        <span class="block font-bold text-lg leading-tight transition-colors duration-300"
                            :class="isScrolled ? 'text-primary-900' : 'text-white drop-shadow-md'">
                            Kebun Raya
                        </span>
                        <span class="block text-xs font-medium transition-colors duration-300"
                            :class="isScrolled ? 'text-primary-600' : 'text-primary-200'">
                            Universitas Pahlawan
                        </span>
                    </div>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('tentang-kami') }}" wire:navigate
                        class="font-medium text-sm transition-all duration-300 hover:-translate-y-0.5"
                        :class="isScrolled ? 'text-gray-600 hover:text-primary-700' :
                            'text-white/90 hover:text-white hover:drop-shadow-lg'">
                        Tentang Kami
                    </a>

                    <a href="{{ route('news.index') }}" wire:navigate
                        class="px-4 py-3 text-white hover:bg-white/10 transition-colors font-medium border-b border-white/5">
                        Berita
                    </a>
                    <a href="#" class="font-medium text-sm transition-all duration-300 hover:-translate-y-0.5"
                        :class="isScrolled ? 'text-gray-600 hover:text-primary-700' :
                            'text-white/90 hover:text-white hover:drop-shadow-lg'">
                        Repositori
                    </a>

                    <a href="#fungsi" class="font-medium text-sm transition-all duration-300 hover:-translate-y-0.5"
                        :class="isScrolled ? 'text-gray-600 hover:text-primary-700' :
                            'text-white/90 hover:text-white hover:drop-shadow-lg'">
                        Fungsi
                    </a>

                    <a href="#kontak" class="font-medium text-sm transition-all duration-300 hover:-translate-y-0.5"
                        :class="isScrolled ? 'text-gray-600 hover:text-primary-700' :
                            'text-white/90 hover:text-white hover:drop-shadow-lg'">
                        kontak
                    </a>

                    <a href="/login" wire:navigate
                        class="px-4 py-2 rounded-full font-medium text-sm transition-all duration-300 shadow-sm"
                        :class="isScrolled
                            ?
                            'bg-primary-600 text-white hover:bg-primary-700' :
                            'bg-white/10 text-white border border-white/20 hover:bg-white/20 backdrop-blur-sm'">
                        Login
                    </a>
                </div>

                <button @click="mobileOpen = !mobileOpen"
                    class="md:hidden p-2 rounded-lg transition-colors focus:outline-none"
                    :class="isScrolled ? 'text-gray-800 hover:bg-gray-100' : 'text-white hover:bg-white/10'">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                class="md:hidden mt-2 bg-primary-900/80 backdrop-blur-xl border border-white/10 rounded-xl shadow-2xl overflow-hidden"
                style="display: none;">
                <div class="flex flex-col py-2">
                    <a href="{{ route('tentang-kami') }}" wire:navigate
                        class="px-4 py-3 text-white hover:bg-white/10 transition-colors font-medium border-b border-white/5">
                        Tentang Kami
                    </a>
                    <a href="{{ route('news.index') }}" wire:navigate
                        class="px-4 py-3 text-white hover:bg-white/10 transition-colors font-medium border-b border-white/5">
                        Berita
                    </a>
                    <a href="#"
                        class="px-4 py-3 text-white hover:bg-white/10 transition-colors font-medium border-b border-white/5">
                        Repositori
                    </a>
                    <a href="#fungsi"
                        class="px-4 py-3 text-white hover:bg-white/10 transition-colors font-medium border-b border-white/5">
                        Fungsi
                    </a>
                    <a href="#kontak" class="px-4 py-3 text-white hover:bg-white/10 transition-colors font-medium">
                        Kontak
                    </a>

                    <a href="/login" wire:navigate
                        class="px-4 py-2 rounded-full font-medium text-sm transition-all duration-300 shadow-sm"
                        :class="isScrolled
                            ?
                            'bg-primary-600 text-white hover:bg-primary-700' :
                            'bg-white/10 text-white border border-white/20 hover:bg-white/20 backdrop-blur-sm'">
                        Login
                    </a>
                </div>
            </div>
        </nav>
    </header>

    {{-- SLOT --}}


    {{ $slot }}
    <!-- Footer -->
    <footer id="kontak" class="bg-primary-950 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Brand -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <img src="{{ asset('assets/images/LogoKebunRaya.jpeg') }}" alt="Logo"
                            class="h-12 w-auto rounded-full" onerror="this.style.display='none'">
                        <div>
                            <h3 class="text-xl font-bold">Kebun Raya</h3>
                            <p class="text-primary-400 text-sm">Universitas Pahlawan Tuanku Tambusai</p>
                        </div>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6 max-w-md">
                        {{ $site->description ?? '-' }}
                    </p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-primary-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-primary-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-primary-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Navigasi</h4>
                    <ul class="space-y-4">
                        <li><a href="/" class="text-gray-400 hover:text-white transition-colors">Beranda</a>
                        </li>
                        <li><a href="/about" class="text-gray-400 hover:text-white transition-colors">Tentang
                                Kami</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Repositori</a>
                        </li>
                        <li><a href="#fungsi" class="text-gray-400 hover:text-white transition-colors">Fungsi</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="overflow-hidden">
                    <h4 class="text-lg font-semibold mb-6">Kontak</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-primary-400 mt-1 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-400 break-words">{{ $site->address ?? '' }}</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-primary-400 flex-shrink-0 mt-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span class="text-gray-400 break-all text-sm">{{ $site->email ?? '' }}</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            <span class="text-gray-400">{{ $site->phone ?? '' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-gray-500 text-sm text-center md:text-left">
                        © 2026 {{ $site->site_name ?? 'Kebun Raya' }}. All rights reserved.
                    </p>
                    <div class="flex items-center space-x-6">
                        <a href="#" class="text-gray-500 hover:text-white text-sm transition-colors">Kebijakan
                            Privasi</a>
                        <a href="#" class="text-gray-500 hover:text-white text-sm transition-colors">Syarat &
                            Ketentuan</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @livewireScripts

    <script>
        function initCustomScripts() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');

            if (btn && menu) {
                btn.replaceWith(btn.cloneNode(true));
                const newBtn = document.getElementById('mobile-menu-btn');

                newBtn.addEventListener('click', function() {
                    menu.classList.toggle('hidden');
                });
            }

            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        // Opsional: Stop observe setelah animasi selesai agar ringan
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.scroll-animate').forEach(el => {
                observer.observe(el);
            });
        }


        document.addEventListener('DOMContentLoaded', () => {
            initCustomScripts();
        });


        document.addEventListener('livewire:navigated', () => {
            initCustomScripts();
        });
    </script>


</body>

</html>
