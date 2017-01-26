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
     * 店舗情報を取得する関数
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
     * [POST]店舗情報を修正する関数
     *
     * POSTで受け取った店舗IDをプレゼンタに渡す。
     * プレゼンタで処理を行う。
     * 
     * @access public
     * @see Presenter_Mylist_modify::view
     */
	public function action_modify()
	{
		$this->template->content = Presenter::forge('mylist/modify')
			->set('shop_id', Input::post('shop_id'));
	}
}