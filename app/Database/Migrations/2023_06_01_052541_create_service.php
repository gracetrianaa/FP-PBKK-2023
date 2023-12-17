<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServiceTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'svc_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'svc_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'svc_priceperkilo' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
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

        $this->forge->addKey('svc_id', true);
        $this->forge->createTable('service');
    }

    public function down()
    {
        $this->forge->dropTable('service');
    }
}
