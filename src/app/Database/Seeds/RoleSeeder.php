<?php
namespace App\Database\Seeds;

use \CodeIgniter\Database\Seeder;
use Illuminate\Database\Capsule\Manager as DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role_code' => 'admin',
                'role_name' => [
                    'en' => 'admin',
                    'zh-CN' => '管理者',
                    'zh-TW' => '管理者'
                ],
                'remark' => '管理者'
            ],
            [
                'role_code' => 'member',
                'role_name' => [
                    'en' => 'member',
                    'zh-CN' => '会员',
                    'zh-TW' => '會員'
                ],
                'remark' => '一般會員'
            ],
        ];

        foreach($data as $key => $val) {
            if (DB::table('roles')->where('role_code', $val['role_code'])->exists() === false) {
                DB::table('roles')->insert([
                    'role_code' => $val['role_code'],
                    'role_name' => json_encode($val['role_name']),
                    'is_open' => true,
                    'remark' => $val['remark']
                ]);
            }
        }
    }
}