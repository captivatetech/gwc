<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Products;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = new Products();

        $arrDetails = [];

        $arrData = [
            'product_code'      => 'Salary-Advance',
            'product_name'      => 'Salary Advance',
            'product_details'   => json_encode($arrDetails),
            'product_status'    => 1,
            'created_date'      => date('Y-m-d H:i:s')
        ];

        $products->insert($arrData);
    }
}
