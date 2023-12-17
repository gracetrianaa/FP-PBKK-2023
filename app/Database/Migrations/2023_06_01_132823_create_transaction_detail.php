<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionDetailTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'tsc_td_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tsc_td_quantity' => [
                'type' => 'INT',
            ],
            'tsc_td_pricequantity' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'service_svc_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'transaction_tsc_id' => [
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

        $this->forge->addKey('tsc_td_id', true);
        $this->forge->addForeignKey('service_svc_id', 'service', 'svc_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('transaction_tsc_id', 'transaction', 'tsc_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaction_detail');
    }

    public function down()
    {
        $this->forge->dropTable('transaction_detail');
    }
}
