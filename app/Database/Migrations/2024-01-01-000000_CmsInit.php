<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CmsInit extends Migration
{
    public function up()
    {
        // 1. admins
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username'   => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'avatar'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('admins');

        // 2. hero_settings
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'pill_text'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'title_line1'    => ['type' => 'TEXT'],
            'typewrite_words1'=> ['type' => 'TEXT'],
            'title_line2'    => ['type' => 'TEXT'],
            'typewrite_words2'=> ['type' => 'TEXT'],
            'description'    => ['type' => 'TEXT'],
            'photo'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'bg_desktop'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'bg_mobile'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'cv_file'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'portfolio_link' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('hero_settings');

        // 3. hero_stats
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'label'      => ['type' => 'VARCHAR', 'constraint' => 50],
            'value'      => ['type' => 'VARCHAR', 'constraint' => 50],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('hero_stats');

        // 4. hero_meta
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'key_label'  => ['type' => 'VARCHAR', 'constraint' => 50],
            'value_text' => ['type' => 'VARCHAR', 'constraint' => 255],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('hero_meta');

        // 5. about_settings
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'pill_text'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'title'       => ['type' => 'TEXT'],
            'description' => ['type' => 'TEXT'],
            'bg_image'    => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('about_settings');

        // 6. about_icons
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'icon'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'label'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('about_icons');

        // 7. about_mini_stats
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'icon'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'label'      => ['type' => 'VARCHAR', 'constraint' => 50],
            'value'      => ['type' => 'VARCHAR', 'constraint' => 50],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('about_mini_stats');

        // 8. about_cards
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'icon'        => ['type' => 'VARCHAR', 'constraint' => 50],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'description' => ['type' => 'TEXT'],
            'sort_order'  => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('about_cards');

        // 9. brands
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'logo'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'location'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'description'  => ['type' => 'TEXT'],
            'project_link' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sort_order'   => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'is_active'    => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('brands');

        // 10. project_categories
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'slug'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('project_categories');

        // 11. projects
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'title'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'description'    => ['type' => 'TEXT'],
            'tag'            => ['type' => 'VARCHAR', 'constraint' => 255],
            'thumbnail'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'thumbnail_type' => ['type' => 'ENUM', 'constraint' => ['image', 'video', 'both'], 'default' => 'image'],
            'youtube_url'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'project_link'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'views'          => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'ctr'            => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'sort_order'     => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'is_active'      => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('projects');

        // 12. project_galleries
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'project_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'media_type'       => ['type' => 'ENUM', 'constraint' => ['image', 'youtube'], 'default' => 'image'],
            'file_path'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'youtube_url'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'custom_thumbnail' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'caption'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sort_order'       => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('project_galleries');

        // 13. project_bullets
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'project_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'text'       => ['type' => 'TEXT'],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('project_bullets');

        // 14. achievement_categories
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'slug'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'icon'       => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('achievement_categories');

        // 15. achievements
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'is_main'        => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'year'           => ['type' => 'VARCHAR', 'constraint' => 10],
            'date_label'     => ['type' => 'VARCHAR', 'constraint' => 50],
            'title'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'description'    => ['type' => 'TEXT'],
            'photo'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'badge_text'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'icon'           => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'small_text'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'heading_text'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'signature_text' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'sort_order'     => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('achievements');

        // 16. resume_experiences
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'period'      => ['type' => 'VARCHAR', 'constraint' => 50],
            'description' => ['type' => 'TEXT'],
            'sort_order'  => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('resume_experiences');

        // 17. resume_skills
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'percentage' => ['type' => 'INT', 'constraint' => 3],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('resume_skills');

        // 18. resume_tools
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'logo'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('resume_tools');

        // 19. testimonials
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'brand_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'logo'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'rating'     => ['type' => 'INT', 'constraint' => 1, 'default' => 5],
            'text'       => ['type' => 'TEXT'],
            'is_active'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('testimonials');

        // 20. social_links
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'platform'   => ['type' => 'VARCHAR', 'constraint' => 50],
            'url'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'icon'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('social_links');

        // 21. contact_messages
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'message'    => ['type' => 'TEXT'],
            'is_read'    => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('contact_messages');

        // 22. site_settings
        $this->forge->addField([
            'id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'key'   => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'value' => ['type' => 'TEXT', 'null' => true],
            'group' => ['type' => 'VARCHAR', 'constraint' => 50],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('site_settings');

        // 23. portfolio_stats
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'icon'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'value'      => ['type' => 'VARCHAR', 'constraint' => 50],
            'label'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('portfolio_stats');
    }

    public function down()
    {
        $this->forge->dropTable('portfolio_stats', true);
        $this->forge->dropTable('site_settings', true);
        $this->forge->dropTable('contact_messages', true);
        $this->forge->dropTable('social_links', true);
        $this->forge->dropTable('testimonials', true);
        $this->forge->dropTable('resume_tools', true);
        $this->forge->dropTable('resume_skills', true);
        $this->forge->dropTable('resume_experiences', true);
        $this->forge->dropTable('achievements', true);
        $this->forge->dropTable('achievement_categories', true);
        $this->forge->dropTable('project_bullets', true);
        $this->forge->dropTable('project_galleries', true);
        $this->forge->dropTable('projects', true);
        $this->forge->dropTable('project_categories', true);
        $this->forge->dropTable('brands', true);
        $this->forge->dropTable('about_cards', true);
        $this->forge->dropTable('about_mini_stats', true);
        $this->forge->dropTable('about_icons', true);
        $this->forge->dropTable('about_settings', true);
        $this->forge->dropTable('hero_meta', true);
        $this->forge->dropTable('hero_stats', true);
        $this->forge->dropTable('hero_settings', true);
        $this->forge->dropTable('admins', true);
    }
}
