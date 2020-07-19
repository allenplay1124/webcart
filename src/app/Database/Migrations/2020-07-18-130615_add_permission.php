<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPermission extends Migration
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
			'permisson_code' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => false,
				'default' => '',
				'comment' => '權限代碼'
			],
			'name' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => true,
				'default' => null,
				'comment' => '權限名稱'
			],
			'action' => [
				'type' => 'text',
				'constraint' => 255,
				'null' => false,
				'default' => json_encode([]),
				'comment' => '動作'
			],
			'remark' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => true,
				'default' => '',
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

		$attributes = ['ENGINE' => 'InnoDB', 'COMMENT' => '權限'];
		$this->forge->addKey('id', true);
		$this->forge->addKey(['module_code', 'permisson_code']);
		$this->forge->createTable('permission', true, $attributes);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('permission');
	}
}
