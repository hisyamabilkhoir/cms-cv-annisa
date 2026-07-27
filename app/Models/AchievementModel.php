<?php

namespace App\Models;

use CodeIgniter\Model;

class AchievementModel extends Model
{
    protected $table = 'achievements';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'category_id', 'is_main', 'year', 'date_label', 'title', 
        'description', 'photo', 'badge_text', 'icon', 'small_text', 
        'heading_text', 'signature_text', 'sort_order'
    ];
}
