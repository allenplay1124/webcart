<?php

namespace Mod\System\Controllers;

use App\Controllers\BaseController;
use Mod\System\Models\System;

class BaseSetting extends BaseController
{
    protected $request;

    public function __construct()
    {
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        $data = [];
        $data['page_title'] = lang('BaseSetting.page_title');
        $data['breadcrumbs'] = [];

        array_push($data['breadcrumbs'], [
            'title' => lang('Comm.dashboard'),
            'link' => site_url('admin')
        ]);

        array_push($data['breadcrumbs'], [
            'title' => lang('BaseSetting.page_title'),
            'link' => '#'
        ]);

        $langs = System::where('module_code', 'system')->where('setting_key', 'lang')->first()->setting_value;
        $data['langs'] = json_decode($langs, true);

        $results = System::where('module_code', 'system')->get();


        foreach ($results as $result) {
            $data['data'][$result->setting_key] = json_decode($result->setting_value, true);
        }

        return view('\Mod\System\Views\baseSetting', $data);
    }

    public function update()
    {
        $data = $this->request->getJSON(true);

        foreach ($data as $key => $val) {
            $val = (is_array($val)) ? json_encode($val) : $val;

            if (System::where('module_code', 'system')->where('setting_key', $key)->exists()) {
                System::where('module_code', 'system')
                    ->where('setting_key', $key)
                    ->update(['setting_value' => $val]);
            } else {
                System::create([
                    'module_code' => 'system',
                    'setting_key' => $key,
                    'setting_value' => $val,
                    'created_user' => 'admin',
                    'updated_user' => 'admin'
                ]);
            }
        }

        return $this->response->setJson([
            'msg' => lang('Comm.update_success')
        ]);
    }
}
