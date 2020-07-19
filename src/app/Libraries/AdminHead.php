<?php

namespace App\Libraries;

class AdminHead
{
    protected $lang;

    public function __construct()
    {
        $config = new \Config\App();
        $this->lang = !empty(session('lang'))? session('lang') : $config->defaultLocale;
    }

    public function Meta()
    {
        $data = [
            'lang' => $this->lang
        ];
        return view('web/admin/Head', $data);
    }

    public function Navbar()
    {
        return view('web/admin/navbar');
    }
}