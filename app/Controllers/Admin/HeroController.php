<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HeroSettingModel;

class HeroController extends BaseController
{
    protected $heroModel;

    public function __construct()
    {
        $this->heroModel = new HeroSettingModel();
        helper('upload');
    }

    public function index()
    {
        $data = [
            'hero' => $this->heroModel->find(1)
        ];
        return view('admin/hero/index', $data);
    }

    public function update()
    {
        $oldData = $this->heroModel->find(1);

        // Handle Typewrite words (convert from comma separated back to JSON array)
        $words1 = explode(',', $this->request->getPost('typewrite_words1'));
        $words1 = array_map('trim', $words1);
        
        $words2 = explode(',', $this->request->getPost('typewrite_words2'));
        $words2 = array_map('trim', $words2);

        $data = [
            'pill_text' => $this->request->getPost('pill_text'),
            'title_line1' => $this->request->getPost('title_line1'),
            'typewrite_words1' => json_encode($words1),
            'title_line2' => $this->request->getPost('title_line2'),
            'typewrite_words2' => json_encode($words2),
            'description' => $this->request->getPost('description'),
            'portfolio_link' => $this->request->getPost('portfolio_link'),
        ];

        // Handle file uploads (need to create assets/uploads/hero directory)
        $uploadPath = 'hero';
        if (!is_dir(FCPATH . 'assets/uploads/' . $uploadPath)) {
            mkdir(FCPATH . 'assets/uploads/' . $uploadPath, 0777, true);
        }

        $photo = upload_file($this->request, 'photo', $uploadPath, $oldData['photo']);
        $bg_desktop = upload_file($this->request, 'bg_desktop', $uploadPath, $oldData['bg_desktop']);
        $bg_mobile = upload_file($this->request, 'bg_mobile', $uploadPath, $oldData['bg_mobile']);
        $cv_file = upload_file($this->request, 'cv_file', $uploadPath, $oldData['cv_file']);

        if ($photo) $data['photo'] = $photo;
        if ($bg_desktop) $data['bg_desktop'] = $bg_desktop;
        if ($bg_mobile) $data['bg_mobile'] = $bg_mobile;
        if ($cv_file) $data['cv_file'] = $cv_file;

        $this->heroModel->update(1, $data);

        return redirect()->to('admin/hero')->with('success', 'Pengaturan Hero berhasil diperbarui.');
    }
}
