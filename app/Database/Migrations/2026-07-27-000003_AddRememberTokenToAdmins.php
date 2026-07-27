<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRememberTokenToAdmins extends Migration
{
    public function up()
    {
        $fields = [
            'remember_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'avatar',
            ],
        ];
        $this->forge->addColumn('admins', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('admins', 'remember_token');
    }
}
