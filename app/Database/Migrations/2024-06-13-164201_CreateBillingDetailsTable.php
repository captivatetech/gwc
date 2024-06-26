<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBillingDetailsTable extends Migration
{
    public function up()
    {
        //11 fields
        $this->forge->addField([
            'id'                        => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'billing_id'                => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'loan_id'                   => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'billing_amount'            => [
                'type'              => 'DECIMAL',
                'constraint'        => [20,2],
                'null'              => true,
            ],
            'penalty'                   => [
                'type'              => 'DECIMAL',
                'constraint'        => [20,2],
                'null'              => true,
            ],
            'billing_series'            => [
                'type'              => 'INT',
                'constraint'        => 11,
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
        $this->forge->createTable('billing_details');
    }

    public function down()
    {
        $this->forge->dropTable('billing_details');
    }
}
