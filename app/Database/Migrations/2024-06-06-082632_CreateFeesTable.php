<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFeesTable extends Migration
{
    public function up()
    {
        //8 fields
        $this->forge->addField([
            'id'                => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'type'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
                'null'              => true,
            ],
            'amount'            => [
                'type'              => 'DECIMAL',
                'constraint'        => [20,2],
                'null'              => true,
            ],
            'fee_status'        => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'created_by'        => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'created_date'      => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'updated_by'        => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'updated_date'      => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('fees');
    }

    public function down()
    {
        $this->forge->dropTable('fees');
    }
}
