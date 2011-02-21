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
		
		
		// Method: add / fire
		public function test_event_with_param() {
			Event::add('init', array('EventTest','action'));
			
			$value = 'Hello';
			Event::fire('init', &$value);
			
			$this->assertEquals('Hello World',$value);
		}
		
		public function test_two_events_with_param() {
			Event::add('init2', array('EventTest','action'));
			Event::add('init2', array('EventTest','action2'));
			
			$value = 'Hello';
			Event::fire('init2', &$value);
			
			$this->assertEquals('Hello World Drumon',$value);
		}
		
		/**
		 * @expectedException BadMethodCallException
		 */
		public function test_event_clone() {
			$event = Event::get_instance();
			$event2 = clone($event);
		}
		
		
		public function action($text) {
			 $text .= ' World';
		}
		
		public function action2($text) {
			 $text .= ' Drumon';
		}
		
	}
?>