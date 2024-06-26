<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBillingsTable extends Migration
{
    public function up()
    {
        //14 fields
        $this->forge->addField([
            'id'                        => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'company_id'                => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'billing_number'            => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'billing_date'              => [
                'type'              => 'DATE',
                'null'              => true,
            ],
            'total_amount'              => [
                'type'              => 'DECIMAL',
                'constraint'        => [20,2],
                'null'              => true,
            ],
            'total_paid'                => [
                'type'              => 'DECIMAL',
                'constraint'        => [20,2],
                'null'              => true,
            ],
            'penalty'                   => [
                'type'              => 'DECIMAL',
                'constraint'        => [20,2],
                'null'              => true,
            ],
            'balance'                   => [
                'type'              => 'DECIMAL',
                'constraint'        => [20,2],
                'null'              => true,
            ],
            'due_date'                  => [
                'type'              => 'DATE',
                'null'              => true,
            ],
            'payment_status'            => [
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
        $this->forge->createTable('billings');
    }

    public function down()
    {
        $this->forge->dropTable('billings');
    }
}
