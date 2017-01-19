<?php

namespace Fuel\Migrations;

class Create_shop_data
{
	public function up()
	{
		\DBUtil::create_table('shop_data', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'shop_photo_id' => array('constraint' => 11, 'type' => 'int'),
			'gnavi_shop_id' => array('constraint' => 64, 'type' => 'varchar'),
			'name' => array('constraint' => 64, 'type' => 'varchar'),
			'address' => array('constraint' => 255, 'type' => 'varchar'),
			'comments' => array('constraint' => 255, 'type' => 'varchar'),
			'release_flag' => array('constraint' => 1, 'type' => 'tinyint'),
			'delete_at' => array('type' => 'datetime'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('shop_data');
	}
}