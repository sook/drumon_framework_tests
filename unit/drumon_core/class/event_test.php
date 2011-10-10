<?php
	
	require_once CORE_PATH. '/class/event.php';

	class EventTest extends PHPUnit_Framework_TestCase {
		
		// Method: get_instance
		public function test_get_instance() {
			$event = Event::get_instance();
			$this->assertTrue( $event instanceof Event);
		}
		
		public function test_event_singleton() {
			$instance1 = Event::get_instance();
			$instance2 = Event::get_instance();
			
			$this->assertEquals($instance1, $instance2, 'For a singleton partner this two instaces should be equals.');
		}
		
		/**
		 * @expectedException BadMethodCallException
		 */
		public function test_event_clone() {
			$event = Event::get_instance();
			$event2 = clone($event);
		}
		
		
		
		
	}
?>