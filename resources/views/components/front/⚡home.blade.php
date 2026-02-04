 <?php
 use Livewire\Attributes\Layout;
 use Livewire\Attributes\Computed;
 use Livewire\Component;
 use App\Models\Post;
 use App\Models\Partner;
 use App\Models\SiteSetting;
 use App\Models\Penghargaan;
 
 new #[Layout('layouts.front')] class extends Component {
     #[Computed]
     public function posts()
     {
         return Post::where('status', 'published')->latest()->take(6)->get();
     }
 
     public function with()
     {
         return [
             'site' => SiteSetting::first() ?? new SiteSetting(),
 
             'partners' => Partner::where('status', 'published')->latest()->get(),
 
             'penghargaans' => Penghargaan::latest()->take(3)->get(),
         ];
     }
 };
 ?>
 <div>
     <section class="relative min-h-screen bg-gradient-hero flex items-center justify-center overflow-hidden">
         <div class="absolute inset-0 overflow-hidden">
             <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-500/20 rounded-full blur-3xl animate-float">
             </div>
             <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-accent-500/20 rounded-full blur-3xl animate-float"
                 style="animation-delay: 1s;"></div>
             <div
                 class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary-400/10 rounded-full blur-3xl">
             </div>
         </div>

         <div class="absolute inset-0 opacity-5">
             <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                 <pattern id="leaf-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                     <path d="M10 2 Q15 10 10 18 Q5 10 10 2" fill="currentColor" class="text-white" />
                 </pattern>
                 <rect width="100%" height="100%" fill="url(#leaf-pattern)" />
             </svg>
         </div>

         <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-24">
             <div class="animate-fade-in-up">
                 <span
                     class="inline-block px-4 py-2 bg-primary-500/20 text-primary-300 rounded-full text-sm font-medium mb-6 backdrop-blur-sm border border-primary-500/30">
                     🌿 Pusat Konservasi Flora Sumatera
                 </span>
                 @php
                     $fullName = $site->site_name ?? 'Kebun Raya | Universitas Pahlawan';

                     $parts = explode('|', $fullName);
                     $part1 = trim($parts[0]);
                     $part2 = isset($parts[1]) ? trim($parts[1]) : '';
                 @endphp
                 <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight drop-shadow-lg">
                     {{-- Baris Pertama (Putih Polos) --}}
                     {{ $part1 }}

                     @if ($part2)
                         <br>
                         {{-- Baris Kedua (Gradient Text) --}}
                         <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-200 to-white">
                             {{ $part2 }}
                         </span>
                     @endif
                 </h1>

                 <p
                     class="text-lg md:text-xl text-primary-100/90 max-w-3xl mx-auto mb-10 leading-relaxed drop-shadow-md">

                     {{ $site->description ?? '-' }}

                 </p>

                 <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
                     <a href="/about"
                         class="group px-8 py-4 bg-primary-600 hover:bg-primary-500 text-white font-semibold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-primary-500/50 hover:-translate-y-1">
                         Selengkapnya
                         <svg class="inline-block w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                         </svg>
                     </a>
                     <a href="#fungsi"
                         class="px-8 py-4 border-2 border-white/30 text-white font-semibold rounded-2xl hover:bg-white/10 transition-all duration-300 hover:-translate-y-1 backdrop-blur-sm">
                         Jelajahi Fungsi
                     </a>
                 </div>
             </div>

             <div class="absolute -bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
                 <svg class="w-8 h-8 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                 </svg>
             </div>
         </div>
     </section>

     <section class="py-20 md:py-28 bg-white scroll-animate opacity-0 translate-y-10 transition-all duration-700">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="grid lg:grid-cols-2 gap-12 items-center">
                 <div class="animate-fade-in-up">
                     <span
                         class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                         Tentang Kami
                     </span>
                     <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                         Menjaga Warisan <span class="text-primary-600">Flora Nusantara</span>
                     </h2>
                     <p class="text-gray-600 text-lg leading-relaxed mb-6">
                         Kami berdedikasi untuk melestarikan keanekaragaman hayati Sumatera melalui konservasi ex-situ,
                         penelitian, dan pendidikan lingkungan.
                     </p>
                     <p class="text-gray-600 text-lg leading-relaxed mb-8">
                         Sebagai bagian dari Universitas Pahlawan, kami mengintegrasikan ilmu pengetahuan dengan
                         keindahan alam untuk menciptakan ruang hijau yang edukatif.
                     </p>
                     <a href="/about"
                         class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold group text-lg">
                         Baca Selengkapnya
                         <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                         </svg>
                     </a>
                 </div>

                 <div class="relative">
                     <div
                         class="aspect-square bg-gradient-to-br from-primary-100 to-primary-200 rounded-3xl overflow-hidden shadow-2xl relative">
                         <div class="absolute inset-0 bg-primary-900/10 z-10"></div>
                         <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                             alt="Tanaman" class="w-full h-full object-cover">

                         <div class="absolute inset-0 flex items-center justify-center z-20">
                             <div
                                 class="text-center p-8 bg-white/90 backdrop-blur-md rounded-2xl shadow-xl transform hover:scale-105 transition-transform duration-300">
                                 <div
                                     class="w-20 h-20 mx-auto mb-4 bg-primary-100 rounded-full flex items-center justify-center">
                                     <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                             d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                         </path>
                                     </svg>
                                 </div>
                                 <p class="text-3xl font-bold text-gray-900">300+</p>
                                 <p class="text-gray-600 text-sm font-medium uppercase tracking-wider">Spesies Tanaman
                                 </p>
                             </div>
                         </div>
                     </div>
                     <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl z-30 animate-float"
                         style="animation-duration: 4s;">
                         <div class="flex items-center space-x-3">
                             <div class="w-12 h-12 bg-accent-100 rounded-xl flex items-center justify-center">
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

     <section class="py-20 md:py-28 bg-gray-50 scroll-animate opacity-0 translate-y-10 transition-all duration-700">

         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-16">
                 <span
                     class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                     🏆 Penghargaan
                 </span>
                 <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                     Prestasi & <span class="text-primary-600">Pengakuan</span>
                 </h2>
                 <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                     Komitmen kami terhadap pelestarian lingkungan dan manajemen taman yang berkelanjutan.
                 </p>
             </div>

             <div class="grid md:grid-cols-3 gap-8">

                 @foreach ($penghargaans as $penghargaan)
                     <div
                         class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100 relative overflow-hidden group">
                         <div
                             class="absolute top-0 right-0 bg-primary-500 w-16 h-16 rounded-bl-full -mr-8 -mt-8 opacity-10 group-hover:scale-150 transition-transform duration-500">
                         </div>
                         <div
                             class="w-16 h-16 bg-gradient-to-br from-{{ $penghargaan->warna }}-400 to-{{ $penghargaan->warna }}-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-{{ $penghargaan->warna }}-500/30">
                             {{-- <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                 </path>
                             </svg> --}}
                             {!! $penghargaan->icon !!}


                         </div>
                         <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $penghargaan->peringkat }}</h3>
                         <h4 class="text-primary-600 font-semibold mb-4">{{ $penghargaan->nama_penghargaan }}</h4>
                         <p class="text-gray-600 leading-relaxed text-sm">
                             {{ $penghargaan->deskripsi }}
                         </p>
                     </div>
                 @endforeach
                
             </div>
         </div>
     </section>

     <section id="fungsi"
         class="py-20 md:py-28 bg-primary-900 text-white scroll-animate opacity-0 translate-y-10 transition-all duration-700 relative overflow-hidden">

         <div class="absolute inset-0 opacity-10">
             <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                 <path d="M0 100 C 20 0 50 0 100 100 Z" fill="currentColor" />
             </svg>
         </div>

         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
             <div class="text-center mb-16">
                 <span
                     class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md text-white rounded-full text-sm font-medium mb-4 border border-white/20">
                     🌳 Lima Pilar Utama
                 </span>
                 <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                     Fungsi Kebun Raya
                 </h2>
                 <p class="text-primary-100/80 text-lg max-w-2xl mx-auto">
                     Landasan operasional kami dalam memberikan manfaat bagi alam dan masyarakat.
                 </p>
             </div>

             <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                 <div
                     class="group bg-white/5 backdrop-blur-sm rounded-3xl p-6 text-center hover:bg-white/10 transition-all duration-300 border border-white/10 hover:transform hover:-translate-y-2">
                     <div
                         class="w-16 h-16 mx-auto mb-6 bg-white/10 rounded-2xl flex items-center justify-center group-hover:bg-primary-500 transition-colors">
                         <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                 d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                             </path>
                         </svg>
                     </div>
                     <h3 class="text-lg font-bold mb-2">Konservasi</h3>
                     <p class="text-primary-100/70 text-sm leading-relaxed">
                         Pelestarian flora langka dan endemik secara ex-situ.
                     </p>
                 </div>

                 <div
                     class="group bg-white/5 backdrop-blur-sm rounded-3xl p-6 text-center hover:bg-white/10 transition-all duration-300 border border-white/10 hover:transform hover:-translate-y-2">
                     <div
                         class="w-16 h-16 mx-auto mb-6 bg-white/10 rounded-2xl flex items-center justify-center group-hover:bg-primary-500 transition-colors">
                         <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                 d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                             </path>
                         </svg>
                     </div>
                     <h3 class="text-lg font-bold mb-2">Penelitian</h3>
                     <p class="text-primary-100/70 text-sm leading-relaxed">
                         Pusat riset botani dan pengembangan ilmu pengetahuan.
                     </p>
                 </div>

                 <div
                     class="group bg-white/5 backdrop-blur-sm rounded-3xl p-6 text-center hover:bg-white/10 transition-all duration-300 border border-white/10 hover:transform hover:-translate-y-2">
                     <div
                         class="w-16 h-16 mx-auto mb-6 bg-white/10 rounded-2xl flex items-center justify-center group-hover:bg-primary-500 transition-colors">
                         <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                 d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                             </path>
                         </svg>
                     </div>
                     <h3 class="text-lg font-bold mb-2">Edukasi</h3>
                     <p class="text-primary-100/70 text-sm leading-relaxed">
                         Sarana pembelajaran alam bagi pelajar dan masyarakat.
                     </p>
                 </div>

                 <div
                     class="group bg-white/5 backdrop-blur-sm rounded-3xl p-6 text-center hover:bg-white/10 transition-all duration-300 border border-white/10 hover:transform hover:-translate-y-2">
                     <div
                         class="w-16 h-16 mx-auto mb-6 bg-white/10 rounded-2xl flex items-center justify-center group-hover:bg-primary-500 transition-colors">
                         <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                 d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                             </path>
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                 d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                         </svg>
                     </div>
                     <h3 class="text-lg font-bold mb-2">Wisata</h3>
                     <p class="text-primary-100/70 text-sm leading-relaxed">
                         Destinasi ekowisata yang asri, sejuk, dan instagramable.
                     </p>
                 </div>

                 <div
                     class="group bg-white/5 backdrop-blur-sm rounded-3xl p-6 text-center hover:bg-white/10 transition-all duration-300 border border-white/10 hover:transform hover:-translate-y-2">
                     <div
                         class="w-16 h-16 mx-auto mb-6 bg-white/10 rounded-2xl flex items-center justify-center group-hover:bg-primary-500 transition-colors">
                         <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                 d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                             </path>
                         </svg>
                     </div>
                     <h3 class="text-lg font-bold mb-2">Jasa Lingkungan</h3>
                     <p class="text-primary-100/70 text-sm leading-relaxed">
                         Penghasil oksigen, penyerap karbon, dan penjaga tata air.
                     </p>
                 </div>
             </div>
         </div>
     </section>
     <section class="py-20 md:py-28 bg-gray-50 scroll-animate opacity-0 translate-y-10 transition-all duration-700">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-16">
                 <span
                     class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                     📰 Kabar Terbaru
                 </span>
                 <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                     Berita & <span class="text-primary-600">Artikel</span>
                 </h2>
                 <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                     Ikuti perkembangan terkini, kegiatan konservasi, dan artikel edukatif dari Kebun Raya.
                 </p>
             </div>

             <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                 @forelse($this->posts as $post)
                     <article
                         class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden group flex flex-col h-full hover:-translate-y-2">

                         <div class="relative h-56 overflow-hidden">
                             @if ($post->image)
                                 <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                             @else
                                 <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                     <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                         </path>
                                     </svg>
                                 </div>
                             @endif

                             <div class="absolute top-4 left-4">
                                 <span
                                     class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-primary-600 shadow-sm uppercase tracking-wide">
                                     {{ $post->category->name ?? 'Berita' }}
                                 </span>
                             </div>
                         </div>

                         <div class="p-6 flex flex-col flex-grow">
                             <div class="flex items-center text-gray-500 text-sm mb-3">
                                 <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                     </path>
                                 </svg>
                                 {{ $post->created_at->format('d M Y') }}
                             </div>

                             <h3
                                 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                 <a href="#">
                                     {{ $post->title }}
                                 </a>
                             </h3>

                             <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                 {{ Str::limit(strip_tags($post->content), 120) }}
                             </p>

                             <div class="mt-auto pt-4 border-t border-gray-100">
                                 <a href="{{ route('berita.show', $post->slug) }}" wire:navigate
                                     class="inline-flex items-center text-primary-600 font-semibold text-sm hover:text-primary-700 group/link">
                                     Baca Selengkapnya
                                     <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                     </svg>
                                 </a>
                             </div>
                         </div>
                     </article>
                 @empty
                     <div
                         class="col-span-1 md:col-span-3 text-center py-12 bg-gray-50 rounded-3xl border border-dashed border-gray-300">
                         <div class="mx-auto h-12 w-12 text-gray-400">
                             <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                 </path>
                             </svg>
                         </div>
                         <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada berita</h3>
                         <p class="mt-1 text-sm text-gray-500">Kabar terbaru akan segera hadir.</p>
                     </div>
                 @endforelse
             </div>

             <div class="text-center mt-12">
                 <a href="{{ route('news.index') }}" wire:navigate
                     class="inline-block px-8 py-3 border border-primary-600 text-primary-600 font-semibold rounded-xl hover:bg-primary-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-lg">
                     Lihat Semua Berita
                 </a>
             </div>
         </div>
     </section>
     <section class="py-20 md:py-28 bg-white scroll-animate opacity-0 translate-y-10 transition-all duration-700">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
             <span
                 class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4">
                 📱 Ikuti Kami
             </span>
             <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                 Tetap <span class="text-primary-600">Terhubung</span>
             </h2>
             <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-12">
                 Jangan lewatkan info terbaru seputar koleksi tanaman baru, event, dan tips berkebun di media sosial
                 kami.
             </p>

             <div class="flex flex-wrap items-center justify-center gap-6">
                 <a href="#"
                     class="group flex items-center space-x-3 bg-gradient-to-br from-purple-600 via-pink-600 to-orange-500 p-4 pr-8 rounded-2xl text-white hover:shadow-xl hover:shadow-pink-500/30 transition-all duration-300 hover:-translate-y-1">
                     <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                         <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                             <path
                                 d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" />
                         </svg>
                     </div>
                     <span class="font-bold text-lg">Instagram</span>
                 </a>

                 <a href="#"
                     class="group flex items-center space-x-3 bg-[#FF0000] p-4 pr-8 rounded-2xl text-white hover:shadow-xl hover:shadow-red-500/30 transition-all duration-300 hover:-translate-y-1">
                     <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                         <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                             <path
                                 d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                         </svg>
                     </div>
                     <span class="font-bold text-lg">YouTube</span>
                 </a>

                 <a href="#"
                     class="group flex items-center space-x-3 bg-[#1877F2] p-4 pr-8 rounded-2xl text-white hover:shadow-xl hover:shadow-blue-500/30 transition-all duration-300 hover:-translate-y-1">
                     <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                         <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                             <path
                                 d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                         </svg>
                     </div>
                     <span class="font-bold text-lg">Facebook</span>
                 </a>
             </div>
         </div>
     </section>

     <section class="py-16 bg-white border-t border-gray-100">
         <div class="container mx-auto px-6 mb-10">
             <div class="text-center max-w-2xl mx-auto">
                 <h2 class="text-primary-600 font-bold tracking-widest uppercase text-xs mb-3">
                     Jaringan & Kolaborasi
                 </h2>
                 <h3 class="text-2xl md:text-3xl font-bold text-gray-900">
                     Mitra Strategis Kami
                 </h3>
             </div>
         </div>

         <div class="relative flex overflow-x-hidden group/marquee"
             style="-webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);">

             <div class="flex gap-8 w-full">


                 <div
                     class="flex min-w-full shrink-0 items-center gap-8 animate-marquee group-hover/marquee:[animation-play-state:paused]">
                     @foreach ($partners as $partner)
                         <div
                             class="group relative flex items-center justify-center w-52 h-32 bg-gray-50 rounded-2xl border border-gray-100 hover:bg-white hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                             <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner['name'] }}"
                                 class="max-h-16 w-auto max-w-[80%] filter grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 transition duration-500"
                                 title="{{ $partner['name'] }}">
                         </div>
                     @endforeach
                 </div>


                 <div class="flex min-w-full shrink-0 items-center gap-8 animate-marquee group-hover/marquee:[animation-play-state:paused]"
                     aria-hidden="true">
                     @foreach ($partners as $partner)
                         <div
                             class="group relative flex items-center justify-center w-52 h-32 bg-gray-50 rounded-2xl border border-gray-100 hover:bg-white hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                             <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner['name'] }}"
                                 class="max-h-16 w-auto max-w-[80%] filter grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 transition duration-500"
                                 title="{{ $partner['name'] }}">
                         </div>
                     @endforeach
                 </div>

             </div>
         </div>
         <div class="mt-12 text-center">
             <a href="#"
                 class="inline-flex items-center gap-2 px-6 py-2.5 bg-white border border-gray-200 text-gray-700 font-semibold rounded-full text-sm hover:bg-primary-50 hover:text-primary-700 hover:border-primary-200 transition-all shadow-sm">
                 <span>Ingin menjalin kerjasama?</span>
                 <span class="text-primary-600 font-bold">Hubungi Kami &rarr;</span>
             </a>
         </div>
     </section>
 </div>
