<?php
/**
 * エラー画面出力用コントローラークラス
 * 
 * エラーがはかれたら実行される。
 * 
 * @author tkaneda
 * @package Controller
 */
class Controller_Error extends Controller
{
    public function action_404()
	{
	    return View::forge('errors/404');
	}
}