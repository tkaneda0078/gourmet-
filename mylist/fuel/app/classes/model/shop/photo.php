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
class Model_Shop_Photo extends \Orm\Model_Soft
{
	protected static $_belongs_to = array(
		'shop_data' => array(
			'model_to'       => 'Model_Shop_Data',
			'key_from'       => 'shop_id',
			'key_to'         => 'shop_photo_id',
			'cascade_save'   => 'true',
			'cascade_delete' => 'true',
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
		'deleted_at',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => true,
		),
	);
	
	protected static $_soft_delete = array(
        'deleted_field' => 'deleted_at',
        'mysql_timestamp' => true,
    );

	protected static $_table_name = 'shop_photos';

}
