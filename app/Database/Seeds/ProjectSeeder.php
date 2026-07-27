<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // 1. Matikan Foreign Key Checks & Truncate data lama
        $db->disableForeignKeyChecks();
        $db->table('project_galleries')->truncate();
        $db->table('project_bullets')->truncate();
        $db->table('projects')->truncate();
        $db->table('project_categories')->truncate();
        $db->enableForeignKeyChecks();

        // 2. Buat folder upload jika belum ada
        $uploadDir = FCPATH . 'assets/uploads/projects/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // 3. Sediakan 8 Kategori Project
        $categories = [
            ['id' => 1, 'name' => 'F&B',         'slug' => 'fb',          'sort_order' => 1],
            ['id' => 2, 'name' => 'Fashion',     'slug' => 'fashion',     'sort_order' => 2],
            ['id' => 3, 'name' => 'Logo',        'slug' => 'logo',        'sort_order' => 3],
            ['id' => 4, 'name' => 'Product',     'slug' => 'product',     'sort_order' => 4],
            ['id' => 5, 'name' => 'Event',       'slug' => 'event',       'sort_order' => 5],
            ['id' => 6, 'name' => 'Wedding',     'slug' => 'wedding',     'sort_order' => 6],
            ['id' => 7, 'name' => 'Property',    'slug' => 'property',    'sort_order' => 7],
            ['id' => 8, 'name' => 'Travel Vlog', 'slug' => 'travel-vlog', 'sort_order' => 8]
        ];

        foreach ($categories as $cat) {
            $db->table('project_categories')->insert($cat);
        }

        // 4. Sediakan 8 Project Data Lengkap
        $projectsData = [
            [
                'category_id'    => 1,
                'title'          => 'Chicken Master Commercial',
                'description'    => 'Video iklan komersial gourmet crispy chicken dengan pencahayaan sinematik studio dan color grading profesional.',
                'tag'            => 'Commercial Video, F&B Ads',
                'thumbnail'      => 'p1.png',
                'thumbnail_type' => 'image',
                'youtube_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'project_link'   => 'https://instagram.com/annisaesce',
                'views'          => '1.2M',
                'ctr'            => '8.5%',
                'sort_order'     => 1,
                'is_active'      => 1,
                'bullets'        => [
                    'Cinematic Lighting Studio Setup',
                    'Dynamic Transitions & High Speed Camera',
                    'Color Graded in DaVinci Resolve',
                    '4K Ultra HD Commercial Shoot'
                ]
            ],
            [
                'category_id'    => 2,
                'title'          => 'Glamour Runway 2024',
                'description'    => 'Liputan sinematik ajang peragaan busana malam dengan teknik slow motion dan ritme editing yang trendy.',
                'tag'            => 'Fashion Show, Model Reel',
                'thumbnail'      => 'p2.png',
                'thumbnail_type' => 'image',
                'youtube_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'project_link'   => 'https://instagram.com/annisaesce',
                'views'          => '850K',
                'ctr'            => '7.2%',
                'sort_order'     => 2,
                'is_active'      => 1,
                'bullets'        => [
                    '4K Runway Coverage & Close-up Details',
                    'High-Fashion Editing Style',
                    'Slow Motion Catwalk Highlight',
                    'Vibrant Fashion Color Profile'
                ]
            ],
            [
                'category_id'    => 3,
                'title'          => 'Annisa Esce Brand Identity',
                'description'    => 'Animasi logo 3D futuristik dengan efek pendaran cahaya neon pink dan desain sound khas personal branding.',
                'tag'            => '3D Motion Logo, Brand Identity',
                'thumbnail'      => 'p3.png',
                'thumbnail_type' => 'image',
                'youtube_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'project_link'   => 'https://instagram.com/annisaesce',
                'views'          => '2.4M',
                'ctr'            => '12.4%',
                'sort_order'     => 3,
                'is_active'      => 1,
                'bullets'        => [
                    '3D Geometry Modeling & Texturing',
                    'After Effects Motion Compositing',
                    'Custom Sound Design & Audio Mix',
                    'Vector Geometry Brand Guidelines'
                ]
            ],
            [
                'category_id'    => 4,
                'title'          => 'Tech Gadget Unboxing Reel',
                'description'    => 'Konten UGC video ulasan gadget dalam format vertikal (9:16) dengan hook tinggi dan subtitle dinamis.',
                'tag'            => 'UGC Video, Product Review',
                'thumbnail'      => 'p4.png',
                'thumbnail_type' => 'image',
                'youtube_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'project_link'   => 'https://instagram.com/annisaesce',
                'views'          => '3.1M',
                'ctr'            => '14.8%',
                'sort_order'     => 4,
                'is_active'      => 1,
                'bullets'        => [
                    'Vertical Short-Form Content (9:16)',
                    'Fast-Paced Engaging Editing',
                    'Dynamic Animated Subtitles',
                    'High Converting Marketing Hook'
                ]
            ],
            [
                'category_id'    => 5,
                'title'          => 'Music Festival Aftermovie',
                'description'    => 'Video dokumentasi festival musik nasional dengan sinkronisasi multi-kamera dan pencahayaan panggung spektakuler.',
                'tag'            => 'Event Coverage, Concert Film',
                'thumbnail'      => 'p5.png',
                'thumbnail_type' => 'image',
                'youtube_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'project_link'   => 'https://instagram.com/annisaesce',
                'views'          => '1.8M',
                'ctr'            => '9.6%',
                'sort_order'     => 5,
                'is_active'      => 1,
                'bullets'        => [
                    'Multi-Cam Synchronization',
                    'Stage Pyrotechnics & Laser Shots',
                    'Beat-Matching Rhythmic Cuts',
                    'Epic Crowd Atmosphere Capture'
                ]
            ],
            [
                'category_id'    => 6,
                'title'          => 'The Romantic Dream Wedding',
                'description'    => 'Film dokumenter pernikahan romantis berkonsep impian dengan pengambilan gambar udara dan alur cerita emosional.',
                'tag'            => 'Cinematic Wedding, Film Dokumenter',
                'thumbnail'      => 'p6.png',
                'thumbnail_type' => 'image',
                'youtube_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'project_link'   => 'https://instagram.com/annisaesce',
                'views'          => '920K',
                'ctr'            => '8.1%',
                'sort_order'     => 6,
                'is_active'      => 1,
                'bullets'        => [
                    'Emotional Storytelling Concept',
                    'Drone Aerial Perspective',
                    'Soft Pastel Color Grading',
                    'Crystal Clear Vow Audio Mixing'
                ]
            ],
            [
                'category_id'    => 7,
                'title'          => 'Modern Luxury Villa Tour',
                'description'    => 'Tur properti vila mewah dengan pergerakan kamera gimbal yang sangat halus dan pencahayaan senja dramatis.',
                'tag'            => 'Real Estate Video, Architectural Film',
                'thumbnail'      => 'p7.png',
                'thumbnail_type' => 'image',
                'youtube_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'project_link'   => 'https://instagram.com/annisaesce',
                'views'          => '640K',
                'ctr'            => '6.8%',
                'sort_order'     => 7,
                'is_active'      => 1,
                'bullets'        => [
                    'Smooth Gimbal Architectural Walkthrough',
                    'Interior Natural Light Balance',
                    'HDR Sunset Tone Grading',
                    'Speed Ramp Dynamic Transitions'
                ]
            ],
            [
                'category_id'    => 8,
                'title'          => 'Japan Winter Escape Vlog',
                'description'    => 'Dokumentasi perjalanan wisata musim dingin di Jepang dengan nuansa estetis dan nada warna sinematik.',
                'tag'            => 'Travel Documentary, Vlog Cinematic',
                'thumbnail'      => 'p8.png',
                'thumbnail_type' => 'image',
                'youtube_url'    => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'project_link'   => 'https://instagram.com/annisaesce',
                'views'          => '1.5M',
                'ctr'            => '10.2%',
                'sort_order'     => 8,
                'is_active'      => 1,
                'bullets'        => [
                    'POV Cinematic Travel Style',
                    'Ambient Soundscapes & Natural Audio',
                    'Pink Aesthetic Color Profile',
                    'Fast Short-Reels Montage Cut'
                ]
            ]
        ];

        // Array preset gambar AI untuk galeri per project
        $aiImages = ['p1.png', 'p2.png', 'p3.png', 'p4.png', 'p5.png', 'p6.png', 'p7.png', 'p8.png'];

        // 5. Insert Projects, Bullets, & 5 Galeri (1 Youtube + 4 Image) Per Project
        foreach ($projectsData as $idx => $pData) {
            $bullets = $pData['bullets'];
            unset($pData['bullets']);

            // Insert Project & Get Real Auto-Increment ID
            $db->table('projects')->insert($pData);
            $projectId = $db->insertID();

            // Insert Bullets
            $bOrder = 1;
            foreach ($bullets as $bText) {
                $db->table('project_bullets')->insert([
                    'project_id' => $projectId,
                    'text'       => $bText,
                    'sort_order' => $bOrder++
                ]);
            }

            // Insert 5 Galeri Per Project (1 Youtube + 4 Images)
            // Gambar AI dipilih berurutan dari preset aiImages
            $thumbImg = $aiImages[$idx % count($aiImages)];
            $img1 = $aiImages[($idx + 1) % count($aiImages)];
            $img2 = $aiImages[($idx + 2) % count($aiImages)];
            $img3 = $aiImages[($idx + 3) % count($aiImages)];
            $img4 = $aiImages[($idx + 4) % count($aiImages)];

            // Item 1: Galeri Tipe Youtube (dengan Youtube Embed URL + Custom Thumbnail AI)
            $db->table('project_galleries')->insert([
                'project_id'       => $projectId,
                'media_type'       => 'youtube',
                'file_path'        => null,
                'youtube_url'      => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'custom_thumbnail' => $thumbImg,
                'title'            => 'Video Teaser & Highlights ' . $pData['title'],
                'caption'          => 'Highlight sinematik karya dalam format video YouTube 4K',
                'description'      => 'Video kompilasi momen terbaik project ' . $pData['title'],
                'sort_order'       => 1
            ]);

            // Item 2: Galeri Tipe Image 1
            $db->table('project_galleries')->insert([
                'project_id'       => $projectId,
                'media_type'       => 'image',
                'file_path'        => $img1,
                'youtube_url'      => null,
                'custom_thumbnail' => null,
                'title'            => 'Behind The Scenes & Angle Shot #1',
                'caption'          => 'Pengambilan sudut gambar utama karya',
                'description'      => 'Detail visual hasil editing dan compositing',
                'sort_order'       => 2
            ]);

            // Item 3: Galeri Tipe Image 2
            $db->table('project_galleries')->insert([
                'project_id'       => $projectId,
                'media_type'       => 'image',
                'file_path'        => $img2,
                'youtube_url'      => null,
                'custom_thumbnail' => null,
                'title'            => 'Color Grading & Lighting Showcase #2',
                'caption'          => 'Hasil penataan warna dan gradasi nada cahaya',
                'description'      => 'Studi penataan cahaya studio dan atmosfer sinematik',
                'sort_order'       => 3
            ]);

            // Item 4: Galeri Tipe Image 3
            $db->table('project_galleries')->insert([
                'project_id'       => $projectId,
                'media_type'       => 'image',
                'file_path'        => $img3,
                'youtube_url'      => null,
                'custom_thumbnail' => null,
                'title'            => 'High-Speed Macro Detail #3',
                'caption'          => 'Tampilan detail tekstur dan kecerahan gambar',
                'description'      => 'Kejelasan detail resolusi tinggi 4K Ultra HD',
                'sort_order'       => 4
            ]);

            // Item 5: Galeri Tipe Image 4
            $db->table('project_galleries')->insert([
                'project_id'       => $projectId,
                'media_type'       => 'image',
                'file_path'        => $img4,
                'youtube_url'      => null,
                'custom_thumbnail' => null,
                'title'            => 'Final Production Showcase #4',
                'caption'          => 'Poster dan tampilan akhir hasil produksi karya',
                'description'      => 'Tampilan utuh karya yang telah dipublikasikan',
                'sort_order'       => 5
            ]);
        }
    }
}
