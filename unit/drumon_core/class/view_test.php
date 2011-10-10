<?php
	
	require_once CORE_PATH. '/class/view.php';

	class ViewTest extends PHPUnit_Framework_TestCase {
		
		public function setUp() {
			$this->view = new View(array(), false);
		}
		
		
		// Method: render_file
		public function test_render_file() {
			$result = $this->view->render_file(ASSETS_PATH.'/view_test1.php');
			
			$this->assertEquals('Hello', $result);
		}
		
		public function test_render_file_and_var() {
			$this->view->add('world','World');
			$result = $this->view->render_file(ASSETS_PATH.'/view_test2.php');
			
			$this->assertEquals('Hello World',$result);
		}
		
		public function test_render_file_with_gzip() {
			$this->view = new View(array(), true);
			$result = $this->view->render_file(ASSETS_PATH.'/view_test1.php');
			
			$this->assertEquals('Hello',$result);
		}
		
		
		// Method: render
		public function test_render() {
			$view = $this->getMock('View',array('render_file'),array(array(),false));
			$view->expects($this->once())->method('render_file')->with(APP_PATH.'/app/views/me.php');
			
			$view->render('me');
		}
		
		public function test_render_with_absolute_path() {
			$view = $this->getMock('View',array('render_file'),array(array(),false));
			$view->expects($this->once())->method('render_file')->with(APP_PATH.'/me.php');
			
			$view->render('/me');
		}
		
				
		
		// Method: get
		public function test_get_variable() {
			$this->view->add('hello','world');
			
			$this->assertEquals('world', $this->view->get('hello'));
		}
		
		// Method: add
		public function test_add_one_variable() {
			$this->view->add('hello','world');
			
			$this->assertEquals(1, count($this->view->get_all()));
		}
		
		public function test_add_two_variable() {
			$this->view->add('hello','world');
			$this->view->add('hello2','world');
			
			$this->assertEquals(2, count($this->view->get_all()));
		}
		
		
		// Method: remove
		public function test_remove_variable() {
			
			$this->view->add('hello','world');
			$this->view->remove('hello');
			
			$this->assertEquals(0,count($this->view->get_all()));
		}
		
		
		// Method: remove_all
		public function test_remove_all_variable() {
			
			$this->view->add('hello','world');
			$this->view->add('hello2','world');
			$this->view->remove_all();
			
			$this->assertEquals(0,count($this->view->get_all()));
		}
		
		
		
		
		
	}
?>