<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function __construct()
    {
        //
    }

    public function loadUsers()
    {
        echo json_encode(["sample"]);
    }
}
