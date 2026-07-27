<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AchievementCategoryModel;

class AchievementCategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new AchievementCategoryModel();
    }

    public function index()
    {
        $data = [
            'categories' => $this->categoryModel->orderBy('sort_order', 'ASC')->findAll()
        ];
        return view('admin/achievement-categories/index', $data);
    }

    public function store()
    {
        $name = $this->request->getPost('name');
        
        $data = [
            'name' => $name,
            'slug' => url_title($name, '-', true),
            'icon' => $this->request->getPost('icon'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];

        $this->categoryModel->insert($data);
        return redirect()->to('admin/achievement-categories')->with('success', 'Kategori Prestasi berhasil ditambahkan.');
    }

    public function update($id)
    {
        $name = $this->request->getPost('name');
        
        $data = [
            'name' => $name,
            'slug' => url_title($name, '-', true),
            'icon' => $this->request->getPost('icon'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];

        $this->categoryModel->update($id, $data);
        return redirect()->to('admin/achievement-categories')->with('success', 'Kategori Prestasi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();
        $count = $db->table('achievements')->where('category_id', $id)->countAllResults();
        
        if ($count > 0) {
            return redirect()->to('admin/achievement-categories')->with('error', 'Kategori tidak dapat dihapus karena masih digunakan.');
        }

        $this->categoryModel->delete($id);
        return redirect()->to('admin/achievement-categories')->with('success', 'Kategori Prestasi berhasil dihapus.');
    }
}
