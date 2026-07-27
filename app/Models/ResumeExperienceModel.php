<?php

namespace App\Models;

use CodeIgniter\Model;

class ResumeExperienceModel extends Model
{
    protected $table = 'resume_experiences';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 'period', 'description', 'sort_order'
    ];
}
