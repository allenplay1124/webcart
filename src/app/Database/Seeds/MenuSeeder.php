<?php

namespace App\Database\Seeds;

use \CodeIgniter\Database\Seeder;
use Illuminate\Database\Capsule\Manager as DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'group' => 'admin',
                'parent_id' => 0,
                'icon' => 'fas fa-tachometer-alt',
                'title' => [
                    'zh-tw' => '儀表板',
                    'zh-cn' => '仪表板',
                    'en' => 'Dashboard'
                ],
                'route' => 'admin/dashboard',
                'href' => null,
                'target' => '_self',
                'sort' => 0,
                'is_show' => true,
                'created_user' => 'system',
                'updated_user' => 'system'
            ],
            [
                'id' => 2,
                'group' => 'admin',
                'parent_id' => 0,
                'icon' =>  'fas fa-cog',
                'title' => [
                    'zh-tw' => '系統設定',
                    'zh-cn' => '系统设定',
                    'en' => 'System setting'
                ],
                'route' => '#',
                'href' => null,
                'target' => '_self',
                'sort' => 1,
                'is_show' => true,
                'created_user' => 'system',
                'updated_user' => 'system'
            ],
            [
                'id' => 3,
                'group' => 'admin',
                'parent_id' => 2,
                'icon' => 'fas fa-cogs',
                'title' => [
                    'zh-tw' => '基本設定',
                    'zh-cn' => '基本设定',
                    'en' => 'Basic settings'
                ],
                'route' => 'admin/system/base-setting',
                'href' => null,
                'target' => '_self',
                'sort' => 0,
                'is_show' => true,
                'created_user' => 'system',
                'updated_user' => 'system'
            ],
            [
                'id' => 4,
                'group' => 'admin',
                'parent_id' => 2,
                'icon' => 'fas fa-globe',
                'title' => [
                    'zh-tw' => '語言設定',
                    'zh-cn' => '语言设定',
                    'en' => 'Language setting'
                ],
                'route' => 'admin/system/language',
                'href' => null,
                'target' => '_self',
                'sort' => 1,
                'is_show' => true,
                'created_user' => 'system',
                'updated_user' => 'system'
            ],
            [
                'id' => 5,
                'group' => 'admin',
                'parent_id' => 2,
                'icon' => 'fab fa-elementor',
                'title' => [
                    'zh-tw' => '選單設定',
                    'zh-cn' => '选单设定',
                    'en' => 'Menu settings'
                ],
                'route' => 'admin/system/menu',
                'href' => null,
                'target' => '_self',
                'sort' => 2,
                'is_show' => true,
                'created_user' => 'system',
                'updated_user' => 'system'
            ],
            [
                'id' => 6,
                'group' => 'admin',
                'parent_id' => 2,
                'icon' => 'fas fa-cubes',
                'title' => [
                    'zh-tw' => '模組管理',
                    'zh-cn' => '模組管理',
                    'en' => 'Module management'
                ],
                'route' => 'admin/system/module',
                'href' => null,
                'target' => '_self',
                'sort' => 3,
                'is_show' => true,
                'created_user' => 'system',
                'updated_user' => 'system'
            ]
        ];

        foreach ($data as $val) {
            DB::table('menus')->insert([
                'id' => $val['id'],
                'group' => $val['group'],
                'parent_id' => $val['parent_id'],
                'icon' => $val['icon'],
                'title' => json_encode($val['title']),
                'route' => $val['route'],
                'target' => $val['target'],
                'sort' => $val['sort'],
                'is_show' => $val['is_show'],
                'created_user' => $val['created_user'],
                'updated_user' => $val['updated_user']
            ]);
        }
    }
}
