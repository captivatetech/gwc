<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserActivitiesTable extends Migration
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
            'user_id'           => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'login_code'        => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'module_name'       => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'activity_type'     => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'activity_details'  => [
                'type'              => 'JSON',
                'null'              => true,
            ],
            'created_date'      => [
                'type'              => 'DATETIME',
                'null'              => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user_activities');
    }

    public function down()
    {
        $this->forge->dropTable('user_activities');
    }
}
