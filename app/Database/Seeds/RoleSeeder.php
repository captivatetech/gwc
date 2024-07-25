<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Roles;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = new Roles();

        $arrRoles = [
            [
                [1],[1,1,1,1],[]
            ],
            [
                [1],[1,1,1,1],[]
            ],
            [
                [1],[1,1,1,1],[]
            ],
            [
                [1],[1,1,1,1],[]
            ],
            [
                [1],[1,1,1,1],[]
            ],
            [
                [1],[1,1,1,1],[]
            ],
            [
                [1],[1,1,1,1],[]
            ],
            [
                [1],[1,1,1,1],[]
            ],
            [
                [1],[1,1,1,1],[]
            ],
            [
                [1],[1,1,1,1],[]
            ],
            [
                [1],[1,1,1,1],[]
            ],
            [
                [1],[1,1,1,1],[]
            ],
            [
                [1],[1,1,1,1],[]
            ],
            [
                [1],[1,1,1,1],[]
            ]
        ];

        $arrData = [
            'role_name'             => 'Administrator',
            'role_description'      => 'Default Role',
            'access_modules'        => json_encode($arrRoles),
            'role_status'           => 1,
            'created_date'          => date('Y-m-d H:i:s')
        ];

        $roles->insert($arrData);
    }
}
