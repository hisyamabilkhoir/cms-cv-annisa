<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutSettingModel extends Model
{
    protected $table = 'about_settings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pill_text', 'title', 'description', 'bg_image', 'bg_desktop', 'bg_mobile'
    ];
}
