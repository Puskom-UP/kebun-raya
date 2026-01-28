<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {

        $categories = ['Berita', 'Edukasi', 'Event', 'Konservasi', 'Pengumuman'];
        
        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat)
            ]);
        }

        $user = User::first();

        Post::create([
            'user_id' => $user->id ?? 1,
            'category_id' => 1, 
            'title' => 'Penemuan Spesies Anggrek Baru',
            'slug' => 'penemuan-spesies-anggrek-baru',
            'excerpt' => 'Tim peneliti Kebun Raya berhasil mengidentifikasi spesies baru.',
            'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>',
            'status' => 'published',
            'published_at' => now(),
            'views' => 150
        ]);

        Post::create([
            'user_id' => $user->id ?? 1,
            'category_id' => 3, 
            'title' => 'Festival Bunga 2026',
            'slug' => 'festival-bunga-2026',
            'excerpt' => 'Akan segera hadir festival bunga terbesar tahun ini.',
            'content' => '<p>Detail acara festival bunga...</p>',
            'status' => 'draft',
            'published_at' => null,
            'views' => 0
        ]);
    }
}