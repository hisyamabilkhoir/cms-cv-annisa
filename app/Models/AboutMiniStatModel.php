<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutMiniStatModel extends Model
{
    protected $table = 'about_mini_stats';
    protected $primaryKey = 'id';
    protected $allowedFields = ['icon', 'label', 'value', 'sort_order'];
}
