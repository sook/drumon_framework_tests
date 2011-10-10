<?php

	require_once CORE_PATH. '/class/request.php';
	require_once CORE_PATH. '/class/response.php';
	require_once CORE_PATH. '/class/view.php';
	require_once CORE_PATH. '/class/app.php';
	require_once CORE_PATH. '/class/controller.php';

	class ControllerTest extends PHPUnit_Framework_TestCase {
		
		
		public function setUp() {
			$this->app = App::get_instance();
			$this->request = $this->getMock('Request',array(),array(array(), APP_PATH));
			$this->response = $this->getMock('Response',array(),array());
			$this->view = $this->getMock('View', array('add'), array(array(), false));
		}
		
		// Method: add
		public function test_add() {
			
			$this->view->expects($this->once())->method('add')->with($this->equalTo('hello'), $this->equalTo('world'));
			$controller = new Controller($this->app, $this->request, $this->response, $this->view);
			
			$controller->add('hello','world');
		}
		
		
		// Method: render()
		public function test_render() {
			$controller = new Controller($this->app, $this->request, $this->response, $this->view);
			$controller->render('home');
			$view = $controller->get_view();
			$this->assertEquals('home.php', $view->view_file_path);
		}
		
		// Method: get_view()
		public function test_get_view($value='') {
			$controller = new Controller($this->app, $this->request, $this->response, $this->view);
			$view = $controller->get_view();
			$this->assertInstanceOf('View', $view);
		}
		
		
		// Method: render_text
		public function test_render_text() {
			$controller = new Controller($this->app, $this->request, $this->response, $this->view);
			
			$controller->render_text('Hello');
			$this->assertEquals('Hello', $this->readAttribute($controller, 'content_for_layout'));
		}
		
		

		
	}
?>