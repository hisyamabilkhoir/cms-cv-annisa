<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AboutSettingModel;
use App\Models\AboutIconModel;
use App\Models\AboutMiniStatModel;
use App\Models\AboutCardModel;

class AboutController extends BaseController
{
    protected $aboutModel;
    protected $iconModel;
    protected $miniStatModel;
    protected $cardModel;

    public function __construct()
    {
        $this->aboutModel = new AboutSettingModel();
        $this->iconModel = new AboutIconModel();
        $this->miniStatModel = new AboutMiniStatModel();
        $this->cardModel = new AboutCardModel();
        helper('upload');
    }

    public function index()
    {
        $about = $this->aboutModel->find(1);
        $parsedTitle = $this->parseTitle($about['title'] ?? '');

        $data = [
            'about' => $about,
            'parsedTitle' => $parsedTitle,
            'icons' => $this->iconModel->orderBy('sort_order', 'ASC')->findAll(),
            'miniStats' => $this->miniStatModel->orderBy('sort_order', 'ASC')->findAll(),
            'cards' => $this->cardModel->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return view('admin/about/index', $data);
    }

    public function update()
    {
        $oldData = $this->aboutModel->find(1);

        $titleLine1 = trim($this->request->getPost('title_line1') ?? '');
        $titlePink  = trim($this->request->getPost('title_pink') ?? '');
        $titleLine2 = trim($this->request->getPost('title_line2') ?? '');

        if (!empty($titlePink)) {
            $fullTitle = $titleLine1 . ' <span class="text-pink">' . $titlePink . '</span>';
        } else {
            $fullTitle = $titleLine1;
        }

        if (!empty($titleLine2)) {
            $fullTitle .= ', <br>' . $titleLine2;
        }

        $data = [
            'pill_text'   => $this->request->getPost('pill_text'),
            'title'       => $fullTitle,
            'description' => $this->request->getPost('description'),
        ];

        $uploadPath = 'about';
        if (!is_dir(FCPATH . 'assets/uploads/' . $uploadPath)) {
            mkdir(FCPATH . 'assets/uploads/' . $uploadPath, 0777, true);
        }

        $bg_image   = upload_file($this->request, 'bg_image', $uploadPath, $oldData['bg_image'] ?? null);
        $bg_desktop = upload_file($this->request, 'bg_desktop', $uploadPath, $oldData['bg_desktop'] ?? null);
        $bg_mobile  = upload_file($this->request, 'bg_mobile', $uploadPath, $oldData['bg_mobile'] ?? null);

        if ($bg_image)   $data['bg_image'] = $bg_image;
        if ($bg_desktop) $data['bg_desktop'] = $bg_desktop;
        if ($bg_mobile)  $data['bg_mobile'] = $bg_mobile;

        $this->aboutModel->update(1, $data);

        return redirect()->to('admin/about')->with('success', 'Pengaturan About berhasil diperbarui.');
    }

    // ==========================================
    // ABOUT ICONS CRUD
    // ==========================================
    public function storeIcon()
    {
        $this->iconModel->insert([
            'icon'       => $this->request->getPost('icon'),
            'label'      => $this->request->getPost('label'),
            'sort_order' => (int) $this->request->getPost('sort_order'),
        ]);
        return redirect()->to('admin/about#icons')->with('success', 'Item Icon berhasil ditambahkan.');
    }

    public function updateIcon($id)
    {
        $this->iconModel->update($id, [
            'icon'       => $this->request->getPost('icon'),
            'label'      => $this->request->getPost('label'),
            'sort_order' => (int) $this->request->getPost('sort_order'),
        ]);
        return redirect()->to('admin/about#icons')->with('success', 'Item Icon berhasil diperbarui.');
    }

    public function deleteIcon($id)
    {
        $this->iconModel->delete($id);
        return redirect()->to('admin/about#icons')->with('success', 'Item Icon berhasil dihapus.');
    }

    // ==========================================
    // ABOUT MINI STATS CRUD
    // ==========================================
    public function storeMiniStat()
    {
        $this->miniStatModel->insert([
            'icon'       => $this->request->getPost('icon'),
            'label'      => $this->request->getPost('label'),
            'value'      => $this->request->getPost('value'),
            'sort_order' => (int) $this->request->getPost('sort_order'),
        ]);
        return redirect()->to('admin/about#ministats')->with('success', 'Mini Stat berhasil ditambahkan.');
    }

    public function updateMiniStat($id)
    {
        $this->miniStatModel->update($id, [
            'icon'       => $this->request->getPost('icon'),
            'label'      => $this->request->getPost('label'),
            'value'      => $this->request->getPost('value'),
            'sort_order' => (int) $this->request->getPost('sort_order'),
        ]);
        return redirect()->to('admin/about#ministats')->with('success', 'Mini Stat berhasil diperbarui.');
    }

    public function deleteMiniStat($id)
    {
        $this->miniStatModel->delete($id);
        return redirect()->to('admin/about#ministats')->with('success', 'Mini Stat berhasil dihapus.');
    }

    // ==========================================
    // ABOUT CARDS CRUD
    // ==========================================
    public function storeCard()
    {
        $this->cardModel->insert([
            'icon'        => $this->request->getPost('icon'),
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'sort_order'  => (int) $this->request->getPost('sort_order'),
        ]);
        return redirect()->to('admin/about#cards')->with('success', 'Kartu Fitur berhasil ditambahkan.');
    }

    public function updateCard($id)
    {
        $this->cardModel->update($id, [
            'icon'        => $this->request->getPost('icon'),
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'sort_order'  => (int) $this->request->getPost('sort_order'),
        ]);
        return redirect()->to('admin/about#cards')->with('success', 'Kartu Fitur berhasil diperbarui.');
    }

    public function deleteCard($id)
    {
        $this->cardModel->delete($id);
        return redirect()->to('admin/about#cards')->with('success', 'Kartu Fitur berhasil dihapus.');
    }

    private function parseTitle($fullTitle)
    {
        $titleLine1 = '';
        $titlePink  = '';
        $titleLine2 = '';

        if (preg_match('/^(.*?)\s*<span[^>]*>(.*?)<\/span>(.*)$/is', $fullTitle, $matches)) {
            $titleLine1 = trim($matches[1]);
            $titlePink  = trim($matches[2]);
            $remainder  = trim($matches[3]);
            $remainder  = preg_replace('/^[\s,]*<br\s*\/?>[\s,]*/i', '', $remainder);
            $remainder  = ltrim($remainder, ', ');
            $titleLine2 = trim($remainder);
        } else {
            $titleLine1 = strip_tags($fullTitle);
        }

        return [
            'title_line1' => $titleLine1,
            'title_pink'  => $titlePink,
            'title_line2' => $titleLine2,
        ];
    }
}
