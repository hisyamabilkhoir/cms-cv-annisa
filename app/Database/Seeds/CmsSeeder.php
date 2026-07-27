<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run()
    {
        // 1. Admin
        $this->db->table('admins')->insert([
            'username'   => 'admin',
            'email'      => 'admin@example.com',
            'password'   => password_hash('admin123', PASSWORD_DEFAULT),
            'name'       => 'Administrator',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // 2. Hero Settings
        $this->db->table('hero_settings')->insert([
            'id'             => 1,
            'pill_text'      => 'Short-form • Hooks • Story',
            'title_line1'    => 'Konten yang',
            'typewrite_words1'=> json_encode(["nempel,", "berkesan,", "viral,"]),
            'title_line2'    => 'hasil yang',
            'typewrite_words2'=> json_encode(["kerasa.", "nyata.", "maksimal."]),
            'description'    => 'Hai, gue Annisa! Kreator yang ngebantu brand dan audiens lo connect lewat konten yang hook-nya dapet, story-nya relatable, dan hasilnya nyata.',
            'photo'          => 'header.jpg',
            'bg_desktop'     => 'hero-bg.png',
            'bg_mobile'      => 'hero-bg-mobile.png',
            'cv_file'        => 'cv annisa.pdf',
            'portfolio_link' => 'https://drive.google.com/drive/u/0/folders/1Q2Z3Z4Z5Z6Z7Z8Z9Z0Z1Z2Z3Z4Z5Z6Z7',
        ]);

        // 3. Hero Stats
        $this->db->table('hero_stats')->insertBatch([
            ['label' => 'Total Campaigns', 'value' => '100+', 'sort_order' => 1],
            ['label' => 'Total Views', 'value' => '50M+', 'sort_order' => 2],
            ['label' => 'Avg CTR', 'value' => '4.2%', 'sort_order' => 3],
        ]);

        // 4. Hero Meta
        $this->db->table('hero_meta')->insertBatch([
            ['key_label' => 'Niche', 'value_text' => 'Lifestyle, Tech, Beauty', 'sort_order' => 1],
            ['key_label' => 'Strength', 'value_text' => 'Storytelling, Visual Hooks', 'sort_order' => 2],
            ['key_label' => 'Tools', 'value_text' => 'CapCut, Premiere, Figma', 'sort_order' => 3],
        ]);

        // 5. About Settings
        $this->db->table('about_settings')->insert([
            'id'          => 1,
            'pill_text'   => 'About Me',
            'title'       => 'Behind the Content',
            'description' => 'Dari ide acak di notes sampai jadi video viral. Gue percaya konten terbaik itu yang nggak cuma estetik, tapi juga bisa bikin orang ngomong, "Wah, ini gue banget!"',
            'bg_image'    => 'bg-about.png',
        ]);

        // 6. Project Categories
        $this->db->table('project_categories')->insertBatch([
            ['name' => 'F&B', 'slug' => 'fb', 'sort_order' => 1],
            ['name' => 'Fashion', 'slug' => 'fashion', 'sort_order' => 2],
            ['name' => 'Logo', 'slug' => 'logo', 'sort_order' => 3],
            ['name' => 'Product', 'slug' => 'product', 'sort_order' => 4],
            ['name' => 'Event', 'slug' => 'event', 'sort_order' => 5],
            ['name' => 'Wedding', 'slug' => 'wedding', 'sort_order' => 6],
            ['name' => 'Property', 'slug' => 'property', 'sort_order' => 7],
            ['name' => 'Travel Vlog', 'slug' => 'travel', 'sort_order' => 8],
            ['name' => 'Poster', 'slug' => 'poster', 'sort_order' => 9],
            ['name' => 'Motion Logo', 'slug' => 'motion', 'sort_order' => 10],
        ]);
        
        // 7. Site Settings
        $this->db->table('site_settings')->insertBatch([
            ['key' => 'site_title', 'value' => 'Annisa ESCE - Content Creator', 'group' => 'seo'],
            ['key' => 'site_description', 'value' => 'Portfolio Annisa ESCE', 'group' => 'seo'],
            ['key' => 'whatsapp_number', 'value' => '6281234567890', 'group' => 'contact'],
            ['key' => 'email_address', 'value' => 'hello@annisa.com', 'group' => 'contact'],
        ]);
        
        // Project dummy data
        $this->db->table('projects')->insertBatch([
            [
                'category_id' => 8, // travel
                'title' => 'Video Tips and trick traveling',
                'description' => 'Konten travel edukatif yang dikemas ringkas dan engaging untuk audiens digital. Mengubah perencanaan perjalanan yang kompleks menjadi visual storytelling yang mudah dipahami, informatif, dan menarik.',
                'tag' => 'Scripter + Talent + Cameraman + Video Editor',
                'thumbnail' => 'triptracker.jpeg',
                'thumbnail_type' => 'image',
                'views' => '±101.157',
                'project_link' => 'https://www.instagram.com/triptracker.id',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'category_id' => 1, // fb
                'title' => 'Chicken Master',
                'description' => 'Konten visual F&B yang dirancang untuk meningkatkan daya tarik brand dan engagement audiens.',
                'tag' => 'Photographer + Designer + Cameraman',
                'thumbnail' => 'f&b-1.jpeg',
                'thumbnail_type' => 'image',
                'views' => '±105.827',
                'project_link' => 'https://www.instagram.com/officialchickenmaster/',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
