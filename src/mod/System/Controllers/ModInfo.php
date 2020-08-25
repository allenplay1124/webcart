<?php

namespace Mod\System\Controllers;

use App\Controllers\BaseController;
use Illuminate\Database\Capsule\Manager as DB;

class Modinfo extends BaseController
{
    private $modConfig;

    public function __construct()
    {
        $this->modConfig = new \Mod\System\Config\Modinfo;
    }

    public function install()
    {
        DB::table('modules')
            ->insert([
                'module_code' => 'System',
                'module_name' => $this->modConfig->modName,
                'version' => $this->modConfig->modVersion,
                'cover_img' => $this->modConfig->coverImg,
                'description' => $this->modConfig->modDesc
            ]);
        
        return $this->response->setStatusCode(200)
                ->setJSON([
                    'msg' => lang('modules.install_success')
                ]);
    }

    public function update()
    {

    }

    public function uninstall()
    {

    }
}