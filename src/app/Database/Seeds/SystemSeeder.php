<?php
namespace App\Database\Seeds;

use \CodeIgniter\Database\Seeder;
use Illuminate\Database\Capsule\Manager as DB;

class SystemSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'site_name' => [
                'value' => [
                    'zh-CN' => '网站名称',
                    'zh-TW' => '網站名稱',
                    'en' => 'Website name'
                ],
                'remark' => '網站名稱'
            ],
            'keywords' => [
                'value' => [],
                'remark' => '網站關鍵字'
            ],
            'description' => [
                'value' => [],
                'remark' => '網站描述'
            ],
            'lang' => [
                'value' => [
                    'zh-CN' => '简体中文',
                    'zh-TW' => '繁體中文',
                    'en' => 'English'
                ],
                'remark' => '語言'
            ],
            'currency' => [
                'value' => [
                    'HKD' => [
                        'zh-CN' => '港元',
                        'zh-TW' => '港元',
                        'en' => 'Hong Kong dollar'
                    ],
                    'CNY' => [
                        'zh-CN' => '人民币',
                        'zh-TW' => '人民幣',
                        'en' => 'Renminbi'
                    ],
                    'TWD' => [
                        'zh-CN' => '新台币',
                        'zh-TW' => '新台幣',
                        'en' => 'New Taiwan Dollar'
                    ],
                    'SGD' => [
                        'zh-CN' => '新加坡币',
                        'zh-TW' => '新加坡元',
                        'en' => 'Singapore Dollar'
                    ],
                    'USD' => [
                        'zh-CN' => '美元',
                        'zh-TW' => '美元',
                        'en' => 'US dollar'
                    ]
                ],
                'remark' => '幣別'
            ]
        ];

        foreach ($data as $key => $val) {
            if (DB::table('system')->where('setting_key', $key)->exists() === false) {
                DB::table('system')->insert([
                    'setting_key' => $key,
                    'setting_value' => json_encode($val['value']),
                    'remark' => $val['remark']
                ]);
            }
        }
    }
}
