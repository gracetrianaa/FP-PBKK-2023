<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeeTransactionTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'epl_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'tsc_id' => [
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
        $this->forge->addForeignKey('epl_id', 'employee', 'epl_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tsc_id', 'transaction', 'tsc_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('employee_transaction');
    }

    public function down()
    {
        $this->forge->dropTable('employee_transaction');
    }
}
