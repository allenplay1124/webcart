<?php
namespace App\Libraries;

use App\Repo\SystemRepo;

class Header
{
    protected $systemRepo;

    protected $lang;

    protected $session;

    protected $request;

    public function __construct()
    {
        $this->systemRepo = new SystemRepo;

        $this->session = \Config\Services::session();

        $this->request = \Config\Services::request();

        $this->lang = $this->session->get('lang') ?? $this->request->getLocale();
    }

    public function TopBar($params)
    {
        $currency = $this->systemRepo->getSettingValue('currency');
   
        foreach ($currency as $key => $val) {
            $currencies[$key] = $val[$this->lang];
        }

        $data = [
            'langs' => $this->systemRepo->getSettingValue('lang'),
            'currencies' => $currencies
        ];
        
        return view('web/Header', $data);
    }
}
