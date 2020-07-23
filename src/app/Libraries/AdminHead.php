<?php

namespace App\Libraries;

use Mod\System\Models\Menu;

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
        $data['menus'] = Menu::where('group', 'admin')
                    ->with('child')
                    ->where('parent_id', 0)
                    ->orderBy('sort', 'asc')
                    ->get()
                    ->toArray();
   
        return view('web/admin/navbar', $data);
    }
}