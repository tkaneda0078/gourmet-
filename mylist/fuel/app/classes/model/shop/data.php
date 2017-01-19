<?php

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
	
	public static function validate()
	{
		$val = Validation::forge();
		
		$val->add('name', '名前')
			->add_rule('required')
			->add_rule('max_length', 20);
		
		$val->add('address', '住所')
			->add_rule('required')
			->add_rule('max_length', 50);
		
		$val->add('comments', 'コメント')
			->add_rule('max_length', 200);
			
		return $val;
	}
	
	/**
     * ぐるなび情報を取得
     *
     * 
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

        // gnavi_shop_idが存在すう場合true
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
        //取得した結果をオブジェクト化
        $obj  = json_decode($json);

        //結果をパース
        //トータルヒット件数、店舗番号、店舗名、最寄の路線、最寄の駅、最寄駅から店までの時間、店舗の小業態を出力
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
