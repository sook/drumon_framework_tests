<?php
	require_once 'drumon_test.php';
	require_once 'helper_test.php';
	require_once 'request_handler_test.php';
	// ...
 
	class DrumonCore_Class_All  {
		
		public static function suite() {
			$suite = new PHPUnit_Framework_TestSuite('Drumon Framework All Class');
			$suite->addTestSuite('DrumonTest');
			$suite->addTestSuite('HelperTest');
			$suite->addTestSuite('RequestHandlerTest');
			// ...

			return $suite;
		}
	}
?>