<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutIconModel extends Model
{
    protected $table = 'about_icons';
    protected $primaryKey = 'id';
    protected $allowedFields = ['icon', 'label', 'sort_order'];
}
