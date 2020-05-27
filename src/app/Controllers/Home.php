<?php namespace App\Controllers;

use App\Repo\SystemRepo;

class Home extends BaseController
{
    public function __construct()
    {

    }

    public function index()
    {
        $data =  ['keywords' => '購物, 按摩'];
        return view('web/Home', $data);
    }

    //--------------------------------------------------------------------
}
