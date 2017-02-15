<?php
/**
 * 店舗情報モデルクラス
 * 
 * リレーション定義
 * バリデーション処理
 * ぐるなびAPIを利用して、詳細な店舗情報を取得する。
 * 
 * @author tkaneda
 * @package Model
 */
class Model_Shop_Data extends \Orm\Model_Soft
{
	protected static $_has_many = array(
		'shop_photos' => array(
			'model_to'       => 'Model_Shop_Photo',
			'key_from'       => 'shop_photo_id',
			'key_to'         => 'shop_id',
			'cascade_save'   => 'true',
			'cascade_delete' => 'true',
		)
	);

	protected static $_properties = array(
		'id',
		'shop_photo_id',
		'gnavi_id',
		'name',
		'address',
		'comments',
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

	protected static $_table_name = 'shop_data';
	
	/**
     * バリデーション関数
     *
     * ユーザーが入力した店舗情報のチェックを行う。
     * 
     * @access public
     * @return $val バリデーション結果
     */
	public static function validate()
	{
		$val = Validation::forge();
		
		$val->add('name', 'name')
			->add_rule('required')
			->add_rule('max_length', 20);
		
		$val->add('address', 'address')
			->add_rule('max_length', 50);
		
		$val->add('comments', 'comments')
			->add_rule('max_length', 200);
		
		return $val;
	}

}
