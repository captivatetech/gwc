<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TestController extends BaseController
{
    public function sample()
    {
        $series = substr('GWC0001-202400001', 12);
        echo $series;

        $year = substr('GWC0001-202400001', 8, 4);
        echo $year;
    }

    public function testZohoSign()
    {

        // $curl = curl_init("https://sign.zoho.com/api/v1/templates");
        // curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        //     'Authorization:Zoho-oauthtoken 1000.928b54a3cb9e47afae1de4cc88f76468.13c97c8bd555d2590ed8467d6d5309a9',
        // ));
        // curl_setopt($curl, CURLOPT_POST, false);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // $result = curl_exec($curl);
        // curl_close($curl);


        // return $response;

        $result = sendTemplate();

        return $this->response->setJSON($result);
    }
}
