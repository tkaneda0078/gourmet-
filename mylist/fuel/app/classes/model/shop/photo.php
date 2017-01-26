<?php
/**
 * 店舗情報（画像）モデルクラス
 * 
 * リレーション定義
 * 
 * @author tkaneda
 * @package Model
 * @access protected
 */
class Model_Shop_Photo extends \Orm\Model
{
	protected static $_belongs_to = array(
		'shop_data' => array(
			'model_to'       => 'Model_Shop_Data',
			'key_from'       => 'shop_id',
			'key_to'         => 'shop_photo_id',
			'cascade_save'   => 'true',
			'cascade_delete' => 'false',
		)
	);
	
	protected static $_properties = array(
		'id',
		'shop_id',
		'name',
		'type',
		'size',
		'saved_to',
		'release_flag',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'shop_photos';

}
