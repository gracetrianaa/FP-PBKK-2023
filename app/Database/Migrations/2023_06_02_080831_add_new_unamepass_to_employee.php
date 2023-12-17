<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmployeeColumns extends Migration
{
    public function up()
    {
        $this->forge->addColumn('employee', [
            'epl_uname' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'epl_password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('employee', ['epl_uname', 'epl_password']);
    }
}
