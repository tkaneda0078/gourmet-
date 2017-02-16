<?php
/**
 * トップ画面に表示する店舗情報を取得するコントローラークラス
 * 
 * コントローラーからプレゼンタを呼び出し、
 * プレゼンンタ内で店舗情報を取得する。
 * 
 * @author tkaneda
 * @package Controller
 */
class Controller_Mylist extends Controller_Base
{
	/**
     * 店舗情報を取得する
     *
     * プレゼンタで処理を行い、全店舗情報を取得する。
     * 
     * @access public
     * @see Presenter_Mylist_index::view
     */
    public function action_index()
	{
	    $this->template->content = Presenter::forge('mylist/index');
	}
	
	/**
     * [POST]店舗情報を削除する
     * 
     * @access public
     */
	public function action_delete()
	{
		$shop_data = Model_Shop_Data::find(Input::post('shop_id'));
		
		if ( ! $shop_data->delete())
		{
			throw new HttpServerException;
		}
		
		Response::redirect('mylist/index');
	}
	
}