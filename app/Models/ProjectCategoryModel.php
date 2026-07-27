<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectCategoryModel extends Model
{
    protected $table = 'project_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'slug', 'sort_order'];
}
