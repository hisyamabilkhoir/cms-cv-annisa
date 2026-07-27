<?php

// Load CI4 environment
define('FCPATH', __DIR__ . '/public' . DIRECTORY_SEPARATOR);
require FCPATH . '../app/Config/Paths.php';
$paths = new Config\Paths();
require rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';

$db = \Config\Database::connect();
$db->table('hero_stats')->insertBatch([
    ['label'=>'Followers','value'=>'1.2M+','sort_order'=>1],
    ['label'=>'Videos Edited','value'=>'500+','sort_order'=>2],
    ['label'=>'Brands','value'=>'50+','sort_order'=>3]
]);
$db->table('hero_meta')->insertBatch([
    ['key_label'=>'Niche','value_text'=>'Property • Self-Dev • Travel • F&B','sort_order'=>1],
    ['key_label'=>'Strength','value_text'=>'Hooks • Script • Edit','sort_order'=>2],
    ['key_label'=>'Tools','value_text'=>'CapCut • AE • Photoshop • Canva','sort_order'=>3]
]);
$db->table('social_links')->insertBatch([
    ['platform'=>'TikTok','url'=>'https://tiktok.com','icon'=>'ri-tiktok-fill','sort_order'=>1],
    ['platform'=>'Instagram','url'=>'https://instagram.com','icon'=>'ri-instagram-line','sort_order'=>2],
    ['platform'=>'YouTube','url'=>'https://youtube.com','icon'=>'ri-youtube-fill','sort_order'=>3]
]);
echo "Success";
