<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSystem extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'group' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => false,
				'default' => '',
				'comment' => '設定代碼'
			],
			'setting_key' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => false,
				'default' => '',
				'comment' => '設定項目'
			],
			'setting_value' => [
				'type' => 'text',
				'null' => true,
				'default' => null,
				'comment' => '設定值'
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp',
			'created_user' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => true,
				'default' => null,
				'comment' => '新增人員'
			],
			'updated_user' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => true,
				'default' => null,
				'comment' => '修改人員'
			]
		]);
		$attributes = ['ENGINE' => 'InnoDB', 'COMMENT' => '系統設定'];
		$this->forge->addKey('group');
		$this->forge->addKey('setting_key');
		$this->forge->createTable('system', true, $attributes);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('system');
	}
}
