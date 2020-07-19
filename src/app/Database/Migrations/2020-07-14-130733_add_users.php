<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsers extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'bigint',
				'unsigned' => true,
				'auto_increment' => true,
				'comment' => 'PK'
			],
			'username' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => false,
				'default' => '',
				'comment' => '會員帳號'
			],
			'password'  => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => false,
				'default' => '',
				'comment' => '密碼'
			],
			'email' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => false,
				'default' => '',
				'comment' => '電子信箱'
			],
			'status' => [
				'type' => 'enum',
				'constraint' => ['unactive', 'active', 'stop'],
				'default' => 'unactive',
				'null' => false,
				'comment' => '會員狀態'
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
		$attributes = ['ENGINE' => 'InnoDB', 'COMMENT' => '會員'];
		$this->forge->addKey('id', true);
		$this->forge->addKey(['username', 'email', 'status']);
		$this->forge->createTable('users', true, $attributes);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
