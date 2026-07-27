<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'category_id', 'title', 'description', 'tag', 'thumbnail', 
        'thumbnail_type', 'youtube_url', 'project_link', 'views', 
        'ctr', 'sort_order', 'is_active'
    ];
}
