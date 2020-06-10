<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddResetPass extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'auto_increment' => true,
                'unsigned' => true,
                'comment' => 'PK'
            ],
            'role_type' => [
                'type' => 'varchar',
                'constraint' => 6,
                'null' => false,
                'default' => 'member',
                'comment' => '角色類型:member會員角色, admin 管理者角色'
            ],
            'active_id' => [
                'type' => 'bigint',
                'unsigned' => true,
                'comment' => '關聯帳號id'
            ],
            'active_code' => [
                'type' => 'varchar',
                'constraint' => 36,
                'null' => false,
                'default' => '',
                'comment' => '啟用碼'
            ],
            "created_at TIMESTAMP default CURRENT_TIMESTAMP COMMENT '新增時間'",
            "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最後更新時間'",
        ]);

        $attributes = ['ENGINE' => 'InnoDB', 'COMMENT' => '帳號啟用及重設密碼'];
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('active_code');
        $this->forge->addKey(['role_type', 'active_id']);
        $this->forge->createTable('reset_pass', true, $attributes);
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('reset_pass');
    }
}
