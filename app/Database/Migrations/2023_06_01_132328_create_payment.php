<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pm_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'pm_method' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'pm_date' => [
                'type' => 'TIMESTAMP',
            ],
            'pm_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'pm_discount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'transaction_tsc_id' => [
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

        $this->forge->addKey('pm_id', true);
        $this->forge->addForeignKey('transaction_tsc_id', 'transaction', 'tsc_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payment');
    }

    public function down()
    {
        $this->forge->dropTable('payment');
    }
}
