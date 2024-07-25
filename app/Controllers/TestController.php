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
}
