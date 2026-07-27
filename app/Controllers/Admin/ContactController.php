<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContactMessageModel;
use App\Models\SocialLinkModel;
use App\Models\SiteSettingModel;

class ContactController extends BaseController
{
    protected $messageModel;
    protected $socialModel;
    protected $settingModel;

    public function __construct()
    {
        $this->messageModel = new ContactMessageModel();
        $this->socialModel = new SocialLinkModel();
        $this->settingModel = new SiteSettingModel();
    }

    public function index()
    {
        $settingsRaw = $this->settingModel->where('group', 'contact')->findAll();
        $settings = [];
        foreach($settingsRaw as $s) {
            $settings[$s['key']] = $s['value'];
        }

        $data = [
            'messages' => $this->messageModel->orderBy('created_at', 'DESC')->findAll(),
            'socials' => $this->socialModel->orderBy('sort_order', 'ASC')->findAll(),
            'settings' => $settings
        ];
        return view('admin/contacts/index', $data);
    }

    // Settings
    public function updateSettings()
    {
        $postData = $this->request->getPost();
        foreach(['contact_email', 'contact_phone', 'contact_address', 'contact_map_iframe'] as $key) {
            if (isset($postData[$key])) {
                $existing = $this->settingModel->where('key', $key)->first();
                if ($existing) {
                    $this->settingModel->update($existing['id'], ['value' => $postData[$key]]);
                } else {
                    $this->settingModel->insert(['key' => $key, 'value' => $postData[$key], 'group' => 'contact']);
                }
            }
        }
        return redirect()->to('admin/contacts')->with('success', 'Pengaturan kontak berhasil diperbarui.');
    }

    // Socials
    public function storeSocial()
    {
        $data = [
            'platform' => $this->request->getPost('platform'),
            'url' => $this->request->getPost('url'),
            'icon' => $this->request->getPost('icon'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];
        $this->socialModel->insert($data);
        return redirect()->to('admin/contacts')->with('success', 'Social Link berhasil ditambahkan.');
    }

    public function updateSocial($id)
    {
        $data = [
            'platform' => $this->request->getPost('platform'),
            'url' => $this->request->getPost('url'),
            'icon' => $this->request->getPost('icon'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];
        $this->socialModel->update($id, $data);
        return redirect()->to('admin/contacts')->with('success', 'Social Link berhasil diperbarui.');
    }

    public function deleteSocial($id)
    {
        $this->socialModel->delete($id);
        return redirect()->to('admin/contacts')->with('success', 'Social Link berhasil dihapus.');
    }

    // Messages
    public function markAsRead($id)
    {
        $this->messageModel->update($id, ['is_read' => 1]);
        return redirect()->to('admin/contacts')->with('success', 'Pesan ditandai sudah dibaca.');
    }

    public function deleteMessage($id)
    {
        $this->messageModel->delete($id);
        return redirect()->to('admin/contacts')->with('success', 'Pesan berhasil dihapus.');
    }
}
