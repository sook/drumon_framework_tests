<?php

	class HomeController extends AppController {
		
		function index() {
			// Gera chave para o app_secret
			$this->add('app_secret', md5(uniqid()));
		}
		
		
		function about() {
			echo t('custom.Hello Boy');
		}
		
		
		function variables() {
			$this->add('var1', $this->params['var']);
			$this->add('var2', $this->params['query']);
		}
		
	}
?>