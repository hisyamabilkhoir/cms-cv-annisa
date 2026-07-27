<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandSettingModel extends Model
{
    protected $table = 'brand_settings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'bg_desktop', 'bg_mobile'
    ];
}
