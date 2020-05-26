<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCiSessions extends Migration
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
			'ip_address' => [
				'type' => 'varchar',
				'constraint' => 45,
				'null' => false,
				'comment' => 'IP位置'
			],
			'timestamp' => [
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => true,
				'null' => false,
				'default' => 0,
				'comment' => '時間'
			],
			'data' => [
				'type' => 'blob',
				'null' => false,
				'comment' => '資料'
			]
		]);
		$attributes = ['ENGINE' => 'InnoDB', 'COMMENT' => 'SESSION Table'];
		$this->forge->addPrimaryKey('id');
		$this->forge->addKey('timestamp');
		$this->forge->createTable('ci_sessions', true, $attributes);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('ci_sessions');
	}
}
