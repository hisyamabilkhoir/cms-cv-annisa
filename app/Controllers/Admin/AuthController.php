<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('is_admin_logged_in')) {
            return redirect()->to('admin/dashboard');
        }

        return view('admin/auth/login');
    }

    public function process()
    {
        $db = \Config\Database::connect();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $db->table('admins')->where('username', $username)->get()->getRowArray();

        if ($admin && password_verify($password, $admin['password'])) {
            $sessionData = [
                'admin_id'           => $admin['id'],
                'admin_username'     => $admin['username'],
                'admin_name'         => $admin['name'],
                'is_admin_logged_in' => true,
            ];
            session()->set($sessionData);
            return redirect()->to('admin/dashboard')->with('success', 'Selamat datang, ' . $admin['name']);
        }

        return redirect()->back()->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('admin/login');
    }
}
