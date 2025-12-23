<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class AdminAndPostsSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin Matana',
            'email' => 'admin@matana.ac.id',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'data_completed' => true
        ]);

        // Create sample posts
        $posts = [
            [
                'title' => 'Society 5.0: Transformasi Masyarakat dalam Era Digital',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...',
                'category' => 'Tips & Trik',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Pentingnya Pengalaman Praktis dalam Pengembangan Karir',
                'content' => 'Pengalaman praktis merupakan salah satu aspek penting dalam pengembangan karir profesional. Dalam era digital ini, pengalaman praktis tidak hanya terbatas pada internship di perusahaan...',
                'category' => 'Karir',
                'user_id' => $admin->id,
            ],
            [
                'title' => '5 Keterampilan Kunci untuk Karir di Era Digital',
                'content' => 'Dunia kerja terus berkembang dengan adanya transformasi digital. Berikut adalah 5 keterampilan kunci yang harus dimiliki untuk sukses dalam karir di era digital...',
                'category' => 'Tips & Trik',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Alumni Universitas BSI Kampus Pontianak Jadi PNS Dinas Pendidikan',
                'content' => 'Alhamdulillah, lulusan terbaik dari Universitas BSI kampus Pontianak berhasil lolos seleksi CPNS dan sekarang menjadi PNS di Dinas Pendidikan...',
                'category' => 'Berita Alumni',
                'user_id' => $admin->id,
            ],
            [
                'title' => 'Alumni Sukses Universitas BSI Tasikmalaya Menjadi Pemimpin di Startup',
                'content' => 'Kisah sukses ini menginspirasi banyak mahasiswa untuk terus berinovasi dan mengembangkan passion mereka di bidang teknologi dan bisnis...',
                'category' => 'Berita Alumni',
                'user_id' => $admin->id,
            ],
        ];

        foreach ($posts as $post) {
            Post::create(array_merge($post, [
                'image' => 'images/default-post.jpg',
                'content' => $post['content']
            ]));
        }
    }
}
