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
            'email' => [
                'type' => 'varchar',
                'constraint' => 255, 255,
                'null' => false,
                'default' => '',
                'comment' => 'EMAIL'
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['unactive', 'active', 'suspension'],
                'default' => 'unactive',
                'comment' => '狀態'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
                'comment' => '新增時間'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
                'comment' => '最後更新時間'
            ],
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
        $this->forge->createTable('members', true, $attributes);
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('members');
    }
}
