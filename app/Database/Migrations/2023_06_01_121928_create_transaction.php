<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'tsc_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tsc_status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tsc_tglmasuk' => [
                'type' => 'DATE',
            ],
            'tsc_tglselesai' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tsc_tglambil' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tsc_totalprice' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'customer_cst_id' => [
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

        $this->forge->addKey('tsc_id', true);
        $this->forge->addForeignKey('customer_cst_id', 'customer', 'cst_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaction');
    }

    public function down()
    {
        $this->forge->dropTable('transaction');
    }
}
