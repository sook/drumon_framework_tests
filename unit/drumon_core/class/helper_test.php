<?php

	require_once CORE_PATH. '/class/helper.php';
	require_once CORE_PATH. '/helpers/text_helper.php';
	require_once CORE_PATH. '/class/request_handler.php';
	
	class HelperTest extends PHPUnit_Framework_TestCase {
		
		
		// Method: sprintf2
		public function test_sprintf2_with_one_value() {
			$this->request = $this->getMock('RequestHandler',array(),array(array()));
			$this->helper = new TextHelper($this->request);
			
			$text = "hello world %name";
			$result = $this->helper->sprintf2($text,array('name'=>'drumon'));
			
			$this->assertEquals('hello world drumon',$result);
		}
		
		public function test_sprintf2_with_two_values() {
			$this->request = $this->getMock('RequestHandler',array(),array(array()));
			$this->helper = new TextHelper($this->request);
			
			$text = "hello world %name! you are %X";
			$result = $this->helper->sprintf2($text,array('name'=>'drumon','X'=>'ninja'));
			
			$this->assertEquals('hello world drumon! you are ninja',$result);
		}
		
		public function test_sprintf2_without_value() {
			$this->request = $this->getMock('RequestHandler',array(),array(array()));
			$this->helper = new TextHelper($this->request);
			
			$text = "hello world %name";
			$result = $this->helper->sprintf2($text);
			
			$this->assertEquals('hello world %name',$result);
		}
		
		
	}
?>