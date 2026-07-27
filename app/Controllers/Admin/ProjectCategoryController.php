<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProjectCategoryModel;

class ProjectCategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new ProjectCategoryModel();
    }

    public function index()
    {
        $data = [
            'categories' => $this->categoryModel->orderBy('sort_order', 'ASC')->findAll()
        ];
        return view('admin/project-categories/index', $data);
    }

    public function store()
    {
        $name = $this->request->getPost('name');
        
        $data = [
            'name' => $name,
            'slug' => url_title($name, '-', true),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];

        $this->categoryModel->insert($data);
        return redirect()->to('admin/project-categories')->with('success', 'Kategori Project berhasil ditambahkan.');
    }

    public function update($id)
    {
        $name = $this->request->getPost('name');
        
        $data = [
            'name' => $name,
            'slug' => url_title($name, '-', true),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];

        $this->categoryModel->update($id, $data);
        return redirect()->to('admin/project-categories')->with('success', 'Kategori Project berhasil diperbarui.');
    }

    public function delete($id)
    {
        // Check if used in projects
        $db = \Config\Database::connect();
        $count = $db->table('projects')->where('category_id', $id)->countAllResults();
        
        if ($count > 0) {
            return redirect()->to('admin/project-categories')->with('error', 'Kategori tidak dapat dihapus karena masih digunakan pada project.');
        }

        $this->categoryModel->delete($id);
        return redirect()->to('admin/project-categories')->with('success', 'Kategori Project berhasil dihapus.');
    }
}
