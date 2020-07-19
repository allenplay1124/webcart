<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRole extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'int',
				'unsigned' => true,
				'auto_increment' => true,
				'comment' => 'PK'
			],
			'role_code' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => true,
				'default' => null,
				'comment' => '角色代碼'
			],
			'role_name' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => false,
				'default' => '',
				'comment' => '角色名稱'
			],
			'is_open' => [
				'type' => 'boolean',
				'null' => false,
				'default' => false,
				'comment' => '是否開啟'
			],
			'remark' => [
				'type' => 'text',
				'null' => true,
				'default' => null,
				'comment' => '備註'
			],
			'created_at datetime default current_timestamp COMMENT "新增時間"',
			'updated_at datetime default current_timestamp COMMENT "更新時間"',
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
				'defulat' => null,
				'comment' => '修改人員'
			]
		]);

		$attributes = ['ENGINE' => 'InnoDB', 'COMMENT' => '角色'];
		$this->forge->addKey('id', true);
		$this->forge->addKey(['role_code', 'is_open']);
		$this->forge->createTable('roles', true, $attributes);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('roles');
	}
}
