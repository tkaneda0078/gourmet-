<?php
/**
 * エラーコントローラ
 *
 * @package app
 */

class Controller_Error extends Controller
{
    public function action_404()
	{
	    return View::forge('errors/404');
	}
}