<?php
/**
 * gnavi店舗登録コントローラークラス
 * 
 * 店舗登録の処理全般を実行する。
 * 
 * @author tkaneda
 * @package Controller
 */
class Controller_Gnavi_index extends Controller_Base
{
    // 入力フォームで扱うフィールドを配列として設定
    private $fields = array('name', 'area');
    
    private $data = array();
    
    /**
     * 店舗検索画面を表示させる関数
     *
     * ユーザーが入力した情報をもとに、
     * ぐるなびに登録されている店舗を検索する
     * 
     * @access public
     */
    public function action_index()
	{
	    $this->template->content = View::forge('gnavi/index');
	}

    /**
     * [POST]店舗情報を処理する関数
     *
     * 入力された店舗情報のバリデーションチェックを行う。
     * 入力に問題がない場合は、下部のaction_confirm関数を実行する。
     * 
     * @access public
     * @return array $data エラーメッセージ （バリデーションチェックに引っ掛かった場合）
     * @see Controller_Gnavi_index::action_confirm
     */
	public function post_index()
	{
	    // 各データのpost値をフラッシュセッションに保存
	    foreach ($this->fields as $field)
	    {
	        Session::set_flash($field, Security::xss_clean(Input::post($field)));
	    }

        // エラーメッセージ用
        // $data = array();
        
        $val = Model_Gnavi_Data::validate();

        if ( ! $val->run())
        {
            foreach ($val->error() as $key => $error)
            {
                $this->data['error_msg'][$key] = $error->get_message();
            }
        }

        if ( ! empty($this->data['error_msg']))
        {
            $this->template->content = View::forge('gnavi/index', $this->data);
            return;
        }
        
	    Response::redirect('gnavi/confirm');
	}
	
	/**
     * ぐるなび店舗検索結果を処理する関数
     *
     * 入力された店舗情報をもとにぐるなびAPIを実行して、
     * 該当する店舗情報を出力する。
     * 該当する店舗が一件も見つからなかった場合は、
     * 検索画面のままで、メッセージ表示する。
     * 
     * @access public
     */
	public function action_confirm()
	{
	    foreach ($this->fields as $field)
	    {
	        $this->data[$field] = Session::get_flash($field);

	        Session::keep_flash($field);
	    }

	    // 店舗情報を取得
	    $gnavi_data = Model_Gnavi_Data::fetchGnaviData(null, $this->data['name'], $this->data['area']);

	    if (empty($gnavi_data))
	    {
	    	$this->data['gnavi_data'] = $gnavi_data;
	    	$this->template->content = View::forge('gnavi/index', $this->data);
            return;
	    }

	    $data = array();
	    // おいおい変更予定
	    $image_url = 'http://shima-shima.jp/cms/wp-content/uploads/2012/05/LIV_550.jpg';
	    foreach ($gnavi_data as $key => $val)
	    {
	    	$data[$key]['id']      = $val->id;
	    	$data[$key]['name']    = $val->name;
	    	$data[$key]['url']     = $val->url;
	    	$data[$key]['address'] = $val->address;
	    	$data[$key]['image']   = is_object($val->image_url->shop_image1) ? $image_url : $val->image_url->shop_image1;
	    }

	    $data['gnavi_data'] = $data;

	    $this->template->content = View::forge('gnavi/confirm', $data);

	}
	
	/**
     * 選択された店舗情報の登録処理を行う関数
     *
     * ユーザーによって選択された店舗情報を
     * プレゼンタへ渡す。
     * 
     * @access public
     */
	public function action_complete()
	{
		Session::destroy();
		
		$this->template->content = Presenter::forge('gnavi/index', 'register')
            ->set('gnavi_data', Input::post());
	}
	

}