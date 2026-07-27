<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('is_admin_logged_in')) {
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
                        return; // Proceed to page
                    }
                }
            }

            return redirect()->to(base_url('admin/login'))->with('error', 'Silakan login terlebih dahulu.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
