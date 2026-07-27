<?php

namespace App\Models;

use CodeIgniter\Model;

class ResumeToolModel extends Model
{
    protected $table = 'resume_tools';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'sort_order'
    ];
}
