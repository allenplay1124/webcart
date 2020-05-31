<?php namespace App\Controllers;

use App\Repo\SystemRepo;

class Home extends BaseController
{
    public function __construct()
    {

    }

    public function index()
    {
        $data =  [];
        return view('web/Home', $data);
    }

    //--------------------------------------------------------------------
}
