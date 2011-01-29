<?php
require_once 'drumon_test.php';
// ...
 
class DrumonCore_Class_All  {
    public static function suite() {
	
        $suite = new PHPUnit_Framework_TestSuite('Drumon Framework All Class');
        $suite->addTestSuite('DrumonTest');
        // ...
 
        return $suite;
    }
}
?>