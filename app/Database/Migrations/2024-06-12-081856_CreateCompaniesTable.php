<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        //29 fields
        $this->forge->addField([
            'id'                        => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'company_code'              => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'company_name'              => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
                'null'              => true,
            ],
            'company_address'           => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'company_email'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'mobile_number'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'telephone_number'          => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'company_website'           => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'business_type'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'business_industry'         => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'tax_identification_number' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'bank_depository'           => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'branch_name'               => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'branch_code'               => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'payroll_payout_date1'      => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'cut_off_min_date1'         => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'cut_off_max_date1'         => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'payroll_payout_date2'      => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'cut_off_min_date2'         => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'cut_off_max_date2'         => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'hr_user'                   => [
                'type'              => 'VARCHAR',
                'constraint'        => 10,
                'null'              => true,
            ],
            'bpo_user'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => 10,
                'null'              => true,
            ],
            'subscription_status'       => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'employee_list_status'      => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'company_status'            => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
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
        $this->forge->createTable('companies');
    }

    public function down()
    {
        $this->forge->dropTable('companies');
    }
}
