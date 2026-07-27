<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutCardModel extends Model
{
    protected $table = 'about_cards';
    protected $primaryKey = 'id';
    protected $allowedFields = ['icon', 'title', 'description', 'sort_order'];
}
