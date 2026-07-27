<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBgDesktopMobileToAboutAndBrandSettings extends Migration
{
    public function up()
    {
        // 1. Add bg_desktop and bg_mobile to about_settings
        $fieldsAbout = [
            'bg_desktop' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'bg_mobile'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ];

        if ($this->db->tableExists('about_settings')) {
            if (!$this->db->fieldExists('bg_desktop', 'about_settings')) {
                $this->forge->addColumn('about_settings', [
                    'bg_desktop' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
                ]);
            }
            if (!$this->db->fieldExists('bg_mobile', 'about_settings')) {
                $this->forge->addColumn('about_settings', [
                    'bg_mobile' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
                ]);
            }
        }

        // 2. Create brand_settings table if not exists
        if (!$this->db->tableExists('brand_settings')) {
            $this->forge->addField([
                'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
                'bg_desktop' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'bg_mobile'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('brand_settings');
        }
    }

    public function down()
    {
        if ($this->db->tableExists('about_settings')) {
            if ($this->db->fieldExists('bg_desktop', 'about_settings')) {
                $this->forge->dropColumn('about_settings', 'bg_desktop');
            }
            if ($this->db->fieldExists('bg_mobile', 'about_settings')) {
                $this->forge->dropColumn('about_settings', 'bg_mobile');
            }
        }

        $this->forge->dropTable('brand_settings', true);
    }
}
