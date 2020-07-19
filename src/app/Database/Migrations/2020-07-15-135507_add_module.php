<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddModule extends Migration
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
			'module_code' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => false,
				'default' => '',
				'comment' => '模組代碼'
			],
			'module_name' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => false,
				'default' => '',
				'comment' => '模組名稱'
			],
			'version' => [
				'type' => 'float',
				'null' => false,
				'default' => 0,
				'comment' => '版本號'
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

		$attributes = ['ENGINE' => 'InnoDB', 'COMMENT' => '模組'];
		$this->forge->addKey('id', true);
		$this->forge->addKey(['module_code']);
		$this->forge->createTable('module', true, $attributes);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('module');
	}
}
