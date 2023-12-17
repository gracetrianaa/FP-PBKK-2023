<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFailedJobsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ],
            'connection' => [
                'type' => 'TEXT',
            ],
            'queue' => [
                'type' => 'TEXT',
            ],
            'payload' => [
                'type' => 'LONGTEXT',
            ],
            'exception' => [
                'type' => 'LONGTEXT',
            ],
            'failed_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('failed_jobs');
    }

    public function down()
    {
        $this->forge->dropTable('failed_jobs');
    }
}
