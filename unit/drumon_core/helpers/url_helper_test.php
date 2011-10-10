<?php

	require_once CORE_PATH. '/class/helper.php';
	require_once CORE_PATH. '/helpers/url_helper.php';
	require_once CORE_PATH. '/helpers/text_helper.php';

	class UrlHelperTest extends PHPUnit_Framework_TestCase {


		public function setUp() {
			$this->request = $this->getMock('Request',array(),array(array(),APP_PATH));
			$this->url = new UrlHelper($this->request,'pt-BR');
		}


		// Method: to
		public function test_to_simple() {
			$result = $this->url->to('/home');
			$this->assertEquals('http://local.dev/home',$result);
		}

		// Method: to_image
		public function test_to_image() {
			$result = $this->url->to_image('logo.png');
			$this->assertEquals('http://local.dev/public/images/logo.png', $result);
		}


		// Method to_
		public function test_to_named_route() {
			$route['get']['/home'] = array('Home::index','as'=>'home');
			$_SERVER['REQUEST_METHOD'] = 'get';
			$_SERVER['REQUEST_URI'] = '/home';
			$request = new Request($route, APP_PATH);
			$url = new UrlHelper($request,'pt-BR');

			$result = $url->to_home();
			$this->assertEquals('http://local.dev/home',$result);
		}

		public function test_to_named_route_with_param() {
			$route['get']['/home/{teste}'] = array('Home::index','as'=>'home');
			$_SERVER['REQUEST_METHOD'] = 'get';
			$_SERVER['REQUEST_URI'] = '/home/2';
			$request = new Request($route, APP_PATH);
			$url = new UrlHelper($request,'pt-BR');

			$result = $url->to_home('2');
			$this->assertEquals('http://local.dev/home/2',$result);
		}

		/**
		 * @expectedException PHPUnit_Framework_Error
		 */
		public function test_to_invalid_named_route() {
			$route['get']['/home'] = array('Home','index','as'=>'home');
			$_SERVER['REQUEST_METHOD'] = 'get';
			$_SERVER['REQUEST_URI'] = '/home';
			$request = new Request($route, APP_PATH);
			$url = new UrlHelper($request,'pt-BR');

			$result = $url->to_me();
			$this->assertEquals('http://local.dev/home',$result);
		}

		/**
		 * @expectedException PHPUnit_Framework_Error
		 */
		public function test_invalid_call() {
			$route['get']['/home'] = array('Home','index','as'=>'home');
			$_SERVER['REQUEST_METHOD'] = 'get';
			$_SERVER['REQUEST_URI'] = '/home';
			$request = new Request($route, APP_PATH);
			$url = new UrlHelper($request,'pt-BR');

			$result = $url->tao_me();
			$this->assertEquals('http://local.dev/home',$result);
		}


		// Method: module
		public function test_module() {
			$result = $this->url->module('blog_posts');
			$this->assertEquals('http://local.dev/public/modules/blog_posts',$result);
		}


		// Method: to_here
		public function test_to_here() {
			$_SERVER['REQUEST_URI'] = '/home';
			$result = $this->url->to_here();
			$this->assertEquals('/home',$result);
		}

	}

?>