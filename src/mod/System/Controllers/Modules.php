<?php
namespace Mod\System\Controllers;

use App\Controllers\BaseController;
use Mod\System\Models\Module;

class Modules extends BaseController
{
    protected $request;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        helper('filesystem');
    }

    public function index()
    {
        $data = [];
        $data['page_title'] = lang('Modules.page_title');
        $data['breadcrumbs'] = [];

        array_push($data['breadcrumbs'], [
            'title' => lang('Comm.dashboard'),
            'link' => site_url('admin')
        ]);

        array_push($data['breadcrumbs'], [
            'title' => lang('Modules.page_title'),
            'link' => '#'
        ]);

        $paths = directory_map(ROOTPATH . '/mod/', 1);

        $modules = Module::get()->toArray();
    
        $install = [];
        $uninstall = [];
        foreach ($paths as $path) {
            $key = array_search(str_replace('/', '', $path), array_column($modules, 'module_code'));
            
            if ($key !== false) {
                $modPath = strtolower($modules[$key]['module_code']);

                array_push($install, [
                    'module_code' => $modules[$key]['module_code'],
                    'module_name' => $modules[$key]['module_name'],
                    'version' => $modules[$key]['version'],
                    'cover_img' => base_url($modules[$key]['cover_img']),
                    'description' => $modules[$key]['description'],
                    'install_url' => site_url("admin/{$modPath}/modinfo/instal"),
                    'update_url' => site_url("admin/{$modPath}/modinfo/update"),
                    'uninstall_url' => site_url("admin/{$modPath}/modinfo/uninstall")
                ]);
            } else {
                $moduleCode = str_replace('/', '', $path);
                $namespace = 'Mod\\' . $moduleCode . '\Config\Modinfo';
                $config = new  $namespace;
                
                $modPath = strtolower($moduleCode);
                array_push($uninstall, [
                    'module_code' => $moduleCode,
                    'module_name' => $config->modName,
                    'version' => $config->modVersion,
                    'cover_img' => base_url($config->coverImg),
                    'description' => $config->modDesc,
                    'install_url' => site_url("admin/{$modPath}/modinfo/install"),
                    'update_url' => site_url("admin/{$modPath}/modinfo/update"),
                    'uninstall_url' => site_url("admin/{$modPath}/modinfo/uninstall")
                ]);
            }
        }
        $data['install'] = $install;
        $data['uninstall'] = $uninstall;

        return view('\Mod\System\Views\ModulesIndex', $data);
    }
}