<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BrandModel;
use App\Models\BrandSettingModel;

class BrandController extends BaseController
{
    protected $brandModel;
    protected $brandSettingModel;

    public function __construct()
    {
        $this->brandModel = new BrandModel();
        $this->brandSettingModel = new BrandSettingModel();
        helper('upload');
    }

    public function index()
    {
        $data = [
            'brands'        => $this->brandModel->orderBy('sort_order', 'ASC')->findAll(),
            'brandSettings' => $this->brandSettingModel->find(1)
        ];
        return view('admin/brands/index', $data);
    }

    public function updateSettings()
    {
        $oldData = $this->brandSettingModel->find(1) ?? [];

        $uploadPath = 'brands';
        if (!is_dir(FCPATH . 'assets/uploads/' . $uploadPath)) {
            mkdir(FCPATH . 'assets/uploads/' . $uploadPath, 0777, true);
        }

        $bg_desktop = upload_file($this->request, 'bg_desktop', $uploadPath, $oldData['bg_desktop'] ?? null);
        $bg_mobile  = upload_file($this->request, 'bg_mobile', $uploadPath, $oldData['bg_mobile'] ?? null);

        $data = [];
        if ($bg_desktop) $data['bg_desktop'] = $bg_desktop;
        if ($bg_mobile)  $data['bg_mobile'] = $bg_mobile;

        if (!empty($data)) {
            if (!empty($oldData)) {
                $this->brandSettingModel->update(1, $data);
            } else {
                $data['id'] = 1;
                $this->brandSettingModel->insert($data);
            }
        }

        return redirect()->to('admin/brands')->with('success', 'Pengaturan background section Brands berhasil diperbarui.');
    }

    public function store()
    {
        $uploadPath = 'brands';
        if (!is_dir(FCPATH . 'assets/uploads/' . $uploadPath)) {
            mkdir(FCPATH . 'assets/uploads/' . $uploadPath, 0777, true);
        }

        $logo = upload_file($this->request, 'logo', $uploadPath);

        $data = [
            'name'         => $this->request->getPost('name'),
            'logo'         => $logo,
            'location'     => $this->request->getPost('location'),
            'description'  => $this->request->getPost('description'),
            'project_link' => $this->request->getPost('project_link'),
            'sort_order'   => $this->request->getPost('sort_order') ?? 0,
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->brandModel->insert($data);

        return redirect()->to('admin/brands')->with('success', 'Brand berhasil ditambahkan.');
    }

    public function update($id)
    {
        $oldData = $this->brandModel->find($id);
        
        $uploadPath = 'brands';
        $logo = upload_file($this->request, 'logo', $uploadPath, $oldData['logo']);

        $data = [
            'name'         => $this->request->getPost('name'),
            'location'     => $this->request->getPost('location'),
            'description'  => $this->request->getPost('description'),
            'project_link' => $this->request->getPost('project_link'),
            'sort_order'   => $this->request->getPost('sort_order') ?? 0,
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($logo) {
            $data['logo'] = $logo;
        }

        $this->brandModel->update($id, $data);

        return redirect()->to('admin/brands')->with('success', 'Brand berhasil diperbarui.');
    }

    public function delete($id)
    {
        $oldData = $this->brandModel->find($id);
        if ($oldData && $oldData['logo']) {
            @unlink(FCPATH . 'assets/uploads/brands/' . $oldData['logo']);
        }
        
        $this->brandModel->delete($id);

        return redirect()->to('admin/brands')->with('success', 'Brand berhasil dihapus.');
    }
}
