<?php
	require_once 'html_helper_test.php';
	require_once 'text_helper_test.php';
	// ...

	class DrumonCore_Helpers_All {
		public static function suite() {
			$suite = new PHPUnit_Framework_TestSuite('Drumon Framework All Helpers');
			$suite->addTestSuite('HtmlHelperTest');
			$suite->addTestSuite('TextHelperTest');
			return $suite;
		}
	}
?>