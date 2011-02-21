<?php

	require_once CORE_PATH. '/class/request_handler.php';
	require_once CORE_PATH. '/class/template.php';
	require_once CORE_PATH. '/class/app.php';
	require_once CORE_PATH. '/class/controller.php';

	class ControllerTest extends PHPUnit_Framework_TestCase {
		
		// Method: execute
		
		// TODO: ta certo esse teste ?
		public function test_execute() {
			$app = App::get_instance();
			$request = $this->getMock('RequestHandler',array(),array(array()));
			$controller = $this->getMock('Controller',array('home','execute_render','after_filter','before_filter'),array($app, $request,'template','namespace','classname'));
			
			
			$controller->expects($this->once())->method('before_filter');
			$controller->expects($this->once())->method('home');
			$controller->expects($this->once())->method('after_filter');
			
			$controller->expects($this->once())->method('execute_render');
			
			$controller->execute('home');
		}
		
		
		// Method: add
		public function test_add() {
			$app = App::get_instance();
			$request = $this->getMock('RequestHandler',array(),array(array()));
			$template = $this->getMock('Template',array('add'),array(array(),false));
			//$template = new Template(array(),false);
			$controller = $this->getMock('Controller',null,array($app, $request, &$template,'namespace','classname'));
			
			
			$template->expects($this->once())->method('add')->with($this->equalTo('hello'),$this->equalTo('world'));
			
			$controller->add('hello','world');
		}
		
		
		// Method: render
		public function test_render() {
			$app = App::get_instance();
			$request = $this->getMock('RequestHandler',array(),array(array()));
			$template = $this->getMock('Template',array('add'),array(array(),false));
			$controller = new Controller($app, $request,$template,'aa', 'a');
			
			$controller->render('home');
			$this->assertEquals('home',$this->readAttribute($controller,'view'));
		}
		
		
		// Method: render_text
		public function test_render_text() {
			$app = App::get_instance();
			$request = $this->getMock('RequestHandler',array(),array(array()));
			$template = $this->getMock('Template',array('add'),array(array(),false));
			$controller = new Controller($app, $request,$template,'aa', 'a');
			
			$controller->render_text('Hello');
			$this->assertEquals('Hello',$this->readAttribute($controller,'content_for_layout'));
		}
		
		
		// Method: helpers
		public function test_helpers_with_array() {
			$app = App::get_instance();
			$request = $this->getMock('RequestHandler',array(),array(array()));
			$template = $this->getMock('Template',array('add'),array(array(),false));
			$controller = new Controller($app, $request,$template,'aa', 'a');
			
			$controller->helpers(array('text','html'));
			
			$this->assertEquals(array('text','html'),$this->readAttribute($controller->app,'helpers'));
		}
		
		public function test_helpers_with_string() {
			$app = App::get_instance();
			$request = $this->getMock('RequestHandler',array(),array(array()));
			$template = $this->getMock('Template',array('add'),array(array(),false));
			$controller = new Controller($app, $request, $template, 'aa', 'a');
			
			// Reseta o singleton
			$controller->app->helpers = array();
			$controller->helpers('text');
			
			$this->assertEquals(array('text'),$this->readAttribute($controller->app,'helpers'));
		}
		
		
	}
?>