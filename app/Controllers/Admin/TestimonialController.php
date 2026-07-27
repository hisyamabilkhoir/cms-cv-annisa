<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TestimonialModel;

class TestimonialController extends BaseController
{
    protected $testimonialModel;

    public function __construct()
    {
        $this->testimonialModel = new TestimonialModel();
        helper('upload');
    }

    public function index()
    {
        $data = [
            'testimonials' => $this->testimonialModel->orderBy('sort_order', 'ASC')->findAll()
        ];
        return view('admin/testimonials/index', $data);
    }

    public function store()
    {
        $uploadPath = 'testimonials';
        if (!is_dir(FCPATH . 'assets/uploads/' . $uploadPath)) {
            mkdir(FCPATH . 'assets/uploads/' . $uploadPath, 0777, true);
        }

        $logo = upload_file($this->request, 'logo', $uploadPath);

        $data = [
            'brand_name' => $this->request->getPost('brand_name'),
            'rating' => $this->request->getPost('rating') ?? 5,
            'text' => $this->request->getPost('text'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];

        if ($logo) {
            $data['logo'] = $logo;
        }

        $this->testimonialModel->insert($data);
        return redirect()->to('admin/testimonials')->with('success', 'Testimonial berhasil ditambahkan.');
    }

    public function update($id)
    {
        $oldData = $this->testimonialModel->find($id);
        
        $uploadPath = 'testimonials';
        $logo = upload_file($this->request, 'logo', $uploadPath, $oldData['logo']);

        $data = [
            'brand_name' => $this->request->getPost('brand_name'),
            'rating' => $this->request->getPost('rating') ?? 5,
            'text' => $this->request->getPost('text'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];

        if ($logo) {
            $data['logo'] = $logo;
        }

        $this->testimonialModel->update($id, $data);
        return redirect()->to('admin/testimonials')->with('success', 'Testimonial berhasil diperbarui.');
    }

    public function delete($id)
    {
        $oldData = $this->testimonialModel->find($id);
        if ($oldData && $oldData['logo']) {
            @unlink(FCPATH . 'assets/uploads/testimonials/' . $oldData['logo']);
        }
        
        $this->testimonialModel->delete($id);
        return redirect()->to('admin/testimonials')->with('success', 'Testimonial berhasil dihapus.');
    }
}
