<?php
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Component;

new #[Layout('layouts.app')] 
class extends Component {
    #[Computed]
    public string $username = '';
    public string $password = '';
    public bool $remember = false;

    protected function rules()
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required'],
        ];
    }

    public function login()
    {
        $this->validate();
        if (!Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            throw ValidationException::withMessages([
                'username' => 'Username atau kata sandi yang Anda masukkan salah.',
            ]);
        }

        session()->regenerate();
        return redirect()->intended('/admin');
    }
};

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kebun Raya</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-white">

    <div class="min-h-screen flex">

        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-primary-900">
            <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?q=80&w=2070&auto=format&fit=crop"
                class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay"
                alt="Kebun Raya Background">
            <div class="absolute inset-0 bg-gradient-to-t from-primary-900 via-primary-900/40 to-transparent"></div>

            <div class="relative z-10 flex flex-col justify-between w-full p-12 text-white">
                <div class="flex items-center space-x-3 mb-8">
                    <img src="{{ asset('assets/images/LogoKebunRaya.jpeg') }}"
                        class="h-12 w-12 rounded-full border-2 border-white/30" onerror="this.style.display='none'">
                    <span class="text-xl font-bold tracking-wide">Kebun Raya</span>
                </div>
                <div class="mb-8">
                    <h2 class="text-4xl font-bold mb-4 leading-tight">Lestarikan Flora,<br>Warisi Masa Depan.</h2>
                    <p class="text-primary-100 text-lg max-w-md opacity-90">Sistem Informasi Manajemen Koleksi Tanaman &
                        Konservasi.</p>
                </div>
                <div class="text-sm text-primary-200/60">&copy; 2026 Universitas Pahlawan Tuanku Tambusai</div>
            </div>
        </div>

        <div class="flex-1 flex items-center justify-center p-4 sm:p-12 lg:p-24 bg-white relative">
            <a href="/"
                class="absolute top-6 right-6 text-gray-400 hover:text-primary-600 transition-colors flex items-center gap-2 text-sm font-medium">
                <span>Kembali ke Beranda</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>

            <div class="w-full max-w-md space-y-8">
                <div class="lg:hidden text-center mb-8">
                    <img src="{{ asset('assets/images/LogoKebunRaya.jpeg') }}"
                        class="h-16 w-16 mx-auto rounded-full mb-3">
                    <h2 class="text-2xl font-bold text-gray-900">Kebun Raya</h2>
                </div>

                <div class="text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-gray-900">Selamat Datang 👋</h2>
                    <p class="mt-2 text-sm text-gray-600">Silakan masuk untuk mengakses dashboard admin.</p>
                </div>

                <form wire:submit="login" class="mt-8 space-y-6" x-data="{ showPassword: false }">

                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                            <input wire:model="username" id="text" type="text" required autofocus
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-all duration-200"
                                placeholder="username">
                        </div>
                        @error('username')
                            <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>

                            <input wire:model="password" id="password" :type="showPassword ? 'text' : 'password'"
                                required
                                class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm transition-all duration-200"
                                placeholder="••••••••">

                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
                                @click="showPassword = !showPassword">
                                <svg x-show="!showPassword" class="h-5 w-5 text-gray-400 hover:text-gray-600"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                <svg x-show="showPassword" style="display: none;"
                                    class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 013.999-5.42m3.714-2.172a9.998 9.998 0 013.287-.386c4.478 0 8.268 2.943 9.542 7 .645 2.055 1.196 4.066 1.636 6.015M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3l18 18"></path>
                                </svg>
                            </div>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input wire:model="remember" id="remember_me" type="checkbox"
                                class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded cursor-pointer">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900 cursor-pointer">Ingat
                                saya</label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-primary-600 hover:text-primary-500">Lupa kata
                                sandi?</a>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-primary-900 hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200 transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove>Masuk</span>
                            <span wire:loading class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Memproses...
                            </span>
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center text-sm text-gray-600 border-t border-gray-200 pt-6">
                    Butuh bantuan? Hubungi <a href="#"
                        class="font-medium text-primary-600 hover:text-primary-500">Administrator</a>.
                </div>
            </div>
        </div>
    </div>

</body>

</html>
