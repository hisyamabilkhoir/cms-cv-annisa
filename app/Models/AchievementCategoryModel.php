<?php

namespace App\Models;

use CodeIgniter\Model;

class AchievementCategoryModel extends Model
{
    protected $table = 'achievement_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'slug', 'icon', 'sort_order'];
}
