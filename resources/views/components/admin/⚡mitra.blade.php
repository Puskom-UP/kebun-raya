<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Partner;

new #[Layout('layouts.admin')] #[Title('Kelola Mitra - Kebun Raya')] class extends Component {
    use WithPagination, WithFileUploads;

    // --- State Variables (Sama seperti referensi) ---
    public $showModal = false;
    public $showDeleteModal = false;
    public $isEditMode = false;
    public $deleteId = null;
    public $search = '';

    public $partnerId;

    // --- Form Fields (Disesuaikan untuk Mitra) ---
    #[Rule('required|min:3')]
    public $name = ''; // Menggantikan Title

    #[Rule('nullable|url')]
    public $url = ''; // Menggantikan Category_id
    // Max 2MB

    #[Rule('nullable|image|max:2048')]
    public $logo; // Menggantikan Image

    public $oldLogo; // Menggantikan OldImage

    public $status = 'published'; // Tetap ada (Published/Draft)

    // --- Methods ---

    public function resetForm()
    {
        $this->reset(['name', 'url', 'logo', 'oldLogo', 'status', 'partnerId', 'isEditMode']);
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
        $partner = Partner::find($id);

        $this->partnerId = $partner->id;
        $this->name = $partner->name;
        $this->url = $partner->url;
        $this->status = $partner->status ?? 'published'; // Default published jika null
        $this->oldLogo = $partner->logo;
        $this->logo = null;

        $this->isEditMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'url' => $this->url,
            'status' => $this->status,
        ];

        // Handle Upload Logo
        if ($this->logo) {
            // Hapus logo lama jika edit mode
            if ($this->isEditMode && $this->oldLogo) {
                Storage::disk('public')->delete($this->oldLogo);
            }
            $data['logo'] = $this->logo->store('partners', 'public');
        }

        if ($this->isEditMode) {
            Partner::where('id', $this->partnerId)->update($data);
            $message = 'Mitra berhasil diperbarui!';
        } else {
            // Validasi wajib logo saat create
            if (!$this->logo) {
                $this->addError('logo', 'Logo mitra wajib diupload.');
                return;
            }
            Partner::create($data);
            $message = 'Mitra berhasil ditambahkan!';
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
        $partner = Partner::find($this->deleteId);
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }
        $partner->delete();

        $this->showDeleteModal = false;
        session()->flash('message', 'Mitra berhasil dihapus.');
    }

    public function with()
    {
        return [
            'partners' => Partner::where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10),
        ];
    }
};
?>

<div>
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Kelola Mitra Kerjasama</h1>
            <p class="text-gray-500 mt-1">Atur logo dan link mitra strategis Kebun Raya.</p>
        </div>
        <button wire:click="create"
            class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white transition-all duration-200 bg-primary-900 rounded-xl hover:bg-primary-800 shadow-lg shadow-primary-900/20">
            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Mitra
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
                    placeholder="Cari nama mitra...">
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                        <th class="px-6 py-4 font-semibold">Mitra / Instansi</th>
                        <th class="px-6 py-4 font-semibold">Website</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold">Tanggal</th>
                        <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($partners as $partner)
                        <tr class="group hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    {{-- Logo Box --}}
                                    <div
                                        class="w-16 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-200 p-1 flex items-center justify-center">
                                        @if ($partner->logo)
                                            <img src="{{ asset('storage/' . $partner->logo) }}"
                                                class="max-w-full max-h-full object-contain">
                                        @else
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <h4
                                            class="font-semibold text-gray-900 group-hover:text-primary-700 transition-colors line-clamp-1">
                                            {{ $partner->name }}
                                        </h4>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                @if ($partner->url)
                                    <a href="{{ $partner->url }}" target="_blank"
                                        class="text-primary-600 hover:underline flex items-center gap-1">
                                        Kunjungi
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                            </path>
                                        </svg>
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($partner->status === 'published')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span> Non-Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ \Carbon\Carbon::parse($partner->created_at)->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="edit({{ $partner->id }})"
                                        class="p-2 text-gray-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all"
                                        title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $partner->id }})"
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
                                <p class="text-sm mt-1">Belum ada mitra kerjasama.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100">
            {{ $partners->links() }}
        </div>
    </div>


    {{-- MODAL FORM --}}
    @if ($showModal)
        <div class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div wire:click="$set('showModal', false)"
                class="fixed inset-0 bg-gray-900/80 transition-opacity backdrop-blur-sm"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-gray-100">

                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900">
                                {{ $isEditMode ? 'Edit Mitra' : 'Tambah Mitra Baru' }}
                            </h3>
                        </div>

                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                            <form wire:submit="save" class="space-y-6">

                                {{-- Nama Mitra --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Mitra /
                                        Instansi</label>
                                    <input wire:model="name" type="text"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4"
                                        placeholder="Contoh: Universitas Pahlawan">
                                    @error('name')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Grid Layout untuk URL & Status --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- URL --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Link Website
                                            (Opsional)</label>
                                        <input wire:model="url" type="url"
                                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4"
                                            placeholder="https://...">
                                        @error('url')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status
                                            Tampilan</label>
                                        <div
                                            class="flex items-center space-x-4 mt-2 bg-gray-50 p-2.5 rounded-xl border border-gray-200">
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" wire:model="status" value="published"
                                                    class="text-primary-600 focus:ring-primary-500 border-gray-300">
                                                <span class="ml-2 text-sm text-gray-700">Aktif</span>
                                            </label>
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" wire:model="status" value="draft"
                                                    class="text-gray-600 focus:ring-gray-500 border-gray-300">
                                                <span class="ml-2 text-sm text-gray-700">Sembunyikan</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Upload Logo (Style Drag & Drop sama persis) --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Logo Mitra</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition-all cursor-pointer relative"
                                        x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                                        <div class="space-y-1 text-center w-full">
                                            @if ($logo)
                                                <div class="relative">
                                                    <img src="{{ $logo->temporaryUrl() }}"
                                                        class="mx-auto h-32 object-contain rounded-lg shadow-sm bg-gray-100 p-2">
                                                    <button wire:click="$set('logo', null)" type="button"
                                                        class="text-xs text-red-600 font-medium hover:underline mt-2">Batalkan
                                                        Upload</button>
                                                </div>
                                            @elseif ($oldLogo)
                                                <div class="relative">
                                                    <img src="{{ asset('storage/' . $oldLogo) }}"
                                                        class="mx-auto h-32 object-contain rounded-lg shadow-sm bg-gray-100 p-2">
                                                    <p class="text-xs text-gray-500 mt-2">Logo saat ini</p>
                                                    <label for="file-upload"
                                                        class="cursor-pointer text-xs text-primary-600 font-bold hover:underline">Ganti
                                                        Logo</label>
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
                                                        <span>Upload logo</span>
                                                    </label>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1">PNG, JPG (Transparan lebih baik)
                                                </p>
                                            @endif

                                            <input id="file-upload" wire:model="logo" type="file" class="sr-only"
                                                accept="image/png, image/jpeg, image/jpg, image/webp">

                                            {{-- Progress Bar --}}
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
                                    @error('logo')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                            </form>
                        </div>

                        {{-- Modal Footer --}}
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 flex flex-row-reverse gap-2 border-t border-gray-100">
                            <button wire:click="save" wire:loading.attr="disabled" type="button"
                                class="w-full inline-flex justify-center items-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-primary-900 text-base font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                                <span wire:loading.remove>{{ $isEditMode ? 'Simpan' : 'Tambahkan' }}</span>
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

    {{-- MODAL DELETE CONFIRMATION --}}
    @if ($showDeleteModal)
        <div class="relative z-50">
            <div class="fixed inset-0 bg-gray-900/80 transition-opacity backdrop-blur-sm"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <div
                        class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-md p-6">
                        <div class="text-center">
                            <div
                                class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 mb-4">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold leading-6 text-gray-900">Hapus Mitra?</h3>
                            <p class="mt-2 text-sm text-gray-500">Apakah Anda yakin ingin menghapus mitra ini? Data
                                yang dihapus tidak dapat dikembalikan.</p>
                        </div>
                        <div class="mt-6 flex justify-center gap-3">
                            <button wire:click="$set('showDeleteModal', false)" type="button"
                                class="inline-flex w-full justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:w-auto">Batal</button>
                            <button wire:click="delete" type="button"
                                class="inline-flex w-full justify-center rounded-xl bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:w-auto">Ya,
                                Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
