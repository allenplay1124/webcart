<?php

namespace App\Controllers;

class Member extends BaseController
{
    public function login()
    {
        return view('web/Auth/Login');
    }

    public function register()
    {
        return view('web/Auth/Register');
    }

    public function active()
    {
    }
}
