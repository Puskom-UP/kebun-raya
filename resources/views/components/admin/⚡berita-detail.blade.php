<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Post;

new #[Layout('layouts.front')] 
class extends Component {
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    #[Computed]
    public function relatedPosts()
    {
        return Post::where('id', '!=', $this->post->id)
            ->latest()
            ->take(3)
            ->get();
    }
};
?>

<div class="bg-gray-50 min-h-screen">
    <section class="relative pt-32 pb-32 bg-gradient-hero overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-accent-500/20 rounded-full blur-3xl animate-float"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <nav class="flex items-center justify-center space-x-2 text-primary-200 text-sm mb-8 animate-fade-in-up">
                <a href="/" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="/berita" class="hover:text-white transition-colors">Berita</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-white opacity-80 truncate max-w-[150px]">{{ $post->title }}</span>
            </nav>

            <div class="mb-6 animate-fade-in-up" style="animation-delay: 0.1s;">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-medium bg-white/10 text-white backdrop-blur-sm border border-white/20">
                    <span class="w-2 h-2 mr-2 rounded-full bg-accent-400"></span>
                    {{ $post->category->name ?? 'Berita Umum' }}
                </span>
            </div>

            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight drop-shadow-lg animate-fade-in-up" style="animation-delay: 0.2s;">
                {{ $post->title }}
            </h1>

            <div class="flex items-center justify-center space-x-6 text-primary-100 animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ $post->created_at->format('d M Y') }}
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>{{ $post->user->name ?? 'Admin' }}</span>
                </div>
            </div>
        </div>
    </section>

    <div class="relative z-20 pb-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="-mt-24 mb-12 relative animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="aspect-video w-full rounded-3xl shadow-2xl overflow-hidden border-4 border-white">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             alt="{{ $post->title }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center bg-pattern">
                            <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-dots-pattern opacity-50 hidden md:block"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <div class="lg:col-span-8">
                    <article class="bg-white rounded-3xl p-8 md:p-10 shadow-lg border border-gray-100">
                        <div class="prose prose-lg prose-green max-w-none text-gray-600 leading-relaxed">
                            {!! $post->content !!}
                        </div>

                        <div class="mt-10 pt-8 border-t border-gray-100">
                            <p class="text-sm font-semibold text-gray-900 mb-4">Bagikan berita ini:</p>
                            <div class="flex space-x-4">
                                <button class="p-2 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </button>
                                <button class="p-2 rounded-full bg-green-50 text-green-600 hover:bg-green-100 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-3.196-11.36 1.154-20.633 11.352-20.635 8.354 0 15.6 6.31 8.887 19.308-4.229 8.18-13.438 8.441-17.766 5.564L.057 24zm4.125-5.914l.263.415c2.618 4.145 9.176 4.965 12.639 1.487 3.992-4.015 3.324-11.758-1.571-15.006-5.88-3.903-12.213 1.366-10.74 7.625l.235.998-2.613 2.116 1.787 2.365z"/></svg>
                                </button>
                                <button class="p-2 rounded-full bg-sky-50 text-sky-500 hover:bg-sky-100 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                </button>
                            </div>
                        </div>
                    </article>

                    <div class="mt-8 text-center lg:text-left">
                        <a href="/berita" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                            <svg class="w-5 h-5 mr-2 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                            Kembali ke Daftar Berita
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-4 space-y-8">
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center mr-3 text-sm">📍</span>
                            Info Kebun Raya
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            Kebun Raya Universitas Pahlawan adalah pusat konservasi flora dataran rendah Sumatera.
                        </p>
                        <a href="/about" class="text-sm font-semibold text-primary-600 hover:underline">Pelajari lebih lanjut &rarr;</a>
                    </div>

                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-gray-100 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">Berita Lainnya</h3>
                        <div class="space-y-6">
                            @forelse ($this->relatedPosts as $related)
                                <div class="group flex gap-4 items-start">
                                    <div class="flex-shrink-0 w-20 h-20 rounded-xl overflow-hidden bg-gray-100">
                                        @if($related->image)
                                            <img src="{{ asset('storage/' . $related->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="text-xs text-primary-600 font-medium mb-1">
                                            {{ $related->created_at->format('d M Y') }}
                                        </div>
                                        <h4 class="text-sm font-bold text-gray-900 line-clamp-2 leading-snug group-hover:text-primary-600 transition-colors">
                                            <a href="{{ url('/berita/'.$related->id) }}">
                                                {{ $related->title }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-sm">Tidak ada berita lain.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="py-16 bg-white border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                Tertarik dengan tanaman ini?
            </h2>
            <p class="text-gray-600 mb-8">
                Kunjungi Kebun Raya Universitas Pahlawan untuk melihat koleksi flora secara langsung.
            </p>
            <a href="/#kontak" class="inline-block px-8 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-500 transition-colors shadow-lg shadow-primary-500/30">
                Rencanakan Kunjungan
            </a>
        </div>
    </section>
</div>