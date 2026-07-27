<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddMoreTestimonialsSeeder extends Seeder
{
    public function run()
    {
        $newTestimonials = [
            [
                'brand_name' => 'Trip Tracker',
                'logo'       => null,
                'rating'     => 5,
                'text'       => 'Konten promosi travel yang sangat informatif dan visualnya sangat memanjakan mata.',
                'is_active'  => 1,
                'sort_order' => 4,
            ],
            [
                'brand_name' => '828 Souvenir',
                'logo'       => null,
                'rating'     => 5,
                'text'       => 'Produk souvenir kami jadi terlihat lebih mewah dan eksklusif berkat video reel dari Annisa.',
                'is_active'  => 1,
                'sort_order' => 5,
            ],
            [
                'brand_name' => 'Chicken Master',
                'logo'       => null,
                'rating'     => 5,
                'text'       => 'Visual F&B yang menggugah selera! Sales outlet kami langsung naik setelah campaign jalan.',
                'is_active'  => 1,
                'sort_order' => 6,
            ],
            [
                'brand_name' => 'Selasik',
                'logo'       => null,
                'rating'     => 5,
                'text'       => 'Pacing video rapi dan warna tone-nya pas banget sama identitas brand kami.',
                'is_active'  => 1,
                'sort_order' => 7,
            ],
            [
                'brand_name' => 'Adi Mesti Jadi',
                'logo'       => null,
                'rating'     => 5,
                'text'       => 'Eksekusi script sampai editing sangat profesional, pengerjaan cepat dan komunikatif.',
                'is_active'  => 1,
                'sort_order' => 8,
            ],
            [
                'brand_name' => 'Esce Potrait',
                'logo'       => null,
                'rating'     => 5,
                'text'       => 'Sangat paham tren konten terkini. Hasil videonya aesthetic dan banyak di-save audiens.',
                'is_active'  => 1,
                'sort_order' => 9,
            ],
            [
                'brand_name' => 'Jack Howard',
                'logo'       => null,
                'rating'     => 5,
                'text'       => 'Short-form ads yang dihasilkan sangat berdampak pada peningkatan leads bisnis kami.',
                'is_active'  => 1,
                'sort_order' => 10,
            ],
        ];

        foreach ($newTestimonials as $testi) {
            $exists = $this->db->table('testimonials')
                ->where('brand_name', $testi['brand_name'])
                ->countAllResults();

            if ($exists == 0) {
                $this->db->table('testimonials')->insert($testi);
            }
        }
    }
}
