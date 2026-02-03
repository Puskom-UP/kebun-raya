<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\SiteSetting;

new #[Layout('layouts.front')] 
class extends Component {
    use WithPagination;

    // Menyimpan query pencarian di URL agar bisa dishare
    #[Url(history: true)]
    public $search = '';

    // Reset pagination ke halaman 1 jika user mengetik pencarian
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function with()
    {
        return [
            // Mengambil berita status published, difilter search, diurutkan terbaru
            'posts' => Post::with('category') // Eager load kategori agar query ringan
                ->where('status', 'published')
                ->when($this->search, function($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                          ->orWhere('content', 'like', '%' . $this->search . '%');
                })
                ->latest()
                ->paginate(9), // Menampilkan 9 berita per halaman
                
            'site' => SiteSetting::first(),
        ];
    }
};
?>

<div>
    <section class="relative pt-32 pb-24 bg-gradient-hero overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-accent-500/20 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <nav class="flex items-center justify-center space-x-2 text-primary-200 text-sm mb-6">
                <a href="/" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-white">Berita & Artikel</span>
            </nav>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                Kabar <span class="text-gradient">Kebun Raya</span>
            </h1>
            <p class="text-lg md:text-xl text-primary-100/80 max-w-2xl mx-auto">
                Dapatkan informasi terbaru seputar kegiatan konservasi, edukasi, dan penelitian di Universitas Pahlawan.
            </p>

            <div class="mt-10 max-w-xl mx-auto relative">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" 
                    class="block w-full pl-12 pr-6 py-4 rounded-full border-0 focus:ring-4 focus:ring-primary-500/30 shadow-xl text-gray-900 placeholder-gray-400 sm:text-lg bg-white/95 backdrop-blur-sm transition-all" 
                    placeholder="Cari artikel atau berita...">
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($posts->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <article class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 flex flex-col h-full">
                            <div class="relative aspect-[4/3] overflow-hidden bg-gray-100">
                                <a href="{{ route('berita.show', $post->slug) }}">
                                    @if($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" 
                                             alt="{{ $post->title }}" 
                                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-primary-50 text-primary-200">
                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <div class="absolute top-4 left-4">
                                        <span class="px-3 py-1 bg-white/90 backdrop-blur-md text-primary-700 text-xs font-bold uppercase tracking-wider rounded-full shadow-sm">
                                            {{ $post->category->name ?? 'Umum' }}
                                        </span>
                                    </div>
                                </a>
                            </div>

                            <div class="p-6 md:p-8 flex-1 flex flex-col">
                                <div class="flex items-center text-sm text-gray-500 mb-3 space-x-4">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d M Y') }}
                                    </span>
                                </div>

                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors line-clamp-2">
                                    <a href="{{ route('berita.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <p class="text-gray-600 mb-6 line-clamp-3 text-sm leading-relaxed">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>

                                <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between">
                                    <a href="{{ route('berita.show', $post->slug) }}" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors group/link">
                                        Baca Selengkapnya
                                        <svg class="w-4 h-4 ml-2 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-16">
                    {{ $posts->links() }} 
                    {{-- Pastikan Anda sudah publish vendor pagination tailwind: php artisan vendor:publish --tag=laravel-pagination --}}
                </div>

            @else
                <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak ada berita ditemukan</h3>
                    <p class="text-gray-500">Coba gunakan kata kunci lain atau kembali lagi nanti.</p>
                    @if($search)
                        <button wire:click="$set('search', '')" class="mt-6 text-primary-600 font-medium hover:text-primary-700 hover:underline">
                            Hapus pencarian
                        </button>
                    @endif
                </div>
            @endif

        </div>
    </section>

    <section class="py-20 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Jangan Lewatkan Informasi Terbaru</h2>
            <p class="text-gray-600 mb-8">Dapatkan update terkini seputar Kebun Raya langsung di halaman ini.</p>
        </div>
    </section>
</div>