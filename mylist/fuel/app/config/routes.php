<?php
return array(

	'_404_'             => 'error/404',    // The main 404 route

	// グルメwebサービス
	'register'          => 'register/index',
	'register/(:any)'   => 'register/index/$1',
	'register/complete' => 'mylist/index',
	'detail'            => 'detail/index',
	'modify'            => 'mylist/modify',
	'about'             => 'about/index',
	'gnavi'             => 'gnavi/index',
	'gnavi/(:any)'      => 'gnavi/index/$1',

);
