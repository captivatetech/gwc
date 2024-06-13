<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class NavigationController extends BaseController
{
    public function index()
    {
        return $this->slice->view('login');
    }

    public function login()
    {
        return $this->slice->view('login');
    }

    public function test()
    {
        $data['pageTitle'] = 'Users | GWC';
        $data['customScripts'] = 'users';
        return $this->slice->view('portal.user', $data);
    }
}
