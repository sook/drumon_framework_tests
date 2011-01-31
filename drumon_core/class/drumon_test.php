<?php

	require_once CORE_PATH. '/class/drumon.php';
	require_once CORE_PATH. '/class/request_handler.php';

	
	class DrumonTest extends PHPUnit_Framework_TestCase {
		
		
		// // Method: execute_controller
		// 		public function test_execute_controller_home() {
		// 			$request = $this->getMock('RequestHandler',array(),array(array()));
		// 			$request->method = 'get';
		// 			$request->controller_name = 'Home';
		// 			$request->action_name = 'index';
		// 			$request->params = array();
		// 			
		// 			
		// 			$html = Drumon::execute_controller($request);
		// 			
		// 		}
		
		
		// Method: create_request_token
		public function test_create_request_token_shoud_have_two_parts() {
			$token = Drumon::create_request_token();
			$parts = explode('-',$token);
			$this->assertEquals(2,count($parts));
		}
		
		public function test_create_request_token_should_be_valid() {
			$token = Drumon::create_request_token();
			$parts = explode('-',$token);
			list($token, $hash) = $parts;
			$this->assertEquals($hash,sha1(APP_SECRET.APP_DOMAIN.'-'.$token));
		}

		
		// Method: block_csrf_protection
		public function test_block_csrf_protection_without_token() {
			// Simula um post no request handler manualmente.
			// $route['post']['/comment'] = array('Comment','create');
			// $_SERVER['REQUEST_METHOD'] = 'post';
			// $_SERVER['REQUEST_URI'] = '/comment';
			// $request = new RequestHandler($route);

			// Simula post mais fácil
			$request = $this->getMock('RequestHandler',array(),array(array()));
			$request->method = 'post';
			$request->params = array();
			
			$blocked = Drumon::block_csrf_protection($request);
			$this->assertTrue($blocked);
		}
		
		public function test_block_csrf_protection_with_token() {
			 $request = $this->getMock('RequestHandler',array(),array(array()));
			 $request->method = 'post';
			 $request->params = array('_token' => REQUEST_TOKEN);
			 
			 $blocked = Drumon::block_csrf_protection($request);
			 $this->assertFalse($blocked);
		}
		
		public function test_block_csrf_protection_with_method_get() {
			 $request = $this->getMock('RequestHandler',array(),array(array()));
			 $request->method = 'get';
			 
			 $blocked = Drumon::block_csrf_protection($request);
			 $this->assertFalse($blocked);
		}
		
		
		// Method: to_underscore
		public function test_to_underscore_without_space() {
			$result = Drumon::to_underscore('ClassName');
			$this->assertEquals('class_name',$result);
		}
		
		public function test_to_underscore_with_space() {
			$result = Drumon::to_underscore('Class Name');
			$this->assertEquals('class_name',$result);
		}
		
		
		// Method: to_camelcase
		public function test_to_camelcase() {
			$result = Drumon::to_camelcase('ninja_dev');
			$this->assertEquals('NinjaDev',$result);
		}
		
		
		// Method: array_clean
		public function test_array_clean_with_empty_string() {
			$data = array('a','b','','d');
			$data_clean = Drumon::array_clean($data);
			$this->assertEquals(3,count($data_clean));
		}
		
		public function test_array_clean_with_null() {
			$data = array('a','b',null,'d');
			$data_clean = Drumon::array_clean($data);
			$this->assertEquals(3,count($data_clean));
		}
		
	}
?>