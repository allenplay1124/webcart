<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMenu extends Migration
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
			'group' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => false,
				'default' => '',
				'comment' => '選單群組'
			],
			'parent_id' => [
				'type' => 'int',
				'unsigned' => true,
				'null' => false,
				'default' => 0,
				'comment' => '上層選單'
			],
			'icon' => [
				'type' => 'varchar',
				'constraint' => 25,
				'null' => true,
				'default' => null,
				'comment' => 'ICON'
			],
			'title' => [
				'type' => 'text',
				'null' => false,
				'default' => null,
				'comment' => '選單名稱'
			],
			'route' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => true,
				'default' => null,
				'comment' => '路由網址'
			],
			'href' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => true,
				'default' => null,
				'comment' => '外部連結'
			],
			'target' => [
				'type' => 'enum',
				'constraint' => ['_self', '_blank'],
				'null' => false,
				'default' => '_self',
				'comment' => '開啟視窗'
			],
			'sort' => [
				'type' => 'int',
				'null' => false,
				'default' => 0,
				'comment' => '排序'
			],
			'is_show' => [
				'type' => 'boolean',
				'null' => false,
				'default' => false,
				'comment' => '是否顯示'
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
		$attributes = ['ENGINE' => 'InnoDB', 'COMMENT' => '選單'];
		$this->forge->addKey('id', true);
		$this->forge->addKey(['group', 'parent_id', 'sort']);
		$this->forge->createTable('menus', true, $attributes);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('menu');
	}
}
