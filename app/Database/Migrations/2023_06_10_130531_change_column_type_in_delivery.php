<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyDeliveryColumn extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('delivery', [
            'div_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('delivery', [
            'div_date' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
    }
}
