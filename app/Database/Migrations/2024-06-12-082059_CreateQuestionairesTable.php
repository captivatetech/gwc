<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuestionairesTable extends Migration
{
    public function up()
    {
        //8 fields
        $this->forge->addField([
            'id'                        => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'question'                  => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'answer'                    => [
                'type'              => 'JSON',
                'null'              => true,
            ],
            'questionaire_status'       => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'created_by'                => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'created_date'              => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'updated_by'                => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'updated_date'              => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('questionaires');
    }

    public function down()
    {
        $this->forge->dropTable('questionaires');
    }
}
