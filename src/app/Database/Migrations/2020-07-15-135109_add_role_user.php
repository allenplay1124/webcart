<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleUser extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'role_id' => [
				'type' => 'int',
				'unsigned' => true,
				'comment' => '角色ID'
			],
			'user_id' => [
				'type' => 'bigint',
				'unsigned' => true,
				'comment' => '會員ID'
			]
		]);

		$attributes = ['ENGINE' => 'InnoDB', 'COMMENT' => '會員角色'];
	
		$this->forge->addKey(['role_id', 'user_id']);
		$this->forge->createTable('role_user', true, $attributes);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('role_user');
	}
}
