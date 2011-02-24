<?php
	//  Rota basica
	// 	$route['get']['/blog'] = array('Blog','index');
	//	
	// 	Rota com variável
	// 	$route['get']['/tag/:tag'] = array('Blog','tags');
	//	
	//	Rotas nomeadas
	//  $route['get']['/blog'] = array('Blog','index','as'=>'blog'); //in view => $url->to_blog();
	//  $route['get']['/tag/:tag'] = array('Blog','tags','as'=>'tag'); //in view => $url->to_tag('your-tag-name');
	//  
	// 	Rota com variável e expresão regular
	// 	$route['get']['/tag/:tag'] = array('Blog','tags',':tag'=>'[a-zA-Z0-9_]');
	// 	
	// 	Redirecionamento com rotas
	// 	$route['*']['/twitter'] = array('redirect'=>'http://twitter.com');
	// 	$route['*']['/twitter'] = array('redirect'=>'http://twitter.com',302);
	//	
	//	Rora para a página não encontrada 404
	//	$route['404'] = array('Error','error_404');
	//	ou
	//	$route['404'] = '404.html'; //default
	
	
	// Rota para o inicio da aplicação
	$route['get']['/'] = array('Home','index','as'=>'home'); // $url->to_home();
	$route['get']['/about'] = array('Home','about','as'=>'about'); // $url->to_home();
	$route['*']['/danillos'] = array('redirect'=>'http://www.danillocesar.com.br');
	
	//namespace
	$route['get']['/simple-namespace'] = array('Namespace_Home','index');
	$route['get']['/complex-namespace'] = array('ComplexNamespace_Home','index');
	
	// csfr
	$route['*']['/csfr'] = array('Csfr','form');
	$route['*']['/csfr-invalid'] = array('Csfr','form2');
	
	// http status
	$route['*']['/render-erro-404-page'] = array('HttpStatus','render_erro_404');
	$route['*']['/status-403-page'] = array('HttpStatus','status_403');
	
	
?>