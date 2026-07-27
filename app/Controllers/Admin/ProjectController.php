<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProjectModel;
use App\Models\ProjectCategoryModel;
use App\Models\ProjectGalleryModel;
use App\Models\ProjectBulletModel;

class ProjectController extends BaseController
{
    protected $projectModel;
    protected $categoryModel;
    protected $galleryModel;
    protected $bulletModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->categoryModel = new ProjectCategoryModel();
        $this->galleryModel = new ProjectGalleryModel();
        $this->bulletModel = new ProjectBulletModel();
        helper('upload');
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('projects');
        $builder->select('projects.*, project_categories.name as category_name');
        $builder->join('project_categories', 'project_categories.id = projects.category_id', 'left');
        $builder->orderBy('projects.sort_order', 'ASC');
        
        $data = [
            'projects' => $builder->get()->getResultArray()
        ];
        return view('admin/projects/index', $data);
    }

    public function create()
    {
        $data = [
            'categories' => $this->categoryModel->orderBy('sort_order', 'ASC')->findAll(),
            'action' => base_url('admin/projects/store')
        ];
        return view('admin/projects/form', $data);
    }

    public function store()
    {
        $uploadPath = 'projects';
        if (!is_dir(FCPATH . 'assets/uploads/' . $uploadPath)) {
            mkdir(FCPATH . 'assets/uploads/' . $uploadPath, 0777, true);
        }

        $thumbnail = upload_file($this->request, 'thumbnail', $uploadPath);

        $youtubeUrl = $this->formatYoutubeEmbedUrl($this->request->getPost('youtube_url'));

        $data = [
            'category_id'    => $this->request->getPost('category_id'),
            'title'          => $this->request->getPost('title'),
            'description'    => $this->request->getPost('description'),
            'tag'            => $this->request->getPost('tag'),
            'thumbnail_type' => $this->request->getPost('thumbnail_type'),
            'youtube_url'    => $youtubeUrl,
            'project_link'   => $this->request->getPost('project_link'),
            'views'          => $this->request->getPost('views'),
            'ctr'            => $this->request->getPost('ctr'),
            'sort_order'     => $this->request->getPost('sort_order') ?? 0,
            'is_active'      => $this->request->getPost('is_active') ? 1 : 0,
            'thumbnail'      => $thumbnail
        ];

        $projectId = $this->projectModel->insert($data);

        // Process Bullet Points
        $bulletsText = $this->request->getPost('bullets_raw');
        if (!empty($bulletsText)) {
            $lines = explode("\n", str_replace("\r", "", $bulletsText));
            $order = 1;
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    $this->bulletModel->insert([
                        'project_id' => $projectId,
                        'text'       => $line,
                        'sort_order' => $order++
                    ]);
                }
            }
        }

        // Process Multiple Gallery Uploads
        $galleryFiles = $this->request->getFiles();
        if (isset($galleryFiles['gallery_files'])) {
            $order = 1;
            foreach ($galleryFiles['gallery_files'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'assets/uploads/' . $uploadPath, $newName);
                    $this->galleryModel->insert([
                        'project_id' => $projectId,
                        'media_type' => 'image',
                        'file_path'  => $newName,
                        'sort_order' => $order++
                    ]);
                }
            }
        }

        return redirect()->to('admin/projects')->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $project = $this->projectModel->find($id);
        if (!$project) return redirect()->to('admin/projects')->with('error', 'Data tidak ditemukan');

        $bullets = $this->bulletModel->where('project_id', $id)->orderBy('sort_order', 'ASC')->findAll();
        $bulletsRaw = implode("\n", array_map(function($b) {
            return $b['text'] ?? $b['bullet_text'] ?? '';
        }, $bullets));

        $galleries = $this->galleryModel->where('project_id', $id)->orderBy('sort_order', 'ASC')->findAll();

        $data = [
            'project'    => $project,
            'categories' => $this->categoryModel->orderBy('sort_order', 'ASC')->findAll(),
            'bullets'    => $bullets,
            'bulletsRaw' => $bulletsRaw,
            'galleries'  => $galleries,
            'action'     => base_url('admin/projects/update/' . $id)
        ];
        return view('admin/projects/form', $data);
    }

    public function update($id)
    {
        $oldData = $this->projectModel->find($id);
        if (!$oldData) return redirect()->to('admin/projects')->with('error', 'Data tidak ditemukan.');
        
        $uploadPath = 'projects';
        $thumbnail = upload_file($this->request, 'thumbnail', $uploadPath, $oldData['thumbnail']);

        $youtubeUrl = $this->formatYoutubeEmbedUrl($this->request->getPost('youtube_url'));

        $data = [
            'category_id'    => $this->request->getPost('category_id'),
            'title'          => $this->request->getPost('title'),
            'description'    => $this->request->getPost('description'),
            'tag'            => $this->request->getPost('tag'),
            'thumbnail_type' => $this->request->getPost('thumbnail_type'),
            'youtube_url'    => $youtubeUrl,
            'project_link'   => $this->request->getPost('project_link'),
            'views'          => $this->request->getPost('views'),
            'ctr'            => $this->request->getPost('ctr'),
            'sort_order'     => $this->request->getPost('sort_order') ?? 0,
            'is_active'      => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if ($thumbnail) {
            $data['thumbnail'] = $thumbnail;
        }

        $this->projectModel->update($id, $data);

        // Update Bullet Points
        $this->bulletModel->where('project_id', $id)->delete();
        $bulletsText = $this->request->getPost('bullets_raw');
        if (!empty($bulletsText)) {
            $lines = explode("\n", str_replace("\r", "", $bulletsText));
            $order = 1;
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    $this->bulletModel->insert([
                        'project_id' => $id,
                        'text'       => $line,
                        'sort_order' => $order++
                    ]);
                }
            }
        }

        // Process Additional Gallery Files Upload
        $galleryFiles = $this->request->getFiles();
        if (isset($galleryFiles['gallery_files'])) {
            $currentCount = $this->galleryModel->where('project_id', $id)->countAllResults();
            $order = $currentCount + 1;
            foreach ($galleryFiles['gallery_files'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'assets/uploads/' . $uploadPath, $newName);
                    $this->galleryModel->insert([
                        'project_id' => $id,
                        'media_type' => 'image',
                        'file_path'  => $newName,
                        'sort_order' => $order++
                    ]);
                }
            }
        }

        return redirect()->to('admin/projects/edit/' . $id)->with('success', 'Project berhasil diperbarui.');
    }

    public function deleteGallery($galleryId)
    {
        $item = $this->galleryModel->find($galleryId);
        if ($item) {
            $projectId = $item['project_id'];
            if (!empty($item['file_path'])) {
                @unlink(FCPATH . 'assets/uploads/projects/' . $item['file_path']);
            }
            $this->galleryModel->delete($galleryId);
            return redirect()->to('admin/projects/edit/' . $projectId)->with('success', 'Foto galeri berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Item galeri tidak ditemukan.');
    }

    public function delete($id)
    {
        $oldData = $this->projectModel->find($id);
        if ($oldData && $oldData['thumbnail']) {
            @unlink(FCPATH . 'assets/uploads/projects/' . $oldData['thumbnail']);
        }

        // Delete associated gallery files from disk
        $galleries = $this->galleryModel->where('project_id', $id)->findAll();
        foreach ($galleries as $g) {
            if (!empty($g['file_path'])) {
                @unlink(FCPATH . 'assets/uploads/projects/' . $g['file_path']);
            }
        }
        
        $this->galleryModel->where('project_id', $id)->delete();
        $this->bulletModel->where('project_id', $id)->delete();
        
        $this->projectModel->delete($id);
        return redirect()->to('admin/projects')->with('success', 'Project berhasil dihapus.');
    }

    /**
     * Converts standard YouTube links, Shorts, and watch URLs into embed URLs.
     */
    private function formatYoutubeEmbedUrl($url)
    {
        if (empty($url)) return '';
        $url = trim($url);

        if (strpos($url, 'youtube.com/embed/') !== false) {
            return $url;
        }

        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/i', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $url;
    }
}
