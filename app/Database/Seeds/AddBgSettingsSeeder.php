<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddBgSettingsSeeder extends Seeder
{
    public function run()
    {
        // 1. Copy exact background images to uploads if not present
        $aboutUploadDir = FCPATH . 'assets/uploads/about/';
        if (!is_dir($aboutUploadDir)) mkdir($aboutUploadDir, 0777, true);
        @copy(FCPATH . 'assets/assets/achievements-bg.png', $aboutUploadDir . 'achievements-bg.png');
        @copy(FCPATH . 'assets/assets/hero-bg-mobile-new-3.png', $aboutUploadDir . 'hero-bg-mobile-new-3.png');

        $brandUploadDir = FCPATH . 'assets/uploads/brands/';
        if (!is_dir($brandUploadDir)) mkdir($brandUploadDir, 0777, true);
        @copy(FCPATH . 'assets/assets/bg-brands-new.png', $brandUploadDir . 'bg-brands-new.png');
        @copy(FCPATH . 'assets/assets/bg-brands-mobile.png', $brandUploadDir . 'bg-brands-mobile.png');
        @copy(FCPATH . 'assets/assets/alfatih.png', $brandUploadDir . 'alfatih.png');
        @copy(FCPATH . 'assets/assets/bisaai.png', $brandUploadDir . 'bisaai.png');
        @copy(FCPATH . 'assets/assets/shaff-2.png', $brandUploadDir . 'shaff-2.png');

        // 2. Update about_settings with exact real background image filenames used by style.css in landing page
        $about = $this->db->table('about_settings')->where('id', 1)->get()->getRowArray();
        if ($about) {
            $this->db->table('about_settings')->where('id', 1)->update([
                'bg_image'  => 'achievements-bg.png',
                'bg_mobile' => 'hero-bg-mobile-new-3.png',
            ]);
        } else {
            $this->db->table('about_settings')->insert([
                'id'          => 1,
                'pill_text'   => 'About Me',
                'title'       => 'Menciptakan konten yang <span class="text-pink">berkesan</span>, <br>bukan hanya sekadar viral.',
                'description' => 'Strategi, storytelling, dan visual yang dirancang untuk menarik perhatian dan mendorong aksi nyata.',
                'bg_image'    => 'achievements-bg.png',
                'bg_mobile'   => 'hero-bg-mobile-new-3.png',
            ]);
        }

        // 3. Update brand_settings with exact real background image filenames from landing page
        $brandSettings = $this->db->table('brand_settings')->where('id', 1)->get()->getRowArray();
        if ($brandSettings) {
            $this->db->table('brand_settings')->where('id', 1)->update([
                'bg_desktop' => 'bg-brands-new.png',
                'bg_mobile'  => 'bg-brands-mobile.png',
            ]);
        } else {
            $this->db->table('brand_settings')->insert([
                'id'         => 1,
                'bg_desktop' => 'bg-brands-new.png',
                'bg_mobile'  => 'bg-brands-mobile.png',
            ]);
        }

        echo "AddBgSettingsSeeder updated About and Brands desktop & mobile background images successfully!\n";
    }
}
