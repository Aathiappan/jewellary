<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Catagory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'parent'    => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
				'default'    => 'NULL',
				'null'       => true,
            ],
            'is_deleted' => [
                'type'       => 'TINYINT',
                'constraint' => '1',
				'default'    => '0',
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL',
			'updated_at' => [
				'type'       => 'TIMESTAMP',
				'null'    => true,
			],
        ]);

        $this->forge->addKey('id', true); // Primary key
        $this->forge->createTable('category');
    }

    public function down()
    {
        $this->forge->dropTable('category');
    }
}
