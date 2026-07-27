<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AchievementModel;
use App\Models\AchievementCategoryModel;

class AchievementController extends BaseController
{
    protected $achievementModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->achievementModel = new AchievementModel();
        $this->categoryModel = new AchievementCategoryModel();
        helper('upload');
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('achievements');
        $builder->select('achievements.*, achievement_categories.name as category_name');
        $builder->join('achievement_categories', 'achievement_categories.id = achievements.category_id', 'left');
        $builder->orderBy('achievements.sort_order', 'ASC');
        
        $data = [
            'achievements' => $builder->get()->getResultArray(),
            'categories' => $this->categoryModel->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return view('admin/achievements/index', $data);
    }

    public function store()
    {
        $uploadPath = 'achievements';
        if (!is_dir(FCPATH . 'assets/uploads/' . $uploadPath)) {
            mkdir(FCPATH . 'assets/uploads/' . $uploadPath, 0777, true);
        }

        $photo = upload_file($this->request, 'photo', $uploadPath);

        $data = [
            'category_id' => $this->request->getPost('category_id'),
            'is_main' => $this->request->getPost('is_main') ? 1 : 0,
            'year' => $this->request->getPost('year'),
            'date_label' => $this->request->getPost('date_label'),
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'badge_text' => $this->request->getPost('badge_text'),
            'icon' => $this->request->getPost('icon'),
            'small_text' => $this->request->getPost('small_text'),
            'heading_text' => $this->request->getPost('heading_text'),
            'signature_text' => $this->request->getPost('signature_text'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];

        if ($photo) {
            $data['photo'] = $photo;
        }

        $this->achievementModel->insert($data);
        return redirect()->to('admin/achievements')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function update($id)
    {
        $oldData = $this->achievementModel->find($id);
        
        $uploadPath = 'achievements';
        $photo = upload_file($this->request, 'photo', $uploadPath, $oldData['photo']);

        $data = [
            'category_id' => $this->request->getPost('category_id'),
            'is_main' => $this->request->getPost('is_main') ? 1 : 0,
            'year' => $this->request->getPost('year'),
            'date_label' => $this->request->getPost('date_label'),
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'badge_text' => $this->request->getPost('badge_text'),
            'icon' => $this->request->getPost('icon'),
            'small_text' => $this->request->getPost('small_text'),
            'heading_text' => $this->request->getPost('heading_text'),
            'signature_text' => $this->request->getPost('signature_text'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];

        if ($photo) {
            $data['photo'] = $photo;
        }

        $this->achievementModel->update($id, $data);
        return redirect()->to('admin/achievements')->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $oldData = $this->achievementModel->find($id);
        if ($oldData && $oldData['photo']) {
            @unlink(FCPATH . 'assets/uploads/achievements/' . $oldData['photo']);
        }
        
        $this->achievementModel->delete($id);
        return redirect()->to('admin/achievements')->with('success', 'Prestasi berhasil dihapus.');
    }
}
