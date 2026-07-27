<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $heroModel = new \App\Models\HeroSettingModel();
        $aboutModel = new \App\Models\AboutSettingModel();
        $brandModel = new \App\Models\BrandModel();
        $projectCatModel = new \App\Models\ProjectCategoryModel();
        $projectModel = new \App\Models\ProjectModel();
        $achCatModel = new \App\Models\AchievementCategoryModel();
        $achModel = new \App\Models\AchievementModel();
        $resExpModel = new \App\Models\ResumeExperienceModel();
        $resSkillModel = new \App\Models\ResumeSkillModel();
        $resToolModel = new \App\Models\ResumeToolModel();
        $testiModel = new \App\Models\TestimonialModel();
        $siteSettingModel = new \App\Models\SiteSettingModel();
        $socialModel = new \App\Models\SocialLinkModel();

        $aboutIconModel = new \App\Models\AboutIconModel();
        $aboutMiniStatModel = new \App\Models\AboutMiniStatModel();
        $aboutCardModel = new \App\Models\AboutCardModel();

        // Settings mapping
        $settingsRaw = $siteSettingModel->findAll();
        $settings = [];
        foreach($settingsRaw as $s) {
            $settings[$s['key']] = $s['value'];
        }

        $heroStatsModel = new \App\Models\HeroStatModel();
        $heroMetaModel = new \App\Models\HeroMetaModel();

        $projectsRaw = $projectModel->select('projects.*, project_categories.slug as category_slug')
            ->join('project_categories', 'project_categories.id = projects.category_id', 'left')
            ->where('projects.is_active', 1)
            ->orderBy('projects.sort_order', 'ASC')
            ->findAll();

        $projectBulletModel = new \App\Models\ProjectBulletModel();
        $bullets = $projectBulletModel->orderBy('sort_order', 'ASC')->findAll();
        $bulletsByProject = [];
        foreach ($bullets as $b) {
            $bulletText = $b['text'] ?? $b['bullet_text'] ?? '';
            if (!empty($bulletText)) {
                $bulletsByProject[$b['project_id']][] = $bulletText;
            }
        }

        $projectGalleryModel = new \App\Models\ProjectGalleryModel();
        $galleries = $projectGalleryModel->orderBy('sort_order', 'ASC')->findAll();
        $galleriesByProject = [];
        foreach ($galleries as $g) {
            $item = [
                'id' => $g['id'],
                'media_type' => $g['media_type'],
                'title' => $g['title'] ?? '',
                'description' => $g['description'] ?? ''
            ];

            if ($g['media_type'] === 'youtube') {
                $item['youtube_url'] = $g['youtube_url'];
                preg_match('/(?:embed\/|watch\?v=|shorts\/|youtu\.be\/)([a-zA-Z0-9_-]+)/i', $g['youtube_url'], $ytMatch);
                $ytId = $ytMatch[1] ?? '';
                
                if (!empty($g['custom_thumbnail'])) {
                    $item['thumb'] = base_url('assets/uploads/projects/' . $g['custom_thumbnail']);
                } elseif (!empty($ytId)) {
                    $item['thumb'] = "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg";
                } else {
                    $item['thumb'] = base_url('assets/uploads/projects/' . ($g['file_path'] ?? ''));
                }
            } else {
                $imgPath = $g['file_path'] ?? $g['image_path'] ?? '';
                if (!empty($imgPath)) {
                    $item['thumb'] = base_url('assets/uploads/projects/' . $imgPath);
                    $item['src'] = base_url('assets/uploads/projects/' . $imgPath);
                } else {
                    continue;
                }
            }
            $galleriesByProject[$g['project_id']][] = $item;
        }

        $projects = [];
        foreach ($projectsRaw as $p) {
            $p['bullets'] = $bulletsByProject[$p['id']] ?? [];
            $p['gallery'] = $galleriesByProject[$p['id']] ?? [];
            
            $imgs = [];
            foreach ($p['gallery'] as $gItem) {
                if (($gItem['media_type'] ?? '') === 'image' && !empty($gItem['src'])) {
                    $imgs[] = $gItem['src'];
                }
            }
            $p['images'] = $imgs;

            $projects[] = $p;
        }

        $data = [
            'hero' => $heroModel->find(1),
            'heroStats' => $heroStatsModel->orderBy('sort_order', 'ASC')->findAll(),
            'heroMeta' => $heroMetaModel->orderBy('sort_order', 'ASC')->findAll(),
            'about' => $aboutModel->find(1),
            'aboutIcons' => $aboutIconModel->orderBy('sort_order', 'ASC')->findAll(),
            'aboutMiniStats' => $aboutMiniStatModel->orderBy('sort_order', 'ASC')->findAll(),
            'aboutCards' => $aboutCardModel->orderBy('sort_order', 'ASC')->findAll(),
            'brands' => $brandModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll(),
            'projectCategories' => $projectCatModel->orderBy('sort_order', 'ASC')->findAll(),
            'projects' => $projects,
            'achievementCategories' => $achCatModel->orderBy('sort_order', 'ASC')->findAll(),
            'achievements' => $achModel->orderBy('sort_order', 'ASC')->findAll(),
            'experiences' => $resExpModel->orderBy('sort_order', 'ASC')->findAll(),
            'skills' => $resSkillModel->orderBy('sort_order', 'ASC')->findAll(),
            'tools' => $resToolModel->orderBy('sort_order', 'ASC')->findAll(),
            'testimonials' => $testiModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll(),
            'socials' => $socialModel->orderBy('sort_order', 'ASC')->findAll(),
            'settings' => $settings,
            'brandSettings' => (new \App\Models\BrandSettingModel())->find(1),
        ];

        return view('landing/index', $data);
    }

    public function sendMessage()
    {
        $messageModel = new \App\Models\ContactMessageModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'message' => $this->request->getPost('message'),
            'created_at' => date('Y-m-d H:i:s'),
            'is_read' => 0
        ];

        $messageModel->insert($data);
        return redirect()->to('/#contact')->with('success', 'Pesan Anda berhasil dikirim!');
    }
}
