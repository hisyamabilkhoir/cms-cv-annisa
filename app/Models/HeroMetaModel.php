<?php

namespace App\Models;

use CodeIgniter\Model;

class HeroMetaModel extends Model
{
    protected $table = 'hero_meta';
    protected $primaryKey = 'id';
    protected $allowedFields = ['key_label', 'value_text', 'sort_order'];
    protected $useTimestamps = true;
}
