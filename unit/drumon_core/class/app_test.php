<?php

	require_once CORE_PATH. '/class/app.php';
	require_once CORE_PATH. '/class/request_handler.php';

	
	class AppTest extends PHPUnit_Framework_TestCase {
		
		
		// Method: get_instance
		public function test_get_instance() {
			$drumon = App::get_instance();
			$this->assertTrue( $drumon instanceof App);
		}
		
		public function test_drumon_singleton() {
			$instance1 = App::get_instance();
			$instance2 = App::get_instance();
			
			$this->assertEquals($instance1, $instance2, 'For a singleton partner this two instaces should be equals.');
		}
		
		/**
		 * @expectedException BadMethodCallException
		 */
		public function test_drumon_clone() {
			$drumon = App::get_instance();
			$drumon = clone($drumon);
		}
		
		
		// Method: create_request_token
		public function test_create_request_token_shoud_have_two_parts() {
			$token = App::create_request_token();
			$parts = explode('-',$token);
			$this->assertEquals(2,count($parts));
		}
		
		public function test_create_request_token_should_be_valid() {
			$token = App::create_request_token();
			$parts = explode('-',$token);
			list($token, $hash) = $parts;
			$this->assertEquals($hash,sha1(APP_SECRET.APP_DOMAIN.'-'.$token));
		}

		
		// Method: block_csrf_protection
		public function test_block_csrf_protection_without_token() {
			// Simula post mais fácil
			$request = $this->getMock('RequestHandler',array(),array(array()));
			$request->method = 'post';
			$request->params = array();
			
			$blocked = App::block_csrf_protection($request);
			$this->assertTrue($blocked);
		}
		
		public function test_block_csrf_protection_with_token() {
			 $request = $this->getMock('RequestHandler',array(),array(array()));
			 $request->method = 'post';
			 $request->params = array('_token' => REQUEST_TOKEN);
			 
			 $blocked = App::block_csrf_protection($request);
			 $this->assertFalse($blocked);
		}
		
		public function test_block_csrf_protection_with_method_get() {
			 $request = $this->getMock('RequestHandler',array(),array(array()));
			 $request->method = 'get';
			 
			 $blocked = App::block_csrf_protection($request);
			 $this->assertFalse($blocked);
		}
		
		
		// Method: to_underscore
		public function test_to_underscore_without_space() {
			$result = App::to_underscore('ClassName');
			$this->assertEquals('class_name',$result);
		}
		
		public function test_to_underscore_with_space() {
			$result = App::to_underscore('Class Name');
			$this->assertEquals('class_name',$result);
		}
		
		
		// Method: to_camelcase
		public function test_to_camelcase() {
			$result = App::to_camelcase('ninja_dev');
			$this->assertEquals('NinjaDev',$result);
		}
		
		
		// Method: array_clean
		public function test_array_clean_with_empty_string() {
			$data = array('a','b','','d');
			$data_clean = App::array_clean($data);
			$this->assertEquals(3,count($data_clean));
		}
		
		public function test_array_clean_with_null() {
			$data = array('a','b',null,'d');
			$data_clean = App::array_clean($data);
			$this->assertEquals(3,count($data_clean));
		}
		
	}
?>