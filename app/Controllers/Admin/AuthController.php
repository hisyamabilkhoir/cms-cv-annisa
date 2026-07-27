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

        // Check remember me cookie
        helper('cookie');
        $cookie = get_cookie('remember_admin');
        if ($cookie) {
            $parts = explode(':', $cookie);
            if (count($parts) === 2) {
                $adminId = $parts[0];
                $token = $parts[1];

                $db = \Config\Database::connect();
                $admin = $db->table('admins')->where('id', $adminId)->get()->getRowArray();

                if ($admin && !empty($admin['remember_token']) && hash_equals($admin['remember_token'], $token)) {
                    $sessionData = [
                        'admin_id'           => $admin['id'],
                        'admin_username'     => $admin['username'],
                        'admin_name'         => $admin['name'],
                        'admin_email'        => $admin['email'] ?? '',
                        'admin_avatar'       => $admin['avatar'] ?? '',
                        'is_admin_logged_in' => true,
                    ];
                    session()->set($sessionData);
                    return redirect()->to('admin/dashboard');
                }
            }
        }

        $db = \Config\Database::connect();
        $hero = $db->table('hero_settings')->get()->getRowArray();

        return view('admin/auth/login', [
            'hero' => $hero,
        ]);
    }

    public function process()
    {
        $db = \Config\Database::connect();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        $admin = $db->table('admins')->where('username', $username)->get()->getRowArray();

        if ($admin && password_verify($password, $admin['password'])) {
            $sessionData = [
                'admin_id'           => $admin['id'],
                'admin_username'     => $admin['username'],
                'admin_name'         => $admin['name'],
                'admin_email'        => $admin['email'] ?? '',
                'admin_avatar'       => $admin['avatar'] ?? '',
                'is_admin_logged_in' => true,
            ];
            session()->set($sessionData);

            if ($remember) {
                $token = bin2hex(random_bytes(32));
                $db->table('admins')->where('id', $admin['id'])->update(['remember_token' => $token]);
                
                helper('cookie');
                // Expire in 30 days
                set_cookie('remember_admin', $admin['id'] . ':' . $token, 2592000);
            } else {
                // Clear any existing token/cookie
                $db->table('admins')->where('id', $admin['id'])->update(['remember_token' => null]);
                helper('cookie');
                delete_cookie('remember_admin');
            }

            return redirect()->to('admin/dashboard')->with('success', 'Selamat datang, ' . $admin['name']);
        }

        return redirect()->back()->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        $db = \Config\Database::connect();
        $adminId = session()->get('admin_id');
        if ($adminId) {
            $db->table('admins')->where('id', $adminId)->update(['remember_token' => null]);
        }

        helper('cookie');
        delete_cookie('remember_admin');
        
        session()->destroy();
        return redirect()->to('admin/login');
    }
}
