<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductSubscriptionsTable extends Migration
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
            'product_id'                => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'company_id'                => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true,
            ],
            'subscription_status'       => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'              => true,
            ],
            'access_status'             => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => true, // CLOSE, OPEN
            ],
            'access_request'             => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => true, // 1, 0
            ],
            'remarks'                   => [
                'type'              => 'TEXT',
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
        $this->forge->createTable('product_subscriptions');
    }

    public function down()
    {
        $this->forge->dropTable('product_subscriptions');
    }
}
