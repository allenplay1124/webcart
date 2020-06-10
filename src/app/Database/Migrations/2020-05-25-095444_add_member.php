<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMember extends Migration
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
            'username' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false,
                'default' => '',
                'comment' => '會員帳號'
            ],
            'password' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false,
                'default' => '',
                'comment' => '密碼'
            ],
            'first_name' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
                'default' => null,
                'comment' => '名字'
            ],
            'last_name' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
                'default' => null,
                'comment' => '姓名'
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => 255, 255,
                'null' => false,
                'default' => '',
                'comment' => 'EMAIL'
            ],
            'role_id' => [
                'type' => 'int',
                'null' => false,
                'default' => 0,
                'comment' => '角色id'
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['unactive', 'active', 'suspension'],
                'default' => 'unactive',
                'comment' => '狀態：unactive 未啟用, active 啟用, suspension 停權'
            ],
            'lang' => [
                'type' => 'varchar',
                'constraint' => 5,
                'null' => false,
                'default' => 'zh-CN',
                'comment' => '語言'
            ],
            'currency' => [
                'type' => 'varchar',
                'constraint' => 3,
                'null' => true,
                'default' => 'CNY',
                'comment' => '幣別'
            ],
            "created_at TIMESTAMP default CURRENT_TIMESTAMP COMMENT '新增時間'",
            "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最後更新時間'",
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null,
                'comment' => '軟刪除時間'
            ]
        ]);

        $attributes = ['ENGINE' => 'InnoDB', 'COMMENT' => '會員帳號'];
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('username');
        $this->forge->addKey(['username', 'email', 'status', 'role_id']);
        $this->forge->createTable('members', true, $attributes);
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('members');
    }
}
