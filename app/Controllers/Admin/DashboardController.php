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

        $galleriesByCategory = $db->query('
            SELECT c.name, COUNT(g.id) as total 
            FROM project_categories c 
            LEFT JOIN projects p ON p.category_id = c.id 
            LEFT JOIN project_galleries g ON g.project_id = p.id 
            GROUP BY c.id
        ')->getResultArray();

        $galleriesByProject = $db->query('
            SELECT p.title as project_title, c.name as category_name, COUNT(g.id) as total_media
            FROM project_galleries g
            JOIN projects p ON p.id = g.project_id
            LEFT JOIN project_categories c ON c.id = p.category_id
            GROUP BY p.id
            ORDER BY total_media DESC
            LIMIT 10
        ')->getResultArray();

        $recentProjects = $db->query('
            SELECT p.*, c.name as category_name 
            FROM projects p 
            LEFT JOIN project_categories c ON c.id = p.category_id 
            ORDER BY p.id DESC LIMIT 5
        ')->getResultArray();
        
        $totalGalleries = $db->tableExists('project_galleries') 
            ? $db->table('project_galleries')->countAllResults() 
            : 0;

        $data = [
            'total_projects'       => $db->table('projects')->countAllResults(),
            'total_brands'         => $db->table('brands')->countAllResults(),
            'total_messages'       => $db->table('contact_messages')->where('is_read', 0)->countAllResults(),
            'total_achievements'    => $db->table('achievements')->countAllResults(),
            'total_galleries'      => $totalGalleries,
            'projects_by_category' => $projectsByCategory,
            'galleries_by_category'=> $galleriesByCategory,
            'galleries_by_project' => $galleriesByProject,
            'recent_projects'      => $recentProjects
        ];
        
        return view('admin/dashboard', $data);
    }
}
