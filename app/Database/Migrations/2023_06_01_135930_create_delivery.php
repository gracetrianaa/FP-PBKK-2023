<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDeliveryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'div_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'div_date' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'div_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'div_address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'transaction_tsc_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'employee_epl_id' => [
                'type' => 'BIGINT',
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

        $this->forge->addKey('div_id', true);
        $this->forge->addForeignKey('transaction_tsc_id', 'transaction', 'tsc_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('employee_epl_id', 'employee', 'epl_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('delivery');
    }

    public function down()
    {
        $this->forge->dropTable('delivery');
    }
}
