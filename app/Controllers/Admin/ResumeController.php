<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ResumeExperienceModel;
use App\Models\ResumeSkillModel;
use App\Models\ResumeToolModel;

class ResumeController extends BaseController
{
    protected $experienceModel;
    protected $skillModel;
    protected $toolModel;

    public function __construct()
    {
        $this->experienceModel = new ResumeExperienceModel();
        $this->skillModel = new ResumeSkillModel();
        $this->toolModel = new ResumeToolModel();
    }

    public function index()
    {
        $data = [
            'experiences' => $this->experienceModel->orderBy('sort_order', 'ASC')->findAll(),
            'skills' => $this->skillModel->orderBy('sort_order', 'ASC')->findAll(),
            'tools' => $this->toolModel->orderBy('sort_order', 'ASC')->findAll(),
        ];
        return view('admin/resume/index', $data);
    }

    // Experiences
    public function storeExperience()
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'period' => $this->request->getPost('period'),
            'description' => $this->request->getPost('description'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];
        $this->experienceModel->insert($data);
        return redirect()->to('admin/resume')->with('success', 'Experience berhasil ditambahkan.');
    }

    public function updateExperience($id)
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'period' => $this->request->getPost('period'),
            'description' => $this->request->getPost('description'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];
        $this->experienceModel->update($id, $data);
        return redirect()->to('admin/resume')->with('success', 'Experience berhasil diperbarui.');
    }

    public function deleteExperience($id)
    {
        $this->experienceModel->delete($id);
        return redirect()->to('admin/resume')->with('success', 'Experience berhasil dihapus.');
    }

    // Skills
    public function storeSkill()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'percentage' => $this->request->getPost('percentage'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];
        $this->skillModel->insert($data);
        return redirect()->to('admin/resume')->with('success', 'Skill berhasil ditambahkan.');
    }

    public function updateSkill($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'percentage' => $this->request->getPost('percentage'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];
        $this->skillModel->update($id, $data);
        return redirect()->to('admin/resume')->with('success', 'Skill berhasil diperbarui.');
    }

    public function deleteSkill($id)
    {
        $this->skillModel->delete($id);
        return redirect()->to('admin/resume')->with('success', 'Skill berhasil dihapus.');
    }

    // Tools
    public function storeTool()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];
        $this->toolModel->insert($data);
        return redirect()->to('admin/resume')->with('success', 'Tool berhasil ditambahkan.');
    }

    public function updateTool($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
        ];
        $this->toolModel->update($id, $data);
        return redirect()->to('admin/resume')->with('success', 'Tool berhasil diperbarui.');
    }

    public function deleteTool($id)
    {
        $this->toolModel->delete($id);
        return redirect()->to('admin/resume')->with('success', 'Tool berhasil dihapus.');
    }
}
