<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'cst_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'cst_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'cst_age' => [
                'type' => 'INT',
            ],
            'cst_address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'cst_phonenumber' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'cst_gender' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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

        $this->forge->addKey('cst_id', true);
        $this->forge->createTable('customer');
    }

    public function down()
    {
        $this->forge->dropTable('customer');
    }
}
