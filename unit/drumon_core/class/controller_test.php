<?php
	
	require_once CORE_PATH. '/class/controller.php';

	class ControllerTest extends PHPUnit_Framework_TestCase {
		
		// Method: create_request_token
		public function test_create_request_token_shoud_have_two_parts() {
			// $token = Drumon::create_request_token();
			// 		$parts = explode('-',$token);
			// 		$this->assertEquals(2,count($parts));
		}
		
	}
?>