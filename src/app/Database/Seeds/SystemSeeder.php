<?php

namespace App\Database\Seeds;

use \CodeIgniter\Database\Seeder;
use Illuminate\Database\Capsule\Manager as DB;

class SystemSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'system' => [
                [
                    'setting_key' => 'site_name',
                    'setting_value' => [
                        'zh-TW' => '站台名稱',
                        'zh-CN' => '站台名稱',
                        'en' => 'Site Name'
                    ],
                    'remark' => '站台名稱'
                ],
                [
                    'setting_key' => 'keyword',
                    'setting_value' =>  '',
                    'remark' => '站台關鍵字'
                ],
                [
                    'setting_key' => 'description',
                    'setting_value' => '',
                    'remark' => '站台描述'
                ],
                [
                    'setting_key' => 'lang',
                    'setting_value' => [
                        ['lang_code' => 'en', 'lang_name' => 'English'],
                        ['lang_code' => 'zh-TW', 'lang_name' => '繁體中文'],
                        ['lang_code' => 'zh-CN', 'lang_name' => '简体中文'],
                    ],
                    'remark' => '語言'
                ],
            ]
        ];

        foreach ($data as $key => $val) {
            foreach ($val as $val2) {
                if (
                    DB::table('systems')
                    ->where('module_code', $key)
                    ->where('setting_key', $val2['setting_key'])
                    ->exists() === false
                ) {
                    $setting_value = (is_array($val2['setting_value'])) ? json_encode($val2['setting_value']) : $val2['setting_value'];
                    DB::table('systems')->insert([
                        'module_code' => $key,
                        'setting_key' => $val2['setting_key'],
                        'setting_value' => $setting_value,
                        'remark' => $val2['remark'],
                        'created_user' => 'system',
                        'updated_user' => 'system'
                    ]);
                }
            }
        }
    }
}
