<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\JobVacancy;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // =====================
        // CREATE ADMIN
        // =====================
        $admin = User::create([
            'name' => 'Admin Matana',
            'email' => 'admin@matana.ac.id',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        // =====================    
        // CREATE POSTS
        // =====================
        $posts = [
            [
                'title' => 'Society 5.0: Transformasi Masyarakat',
                'content' => 'Lorem ipsum dolor sit amet...',
                'category' => 'Tips & Trik',
            ],
            [
                'title' => 'Pentingnya Pengalaman Praktis',
                'content' => 'Pengalaman praktis sangat penting...',
                'category' => 'Karir',
            ],
            [
                'title' => 'Alumni Sukses Menjadi PNS',
                'content' => 'Alumni berhasil menjadi PNS...',
                'category' => 'Berita Alumni',
            ],
        ];

        foreach ($posts as $post) {
            Post::create([
                'title' => $post['title'],
                'content' => $post['content'],
                'category' => $post['category'],
                'image' => 'images/default-post.jpg',
                'user_id' => $admin->id,
            ]);
        }

        // =====================
        // CREATE JOB VACANCIES
        // =====================
        $jobs = [
            [
                'judul' => 'Junior Web Developer',
                'perusahaan' => 'PT Teknologi Nusantara',
                'tipe_pekerjaan' => 'fulltime',
                'lokasi' => 'Jakarta',
                'deskripsi' => 'Mengembangkan aplikasi web Laravel.',
                'persyaratan' => 'HTML, CSS, PHP, Laravel',
                'gaji_min' => 5000000,
                'gaji_max' => 8000000,
                'kontak_email' => 'hr@teknologinusantara.com',
            ],
            [
                'judul' => 'UI/UX Designer',
                'perusahaan' => 'Startup Kreatif',
                'tipe_pekerjaan' => 'freelance',
                'lokasi' => 'Remote',
                'deskripsi' => 'Desain UI/UX aplikasi.',
                'persyaratan' => 'Figma, Adobe XD',
                'gaji_min' => null,
                'gaji_max' => null,
                'kontak_email' => 'recruitment@startupkreatif.id',
            ],
        ];

        foreach ($jobs as $job) {
            JobVacancy::create([
                ...$job,
                'posted_by' => $admin->id,
            ]);
        }
    }
}
