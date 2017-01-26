<?php
/**
 * 当webサービスについての画面用コントローラークラス
 * 
 * @author tkaneda
 * @package Controller
 */
class Controller_About_index extends Controller_Base
{
    public function action_index()
	{
	    $this->template->content = View::forge('about/index');
	}
}