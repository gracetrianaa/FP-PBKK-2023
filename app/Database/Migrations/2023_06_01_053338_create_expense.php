<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateExpenseTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'exp_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'exp_type' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'exp_totalexpense' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'exp_date' => [
                'type' => 'TIMESTAMP',
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

        $this->forge->addKey('exp_id', true);
        $this->forge->createTable('expense');
    }

    public function down()
    {
        $this->forge->dropTable('expense');
    }
}
