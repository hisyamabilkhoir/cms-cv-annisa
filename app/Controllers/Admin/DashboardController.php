<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        $projectsByCategory = $db->query('
            SELECT c.name, COUNT(p.id) as total 
            FROM project_categories c 
            LEFT JOIN projects p ON p.category_id = c.id 
            GROUP BY c.id
        ')->getResultArray();

        $recentProjects = $db->query('
            SELECT p.*, c.name as category_name 
            FROM projects p 
            LEFT JOIN project_categories c ON c.id = p.category_id 
            ORDER BY p.id DESC LIMIT 5
        ')->getResultArray();
        
        $data = [
            'total_projects' => $db->table('projects')->countAllResults(),
            'total_brands' => $db->table('brands')->countAllResults(),
            'total_messages' => $db->table('contact_messages')->where('is_read', 0)->countAllResults(),
            'total_achievements' => $db->table('achievements')->countAllResults(),
            'projects_by_category' => $projectsByCategory,
            'recent_projects' => $recentProjects
        ];
        
        return view('admin/dashboard', $data);
    }
}
