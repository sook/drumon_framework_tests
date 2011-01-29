<?php

require_once 'drumon_core/class/all.php';

class AllClassTests {
    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite('Drumon Framework Class');
        $suite->addTest(DrumonCore_Class_All::suite());
        return $suite;
    }
}

?>