<?php

require_once 'drumon_core/helpers/all.php';

class AllHelpersTests {
    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite('Drumon Framework Helpers');
        $suite->addTest(DrumonCore_Helpers_All::suite());
        return $suite;
    }
}

?>