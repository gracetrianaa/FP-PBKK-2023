<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePersonalAccessTokensTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tokenable_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'tokenable_type' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'unique' => true,
            ],
            'abilities' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'last_used_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'expires_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('personal_access_tokens');
    }

    public function down()
    {
        $this->forge->dropTable('personal_access_tokens');
    }
}
