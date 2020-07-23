<?php 
namespace Mod\System\Controllers;

use App\Controllers\BaseController;

class SystemSetting extends BaseController
{
    public function baseSetting()
    {
        return view('\Mod\System\Views\baseSettingShow');
    }
}