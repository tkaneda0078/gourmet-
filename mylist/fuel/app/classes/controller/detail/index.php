<?php
/**
 * 登録済みの店舗情報の処理を行うコントローラークラス
 * 
 * @author tkaneda
 * @package Controller
 */
class Controller_Detail_index extends Controller_Base
{
	/**
     * [GET]店舗情報を取得する関数
     *
     * トップ画面から渡された店舗IDをプレゼンタに渡し、
     * 登録済みの店舗情報を取得
     * 
     * @access public
     * @see Presenter_Mylist_Detail::view
     * @throws NotFoundException 店舗情報が取得できない場合は404エラーを返す
     */
    public function get_index()
	{
	    $this->template->content = Presenter::forge('mylist/detail')
	       ->set('shop_id', Input::get('id'));
	}
}