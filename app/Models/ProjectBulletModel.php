<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectBulletModel extends Model
{
    protected $table = 'project_bullets';
    protected $primaryKey = 'id';
    protected $allowedFields = ['project_id', 'text', 'sort_order'];
}
