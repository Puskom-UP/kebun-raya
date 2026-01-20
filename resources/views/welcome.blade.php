<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kebun Raya Universitas Pahlawan Tuanku Tambusai - Pusat Konservasi, Penelitian, dan Edukasi Flora">
    <title>Kebun Raya Universitas Pahlawan</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    
    <!-- Sticky Navbar -->
    <header class="fixed top-0 left-0 right-0 z-50 glass-effect bg-primary-900/90">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-3">
                    <img src="{{ asset('assets/images/LogoKebunRaya.jpeg') }}" alt="Logo Kebun Raya" class="h-10 md:h-12 w-auto rounded-full" onerror="this.style.display='none'">
                    <div class="hidden sm:block">
                        <span class="text-white font-bold text-lg md:text-xl">Kebun Raya</span>
                        <span class="block text-primary-300 text-xs md:text-sm">Universitas Pahlawan</span>
                    </div>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/about" class="text-white hover:text-primary-300 transition-colors font-medium">Tentang Kami</a>
                    <a href="#" class="text-white hover:text-primary-300 transition-colors font-medium">Repositori</a>
                    <a href="#fungsi" class="text-white hover:text-primary-300 transition-colors font-medium">Fungsi</a>
                    <a href="#kontak" class="text-white hover:text-primary-300 transition-colors font-medium">Kontak</a>
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden text-white p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="/about" class="text-white hover:text-primary-300 transition-colors font-medium py-2">Tentang Kami</a>
                    <a href="#" class="text-white hover:text-primary-300 transition-colors font-medium py-2">Repositori</a>
                    <a href="#fungsi" class="text-white hover:text-primary-300 transition-colors font-medium py-2">Fungsi</a>
                    <a href="#kontak" class="text-white hover:text-primary-300 transition-colors font-medium py-2">Kontak</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative min-h-screen bg-gradient-hero flex items-center justify-center overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-500/20 rounded-full blur-3xl animate-float"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-accent-500/20 rounded-full blur-3xl animate-float" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary-400/10 rounded-full blur-3xl"></div>
        </div>
        
        <!-- Leaf Pattern Overlay -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <pattern id="leaf-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <path d="M10 2 Q15 10 10 18 Q5 10 10 2" fill="currentColor" class="text-white"/>
                </pattern>
                <rect width="100%" height="100%" fill="url(#leaf-pattern)"/>
            </svg>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
            <div class="animate-fade-in-up">
                <span class="inline-block px-4 py-2 bg-primary-500/20 text-primary-300 rounded-full text-sm font-medium mb-6">
                    🌿 Pusat Konservasi Flora Sumatera
                </span>
                
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    Kebun Raya<br>
                    <span class="text-gradient">Universitas Pahlawan</span>
                </h1>
                
                <p class="text-lg md:text-xl text-primary-100/80 max-w-3xl mx-auto mb-10 leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Kebun Raya Universitas Pahlawan Tuanku Tambusai 
                    merupakan pusat konservasi tumbuhan yang mengusung tema pelestarian flora dataran rendah Sumatera. 
                    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
                    <a href="/about" class="group px-8 py-4 bg-primary-500 hover:bg-primary-400 text-white font-semibold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-primary-500/50 animate-pulse-glow">
                        Selengkapnya
                        <svg class="inline-block w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="#fungsi" class="px-8 py-4 border-2 border-white/30 text-white font-semibold rounded-2xl hover:bg-white/10 transition-all duration-300">
                        Jelajahi Fungsi
                    </a>
                </div>
            </div>
            
            <!-- Scroll Indicator -->
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>

    <!-- About Preview Section -->
    <section class="py-20 md:py-28 bg-white scroll-animate opacity-0 translate-y-10 transition-all duration-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="animate-fade-in-up">
                    <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                        Tentang Kami
                    </span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                        Menjaga Warisan <span class="text-gradient">Flora Nusantara</span>
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam, quis nostrud 
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in 
                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim 
                        id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.
                    </p>
                    <a href="/about" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold group">
                        Baca Selengkapnya
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <div class="relative">
                    <div class="aspect-square bg-gradient-to-br from-primary-100 to-primary-200 rounded-3xl overflow-hidden shadow-2xl">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center p-8">
                                <div class="w-24 h-24 mx-auto mb-4 bg-primary-500/20 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <p class="text-primary-700 font-medium">300+ Spesies Tanaman</p>
                                <p class="text-primary-600 text-sm">Terkonservasi</p>
                            </div>
                        </div>
                    </div>
                    <!-- Floating stats -->
                    <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-accent-500/20 rounded-xl flex items-center justify-center">
                                <span class="text-2xl">🌱</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">34+</p>
                                <p class="text-gray-500 text-sm">Spesies Anggrek</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Awards Section -->
    <section class="py-20 md:py-28 bg-gray-50 scroll-animate opacity-0 translate-y-10 transition-all duration-700">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                    🏆 Penghargaan
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Prestasi & <span class="text-gradient">Penghargaan</span>
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Berbagai penghargaan yang telah diraih.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Award Card 1 -->
                <div class="bg-white rounded-3xl p-8 shadow-lg card-hover border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-yellow-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Terbaik 1</h3>
                    <h4 class="text-primary-600 font-semibold mb-3">Pengelola Anggaran Terbaik</h4>
                    <p class="text-gray-600 leading-relaxed">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam, quis nostrud 
                        exercitation ullamco laboris nisi ut aliquip.
                    </p>
                </div>
                
                <!-- Award Card 2 -->
                <div class="bg-white rounded-3xl p-8 shadow-lg card-hover border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-primary-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Terbaik 3</h3>
                    <h4 class="text-primary-600 font-semibold mb-3">Kebun Raya Daerah Terbaik</h4>
                    <p class="text-gray-600 leading-relaxed">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pembangunan dan pengelolaan Kebun Raya 
                        di Indonesia yang diakui secara nasional.
                    </p>
                </div>
                
                <!-- Award Card 3 -->
                <div class="bg-white rounded-3xl p-8 shadow-lg card-hover border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2m10 2V2M3 8h18M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Terbaik 3</h3>
                    <h4 class="text-primary-600 font-semibold mb-3">Pengelolaan Media Sosial</h4>
                    <p class="text-gray-600 leading-relaxed">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Kategori pengelolaan media sosial 
                        terbaik di lingkungan universitas.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5 Fungsi Section -->
    <section id="fungsi" class="py-20 md:py-28 bg-gradient-botanical text-white scroll-animate opacity-0 translate-y-10 transition-all duration-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-white/20 text-white rounded-full text-sm font-medium mb-4">
                    🌳 Lima Pilar Utama
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                    Fungsi Kebun Raya
                </h2>
                <p class="text-primary-100/80 text-lg max-w-2xl mx-auto">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lima fungsi utama yang menjadi pilar kebun raya.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <!-- Konservasi -->
                <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-6 text-center card-hover border border-white/20">
                    <div class="w-20 h-20 mx-auto mb-4 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Konservasi</h3>
                    <p class="text-primary-100/70 text-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pelestarian flora langka.
                    </p>
                </div>
                
                <!-- Penelitian -->
                <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-6 text-center card-hover border border-white/20">
                    <div class="w-20 h-20 mx-auto mb-4 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Penelitian</h3>
                    <p class="text-primary-100/70 text-sm">
                        Lorem ipsum dolor sit amet. Pusat riset dan pengembangan botani.
                    </p>
                </div>
                
                <!-- Edukasi -->
                <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-6 text-center card-hover border border-white/20">
                    <div class="w-20 h-20 mx-auto mb-4 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Edukasi</h3>
                    <p class="text-primary-100/70 text-sm">
                        Lorem ipsum dolor sit amet. Pembelajaran tentang keanekaragaman hayati.
                    </p>
                </div>
                
                <!-- Wisata -->
                <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-6 text-center card-hover border border-white/20">
                    <div class="w-20 h-20 mx-auto mb-4 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Wisata</h3>
                    <p class="text-primary-100/70 text-sm">
                        Lorem ipsum dolor sit amet. Destinasi wisata alam yang menarik.
                    </p>
                </div>
                
                <!-- Jasa Lingkungan -->
                <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-6 text-center card-hover border border-white/20">
                    <div class="w-20 h-20 mx-auto mb-4 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Jasa Lingkungan</h3>
                    <p class="text-primary-100/70 text-sm">
                        Lorem ipsum dolor sit amet. Penyedia layanan ekosistem berkelanjutan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media Section -->
    <section class="py-20 md:py-28 bg-white scroll-animate opacity-0 translate-y-10 transition-all duration-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                📱 Ikuti Kami
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                Tetap <span class="text-gradient">Terhubung</span>
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-12">
                Ikuti kami di media sosial untuk mendapatkan informasi terkini tentang kegiatan dan acara di Kebun Raya.
            </p>
            
            <div class="flex flex-wrap items-center justify-center gap-6">
                <!-- Instagram -->
                <a href="#" class="group flex items-center space-x-3 bg-gradient-to-br from-purple-500 via-pink-500 to-orange-400 p-4 pr-6 rounded-2xl text-white card-hover shadow-lg shadow-pink-500/30">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/>
                        </svg>
                    </div>
                    <span class="font-semibold">Instagram</span>
                </a>
                
                <!-- YouTube -->
                <a href="#" class="group flex items-center space-x-3 bg-gradient-to-br from-red-500 to-red-600 p-4 pr-6 rounded-2xl text-white card-hover shadow-lg shadow-red-500/30">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </div>
                    <span class="font-semibold">YouTube</span>
                </a>
                
                <!-- Facebook -->
                <a href="#" class="group flex items-center space-x-3 bg-gradient-to-br from-blue-600 to-blue-700 p-4 pr-6 rounded-2xl text-white card-hover shadow-lg shadow-blue-500/30">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </div>
                    <span class="font-semibold">Facebook</span>
                </a>
                
                <!-- Twitter/X -->
                <a href="#" class="group flex items-center space-x-3 bg-gradient-to-br from-gray-800 to-gray-900 p-4 pr-6 rounded-2xl text-white card-hover shadow-lg shadow-gray-500/30">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </div>
                    <span class="font-semibold">Twitter</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="bg-primary-950 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Brand -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <img src="{{ asset('assets/images/LogoKebunRaya.jpeg') }}" alt="Logo" class="h-12 w-auto rounded-full" onerror="this.style.display='none'">
                        <div>
                            <h3 class="text-xl font-bold">Kebun Raya</h3>
                            <p class="text-primary-400 text-sm">Universitas Pahlawan Tuanku Tambusai</p>
                        </div>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6 max-w-md">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pusat konservasi tumbuhan dataran rendah 
                        Sumatera dengan berbagai koleksi flora langka dan endemik.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-primary-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-primary-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-primary-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Navigasi</h4>
                    <ul class="space-y-4">
                        <li><a href="/" class="text-gray-400 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="/about" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Repositori</a></li>
                        <li><a href="#fungsi" class="text-gray-400 hover:text-white transition-colors">Fungsi</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div class="overflow-hidden">
                    <h4 class="text-lg font-semibold mb-6">Kontak</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-primary-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-400 break-words">Universitas Pahlawan Tuanku Tambusai, Riau</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-primary-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-400 break-all text-sm">kebunraya@universitaspahlawan.ac.id</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-400">+62 812 3456 7890</span>
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
                        © 2026 Kebun Raya Universitas Pahlawan Tuanku Tambusai. All rights reserved.
                    </p>
                    <div class="flex items-center space-x-6">
                        <a href="#" class="text-gray-500 hover:text-white text-sm transition-colors">Kebijakan Privasi</a>
                        <a href="#" class="text-gray-500 hover:text-white text-sm transition-colors">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Scroll Animation with Intersection Observer
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
                }
            });
        }, observerOptions);

        document.querySelectorAll('.scroll-animate').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
