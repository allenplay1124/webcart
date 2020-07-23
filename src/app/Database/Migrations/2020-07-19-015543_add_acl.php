<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAcl extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'permission_id' => [
				'type' => 'int',
				'null' => false,
				'default' => 0,
				'comment' => '權限id'
			],
			'role_id' => [
				'type' => 'int',
				'null' => false,
				'default' => 0,
				'comment' => '角色id'
			],
			'acl_value' => [
				'type' => 'int',
				'null' => false,
				'default' => 0,
				'comment' => '權限值'
			]
		]);
		$attributes = ['ENGINE' => 'InnoDB', 'COMMENT' => '角色權限控制'];
		$this->forge->addKey(['permissin_id', 'role_id', 'acl_value']);
		$this->forge->createTable('acl', true, $attributes);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('acl');
	}
}
