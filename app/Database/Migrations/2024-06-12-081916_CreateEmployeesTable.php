<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        //33 fields
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
            'identification_number'     => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'first_name'                => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'middle_name'               => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'last_name'                 => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'marital_status'            => [
                'type'              => 'VARCHAR',
                'constraint'        => 20,
                'null'              => true,
            ],
            'email_address'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'mobile_number'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'user_password'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'auth_code'                 => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'user_status'               => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'user_type'                 => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'permanent_address'         => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'department'                => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'position'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'employement_status'        => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true,
            ],
            'date_hired'                => [
                'type'              => 'DATE',
                'null'              => true,
            ],
            'years_stayed'                => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'gross_salary'              => [
                'type'              => 'DECIMAL',
                'constraint'        => [20,2],
                'null'              => true,
            ],
            'net_salary'                => [
                'type'              => 'DECIMAL',
                'constraint'        => [20,2],
                'null'              => true,
            ],
            'minimum_credit_amount'     => [
                'type'              => 'DECIMAL',
                'constraint'        => [20,2],
                'null'              => true,
            ],
            'maximum_credit_amount'     => [
                'type'              => 'DECIMAL',
                'constraint'        => [20,2],
                'null'              => true,
            ],
            'employee_status'           => [
                'type'              => 'VARCHAR',
                'constraint'        => 20,
                'null'              => true,
            ],
            'payroll_bank_number'       => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'profile_picture'           => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
                'null'              => true,
            ],
            'user_role'                 => [
                'type'              => 'VARCHAR',
                'constraint'        => 20,
                'null'              => true,
            ],
            'role_id'                   => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'access_modules'            => [
                'type'              => 'JSON',
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
        $this->forge->createTable('employees');
    }

    public function down()
    {
        $this->forge->dropTable('employees');
    }
}
