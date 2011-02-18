<?php
	define('TEST_ROOT', dirname(__FILE__));
	define('ROOT', dirname(realpath('../drumon_framework/your_app_name/index.php')));
	define('CORE_PATH', ROOT.'/vendor/drumon_core');
	
	
	require_once(CORE_PATH.'/class/drumon.php');
	
	
	// Application Domain
	define('APP_DOMAIN','http://local.dev');
	define('LANGUAGE','pt-BR');
	define('APP_SECRET','123456');
	define('REQUEST_TOKEN',Drumon::create_request_token());
	
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