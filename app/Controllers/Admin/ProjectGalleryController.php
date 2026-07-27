<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProjectGalleryModel;
use App\Models\ProjectModel;
use App\Models\ProjectCategoryModel;

class ProjectGalleryController extends BaseController
{
    protected $galleryModel;
    protected $projectModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->galleryModel = new ProjectGalleryModel();
        $this->projectModel = new ProjectModel();
        $this->categoryModel = new ProjectCategoryModel();
        helper('upload');
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('project_galleries');
        $builder->select('project_galleries.*, projects.title as project_title, projects.thumbnail as project_thumb, project_categories.name as category_name');
        $builder->join('projects', 'projects.id = project_galleries.project_id', 'left');
        $builder->join('project_categories', 'project_categories.id = projects.category_id', 'left');

        $projectId = $this->request->getGet('project_id');
        if (!empty($projectId)) {
            $builder->where('project_galleries.project_id', $projectId);
        }

        $mediaType = $this->request->getGet('media_type');
        if (!empty($mediaType)) {
            $builder->where('project_galleries.media_type', $mediaType);
        }

        $builder->orderBy('project_galleries.sort_order', 'ASC');
        $builder->orderBy('project_galleries.id', 'DESC');
        $galleries = $builder->get()->getResultArray();

        $data = [
            'galleries'        => $galleries,
            'projects'         => $this->projectModel->orderBy('sort_order', 'ASC')->findAll(),
            'categories'       => $this->categoryModel->orderBy('sort_order', 'ASC')->findAll(),
            'selectedProject'  => $projectId,
            'selectedMediaType'=> $mediaType
        ];

        return view('admin/project-galleries/index', $data);
    }

    public function store()
    {
        $uploadPath = 'projects';
        if (!is_dir(FCPATH . 'assets/uploads/' . $uploadPath)) {
            mkdir(FCPATH . 'assets/uploads/' . $uploadPath, 0777, true);
        }

        $items = $this->request->getPost('items');
        $files = $this->request->getFiles();
        $totalSaved = 0;

        if (is_array($items) && !empty($items)) {
            foreach ($items as $idx => $item) {
                $mediaType   = $item['media_type'] ?? 'image';
                $projectId   = $item['project_id'] ?? null;
                $title       = $item['title'] ?? null;
                $description = $item['description'] ?? null;
                $sortOrder   = intval($item['sort_order'] ?? 0);

                if (empty($projectId)) continue;

                if ($mediaType === 'youtube') {
                    $rawYoutube = $item['youtube_url'] ?? '';
                    if (!empty($rawYoutube)) {
                        $embedUrl = $this->formatYoutubeEmbedUrl($rawYoutube);
                        $customThumbName = null;

                        // Check custom thumbnail file upload for this youtube item
                        if (isset($files['items'][$idx]['custom_thumbnail'])) {
                            $thumbFile = $files['items'][$idx]['custom_thumbnail'];
                            if ($thumbFile->isValid() && !$thumbFile->hasMoved()) {
                                $customThumbName = $thumbFile->getRandomName();
                                $thumbFile->move(FCPATH . 'assets/uploads/' . $uploadPath, $customThumbName);
                            }
                        }

                        $this->galleryModel->insert([
                            'project_id'       => $projectId,
                            'media_type'       => 'youtube',
                            'youtube_url'      => $embedUrl,
                            'custom_thumbnail' => $customThumbName,
                            'caption'          => $title,
                            'title'            => $title,
                            'description'      => $description,
                            'sort_order'       => $sortOrder
                        ]);
                        $totalSaved++;
                    }
                } else {
                    // Image upload
                    if (isset($files['items'][$idx]['gallery_files'])) {
                        $fileList = $files['items'][$idx]['gallery_files'];
                        if (!is_array($fileList)) {
                            $fileList = [$fileList];
                        }
                        foreach ($fileList as $file) {
                            if ($file->isValid() && !$file->hasMoved()) {
                                $newName = $file->getRandomName();
                                $file->move(FCPATH . 'assets/uploads/' . $uploadPath, $newName);

                                $this->galleryModel->insert([
                                    'project_id'  => $projectId,
                                    'media_type'  => 'image',
                                    'file_path'   => $newName,
                                    'caption'     => $title,
                                    'title'       => $title,
                                    'description' => $description,
                                    'sort_order'  => $sortOrder
                                ]);
                                $totalSaved++;
                            }
                        }
                    }
                }
            }
        } else {
            // Single fallback
            $mediaType   = $this->request->getPost('media_type') ?: 'image';
            $projectId   = $this->request->getPost('project_id');
            $title       = $this->request->getPost('title');
            $description = $this->request->getPost('description');
            $sortOrder   = intval($this->request->getPost('sort_order') ?? 0);

            if (!empty($projectId)) {
                if ($mediaType === 'youtube') {
                    $rawYoutube = $this->request->getPost('youtube_url');
                    if (!empty($rawYoutube)) {
                        $embedUrl = $this->formatYoutubeEmbedUrl($rawYoutube);
                        $customThumbName = upload_file($this->request, 'custom_thumbnail', $uploadPath);

                        $this->galleryModel->insert([
                            'project_id'       => $projectId,
                            'media_type'       => 'youtube',
                            'youtube_url'      => $embedUrl,
                            'custom_thumbnail' => $customThumbName,
                            'caption'          => $title,
                            'title'            => $title,
                            'description'      => $description,
                            'sort_order'       => $sortOrder
                        ]);
                        $totalSaved++;
                    }
                } else {
                    if (isset($files['gallery_files'])) {
                        foreach ($files['gallery_files'] as $file) {
                            if ($file->isValid() && !$file->hasMoved()) {
                                $newName = $file->getRandomName();
                                $file->move(FCPATH . 'assets/uploads/' . $uploadPath, $newName);

                                $this->galleryModel->insert([
                                    'project_id'  => $projectId,
                                    'media_type'  => 'image',
                                    'file_path'   => $newName,
                                    'caption'     => $title,
                                    'title'       => $title,
                                    'description' => $description,
                                    'sort_order'  => $sortOrder
                                ]);
                                $totalSaved++;
                            }
                        }
                    }
                }
            }
        }

        if ($totalSaved > 0) {
            return redirect()->to('admin/project-galleries')->with('success', 'Berhasil menyimpan ' . $totalSaved . ' item galeri proyek baru!');
        }

        return redirect()->to('admin/project-galleries')->with('error', 'Silakan pilih project dan upload gambar atau masukkan link YouTube.');
    }

    public function update($id)
    {
        $old = $this->galleryModel->find($id);
        if (!$old) {
            return redirect()->to('admin/project-galleries')->with('error', 'Galeri tidak ditemukan.');
        }

        $uploadPath = 'projects';
        $title = $this->request->getPost('title');
        $data = [
            'project_id'  => $this->request->getPost('project_id'),
            'caption'     => $title,
            'title'       => $title,
            'description' => $this->request->getPost('description'),
            'sort_order'  => intval($this->request->getPost('sort_order') ?? 0),
        ];

        if ($old['media_type'] === 'youtube') {
            $rawYoutube = $this->request->getPost('youtube_url');
            $data['youtube_url'] = $this->formatYoutubeEmbedUrl($rawYoutube);

            $newThumb = upload_file($this->request, 'custom_thumbnail', $uploadPath, $old['custom_thumbnail']);
            if ($newThumb) {
                $data['custom_thumbnail'] = $newThumb;
            }
        } else {
            $newImage = upload_file($this->request, 'image_file', $uploadPath, $old['file_path']);
            if ($newImage) {
                $data['file_path'] = $newImage;
            }
        }

        $this->galleryModel->update($id, $data);
        return redirect()->to('admin/project-galleries')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function delete($id)
    {
        $old = $this->galleryModel->find($id);
        if ($old) {
            if (!empty($old['file_path'])) {
                @unlink(FCPATH . 'assets/uploads/projects/' . $old['file_path']);
            }
            if (!empty($old['custom_thumbnail'])) {
                @unlink(FCPATH . 'assets/uploads/projects/' . $old['custom_thumbnail']);
            }
            $this->galleryModel->delete($id);
            return redirect()->to('admin/project-galleries')->with('success', 'Item galeri berhasil dihapus.');
        }
        return redirect()->to('admin/project-galleries')->with('error', 'Galeri tidak ditemukan.');
    }

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
