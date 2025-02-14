<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class ProductController extends BaseController
{
    public function __construct()
    {
        $this->products = model('Products');
    }

    /*
        USED IN:
        - REPRESENTATIVE_FINANCING_PRODUCTS->r_selectProductInformation()
    */
    public function r_selectFinancingProduct()
    {
        $fields = $this->request->getGet();
        $whereParams = ['a.product_code' => $fields['productCode']];
        $arrData = $this->products->r_selectFinancingProduct($whereParams);
        return $this->response->setJSON($arrData);
    }
}
