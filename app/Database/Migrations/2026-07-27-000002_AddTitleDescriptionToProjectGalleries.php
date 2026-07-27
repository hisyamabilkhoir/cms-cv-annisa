<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTitleDescriptionToProjectGalleries extends Migration
{
    public function up()
    {
        $fields = [
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'caption'
            ],
            'description' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'title'
            ]
        ];

        if (!$this->db->fieldExists('title', 'project_galleries')) {
            $this->forge->addColumn('project_galleries', $fields);
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('title', 'project_galleries')) {
            $this->forge->dropColumn('project_galleries', ['title', 'description']);
        }
    }
}
