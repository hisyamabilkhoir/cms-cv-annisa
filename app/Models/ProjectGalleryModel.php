<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectGalleryModel extends Model
{
    protected $table = 'project_galleries';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'project_id', 'media_type', 'file_path', 'youtube_url', 
        'custom_thumbnail', 'caption', 'title', 'description', 'sort_order'
    ];
}
