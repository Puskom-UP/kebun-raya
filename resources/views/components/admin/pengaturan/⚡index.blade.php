<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

new #[Layout('layouts.admin')] #[Title('Pengaturan Website - Kebun Raya')] 
class extends Component {
    use WithFileUploads;

    // Identitas
    public $site_name;
    public $description;
    public $logo;
    public $oldLogo;

    // Profil (Visi Misi)
    public $about;
    public $vision;
    public $mission;

    // Kontak
    public $email;
    public $phone;
    public $address;

    public function mount()
    {
        // Ambil data pertama, jika tidak ada, biarkan kosong
        $setting = SiteSetting::first();

        if ($setting) {
            $this->site_name = $setting->site_name;
            $this->description = $setting->description;
            $this->oldLogo = $setting->logo;
            $this->about = $setting->about;
            $this->vision = $setting->vision;
            $this->mission = $setting->mission;
            $this->email = $setting->email;
            $this->phone = $setting->phone;
            $this->address = $setting->address;
        } else {
            // Default value jika database kosong
            $this->site_name = 'Kebun Raya Universitas Pahlawan';
        }
    }

    public function save()
    {
        $this->validate([
            'site_name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048', // 2MB Max
            'email' => 'nullable|email',
        ]);

        $data = [
            'site_name' => $this->site_name,
            'description' => $this->description,
            'about' => $this->about,
            'vision' => $this->vision,
            'mission' => $this->mission,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
        ];

        // Handle Logo Upload
        if ($this->logo) {
            // Hapus logo lama jika ada & bukan default
            if ($this->oldLogo) {
                Storage::disk('public')->delete($this->oldLogo);
            }
            $data['logo'] = $this->logo->store('settings', 'public');
        }

        // Update or Create (ID selalu 1)
        SiteSetting::updateOrCreate(['id' => 1], $data);

        // Update state tampilan
        if ($this->logo) {
            $this->oldLogo = $data['logo'];
            $this->logo = null;
        }

        session()->flash('message', 'Pengaturan website berhasil diperbarui!');
    }
};
?>

<div>
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Pengaturan Website</h1>
        <p class="text-gray-500 mt-1">Kelola identitas utama, visi misi, dan informasi kontak website.</p>
    </div>

    {{-- Alert Success --}}
    @if (session()->has('message'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-100 text-green-800 text-sm font-medium flex items-center gap-2 animate-fade-in-down">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="save" class="space-y-8">
        
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-8">
            <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-primary-100 text-primary-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </span>
                Identitas Website
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                <div class="md:col-span-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Logo Website</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 flex flex-col items-center justify-center text-center hover:bg-gray-50 transition-colors relative bg-gray-50/50">
                        
                        @if ($logo)
                            <img src="{{ $logo->temporaryUrl() }}" class="h-32 object-contain mb-3">
                        @elseif($oldLogo)
                            <img src="{{ asset('storage/'.$oldLogo) }}" class="h-32 object-contain mb-3">
                        @else
                            <div class="h-32 w-32 bg-gray-200 rounded-full flex items-center justify-center mb-3 text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif

                        <label for="logo-upload" class="cursor-pointer">
                            <span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none transition ease-in-out duration-150">
                                Pilih File
                            </span>
                            <input id="logo-upload" type="file" wire:model="logo" class="hidden" accept="image/*">
                        </label>
                        <p class="text-xs text-gray-500 mt-2">PNG/JPG Max 2MB.</p>
                        <div wire:loading wire:target="logo" class="text-xs text-primary-600 mt-2 font-bold">Uploading...</div>
                    </div>
                </div>

                <div class="md:col-span-8 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Website / Instansi</label>
                        <input type="text" wire:model="site_name" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4" placeholder="Contoh: Kebun Raya Universitas Pahlawan">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat (Meta Description)</label>
                        <textarea wire:model="description" rows="4" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4" placeholder="Deskripsi singkat untuk footer website dan SEO Google..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-8">
            <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </span>
                Profil & Visi Misi
            </h2>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tentang Kami (Sejarah/Profil)</label>
                    <textarea wire:model="about" rows="6" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4" placeholder="Jelaskan sejarah singkat atau profil kebun raya..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Visi</label>
                        <textarea wire:model="vision" rows="6" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4" placeholder="Masukkan Visi..."></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Misi</label>
                        <textarea wire:model="mission" rows="6" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4" placeholder="Masukkan Misi..."></textarea>
                        <p class="text-xs text-gray-500 mt-1">* Gunakan enter untuk poin baru.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 md:p-8">
            <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </span>
                Informasi Kontak
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Resmi</label>
                    <input type="email" wire:model="email" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon / WhatsApp</label>
                    <input type="text" wire:model="phone" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea wire:model="address" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-2.5 px-4" placeholder="Jalan..."></textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end pb-12">
            <button type="submit" wire:loading.attr="disabled" class="inline-flex items-center justify-center px-8 py-3 text-base font-medium text-white transition-all duration-200 bg-primary-900 rounded-xl hover:bg-primary-800 shadow-lg shadow-primary-900/20 disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading.remove>Simpan Semua Pengaturan</span>
                <span wire:loading class="flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    Menyimpan...
                </span>
            </button>
        </div>
    </form>
</div>