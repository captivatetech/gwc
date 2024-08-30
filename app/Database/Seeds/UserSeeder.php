<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Users;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = new Users();

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
            'first_name'            => 'GWC',
            'last_name'             => 'Administrator',
            'mobile_number'         => NULL,
            'email_address'         => 'admin@gmail.com',
            'user_password'         => 'YBO60giQPoFef05oW+gMmg==',
            'user_status'           => 1,
            'role_id'               => 1,
            'access_modules'        => json_encode($arrRoles),
            'created_date'          => date('Y-m-d H:i:s')
        ];

        $users->insert($arrData);
    }
}
