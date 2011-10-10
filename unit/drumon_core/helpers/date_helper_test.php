<?php
	
	require_once CORE_PATH. '/class/helper.php';
	require_once CORE_PATH. '/helpers/date_helper.php';
	require_once CORE_PATH. '/helpers/text_helper.php';
	
	class DateHelperTest extends PHPUnit_Framework_TestCase {
		
		
		public function setUp() {
			$this->request = $this->getMock('Request',array(),array(array(),APP_PATH));
			$this->date = new DateHelper($this->request,'pt-BR');
			$this->date->text = new TextHelper($this->request,'pt-BR');
		}
		
		
		// Method: show
		public function test_show() {
			$date = date('Y-m-d', strtotime('2010-01-31 00:00:00'));
			$result = $this->date->show($date);
			$this->assertEquals('31/01/2010 00:00',$result);
		}
		
		public function test_show_with_format() {
			$date = date('Y-m-d', strtotime('2010-01-31 00:00:00'));
			$result = $this->date->show($date,'date');
			$this->assertEquals('31/01/2010',$result);
		}
		
		public function test_show_with_invalid_format() {
			$date = date('Y-m-d', strtotime('2010-01-31 00:00:00'));
			$result = $this->date->show($date,'ninja_format');
			$this->assertEquals('date.formats.ninja_format',$result);
		}
		
		
		// Method: now
		public function test_now() {
			$date = date('d/m/Y', strtotime('Now'));
			$result = $this->date->now('date');
			$this->assertEquals($date,$result);
		}
		
		// TODO: remover esse método e usar o show junto ao format.
		// Method: time
		public function test_time() {
			$result = $this->date->time('2010-01-31 10:31:00');
			$this->assertEquals('10:31',$result);
		}
		
	}

?>