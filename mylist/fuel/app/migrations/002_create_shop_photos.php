<?php

namespace Fuel\Migrations;

class Create_shop_photos
{
	public function up()
	{
		\DBUtil::create_table('shop_photos', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'shop_id' => array('constraint' => 11, 'type' => 'int'),
			'name' => array('constraint' => 100, 'type' => 'varchar'),
			'type' => array('constraint' => 20, 'type' => 'varchar'),
			'size' => array('constraint' => 11, 'type' => 'int'),
			'saved_to' => array('constraint' => 200, 'type' => 'varchar'),
			'release_flag' => array('constraint' => 1, 'type' => 'tinyint'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('shop_photos');
	}
}