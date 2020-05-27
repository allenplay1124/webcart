<?php
namespace App\Controllers;

class Member extends BaseController
{
    public function login()
    {
        return view('web/Login');
    }

    public function register()
    {
        return view('web/Register');
    }
}