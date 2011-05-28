<?php

	define('UNIT_PATH', dirname(dirname(__FILE__)));
	define('SUPPORT_PATH', UNIT_PATH.'/support');
	define('ASSETS_PATH', UNIT_PATH.'/support/assets');
	
	//define('ROOT', dirname(realpath('../../drumon_framework/your_app_name/index.php'))); // TODO: melhorar
	
	//define('ROOT_PATH', dirname(realpath('../../drumon_framework/your_app_name/index.php')));
	//define('CORE_PATH', ROOT_PATH.'/vendor/drumon_core');
	
	
	define('APP_PATH', '../app_mock');
	define('CORE_PATH', '../app_mock/vendor/drumon_core');
	
	
	require_once(CORE_PATH.'/class/app.php');
	
	
	// Application Domain
	define('APP_DOMAIN','http://local.dev');

	define('APP_SECRET','123456');
	define('REQUEST_TOKEN','token');
	define('LANGUAGE','pt-BR');
	
	// Application Paths
	define('STYLESHEETS_PATH', APP_DOMAIN.'/public/stylesheets/');
	define('JAVASCRIPTS_PATH', APP_DOMAIN.'/public/javascripts/');
	define('IMAGES_PATH',      APP_DOMAIN.'/public/images/');
	define('MODULES_PATH',		 APP_DOMAIN.'/public/modules/');
	
	// 
	define('JS_FRAMEWORK','jquery');
	
	
	// Método da requisição padrão.
	$_SERVER['REQUEST_METHOD'] = 'get';
?>