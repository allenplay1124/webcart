<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSystem extends Migration
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
            'setting_key' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false,
                'default' => '',
                'comment' => '系統設定欄位'
            ],
            'setting_value' => [
                'type' => 'text',
                'null' => true,
                'default' => null,
                'comment' => '系統設定值'
            ],
            'remark' => [
                'type' => 'text',
                'null' => true,
                'default' => null,
                'comment' => '設定值說明'
            ],
            "created_at TIMESTAMP default CURRENT_TIMESTAMP COMMENT '新增時間'",
            "updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最後更新時間'",
		]);
		$attributes = ['ENGINE' => 'InnoDB', 'COMMENT' => '系統設定'];
		$this->forge->addPrimaryKey('id');
		$this->forge->addUniqueKey('setting_key');
		$this->forge->createTable('system', true, $attributes);
    }

    //--------------------------------------------------------------------

    public function down()
    {
		$this->forge->dropTable('system');
    }
}
