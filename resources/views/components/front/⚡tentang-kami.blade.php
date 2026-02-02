 <?php
 use Livewire\Attributes\Layout;
 use Livewire\Attributes\Computed;
 use Livewire\Component;
 use App\Models\Post;
 use App\Models\SiteSetting;
 
 new #[Layout('layouts.front')] 
 class extends Component {
     #[Computed]
     public function posts()
     {
         return Post::all();
     }

       public function with()
     {
         return [
             'site' => SiteSetting::first(),
         ];
     }
 };
 ?>
 <div>
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
                 pusat konservasi flora Sumatera.
             </p>
         </div>
     </section>

     <!-- About Content -->
     <section class="py-20 bg-white scroll-animate opacity-0 translate-y-10 transition-all duration-700">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="grid lg:grid-cols-2 gap-16 items-start">
                 <!-- Left Content -->
                 <div>
                     <span
                         class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                         🌿 Sejarah Kami
                     </span>
                     <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                         Perjalanan Kebun Raya <span class="text-gradient">Universitas Pahlawan</span>
                     </h2>

                     <div class="prose prose-lg text-gray-600">
                       {!! nl2br(e($site->about)) !!}
                     </div>
                 </div>

                 <!-- Right Image -->
                 <div class="relative">
                     <div
                         class="aspect-[4/3] bg-gradient-to-br from-primary-100 to-primary-200 rounded-3xl overflow-hidden shadow-2xl">
                         <div class="absolute inset-0 flex items-center justify-center p-8">
                             <div class="text-center">
                                 <div
                                     class="w-32 h-32 mx-auto mb-6 bg-primary-500/20 rounded-full flex items-center justify-center">
                                     <svg class="w-16 h-16 text-primary-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                             d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                         </path>
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
                             <div
                                 class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
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
                 <span
                     class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                     🎯 Visi & Misi
                 </span>
                 <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900">
                     Visi & <span class="text-gradient">Misi</span>
                 </h2>
             </div>

             <div class="grid md:grid-cols-2 gap-8">
                 <!-- Vision -->
                 <div class="bg-white rounded-3xl p-8 md:p-10 shadow-lg border border-gray-100">
                     <div
                         class="w-16 h-16 bg-gradient-to-br from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-primary-500/30">
                         <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                             </path>
                         </svg>
                     </div>
                     <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi</h3>
                     <p class="text-gray-600 text-lg leading-relaxed">
                         {{ $site->vision }}
                     </p>
                 </div>

                 <!-- Mission -->
                 <div class="bg-white rounded-3xl p-8 md:p-10 shadow-lg border border-gray-100">
                     <div
                         class="w-16 h-16 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-accent-500/30">
                         <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                             </path>
                         </svg>
                     </div>
                     <h3 class="text-2xl font-bold text-gray-900 mb-4">Misi</h3>
                     <ul class="space-y-3 text-gray-600">
                         <li class="flex items-start space-x-3">
                             <svg class="w-5 h-5 text-primary-500 mt-1 flex-shrink-0" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M5 13l4 4L19 7"></path>
                             </svg>
                             <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit konservasi tumbuhan.</span>
                         </li>
                         <li class="flex items-start space-x-3">
                             <svg class="w-5 h-5 text-primary-500 mt-1 flex-shrink-0" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M5 13l4 4L19 7"></path>
                             </svg>
                             <span>Sed ut perspiciatis unde omnis iste natus error penelitian botani.</span>
                         </li>
                         <li class="flex items-start space-x-3">
                             <svg class="w-5 h-5 text-primary-500 mt-1 flex-shrink-0" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M5 13l4 4L19 7"></path>
                             </svg>
                             <span>Nemo enim ipsam voluptatem quia voluptas sit edukasi masyarakat.</span>
                         </li>
                         <li class="flex items-start space-x-3">
                             <svg class="w-5 h-5 text-primary-500 mt-1 flex-shrink-0" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M5 13l4 4L19 7"></path>
                             </svg>
                             <span>Ut enim ad minima veniam, quis nostrum wisata alam edukatif.</span>
                         </li>
                     </ul>
                 </div>
             </div>
         </div>
     </section>

     <!-- Stats Section -->
     <section
         class="py-20 bg-gradient-botanical text-white scroll-animate opacity-0 translate-y-10 transition-all duration-700">
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
                 <span
                     class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
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
                         <span
                             class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                             🕐 Jam Kunjungan
                         </span>
                         <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Waktu Operasional</h2>

                         <div class="space-y-4">
                             <div class="flex items-start space-x-4 p-4 bg-primary-50 rounded-xl">
                                 <div
                                     class="w-12 h-12 bg-primary-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                     <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                         </path>
                                     </svg>
                                 </div>
                                 <div>
                                     <h4 class="font-semibold text-gray-900">Kunjungan Edukasi</h4>
                                     <p class="text-gray-600">Senin - Jum'at</p>
                                     <p class="text-primary-600 font-medium">08.00 - 16.00 WIB</p>
                                 </div>
                             </div>

                             <div class="flex items-start space-x-4 p-4 bg-accent-50 rounded-xl">
                                 <div
                                     class="w-12 h-12 bg-accent-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                     <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                         </path>
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
                     <div
                         class="bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center min-h-[300px]">
                         <div class="text-center p-8">
                             <div
                                 class="w-20 h-20 mx-auto mb-4 bg-primary-500/20 rounded-full flex items-center justify-center">
                                 <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                         d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                     </path>
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                         d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
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
                 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hubungi kami untuk informasi lebih lanjut
                 tentang kunjungan dan edukasi.
             </p>
             <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                 <a href="/"
                     class="px-8 py-4 bg-primary-500 hover:bg-primary-600 text-white font-semibold rounded-2xl transition-colors shadow-lg shadow-primary-500/30">
                     Kembali ke Beranda
                 </a>
                 <a href="/#kontak"
                     class="px-8 py-4 border-2 border-primary-500 text-primary-600 font-semibold rounded-2xl hover:bg-primary-50 transition-colors">
                     Hubungi Kami
                 </a>
             </div>
         </div>
     </section>
 </div>
