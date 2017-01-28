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
class Model_Shop_Data extends \Orm\Model
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
		'gnavi_shop_id',
		'name',
		'address',
		'comments',
		'release_flag',
		'delete_at',
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
			// ->add_rule('required')
			->add_rule('max_length', 50);
		
		$val->add('comments', 'comments')
			->add_rule('max_length', 200);
		
		return $val;
	}
	
	/**
     * ぐるなびAPI関数
     *
     * ユーザーが入力した店舗情報をもとにより詳細な情報を取得する。
     * また、店舗詳細画面へ遷移する際に呼び出される時は、
     * ぐるなびの店舗IDがDBに存在する場合に使用される。
     * 
     * @access public
     * @return array $gnavi_info ぐるなび情報
     */
    public static function getGnaviInfo($shop_data, $gnavi_shop_id = null)
    {
        $gnavi_info = array();

         //エンドポイントのURIとフォーマットパラメータを変数に入れる
        $uri   = "http://api.gnavi.co.jp/RestSearchAPI/20150630/";
        
        //APIアクセスキーを変数に入れる
        $acckey= "24d415daefe2e54d2992ebc9ffa68b85";
        
        //返却値のフォーマットを変数に入れる
        $format= "json";
        
        $name  = urldecode($shop_data['name']);
        $address = urldecode($shop_data['address']);

        // gnavi_shop_idが存在する場合true
        if ( ! empty($gnavi_shop_id))
        {
        	$id = urldecode($gnavi_shop_id);
	        //URL組み立て
	        $url  = sprintf("%s%s%s%s%s%s%s%s%s%s%s", $uri, "?format=", $format, "&keyid=", $acckey, "&id=", $id, "&name=",$name,"&address=", $address);
        }
        else
        {
        	//URL組み立て
        	$url  = sprintf("%s%s%s%s%s%s%s%s%s", $uri, "?format=", $format, "&keyid=", $acckey, "&name=", $name,"&address=", $address);
        }
        
        //API実行
        $json = file_get_contents($url);
        
        $obj  = json_decode($json);

        //結果をパース
        foreach((array)$obj as $key => $restArray)
        {
            if(strcmp($key, "rest") == 0)
            {
                foreach((array)$restArray as $key => $val)
                {
                    $gnavi_info[$key] = $val;
                }
            }
        }
        
        return $gnavi_info;
    }

}
