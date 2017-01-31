<?php
/**
 * ぐるなび店舗情報モデルクラス
 * 
 * リレーション定義
 * バリデーション処理
 * ぐるなびAPIを利用して、店舗検索を実行する。
 * 
 * @author tkaneda
 * @package Model
 */
class Model_Gnavi_Data extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'gnavi_shop_id',
		'name',
		'address',
		'url',
		'image',
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

	protected static $_table_name = 'gnavi_data';
	
	/**
     * バリデーション関数
     *
     * ユーザーが入力した検索条件のチェックを行う。
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
		
		$val->add('area', 'area')
			->add_rule('required')
			->add_rule('max_length', 20);
		
		return $val;
	}
	
    /**
     * ぐるなびAPI関数
     *
     * ユーザーが入力した都道府県をもとにより都道府県コードを取得する。
     * そのコードは店舗検索で使用する。
     * 
     * @access public
     * @return array $data 都道府県コード
     */
	public static function getPrefCodes($area)
	{
	    //エンドポイントのURIとフォーマットパラメータを変数に入れる
        $uri   = "https://api.gnavi.co.jp/master/PrefSearchAPI/20150630/";
        
        //APIアクセスキーを変数に入れる
        $acckey= "24d415daefe2e54d2992ebc9ffa68b85";
        
        //返却値のフォーマットを指定
        $format= "json";
         
        //URI組み立て
        $url  = sprintf("%s%s%s%s%s", $uri, "?format=", $format,"&keyid=", $acckey);
        
        //API実行
        $json = file_get_contents($url);
        
        //取得した結果をオブジェクト化
        $obj  = json_decode($json);
        
        //結果をパース
        $data = array();
        foreach((array)$obj as $key => $val)
        {
           if(strcmp($key,"pref") == 0)
           {
               foreach($val as $k => $v)
               {
                    if ($area === $v->pref_name)
                    {
                        $data['area_code'] = $v->area_code;
                        $data['pref_code'] = $v->pref_code;
                        
                        return $data;
                    }
               }
           }
        }
        
        return;
	}
	
	/**
     * ぐるなびAPI関数
     *
     * ユーザーが入力した店舗名、都道府県コードをもとにより店舗情報を取得する。
     * 店舗詳細画面へ遷移する際は、店舗IDを使用する。
     * 
     * @access public
     * @return array $gnavi_info 店舗情報
     */
    public static function getGnaviInfo($gnavi_shop_id = null, $name, $pref_codes)
    {
        $gnavi_info = array();

         //エンドポイントのURIとフォーマットパラメータを変数に入れる
        $uri   = "http://api.gnavi.co.jp/RestSearchAPI/20150630/";
        
        //APIアクセスキーを変数に入れる
        $acckey= "24d415daefe2e54d2992ebc9ffa68b85";
        
        //返却値のフォーマットを変数に入れる
        $format= "json";

        $name       = urldecode($name);
        $pref_code  = $pref_codes['pref_code'];

        // gnavi_shop_idが存在する場合true
        if (empty($gnavi_shop_id))
        {
	        //URL組み立て
	        $url  = sprintf("%s%s%s%s%s%s%s%s%s", $uri, "?format=", $format, "&keyid=", $acckey, "&name=", $name,"&pref=", $pref_code);
        }
        else
        {
            $id = urldecode($gnavi_shop_id);
        	//URL組み立て
        	$url  = sprintf("%s%s%s%s%s%s%s%s", $uri, "?format=", $format, "&keyid=", $acckey, "&id=", $id);
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
