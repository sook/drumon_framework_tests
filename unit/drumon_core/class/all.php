<?php
	require_once 'app_test.php';
	require_once 'helper_test.php';
	require_once 'request_handler_test.php';
	//require_once 'event_test.php';
	require_once 'view_test.php';
	require_once 'controller_test.php';
	// ...
 
	class DrumonCore_Class_All  {
		
		public static function suite() {
			$suite = new PHPUnit_Framework_TestSuite('Drumon Framework All Class');
			$suite->addTestSuite('AppTest');
			$suite->addTestSuite('HelperTest');
			$suite->addTestSuite('RequestHandlerTest');
		//	$suite->addTestSuite('EventTest');
			$suite->addTestSuite('ViewTest');
			$suite->addTestSuite('ControllerTest');
			// ...

			return $suite;
		}
	}
?>