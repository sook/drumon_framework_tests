<?php

	require_once CORE_PATH. '/class/drumon.php';
	
	class DrumonTest extends PHPUnit_Framework_TestCase {
		
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