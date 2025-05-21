<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username'=>[
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'email'=>[
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'password'=>[
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}