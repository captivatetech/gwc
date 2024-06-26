<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeeAssessmentsTable extends Migration
{
    public function up()
    {
        //9 fields
        $this->forge->addField([
            'id'                        => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'employee_id'               => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'questionaire_id'           => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'answer'                    => [
                'type'              => 'JSON',
                'null'              => true,
            ],
            'assessment_status'         => [
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
        $this->forge->createTable('employee_assessments');
    }

    public function down()
    {
        $this->forge->dropTable('employee_assessments');
    }
}
