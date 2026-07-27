<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // 1. Matikan Foreign Key Checks & Bersihkan tabel lama
        $db->disableForeignKeyChecks();
        $db->table('achievements')->truncate();
        $db->table('achievement_categories')->truncate();
        $db->enableForeignKeyChecks();

        // 2. Buat folder upload jika belum ada
        $uploadDir = FCPATH . 'assets/uploads/achievements/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // 3. Sediakan Kategori Achievement
        $categories = [
            [
                'id'         => 1,
                'name'       => 'Content Creator',
                'slug'       => 'content-creator',
                'icon'       => 'ri-user-star-line',
                'sort_order' => 1
            ],
            [
                'id'         => 2,
                'name'       => 'Academy & Edu',
                'slug'       => 'academy-edu',
                'icon'       => 'ri-briefcase-line',
                'sort_order' => 2
            ],
            [
                'id'         => 3,
                'name'       => 'Filmmaking',
                'slug'       => 'filmmaking',
                'icon'       => 'ri-film-line',
                'sort_order' => 3
            ]
        ];

        foreach ($categories as $cat) {
            $db->table('achievement_categories')->insert($cat);
        }

        // 4. Sediakan Data 12 Items Achievement (4 per Kategori)
        $achievements = [
            // ==================== KATEGORI 1: CONTENT CREATOR (4 Items) ====================
            [
                'category_id'     => 1,
                'is_main'         => 1,
                'year'            => 2024,
                'date_label'      => 'Desember 2024',
                'title'           => 'Creator of the Year 2024',
                'description'     => 'Penghargaan tertinggi bagi kreator yang konsisten memberikan dampak positif melalui konten edukasi kreatif & estetik.',
                'badge_text'      => 'PRESTASI UTAMA',
                'icon'            => 'ri-trophy-line',
                'small_text'      => 'TIKTOK AWARDS INDONESIA',
                'heading_text'    => 'Over 10M Views',
                'signature_text'  => 'Annisa Esce',
                'sort_order'      => 1,
                'photo_name'      => 'ach_creator_1.png',
                'bg_color_start'  => [255, 105, 180],
                'bg_color_end'    => [142, 68, 173]
            ],
            [
                'category_id'     => 1,
                'is_main'         => 0,
                'year'            => 2024,
                'date_label'      => 'Agustus 2024',
                'title'           => 'Top Short-Video Creator',
                'description'     => 'Meraih juara 1 kompetisi pembuatan konten video pendek terbaik skala nasional dengan engagement rate tertinggi.',
                'badge_text'      => 'JUARA 1',
                'icon'            => 'ri-medal-line',
                'small_text'      => 'REELS FESTIVAL 2024',
                'heading_text'    => 'Best Engagement',
                'signature_text'  => 'Annisa Esce',
                'sort_order'      => 2,
                'photo_name'      => 'ach_creator_2.png',
                'bg_color_start'  => [236, 64, 122],
                'bg_color_end'    => [41, 128, 185]
            ],
            [
                'category_id'     => 1,
                'is_main'         => 0,
                'year'            => 2023,
                'date_label'      => 'Oktober 2023',
                'title'           => 'Brand Collab Terbaik',
                'description'     => 'Memenangkan campaign kolaborasi bersama brand teknologi nasional dengan performa konten terbaik.',
                'badge_text'      => 'BEST CAMPAIGN',
                'icon'            => 'ri-star-line',
                'small_text'      => 'DIGITAL BRAND AWARDS',
                'heading_text'    => 'Top Collaboration',
                'signature_text'  => 'Annisa Esce',
                'sort_order'      => 3,
                'photo_name'      => 'ach_creator_3.png',
                'bg_color_start'  => [255, 167, 38],
                'bg_color_end'    => [233, 30, 99]
            ],
            [
                'category_id'     => 1,
                'is_main'         => 0,
                'year'            => 2023,
                'date_label'      => 'Maret 2023',
                'title'           => 'Viral Content Impact Award',
                'description'     => 'Apresiasi atas pencapaian jangkauan audiens lebih dari 15 Juta tayangan dalam waktu satu minggu.',
                'badge_text'      => '15M+ REACH',
                'icon'            => 'ri-fire-line',
                'small_text'      => 'CREATOR CONVENTION 2023',
                'heading_text'    => 'Viral Milestone',
                'signature_text'  => 'Annisa Esce',
                'sort_order'      => 4,
                'photo_name'      => 'ach_creator_4.png',
                'bg_color_start'  => [156, 39, 176],
                'bg_color_end'    => [244, 143, 177]
            ],

            // ==================== KATEGORI 2: ACADEMY & EDU (4 Items) ====================
            [
                'category_id'     => 2,
                'is_main'         => 1,
                'year'            => 2025,
                'date_label'      => 'Januari 2025',
                'title'           => 'Instructor of the Year 2025',
                'description'     => 'Penghargaan tertinggi di bidang pendidikan kreatif atas kontribusi mendidik ribuan kreator muda Indonesia.',
                'badge_text'      => 'PRESTASI UTAMA',
                'icon'            => 'ri-award-line',
                'small_text'      => 'NATIONAL EDUCATION AWARDS',
                'heading_text'    => 'Best Instructor',
                'signature_text'  => 'Annisa Esce',
                'sort_order'      => 5,
                'photo_name'      => 'ach_edu_1.png',
                'bg_color_start'  => [38, 166, 154],
                'bg_color_end'    => [156, 39, 176]
            ],
            [
                'category_id'     => 2,
                'is_main'         => 0,
                'year'            => 2024,
                'date_label'      => 'November 2024',
                'title'           => 'Best Mentorship Program',
                'description'     => 'Program bootcamp video editing dengan kelulusan siswa berpredikat siap kerja terbaik.',
                'badge_text'      => 'BEST MENTOR',
                'icon'            => 'ri-user-voice-line',
                'small_text'      => 'CREATIVE ACADEMY SUMMIT',
                'heading_text'    => 'Mentorship Excellence',
                'signature_text'  => 'Annisa Esce',
                'sort_order'      => 6,
                'photo_name'      => 'ach_edu_2.png',
                'bg_color_start'  => [41, 128, 185],
                'bg_color_end'    => [236, 64, 122]
            ],
            [
                'category_id'     => 2,
                'is_main'         => 0,
                'year'            => 2024,
                'date_label'      => 'Juni 2024',
                'title'           => '10.000+ Alumni Masterclass',
                'description'     => 'Berhasil meluluskan lebih dari 10.000 peserta dalam kelas online editing video kreatif.',
                'badge_text'      => 'MILESTONE 10K',
                'icon'            => 'ri-group-line',
                'small_text'      => 'VIDEO EDITING ACADEMY',
                'heading_text'    => '10K Alumni',
                'signature_text'  => 'Annisa Esce',
                'sort_order'      => 7,
                'photo_name'      => 'ach_edu_3.png',
                'bg_color_start'  => [255, 112, 67],
                'bg_color_end'    => [142, 68, 173]
            ],
            [
                'category_id'     => 2,
                'is_main'         => 0,
                'year'            => 2023,
                'date_label'      => 'Desember 2023',
                'title'           => 'Pembicara Favorit Seminar',
                'description'     => 'Terpilih sebagai narasumber terfavorit pada Seminar Nasional Industri Kreatif Digital.',
                'badge_text'      => 'FAVORITE SPEAKER',
                'icon'            => 'ri-mic-line',
                'small_text'      => 'EXPO KREATIF NATIONAL',
                'heading_text'    => 'Keynote Speaker',
                'signature_text'  => 'Annisa Esce',
                'sort_order'      => 8,
                'photo_name'      => 'ach_edu_4.png',
                'bg_color_start'  => [233, 30, 99],
                'bg_color_end'    => [0, 184, 148]
            ],

            // ==================== KATEGORI 3: FILMMAKING (4 Items) ====================
            [
                'category_id'     => 3,
                'is_main'         => 1,
                'year'            => 2025,
                'date_label'      => 'Maret 2025',
                'title'           => 'Best Short Film Director',
                'description'     => 'Mendapatkan apresiasi tertinggi sebagai sutradara pendatang baru terbaik pada Festival Film Pendek.',
                'badge_text'      => 'PRESTASI UTAMA',
                'icon'            => 'ri-movie-2-line',
                'small_text'      => 'INDONESIA FILM FESTIVAL',
                'heading_text'    => 'Best Director',
                'signature_text'  => 'Annisa Esce',
                'sort_order'      => 9,
                'photo_name'      => 'ach_film_1.png',
                'bg_color_start'  => [108, 92, 231],
                'bg_color_end'    => [255, 105, 180]
            ],
            [
                'category_id'     => 3,
                'is_main'         => 0,
                'year'            => 2024,
                'date_label'      => 'September 2024',
                'title'           => 'Juara 1 Cinematography Shorts',
                'description'     => 'Menang penghargaan sinematografi terbaik untuk karya film sinematik fiksi bertema sosial.',
                'badge_text'      => 'GOLDEN AWARD',
                'icon'            => 'ri-camera-lens-line',
                'small_text'      => 'INDIE FILM AWARDS',
                'heading_text'    => 'Best Cinematography',
                'signature_text'  => 'Annisa Esce',
                'sort_order'      => 10,
                'photo_name'      => 'ach_film_2.png',
                'bg_color_start'  => [0, 206, 201],
                'bg_color_end'    => [142, 68, 173]
            ],
            [
                'category_id'     => 3,
                'is_main'         => 0,
                'year'            => 2024,
                'date_label'      => 'Februari 2024',
                'title'           => 'Best Colorist & Video Editor',
                'description'     => 'Apresiasi karya pengolahan warna (color grading) dan penyuntingan ritme cerita paling memukau.',
                'badge_text'      => 'BEST EDITING',
                'icon'            => 'ri-palette-line',
                'small_text'      => 'SHORT MOVIE COMPETITION',
                'heading_text'    => 'Best Color Grading',
                'signature_text'  => 'Annisa Esce',
                'sort_order'      => 11,
                'photo_name'      => 'ach_film_3.png',
                'bg_color_start'  => [225, 112, 85],
                'bg_color_end'    => [236, 64, 122]
            ],
            [
                'category_id'     => 3,
                'is_main'         => 0,
                'year'            => 2023,
                'date_label'      => 'Juli 2023',
                'title'           => 'Nominee Festival Film Pendek',
                'description'     => 'Lolos menjadi nominasi karya terbaik yang diputar dalam bioskop independen Asia Tenggara.',
                'badge_text'      => 'OFFICIAL SELECTION',
                'icon'            => 'ri-clapperboard-line',
                'small_text'      => 'SOUTH EAST ASIA FILM FEST',
                'heading_text'    => 'Official Selection',
                'signature_text'  => 'Annisa Esce',
                'sort_order'      => 12,
                'photo_name'      => 'ach_film_4.png',
                'bg_color_start'  => [142, 68, 173],
                'bg_color_end'    => [255, 105, 180]
            ]
        ];

        // 5. Insert Data Achievement (Foto di-generate via Gemini AI)
        foreach ($achievements as $item) {
            $photoName = $item['photo_name'];

            // Simpan ke database dengan nama file SAJA (misal: 'ach_creator_1.jpg')
            $db->table('achievements')->insert([
                'category_id'    => $item['category_id'],
                'is_main'        => $item['is_main'],
                'year'           => $item['year'],
                'date_label'     => $item['date_label'],
                'title'          => $item['title'],
                'description'    => $item['description'],
                'photo'          => $photoName,
                'badge_text'     => $item['badge_text'],
                'icon'           => $item['icon'],
                'small_text'     => $item['small_text'],
                'heading_text'   => $item['heading_text'],
                'signature_text' => $item['signature_text'],
                'sort_order'     => $item['sort_order'],
            ]);
        }
    }
}
