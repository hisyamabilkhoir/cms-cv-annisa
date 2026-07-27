<?php

namespace App\Models;

use CodeIgniter\Model;

class ResumeSkillModel extends Model
{
    protected $table = 'resume_skills';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'percentage', 'sort_order'
    ];
}
