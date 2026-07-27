<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimonialModel extends Model
{
    protected $table = 'testimonials';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'brand_name', 'logo', 'rating', 'text', 'is_active', 'sort_order'
    ];
}
