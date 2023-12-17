<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'epl_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'epl_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'epl_jobtitle' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'epl_phonenumber' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'epl_gender' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'epl_salary' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'epl_age' => [
                'type' => 'INT',
            ],
            'epl_workstatus' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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

        $this->forge->addKey('epl_id', true);
        $this->forge->createTable('employee');
    }

    public function down()
    {
        $this->forge->dropTable('employee');
    }
}
