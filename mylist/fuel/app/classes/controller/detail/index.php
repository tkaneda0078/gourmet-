<?php
/**
 * グルメ詳細コントローラ
 *
 * @package app
 */

class Controller_Detail_index extends Controller_Base
{
    public function get_index()
	{
	    $this->template->content = Presenter::forge('mylist/detail')
	       ->set('shop_id', Input::get('id'));
	}
}