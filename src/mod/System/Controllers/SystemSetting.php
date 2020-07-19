<?php 
namespace Mod\System\Controllers;

use App\Controllers\BaseController;

class SystemSetting extends BaseController
{
    public function show()
    {
        return view('\Mod\System\Views\system_show');
    }
}