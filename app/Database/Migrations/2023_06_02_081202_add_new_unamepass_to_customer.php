<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCustomerColumns extends Migration
{
    public function up()
    {
        $this->forge->addColumn('customer', [
            'cst_uname' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'cst_password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('customer', ['cst_uname', 'cst_password']);
    }
}
