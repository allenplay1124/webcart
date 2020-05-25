<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsers extends Migration
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
			]
		]);
		$attributes = ['ENGINE' => 'InnoDB', 'CHARACTER SET' => 'utf8mb4', 'COLLATE' => 'utf8mb4_general_ci', 'COMMENT' => '會員帳號'];
		$this->forge->addPrimaryKey('id');
		$this->forge->addUniqueKey('username');
		$this->forge->createTable('users', true, $attributes);
		
		
		
		
		var_dump($this->forge);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
