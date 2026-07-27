<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FullCmsSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks to allow truncating
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0;');

        // Truncate tables first
        $tables = [
            'brands', 'resume_experiences', 'resume_skills', 'resume_tools', 
            'testimonials', 'achievement_categories', 'achievements', 
            'hero_stats', 'hero_meta', 'social_links', 'about_settings', 
            'about_icons', 'about_mini_stats', 'about_cards', 'brand_settings'
        ];
        foreach ($tables as $table) {
            $this->db->table($table)->truncate();
        }

        // Re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1;');

        // Add Brand Settings
        $this->db->table('brand_settings')->insert([
            'id'         => 1,
            'bg_desktop' => 'bg-brands-desktop.png',
            'bg_mobile'  => 'bg-brands-mobile.png'
        ]);

        // Add Brands
        $this->db->table('brands')->insertBatch([
            ['name' => 'Al Fatih Umrah', 'logo' => 'alfatih.png', 'location' => 'Indonesia', 'description' => 'Perusahaan travel umrah dengan sistem digital & promosi modern.', 'sort_order' => 1, 'is_active' => 1],
            ['name' => 'BISA AI', 'logo' => 'bisaai.png', 'location' => 'Indonesia', 'description' => 'Platform edukasi AI & teknologi untuk pengembangan talenta digital.', 'sort_order' => 2, 'is_active' => 1],
            ['name' => 'Shaff.id', 'logo' => 'shaff-2.png', 'location' => 'Indonesia', 'description' => 'Aplikasi kolaboratif untuk komunitas muslim profesional.', 'sort_order' => 3, 'is_active' => 1]
        ]);

        // Add Resume Experiences
        $this->db->table('resume_experiences')->insertBatch([
            ['title' => 'Content Creator', 'period' => '2023 — Now', 'description' => 'Short-form ads + brand story + content system.', 'sort_order' => 1],
            ['title' => 'Lead Video Editor', 'period' => '2021 — 2023', 'description' => 'Nge-lead tim post-production untuk YouTube channel lifestyle.', 'sort_order' => 2],
            ['title' => 'Freelance Scripter', 'period' => '2020 — 2021', 'description' => 'Nulis ratusan hook & script buat kreator TikTok dan Reels.', 'sort_order' => 3],
        ]);

        // Add Resume Skills
        $this->db->table('resume_skills')->insertBatch([
            ['name' => 'Scriptwriting (Hook & Retention)', 'percentage' => 90, 'sort_order' => 1],
            ['name' => 'Video Editing (Pacing & Rhythm)', 'percentage' => 85, 'sort_order' => 2],
            ['name' => 'Content Strategy & Directing', 'percentage' => 80, 'sort_order' => 3],
        ]);

        // Add Resume Tools
        $this->db->table('resume_tools')->insertBatch([
            ['name' => 'Premiere', 'logo' => 'd-logo-1.jpeg', 'sort_order' => 1],
            ['name' => 'CapCut Pro', 'logo' => 'jack.jpeg', 'sort_order' => 2],
            ['name' => 'Photoshop', 'logo' => 'event-4.jpeg', 'sort_order' => 3],
        ]);

        // Add Testimonials
        $this->db->table('testimonials')->insertBatch([
            ['brand_name' => 'BISA AI', 'logo' => 'triptracker.jpeg', 'rating' => 5, 'text' => 'Gila sih, script dari Annisa bikin retensi video kita naik 40%.', 'is_active' => 1, 'sort_order' => 1],
            ['brand_name' => 'Shaff.id', 'logo' => 'shaff-2.png', 'rating' => 5, 'text' => 'Editingnya nggak kaku, pacing-nya dapet banget buat TikTok.', 'is_active' => 1, 'sort_order' => 2],
            ['brand_name' => 'Al Fatih', 'logo' => 'f&b-1.jpeg', 'rating' => 5, 'text' => 'Kerja cepet, revisi minim, langsung paham brief tanpa banyak tanya.', 'is_active' => 1, 'sort_order' => 3],
        ]);
        
        // Add Achievement Categories
        $this->db->table('achievement_categories')->insertBatch([
            ['name' => 'Content Creator', 'slug' => 'content', 'icon' => 'bi bi-person-fill', 'sort_order' => 1],
            ['name' => 'Academy & Edu', 'slug' => 'academy', 'icon' => 'bi bi-briefcase-fill', 'sort_order' => 2],
            ['name' => 'Filmmaking', 'slug' => 'film', 'icon' => 'bi bi-play-fill', 'sort_order' => 3],
        ]);

        // Add Achievements
        $this->db->table('achievements')->insertBatch([
            // Content
            ['category_id' => 1, 'is_main' => 1, 'title' => 'CREATOR OF THE YEAR 2024', 'small_text' => 'TIKTOK AWARDS INDONESIA', 'description' => 'Penghargaan tertinggi bagi kreator yang konsisten memberikan dampak positif melalui konten edukasi kreatif.', 'year' => '2024', 'badge_text' => '★ PRESTASI UTAMA', 'date_label' => '2024', 'photo' => 'creator_award.png', 'sort_order' => 1],
            ['category_id' => 1, 'is_main' => 0, 'title' => 'Brand Collab Terbaik', 'small_text' => '', 'description' => 'Memenangkan campaign kolaborasi dengan brand tech nasional.', 'year' => '2023', 'badge_text' => '', 'date_label' => 'Oktober 2023', 'photo' => 'brand_collab.png', 'sort_order' => 2],
            // Academy
            ['category_id' => 2, 'is_main' => 1, 'title' => 'INSTRUCTOR OF THE YEAR 2025', 'small_text' => 'NATIONAL EDUCATION AWARDS', 'description' => 'Penghargaan tertinggi di bidang pendidikan kreatif.', 'year' => '2025', 'badge_text' => '★ PRESTASI UTAMA', 'date_label' => '2025', 'photo' => 'main_academy.png', 'sort_order' => 3],
            // Film
            ['category_id' => 3, 'is_main' => 1, 'title' => 'BEST SHORT FILM DIRECTOR', 'small_text' => 'INDONESIA FILM FESTIVAL', 'description' => 'Mendapatkan apresiasi tertinggi sebagai sutradara pendatang baru terbaik.', 'year' => '2025', 'badge_text' => '★ PRESTASI UTAMA', 'date_label' => '2025', 'photo' => 'main_film.png', 'sort_order' => 4],
        ]);

        // Add Hero Stats
        $this->db->table('hero_stats')->insertBatch([
            ['label'=>'Followers','value'=>'1.2M+','sort_order'=>1],
            ['label'=>'Videos Edited','value'=>'500+','sort_order'=>2],
            ['label'=>'Brands','value'=>'50+','sort_order'=>3]
        ]);

        // Add Hero Meta
        $this->db->table('hero_meta')->insertBatch([
            ['key_label'=>'Niche','value_text'=>'Property • Self-Dev • Travel • F&B','sort_order'=>1],
            ['key_label'=>'Strength','value_text'=>'Hooks • Script • Edit','sort_order'=>2],
            ['key_label'=>'Tools','value_text'=>'CapCut • AE • Photoshop • Canva','sort_order'=>3]
        ]);

        // Add Social Links
        $this->db->table('social_links')->insertBatch([
            ['platform'=>'TikTok','url'=>'https://tiktok.com','icon'=>'ri-tiktok-fill','sort_order'=>1],
            ['platform'=>'Instagram','url'=>'https://instagram.com','icon'=>'ri-instagram-line','sort_order'=>2],
            ['platform'=>'YouTube','url'=>'https://youtube.com','icon'=>'ri-youtube-fill','sort_order'=>3]
        ]);

        // Add About Settings
        $this->db->table('about_settings')->insert([
            'id' => 1,
            'pill_text' => 'About Me',
            'title' => 'Menciptakan konten yang <span class="text-pink">berkesan</span>, <br>bukan hanya sekadar viral.',
            'description' => 'Strategi, storytelling, dan visual yang dirancang untuk menarik perhatian dan mendorong aksi nyata.',
            'bg_image' => 'bg-about.png'
        ]);

        // Add About Icons
        $this->db->table('about_icons')->insertBatch([
            ['icon' => 'bi bi-tiktok', 'label' => "Hook\nStrategy", 'sort_order' => 1],
            ['icon' => 'bi bi-file-earmark-text', 'label' => "Storytelling\nTerstruktur", 'sort_order' => 2],
            ['icon' => 'bi bi-play-btn', 'label' => "Editing\nDinamis", 'sort_order' => 3],
            ['icon' => 'bi bi-sliders', 'label' => "CTA\nMenghasilkan Aksi", 'sort_order' => 4],
        ]);

        // Add About Mini Stats
        $this->db->table('about_mini_stats')->insertBatch([
            ['icon' => 'bi bi-clock', 'label' => 'Delivery', 'value' => '24–72h', 'sort_order' => 1],
            ['icon' => 'bi bi-play', 'label' => 'Format', 'value' => 'Reels / TikTok', 'sort_order' => 2],
            ['icon' => 'bi bi-sparkles', 'label' => 'Style', 'value' => 'Clean + Cinematic', 'sort_order' => 3],
        ]);

        // Add About Cards
        $this->db->table('about_cards')->insertBatch([
            ['icon' => 'bi bi-lightning-charge', 'title' => 'Hook & Structure', 'description' => '2 detik pertama harus “nangkep”. Problem → proof → CTA.', 'sort_order' => 1],
            ['icon' => 'bi bi-play-fill', 'title' => 'Editing Rhythm', 'description' => 'Cut tegas, beat sync, sound accent biar enak ditonton.', 'sort_order' => 2],
            ['icon' => 'bi bi-layers', 'title' => 'UGC / Ads', 'description' => 'Trust-first visual, overlay tipis, versi A/B untuk testing.', 'sort_order' => 3],
            ['icon' => 'bi bi-sliders', 'title' => 'Data Iteration', 'description' => 'Improve dari retention, CTR, saves. Bukan “feeling” doang.', 'sort_order' => 4],
        ]);
    }
}
