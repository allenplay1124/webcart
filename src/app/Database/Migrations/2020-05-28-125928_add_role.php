<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRole extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
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
            'role_code' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => true,
                'default' => null,
                'comment' => '角色代碼'
            ],
            'role_name' => [
                'type' => 'text',
                'null' => true,
                'default' => null,
                'comment' => '角色名稱'
            ],
            'remark' => [
                'type' => 'text',
                'null' => true,
                'default' => null,
                'comment' => '角色說明'
            ],
            "created_at TIMESTAMP default CURRENT_TIMESTAMP COMMENT '新增時間'",
            "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最後更新時間'",
        ]);

        $attributes = ['ENGINE' => 'InnoDB', 'COMMENT' => '角色'];
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('role_code');
        $this->forge->addKey(['role_type', 'role_code']);
        $this->forge->createTable('roles', true, $attributes);
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('roles');
    }
}
