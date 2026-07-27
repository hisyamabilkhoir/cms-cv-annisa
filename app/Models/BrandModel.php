<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'logo', 'location', 'description', 
        'project_link', 'sort_order', 'is_active'
    ];
}
