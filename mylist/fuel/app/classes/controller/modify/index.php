<?php
/**
 * 店舗情報を編集するコントローラークラス
 * 
 * 
 * @author tkaneda
 * @package Controller
 */
class Controller_Modify_Index extends Controller_Base
{
    // 入力フォームで扱うフィールドを配列として設定
    private $fields = array('name', 'address', 'comments', 'img_path');
    
	/**
     * 店舗情報を表示する
     *
     * 店舗IDを元に店舗情報を取得する。。
     * 
     * @access public
     * @see Presenter_Modify_index::view
     */
    public function action_index()
	{
	    Session::set_flash('shop_id', Input::post('shop_id'));
	    
	    $this->template->content = Presenter::forge('modify/index')
			->set('shop_id', Input::post('shop_id'));
	}
	
	/**
     * [POST]店舗情報を編集する
     *
     * POSTで受け取った店舗情報の入力チェックを行う。
     * 
     * @access public
     */
	public function action_confirm()
	{
	    $data = array();
	    
	    $val = Model_Shop_Data::validate();

        if ( ! $val->run())
        {
            foreach ($val->error() as $key => $error)
            {
                $data['error_msg'][$key] = $error->get_message();
            }
        }

	    foreach ($this->fields as $field)
	    {
	        if ($field == 'img_path')
	        {
	            $data['img_paths'][] = Input::post($field);
	        }
	        else
	        {
	            $data['shop_data'][$field] = Security::xss_clean(Input::post($field));   
	        }
	    }
        
        if ( ! empty($data['error_msg']))
        {
            $this->template->content = View::forge('modify/index', $data);
            return;
        }
        
	    $this->template->content = View::forge('modify/confirm', $data);
	}
	
	/**
     * [POST]店舗情報を更新する
     *
     * POST情報をプレゼンタに渡す。
     * 店舗IDに紐付く店舗情報を更新する。
     * 
     * @access public
     * @see Presenter_Mylist_modify::shop_modify
     */
	public function action_complete()
	{
	    $this->template->content = Presenter::forge('modify/index', 'shop_update')
            ->set('shop_data', Input::post());
	}
	
}