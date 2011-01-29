<?php

require_once 'drumon_core/all.php';

class AllTests extends PHPUnit_Framework_TestSuite {
    public static function suite() {

       // $suite = new PHPUnit_Framework_TestSuite('Drumon Framework');
				$suite = new AllTests('Drumon Framework');
        $suite->addTest(DrumonCore_All::suite());
        // ...

        return $suite;
    }

	protected function setUp() {
		//print 'a';
	}
	
	protected function tearDown() {
		//print 'b';
	}
}

?>