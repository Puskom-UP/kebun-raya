<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Penghargaan;

new #[Layout('layouts.admin')] #[Title('Kelola Penghargaan - Kebun Raya')] class extends Component {
    use WithPagination, WithFileUploads;

    public $showModal = false;
    public $showDeleteModal = false;
    public $isEditMode = false;
    public $deleteId = null;
    public $search = '';

    public $penghargaanId;

    #[Rule('required|min:3')]
    public $nama_penghargaan = '';

    #[Rule('nullable|string')]
    public $peringkat = '';

    #[Rule('nullable|string|max:500')]
    public $deskripsi = '';

    #[Rule('nullable|string')]
    public $icon = '';

    #[Rule('nullable|string')]
    public $warna = '';

    public $oldfile_sertifikat; 

    #[Rule('required|file|mimes:pdf,jpg,jpeg,png,webp|max:5120')]
    public $file_sertifikat;

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function resetForm()
    {
        $this->reset(['nama_penghargaan', 'peringkat', 'deskripsi', 'warna', 'icon', 'file_sertifikat', 'penghargaanId', 'isEditMode']);
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
        $data = Penghargaan::find($id);

        $this->penghargaanId = $data->id;
        $this->nama_penghargaan = $data->nama_penghargaan;
        $this->peringkat = $data->peringkat;
        $this->deskripsi = $data->deskripsi;
        $this->icon = $data->icon;
        $this->warna = $data->warna;
        $this->oldfile_sertifikat = $data->file_sertifikat;
        $this->file_sertifikat = null;

        $this->isEditMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama_penghargaan' => $this->nama_penghargaan,
            'peringkat' => $this->peringkat,
            'deskripsi' => $this->deskripsi,
            'warna' => $this->warna,
            'icon' => $this->icon,
            'file_sertifikat' => $this->file_sertifikat,
        ];

        if ($this->file_sertifikat) {
            if ($this->isEditMode && $this->oldfile_sertifikat) {
                Storage::disk('public')->delete($this->oldfile_sertifikat);
            }
            $data['file_sertifikat'] = $this->file_sertifikat->store('sertifikat', 'public');
        }
        if ($this->isEditMode) {
            Penghargaan::where('id', $this->penghargaanId)->update($data);
            $message = 'Penghargaan berhasil diperbarui!';
        } else {
            Penghargaan::create($data);
            $message = 'Penghargaan berhasil ditambahkan!';
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
        Penghargaan::find($this->deleteId)->delete();
        $this->showDeleteModal = false;
        session()->flash('message', 'Penghargaan berhasil dihapus.');
    }

    public function with()
    {
        return [
            'penghargaans' => Penghargaan::where('nama_penghargaan', 'like', '%' . $this->search . '%')
                ->orWhere('peringkat', 'like', '%' . $this->search . '%')
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
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Prestasi & Penghargaan</h1>
            <p class="text-gray-500 mt-1">Kelola daftar pencapaian dan penghargaan Kebun Raya.</p>
        </div>
        <button wire:click="create"
            class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white transition-all duration-200 bg-primary-900 rounded-xl hover:bg-primary-800 shadow-lg shadow-primary-900/20">
            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Catat Prestasi
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
                    placeholder="Cari prestasi...">
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                        <th class="px-6 py-4 font-semibold">Nama Penghargaan</th>
                        <th class="px-6 py-4 font-semibold">Peringkat</th>
                        <th class="px-6 py-4 font-semibold">Deskripsi Singkat</th>
                        <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($penghargaans as $item)
                        <tr class="group hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-yellow-50 flex items-center justify-center flex-shrink-0 text-yellow-600 border border-yellow-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4
                                            class="font-semibold text-gray-900 group-hover:text-primary-700 transition-colors">
                                            {{ $item->nama_penghargaan }}
                                        </h4>
                                        <p class="text-xs text-gray-400 mt-0.5">ID: #{{ $item->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->peringkat)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                        {{ $item->peringkat }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500 max-w-xs truncate">
                                {{ $item->deskripsi ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="edit({{ $item->id }})"
                                        class="p-2 text-gray-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all"
                                        title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $item->id }})"
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
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium">Belum ada data penghargaan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100">
            {{ $penghargaans->links() }}
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
                        class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl border border-gray-100">

                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900">
                                {{ $isEditMode ? 'Edit Penghargaan' : 'Tambah Penghargaan Baru' }}
                            </h3>
                        </div>

                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                            <form wire:submit="save" class="space-y-6">

                                {{-- Nama Penghargaan --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama
                                        Penghargaan</label>
                                    <input wire:model="nama_penghargaan" type="text"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4"
                                        placeholder="Contoh: Kebun Raya Daerah Terbaik 2023">
                                    @error('nama_penghargaan')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Peringkat --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Peringkat / Kategori
                                        (Opsional)</label>
                                    <input wire:model="peringkat" type="text"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4"
                                        placeholder="Contoh: Terbaik 3 Tingkat Provinsi, Gold Medal, dll">
                                    @error('peringkat')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Icon
                                        (Opsional)</label>
                                    <input wire:model="icon" type="text"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4"
                                        placeholder="Masukan code icon dalam bentuk SVG">
                                    @error('icon')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Warna
                                        (Opsional)</label>
                                    <input wire:model="warna" type="text"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4"
                                        placeholder="Contoh: yellow-600, blue-500, red-400">
                                    @error('warna')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Sertifikat
                                        Penghargaan</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition-all cursor-pointer relative"
                                        x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                                        <div class="space-y-1 text-center w-full">
                                            @if ($file_sertifikat)
                                                <div class="relative">
                                                    <img src="{{ $file_sertifikat->temporaryUrl() }}"
                                                        class="mx-auto h-32 object-contain rounded-lg shadow-sm bg-gray-100 p-2">
                                                    <button wire:click="$set('file_sertifikat', null)" type="button"
                                                        class="text-xs text-red-600 font-medium hover:underline mt-2">Batalkan
                                                        Upload</button>
                                                </div>
                                            @elseif ($oldfile_sertifikat)
                                                <div class="relative">
                                                    <img src="{{ asset('storage/' . $oldfile_sertifikat) }}"
                                                        class="mx-auto h-32 object-contain rounded-lg shadow-sm bg-gray-100 p-2">
                                                    <p class="text-xs text-gray-500 mt-2">Sertifikat saat ini</p>
                                                    <label for="file-upload"
                                                        class="cursor-pointer text-xs text-primary-600 font-bold hover:underline">Ganti
                                                        Sertifikat</label>
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
                                                        <span>Upload Sertifikat</span>
                                                    </label>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1">PDF,PNG, JPG (Transparan lebih
                                                    baik)
                                                </p>
                                            @endif

                                            <input id="file-upload" wire:model="file_sertifikat" type="file"
                                                class="sr-only"
                                                accept="image/png, image/jpeg, image/jpg, image/webp, application/pdf">


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

                                {{-- Deskripsi --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi
                                        (Opsional)</label>
                                    <textarea wire:model="deskripsi" rows="3"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4"
                                        placeholder="Tambahkan catatan detail mengenai penghargaan ini..."></textarea>
                                    @error('deskripsi')
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
                            <h3 class="text-lg font-semibold leading-6 text-gray-900">Hapus Penghargaan?</h3>
                            <p class="mt-2 text-sm text-gray-500">Apakah Anda yakin ingin menghapus data ini? Data yang
                                dihapus tidak dapat dikembalikan.</p>
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
