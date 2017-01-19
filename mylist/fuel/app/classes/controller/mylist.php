<?php
/**
 * 自分用グルメコントローラ
 *
 * @package app
 */
 
 /**
 * グルメ一覧を表示する
 */
class Controller_Mylist extends Controller_Base
{
    public function action_index()
	{
	    $this->template->content = Presenter::forge('mylist/index');
	}
	
	/**
     * 店舗情報を改善する
     *
     * 
     */
	public function action_modify()
	{
		$this->template->content = Presenter::forge('mylist/modify')
			->set('shop_id', Input::post('shop_id'));
	}
}