<?php

namespace App\Models;

use CodeIgniter\Model;

class HeroStatModel extends Model
{
    protected $table = 'hero_stats';
    protected $primaryKey = 'id';
    protected $allowedFields = ['label', 'value', 'sort_order'];
    protected $useTimestamps = true;
}
