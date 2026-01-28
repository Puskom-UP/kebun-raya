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

    // State Data Form
    public $postId;

    #[Rule('required|min:5')]
    public $title = '';

    #[Rule('required')]
    public $category = 'Berita';

    public $categori_id;

    #[Rule('required|min:10')]
    public $content = '';

    #[Rule('nullable|image|max:2048')]
    public $image;

    public $status = 'published';

    public $search = '';

    // Reset Form saat modal ditutup
    public function resetForm()
    {
        $this->reset(['title', 'category', 'content', 'image', 'status', 'postId', 'isEditMode']);
        $this->resetValidation();
    }

    // Buka Modal Tambah
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
        $this->category = $post->category->name;
        $this->content = $post->content;
        $this->status = $post->status;

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
            'category_id' => $this->categori_id,
            'status' => $this->status,
            'user_id' => Auth()->user()->id,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('posts', 'public');
        }

        if ($this->isEditMode) {
            Post::where('id', $this->postId)->update($data);
        } else {
            Post::create($data);
        }

        $this->showModal = false;
        session()->flash('message', $this->isEditMode ? 'Berita berhasil diperbarui!' : 'Berita berhasil ditambahkan!');
    }

    // Konfirmasi Hapus
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    // Eksekusi Hapus
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
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Kelola Berita</h1>
            <p class="text-gray-500 mt-1">Buat, edit, dan kelola artikel publikasi Kebun Raya.</p>
        </div>
        <div>
            <button wire:click="create"
                class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white transition-all duration-200 bg-primary-900 rounded-xl hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-900 shadow-lg shadow-primary-900/20">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Berita
            </button>
        </div>
    </div>

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

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">

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
                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-all"
                    placeholder="Cari judul berita...">
            </div>

            <div class="flex gap-2">
                <select
                    class="block w-full pl-3 pr-8 py-2.5 border border-gray-200 rounded-xl leading-5 bg-white text-gray-600 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <option>Semua Kategori</option>
                    <option>Berita</option>
                    <option>Edukasi</option>
                    <option>Event</option>
                </select>
            </div>
        </div>

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
                                        @if (isset($post->image))
                                            <img src="{{ $post->image }}" class="w-full h-full object-cover">
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
                                    {{ $post->category->name }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                @if ($post->status === 'published')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Published
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-600"></span> Draft
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d M Y') }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
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
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900">Belum ada berita</h3>
                                    <p class="text-sm mt-1">Mulai dengan menambahkan berita baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100">
            {{-- {{ $posts->links() }} --}} <p class="text-xs text-gray-500">Menampilkan 3 data terbaru</p>
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
                            <div class="flex justify-between items-center">
                                <h3 class="text-xl font-bold text-gray-900" id="modal-title">
                                    {{ $isEditMode ? 'Edit Berita' : 'Tambah Berita Baru' }}
                                </h3>
                                <button wire:click="$set('showModal', false)"
                                    class="text-gray-400 hover:text-gray-500 bg-gray-50 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                            <form wire:submit="save" class="space-y-6">

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
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                                        <select wire:model="categori_id"
                                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4 bg-white">
                                            @foreach ($kategoris as $kategori)
                                                <option selected>Pilih Kategori</option>
                                                <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

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
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 hover:border-primary-400 transition-all cursor-pointer relative"
                                        x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div class="space-y-1 text-center">
                                            @if ($image && !is_string($image))
                                                <img src="{{ $image->temporaryUrl() }}"
                                                    class="mx-auto h-32 object-cover rounded-lg shadow-sm">
                                                <button wire:click="$set('image', null)" type="button"
                                                    class="text-xs text-red-600 font-medium hover:underline mt-2">Hapus
                                                    Gambar</button>
                                            @elseif($postId && $image && is_string($image))
                                                <img src="{{ asset('storage/' . $image) }}"
                                                    class="mx-auto h-32 object-cover rounded-lg shadow-sm">
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
                                                        class="relative cursor-pointer rounded-md font-bold text-primary-600 hover:text-primary-500 focus-within:outline-none">
                                                        <span>Upload gambar</span>
                                                        <input id="file-upload" wire:model="image" type="file"
                                                            class="sr-only">
                                                    </label>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1">PNG, JPG max 2MB</p>
                                            @endif
                                        </div>

                                        <div x-show="isUploading"
                                            class="absolute inset-0 bg-white/80 flex items-center justify-center rounded-xl">
                                            <div class="text-center">
                                                <svg class="animate-spin h-8 w-8 text-primary-600 mx-auto"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                    </path>
                                                </svg>
                                                <p class="text-xs text-primary-600 mt-2 font-medium"
                                                    x-text="progress + '%'"></p>
                                            </div>
                                        </div>
                                    </div>
                                    @error('image')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

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
                                    
                                            if (this.content) {
                                                editor.root.innerHTML = this.content;
                                            }
                                    
                                            editor.on('text-change', () => {
                                                this.content = editor.root.innerHTML;
                                            });
                                        }
                                    }" x-init="initQuill()">
                                        <div
                                            class="rounded-xl border border-gray-300 overflow-hidden focus-within:ring-1 focus-within:ring-primary-500 focus-within:border-primary-500 transition-all">
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
                                class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Hapus Berita
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus berita ini? Data
                                        yang dihapus tidak dapat dikembalikan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                        <button wire:click="delete" type="button"
                            class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Ya, Hapus
                        </button>
                        <button wire:click="$set('showDeleteModal', false)" type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
