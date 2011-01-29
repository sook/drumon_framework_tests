<?php
require_once 'class/all.php';
require_once 'helpers/all.php';
// ...
 
class DrumonCore_All {
    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite('Drumon Core');

        $suite->addTest(DrumonCore_Class_All::suite());
 				$suite->addTest(DrumonCore_Helpers_All::suite());
				// ...
				
        return $suite;
    }
}
?>