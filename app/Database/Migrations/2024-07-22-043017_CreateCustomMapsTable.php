<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomMapsTable extends Migration
{
    public function up()
    {
        // 7 fields
        $this->forge->addField([
            'id'                => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'map_type'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 20,
                'null'              => true,
            ],
            'map_name'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'map_fields'        => [
                'type'              => 'JSON',
                'null'              => true,
            ],
            'map_values'        => [
                'type'              => 'JSON',
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
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('custom_maps');
    }

    public function down()
    {
        $this->forge->dropTable('custom_maps');
    }
}
