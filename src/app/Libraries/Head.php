<?php

namespace App\Libraries;

use App\Repo\SystemRepo;

class Head
{
    protected $system;

    protected $session;
    
    protected $lang;

    public function __construct()
    {
        $this->system = new SystemRepo;

        $this->session = \Config\Services::session();

        $config = new \Config\App();

        $this->lang = !empty(session('lang'))? session('lang') : $config->defaultLocale;
    }

    public function Meta(array $params)
    {
        $siteName = $this->system->getSettingValue('site_name');

        $data = [
            'site_name' => $siteName[$this->lang],
            'page_title' => $params['page_title'] ?? '',
            'keywords' => $params['keywords'] ?? '',
            'description' => $params['description'] ?? '',
            'lang' => $this->lang
        ];
        
        return view('web/head', $data);
    }
}
