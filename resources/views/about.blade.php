<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tentang Kebun Raya Universitas Pahlawan Tuanku Tambusai - Sejarah, Visi Misi, dan Informasi Lengkap">
    <title>Tentang Kami - Kebun Raya Universitas Pahlawan</title>
    
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
                    <a href="/about" class="text-primary-300 font-medium">Tentang Kami</a>
                    <a href="#" class="text-white hover:text-primary-300 transition-colors font-medium">Repositori</a>
                    <a href="/#fungsi" class="text-white hover:text-primary-300 transition-colors font-medium">Fungsi</a>
                    <a href="/#kontak" class="text-white hover:text-primary-300 transition-colors font-medium">Kontak</a>
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
                    <a href="/about" class="text-primary-300 font-medium py-2">Tentang Kami</a>
                    <a href="#" class="text-white hover:text-primary-300 transition-colors font-medium py-2">Repositori</a>
                    <a href="/#fungsi" class="text-white hover:text-primary-300 transition-colors font-medium py-2">Fungsi</a>
                    <a href="/#kontak" class="text-white hover:text-primary-300 transition-colors font-medium py-2">Kontak</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Banner -->
    <section class="relative pt-32 pb-20 bg-gradient-hero overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-500/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-accent-500/20 rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <nav class="flex items-center justify-center space-x-2 text-primary-200 text-sm mb-6">
                <a href="/" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-white">Tentang Kami</span>
            </nav>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                Tentang <span class="text-gradient">Kebun Raya</span>
            </h1>
            <p class="text-lg md:text-xl text-primary-100/80 max-w-3xl mx-auto">
                Mengenal lebih dekat Kebun Raya Universitas Pahlawan Tuanku Tambusai, 
                pusat konservasi flora dataran rendah Sumatera.
            </p>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-20 bg-white scroll-animate opacity-0 translate-y-10 transition-all duration-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-start">
                <!-- Left Content -->
                <div>
                    <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                        🌿 Sejarah Kami
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                        Perjalanan Kebun Raya <span class="text-gradient">Universitas Pahlawan</span>
                    </h2>
                    
                    <div class="prose prose-lg text-gray-600">
                        <p class="leading-relaxed mb-6">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut perspiciatis unde omnis iste natus 
                            error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo 
                            inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem 
                            quia voluptas sit aspernatur aut odit aut fugit.
                        </p>
                        
                        <p class="leading-relaxed mb-6">
                            Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam 
                            est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius 
                            modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, 
                            quis nostrum exercitationem ullam corporis suscipit laboriosam.
                        </p>
                        
                        <p class="leading-relaxed">
                            Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, 
                            vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio 
                            dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.
                        </p>
                    </div>
                </div>
                
                <!-- Right Image -->
                <div class="relative">
                    <div class="aspect-[4/3] bg-gradient-to-br from-primary-100 to-primary-200 rounded-3xl overflow-hidden shadow-2xl">
                        <div class="absolute inset-0 flex items-center justify-center p-8">
                            <div class="text-center">
                                <div class="w-32 h-32 mx-auto mb-6 bg-primary-500/20 rounded-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-primary-700 font-semibold text-lg">300+ Spesies Tanaman</p>
                                <p class="text-primary-600">Terkonservasi di Kebun Raya</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating Card -->
                    <div class="absolute -bottom-8 -left-8 bg-white p-6 rounded-2xl shadow-2xl max-w-xs">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="text-3xl">🏛️</span>
                            </div>
                            <div>
                                <p class="text-gray-900 font-bold">Universitas Pahlawan</p>
                                <p class="text-gray-500 text-sm">Tuanku Tambusai, Riau</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Mission -->
    <section class="py-20 bg-gray-50 scroll-animate opacity-0 translate-y-10 transition-all duration-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                    🎯 Visi & Misi
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900">
                    Visi & <span class="text-gradient">Misi</span>
                </h2>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Vision -->
                <div class="bg-white rounded-3xl p-8 md:p-10 shadow-lg border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-primary-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi</h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Menjadi pusat konservasi tumbuhan terkemuka 
                        yang berkontribusi dalam pelestarian keanekaragaman hayati flora dataran rendah Sumatera dan menjadi 
                        rujukan penelitian botani tingkat nasional dan internasional.
                    </p>
                </div>
                
                <!-- Mission -->
                <div class="bg-white rounded-3xl p-8 md:p-10 shadow-lg border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-accent-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Misi</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-primary-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit konservasi tumbuhan.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-primary-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Sed ut perspiciatis unde omnis iste natus error penelitian botani.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-primary-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Nemo enim ipsam voluptatem quia voluptas sit edukasi masyarakat.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-primary-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Ut enim ad minima veniam, quis nostrum wisata alam edukatif.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gradient-botanical text-white scroll-animate opacity-0 translate-y-10 transition-all duration-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold mb-2">300+</div>
                    <div class="text-primary-200">Spesies Tanaman</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold mb-2">34+</div>
                    <div class="text-primary-200">Spesies Anggrek</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold mb-2">75</div>
                    <div class="text-primary-200">Hektar Luas Area</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold mb-2">5</div>
                    <div class="text-primary-200">Fungsi Utama</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities -->
    <section class="py-20 bg-white scroll-animate opacity-0 translate-y-10 transition-all duration-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                    🏢 Fasilitas
                </span>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Fasilitas <span class="text-gradient">Kebun Raya</span>
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Lorem ipsum dolor sit amet, berbagai fasilitas pendukung konservasi dan kenyamanan pengunjung.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Facility 1 -->
                <div class="bg-gray-50 rounded-2xl p-6 text-center card-hover">
                    <div class="w-14 h-14 mx-auto mb-4 bg-primary-100 rounded-xl flex items-center justify-center">
                        <span class="text-2xl">🌱</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Rumah Kaca Pembibitan</h3>
                    <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                
                <!-- Facility 2 -->
                <div class="bg-gray-50 rounded-2xl p-6 text-center card-hover">
                    <div class="w-14 h-14 mx-auto mb-4 bg-primary-100 rounded-xl flex items-center justify-center">
                        <span class="text-2xl">🏛️</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Kantor Pengelola</h3>
                    <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                
                <!-- Facility 3 -->
                <div class="bg-gray-50 rounded-2xl p-6 text-center card-hover">
                    <div class="w-14 h-14 mx-auto mb-4 bg-primary-100 rounded-xl flex items-center justify-center">
                        <span class="text-2xl">🛤️</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Akses Jalan</h3>
                    <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                
                <!-- Facility 4 -->
                <div class="bg-gray-50 rounded-2xl p-6 text-center card-hover">
                    <div class="w-14 h-14 mx-auto mb-4 bg-primary-100 rounded-xl flex items-center justify-center">
                        <span class="text-2xl">🚪</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Gerbang Utama</h3>
                    <p class="text-gray-600 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visit Info -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="grid md:grid-cols-2">
                    <!-- Info -->
                    <div class="p-8 md:p-12">
                        <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                            🕐 Jam Kunjungan
                        </span>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Waktu Operasional</h2>
                        
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4 p-4 bg-primary-50 rounded-xl">
                                <div class="w-12 h-12 bg-primary-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Kunjungan Edukasi</h4>
                                    <p class="text-gray-600">Senin - Jum'at</p>
                                    <p class="text-primary-600 font-medium">08.00 - 16.00 WIB</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4 p-4 bg-accent-50 rounded-xl">
                                <div class="w-12 h-12 bg-accent-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Kunjungan Umum</h4>
                                    <p class="text-gray-600">Senin - Minggu</p>
                                    <p class="text-accent-600 font-medium">07.00 - 17.00 WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Map Placeholder -->
                    <div class="bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center min-h-[300px]">
                        <div class="text-center p-8">
                            <div class="w-20 h-20 mx-auto mb-4 bg-primary-500/20 rounded-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <p class="text-primary-700 font-semibold">Lokasi Kebun Raya</p>
                            <p class="text-primary-600 text-sm">Universitas Pahlawan Tuanku Tambusai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                Tertarik Mengunjungi <span class="text-gradient">Kebun Raya?</span>
            </h2>
            <p class="text-gray-600 text-lg mb-8">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hubungi kami untuk informasi lebih lanjut tentang kunjungan dan edukasi.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/" class="px-8 py-4 bg-primary-500 hover:bg-primary-600 text-white font-semibold rounded-2xl transition-colors shadow-lg shadow-primary-500/30">
                    Kembali ke Beranda
                </a>
                <a href="/#kontak" class="px-8 py-4 border-2 border-primary-500 text-primary-600 font-semibold rounded-2xl hover:bg-primary-50 transition-colors">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary-950 text-white">
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
                        <li><a href="/#fungsi" class="text-gray-400 hover:text-white transition-colors">Fungsi</a></li>
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
