<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateExpenseEmployeeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'exp_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'epl_id' => [
                'type' => 'INT',
                'unsigned' => true,
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
        $this->forge->addForeignKey('exp_id', 'expense', 'exp_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('epl_id', 'employee', 'epl_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('expense_employee');
    }

    public function down()
    {
        $this->forge->dropTable('expense_employee');
    }
}
