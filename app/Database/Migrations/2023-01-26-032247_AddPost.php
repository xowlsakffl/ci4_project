<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPost extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'body' => [
                'type' => 'TEXT',
            ],
            'img_name' => [
                'type' => 'TEXT',
            ],
            'file' => [
                'type' => 'TEXT',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
                'type'       => ' TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                'null' => 'true',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('posts');
    }

    public function down()
    {
        $this->forge->dropTable('posts');
    }
}
