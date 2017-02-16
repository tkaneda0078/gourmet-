<?php
return array(

	'_404_'             => 'error/404',    // The main 404 route

	// グルメwebサービス
	'register'          => 'register/index',
	'register/(:any)'   => 'register/index/$1',
	'detail'            => 'detail/index',
	'modify'            => 'modify/index',
	'modify/(:any)'     => 'modify/index/$1',
	'delete'            => 'mylist/delete',
	'about'             => 'about/index',
	'gnavi'             => 'gnavi/index',
	'gnavi/(:any)'      => 'gnavi/index/$1',

);
