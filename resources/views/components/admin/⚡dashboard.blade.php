 <?php
 use Livewire\Attributes\Layout;
 use Livewire\Attributes\Computed;
 use Livewire\Component;

 
 new #[Layout('layouts.admin')] 
 class extends Component {
     #[Computed]
   
 };
 ?>

<div>
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
            Selamat Datang, <span class="text-primary-600">Admin</span> 👋
        </h1>
        <p class="text-gray-500 mt-1">Ringkasan aktivitas Kebun Raya Universitas Pahlawan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div
            class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center text-2xl">🌱</div>
                <span class="text-xs font-medium px-2 py-1 bg-green-100 text-green-700 rounded-full">+12%</span>
            </div>
            <p class="text-gray-500 text-sm font-medium">Total Flora</p>
            <h3 class="text-2xl font-bold text-gray-800">300+</h3>
        </div>

        <div
            class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-2xl">📄</div>
                <span class="text-xs font-medium px-2 py-1 bg-blue-100 text-blue-700 rounded-full">New</span>
            </div>
            <p class="text-gray-500 text-sm font-medium">Artikel Terbit</p>
            <h3 class="text-2xl font-bold text-gray-800">45</h3>
        </div>

        <div
            class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-2xl">👥</div>
            </div>
            <p class="text-gray-500 text-sm font-medium">Pengunjung</p>
            <h3 class="text-2xl font-bold text-gray-800">1.2K</h3>
        </div>

        <div
            class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center text-2xl">⚠️</div>
                <span class="text-xs font-medium px-2 py-1 bg-red-100 text-red-700 rounded-full">Action</span>
            </div>
            <p class="text-gray-500 text-sm font-medium">Perlu Review</p>
            <h3 class="text-2xl font-bold text-gray-800">3</h3>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-lg shadow-gray-200/50 p-6 md:p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-lg text-gray-900">Spesies Terbaru Ditambahkan</h3>
                <button class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-gray-400 text-sm border-b border-gray-100">
                            <th class="py-3 font-medium">Nama Spesies</th>
                            <th class="py-3 font-medium">Kategori</th>
                            <th class="py-3 font-medium">Tanggal</th>
                            <th class="py-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <tr class="group hover:bg-gray-50 transition-colors">
                            <td class="py-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-200 overflow-hidden">
                                    <div class="w-full h-full bg-primary-100"></div>
                                </div>
                                <span class="font-medium text-gray-700">Rafflesia Arnoldii</span>
                            </td>
                            <td class="py-4 text-gray-500">Langka</td>
                            <td class="py-4 text-gray-500">27 Jan 2026</td>
                            <td class="py-4"><span
                                    class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Published</span>
                            </td>
                        </tr>
                        <tr class="group hover:bg-gray-50 transition-colors">
                            <td class="py-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-200 overflow-hidden">
                                    <div class="w-full h-full bg-primary-100"></div>
                                </div>
                                <span class="font-medium text-gray-700">Anggrek Hitam</span>
                            </td>
                            <td class="py-4 text-gray-500">Orchidaceae</td>
                            <td class="py-4 text-gray-500">26 Jan 2026</td>
                            <td class="py-4"><span
                                    class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">Draft</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-primary-900 rounded-3xl p-6 md:p-8 text-white relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>

            <h3 class="font-bold text-lg mb-4 relative z-10">Informasi Sistem</h3>
            <p class="text-primary-200 text-sm mb-6 relative z-10 leading-relaxed">
                Backup data otomatis dilakukan setiap hari pukul 00:00 WIB. Pastikan data flora selalu terupdate.
            </p>

            <div class="space-y-4 relative z-10">
                <div class="flex items-start gap-3 bg-white/10 p-3 rounded-xl backdrop-blur-sm">
                    <div class="mt-1 w-2 h-2 rounded-full bg-green-400 flex-shrink-0"></div>
                    <div>
                        <p class="text-sm font-medium">Server Status</p>
                        <p class="text-xs text-primary-300">Online & Stabil</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 bg-white/10 p-3 rounded-xl backdrop-blur-sm">
                    <div class="mt-1 w-2 h-2 rounded-full bg-yellow-400 flex-shrink-0"></div>
                    <div>
                        <p class="text-sm font-medium">Storage</p>
                        <p class="text-xs text-primary-300">75% Digunakan</p>
                    </div>
                </div>
            </div>

            <button
                class="w-full mt-6 py-3 bg-white text-primary-900 rounded-xl font-semibold text-sm hover:bg-primary-50 transition-colors">
                Kelola Sistem
            </button>
        </div>

    </div>
</div>
