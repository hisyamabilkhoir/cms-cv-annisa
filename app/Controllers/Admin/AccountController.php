<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AccountController extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        helper('upload');
    }

    public function index()
    {
        // Get logged in admin id from session
        $adminId = session()->get('admin_id') ?? 1; // fallback to 1
        
        $data = [
            'admin' => $this->adminModel->find($adminId)
        ];
        
        return view('admin/account/index', $data);
    }

    public function update()
    {
        $adminId = session()->get('admin_id') ?? 1;
        $oldData = $this->adminModel->find($adminId);
        
        $uploadPath = 'avatars';
        if (!is_dir(FCPATH . 'assets/uploads/' . $uploadPath)) {
            mkdir(FCPATH . 'assets/uploads/' . $uploadPath, 0777, true);
        }

        $avatar = upload_file($this->request, 'avatar', $uploadPath, $oldData['avatar']);

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];

        if ($avatar) {
            $data['avatar'] = $avatar;
        }

        // update password if filled
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->adminModel->update($adminId, $data);
        
        return redirect()->to('admin/account')->with('success', 'Profil akun berhasil diperbarui.');
    }
}
