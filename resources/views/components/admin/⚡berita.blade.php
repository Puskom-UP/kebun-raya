<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;

new #[Layout('layouts.admin')] #[Title('Kelola Berita - Kebun Raya')] class extends Component {
    use WithPagination, WithFileUploads;

    public $showModal = false;
    public $showDeleteModal = false;
    public $isEditMode = false;
    public $deleteId = null;
    public $search = '';

    public $postId;

    #[Rule('required|min:5')]
    public $title = '';

    #[Rule('required')]
    public $category_id;

    #[Rule('required|min:10')]
    public $content = '';

    #[Rule('nullable|image|max:10240')]
    public $image;

    public $oldImage;

    public $status = 'published';

    public function resetForm()
    {
        $this->reset(['title', 'category_id', 'content', 'image', 'oldImage', 'status', 'postId', 'isEditMode']);
        $this->resetValidation();
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->resetForm();
        $post = Post::find($id);

        $this->postId = $post->id;
        $this->title = $post->title;
        $this->category_id = $post->category_id;
        $this->content = $post->content;
        $this->status = $post->status;
        $this->oldImage = $post->image;
        $this->image = null;

        $this->isEditMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'user_id' => auth()->id(),
        ];

        // Only handle upload if a NEW file was chosen
        if ($this->image) {
            $data['image'] = $this->image->store('posts', 'public');
        }

        if ($this->isEditMode) {
            Post::where('id', $this->postId)->update($data);
            $message = 'Berita berhasil diperbarui!';
        } else {
            Post::create($data);
            $message = 'Berita berhasil ditambahkan!';
        }

        $this->showModal = false;
        session()->flash('message', $message);
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        Post::destroy($this->deleteId);
        $this->showDeleteModal = false;
        session()->flash('message', 'Berita berhasil dihapus.');
    }

    public function with()
    {
        return [
            'posts' => Post::where('title', 'like', '%' . $this->search . '%')->paginate(10),
            'kategoris' => Category::all(),
        ];
    }
};
?>

<div>
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Kelola Berita</h1>
            <p class="text-gray-500 mt-1">Buat, edit, dan kelola artikel publikasi Kebun Raya.</p>
        </div>
        <button wire:click="create"
            class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white transition-all duration-200 bg-primary-900 rounded-xl hover:bg-primary-800 shadow-lg shadow-primary-900/20">
            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Berita
        </button>
    </div>

    {{-- Alert --}}
    @if (session()->has('message'))
        <div
            class="mb-6 p-4 rounded-xl bg-green-50 border border-green-100 text-green-800 text-sm font-medium flex items-center gap-2 animate-fade-in-down">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('message') }}
        </div>
    @endif

    {{-- Main Content / Table --}}
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        {{-- Search & Filter --}}
        <div
            class="p-6 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row gap-4 justify-between items-center">
            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text"
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 sm:text-sm"
                    placeholder="Cari judul berita...">
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                        <th class="px-6 py-4 font-semibold">Artikel</th>
                        <th class="px-6 py-4 font-semibold">Kategori</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold">Tanggal</th>
                        <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($posts as $post)
                        <tr class="group hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200">
                                        @if ($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4
                                            class="font-semibold text-gray-900 group-hover:text-primary-700 transition-colors line-clamp-1">
                                            {{ $post->title }}</h4>
                                        <p class="text-xs text-gray-500 mt-0.5">Penulis: Admin</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $post->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($post->status === 'published')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700"><span
                                            class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Published</span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700"><span
                                            class="w-1.5 h-1.5 rounded-full bg-yellow-600"></span> Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('berita.show', $post->slug) }}" wire:navigate
                                        class="p-2 text-gray-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all"
                                        title="Lihat Artikel">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <button wire:click="edit({{ $post->id }})"
                                        class="p-2 text-gray-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all"
                                        title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $post->id }})"
                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                        title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <p class="text-sm mt-1">Belum ada berita. Mulai dengan menambahkan berita baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100">
            {{ $posts->links() }}
        </div>
    </div>


    @if ($showModal)
        <div class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div wire:click="$set('showModal', false)"
                class="fixed inset-0 bg-gray-900/80 transition-opacity backdrop-blur-sm"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl border border-gray-100">

                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900">
                                {{ $isEditMode ? 'Edit Berita' : 'Tambah Berita Baru' }}</h3>
                        </div>

                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                            <form wire:submit="save" class="space-y-6">

                                {{-- Judul --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Artikel</label>
                                    <input wire:model="title" type="text"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4"
                                        placeholder="Masukkan judul...">
                                    @error('title')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Kategori --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                                        <select wire:model="category_id"
                                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4 bg-white">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                                        <div
                                            class="flex items-center space-x-4 mt-2 bg-gray-50 p-2.5 rounded-xl border border-gray-200">
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" wire:model="status" value="published"
                                                    class="text-primary-600 focus:ring-primary-500 border-gray-300">
                                                <span class="ml-2 text-sm text-gray-700">Published</span>
                                            </label>
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" wire:model="status" value="draft"
                                                    class="text-yellow-600 focus:ring-yellow-500 border-gray-300">
                                                <span class="ml-2 text-sm text-gray-700">Draft</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Utama</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition-all cursor-pointer relative"
                                        x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                                        <div class="space-y-1 text-center w-full">

                                            @if ($image)
                                                <div class="relative">
                                                    <img src="{{ $image->temporaryUrl() }}"
                                                        class="mx-auto h-32 object-cover rounded-lg shadow-sm">
                                                    <button wire:click="$set('image', null)" type="button"
                                                        class="text-xs text-red-600 font-medium hover:underline mt-2">Batalkan
                                                        Upload</button>
                                                </div>
                                            @elseif ($oldImage)
                                                <div class="relative">
                                                    <img src="{{ asset('storage/' . $oldImage) }}"
                                                        class="mx-auto h-32 object-cover rounded-lg shadow-sm">
                                                    <p class="text-xs text-gray-500 mt-2">Gambar saat ini</p>
                                                    <label for="file-upload"
                                                        class="cursor-pointer text-xs text-primary-600 font-bold hover:underline">Ganti
                                                        Gambar</label>
                                                </div>
                                            @else
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600 justify-center mt-2">
                                                    <label for="file-upload"
                                                        class="relative cursor-pointer font-bold text-primary-600 hover:text-primary-500">
                                                        <span>Upload gambar</span>
                                                    </label>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1">PNG, JPG max 10MB</p>
                                            @endif
                                            <input id="file-upload" wire:model="image" type="file"
                                                class="sr-only" accept="image/png, image/jpeg, image/jpg, image/webp">

                                            <div x-show="isUploading"
                                                class="absolute inset-0 bg-white/90 flex items-center justify-center rounded-xl z-20">
                                                <div class="text-center">
                                                    <svg class="animate-spin h-8 w-8 text-primary-600 mx-auto"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12"
                                                            r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                    <p class="text-xs text-primary-600 mt-2 font-medium"
                                                        x-text="progress + '%'"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('image')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Quill Editor --}}
                                <div wire:ignore>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konten Berita</label>
                                    <div class="bg-white" x-data="{
                                        content: @entangle('content'),
                                        initQuill() {
                                            const editor = new Quill(this.$refs.quillEditor, {
                                                theme: 'snow',
                                                placeholder: 'Tulis isi berita lengkap di sini...',
                                                modules: {
                                                    toolbar: [
                                                        ['bold', 'italic', 'underline', 'strike'],
                                                        ['blockquote', 'code-block'],
                                                        [{ 'header': 1 }, { 'header': 2 }],
                                                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                                                        [{ 'align': [] }],
                                                        ['link', 'clean']
                                                    ]
                                                }
                                            });
                                            if (this.content) { editor.root.innerHTML = this.content; }
                                            editor.on('text-change', () => { this.content = editor.root.innerHTML; });
                                        }
                                    }" x-init="initQuill()">
                                        <div
                                            class="rounded-xl border border-gray-300 overflow-hidden focus-within:ring-1 focus-within:ring-primary-500 focus-within:border-primary-500">
                                            <div x-ref="quillEditor" class="h-96 text-base text-gray-700 bg-white">
                                            </div>
                                        </div>
                                    </div>
                                    @error('content')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                            </form>
                        </div>

                        <div class="bg-gray-50 px-4 py-3 sm:px-6 flex flex-row-reverse gap-2 border-t border-gray-100">
                            <button wire:click="save" wire:loading.attr="disabled" type="button"
                                class="w-full inline-flex justify-center items-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-primary-900 text-base font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                                <span wire:loading.remove>{{ $isEditMode ? 'Simpan' : 'Terbitkan' }}</span>
                                <span wire:loading>Menyimpan...</span>
                            </button>
                            <button wire:click="$set('showModal', false)" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
