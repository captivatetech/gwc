<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLoanDisbursementsTable extends Migration
{
    public function up()
    {
        //14 fields
        $this->forge->addField([
            'id'                    => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'loan_id'               => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'idempotency_key'       => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'reference_number'      => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'currency'              => [
                'type'              => 'VARCHAR',
                'constraint'        => 20,
                'null'              => true,
            ],
            'channel_code'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 20,
                'null'              => true,
            ],
            'account_holder_name'   => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
                'null'              => true,
            ],
            'account_number'        => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'amount'                => [
                'type'              => 'DECIMAL',
                'constraint'        => [20,2],
                'null'              => true,
            ],
            'description'           => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'disbursement_type'     => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'disbursement_status'   => [
                'type'              => 'VARCHAR',
                'constraint'        => 20,
                'null'              => true,
            ],
            'created_by'            => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'null'              => true,
            ],
            'created_date'          => [
                'type'              => 'DATETIME',
                'null'              => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('loan_disbursements');
    }

    public function down()
    {
        $this->forge->dropTable('loan_disbursements');
    }
}
