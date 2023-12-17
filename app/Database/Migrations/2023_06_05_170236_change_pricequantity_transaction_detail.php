<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyTransactionDetailColumn extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('transaction_detail', [
            'tsc_td_pricequantity' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('transaction_detail', [
            'tsc_td_pricequantity' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ],
        ]);
    }
}
