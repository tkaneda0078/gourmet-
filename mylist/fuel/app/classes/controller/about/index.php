<?php
/**
 * aboutコントローラ
 *
 * @package app
 */

class Controller_About_index extends Controller_Base
{
    public function action_index()
	{
	    $this->template->content = View::forge('about/index');
	}
}