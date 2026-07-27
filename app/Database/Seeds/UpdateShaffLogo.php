<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UpdateShaffLogo extends Seeder
{
    public function run()
    {
        $this->db->table('testimonials')
            ->where('brand_name', 'Shaff.id')
            ->update(['logo' => 'shaff-2.png']);
    }
}
