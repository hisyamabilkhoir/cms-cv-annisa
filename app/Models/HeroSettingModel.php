<?php

namespace App\Models;

use CodeIgniter\Model;

class HeroSettingModel extends Model
{
    protected $table = 'hero_settings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pill_text', 'title_line1', 'typewrite_words1', 'title_line2', 
        'typewrite_words2', 'description', 'photo', 'bg_desktop', 
        'bg_mobile', 'cv_file', 'portfolio_link'
    ];
}
