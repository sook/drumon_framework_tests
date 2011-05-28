<?php

	require_once CORE_PATH. '/class/request_handler.php';
	require_once CORE_PATH. '/class/view.php';
	require_once CORE_PATH. '/class/app.php';
	require_once CORE_PATH. '/class/controller.php';

	class ControllerTest extends PHPUnit_Framework_TestCase {
		
		// Method: execute
		
		
		// Method: add
		public function test_add() {
			$app = App::get_instance();
			$request = $this->getMock('RequestHandler',array(),array(array()));
			$view = $this->getMock('View',array('add'),array(array(),false));
			//$view = new View(array(),false);
			$controller = $this->getMock('Controller',null,array($app, $request, &$view,'namespace','classname'));
			
			$view->expects($this->once())->method('add')->with($this->equalTo('hello'),$this->equalTo('world'));
			
			$controller->add('hello','world');
		}
		
		
		// Method: render
		public function test_render() {
			$app = App::get_instance();
			$request = $this->getMock('RequestHandler',array(),array(array()));
			$view = $this->getMock('View',array('add'),array(array(),false));
			$controller = new Controller($app, $request,$view,'aa', 'a');
			
			$controller->render('home');
			$this->assertEquals('home', $this->readAttribute($controller, 'view_name'));
		}
		
		
		// Method: render_text
		public function test_render_text() {
			$app = App::get_instance();
			$request = $this->getMock('RequestHandler',array(),array(array()));
			$view = $this->getMock('View',array('add'),array(array(),false));
			$controller = new Controller($app, $request,$view,'aa', 'a');
			
			$controller->render_text('Hello');
			$this->assertEquals('Hello',$this->readAttribute($controller,'content_for_layout'));
		}
		
		
		// // Method: add_helpers
		// public function test_helpers_with_array() {
		// 	$app = App::get_instance();
		// 	$request = $this->getMock('RequestHandler',array(),array(array()));
		// 	$view = $this->getMock('View',array('add'),array(array(),false));
		// 	$controller = new Controller($app, $request,$view,'aa', 'a');
		// 	
		// 	$controller->add_helpers(array('text','html'));
		// 	
		// 	$this->assertEquals(array(
		// 		'text'=>'../app_mock/vendor/drumon_core/helpers/text_helper.php',
		// 		'html'=>'../app_mock/vendor/drumon_core/helpers/html_helper.php'
		// 	), $this->readAttribute($controller->app,'helpers'));
		// }
		// 
		// public function test_helpers_with_string() {
		// 	$app = App::get_instance();
		// 	$request = $this->getMock('RequestHandler',array(),array(array()));
		// 	$view = $this->getMock('View',array('add'),array(array(),false));
		// 	$controller = new Controller($app, $request, $view, 'aa', 'a');
		// 	
		// 	// Reseta o singleton
		// 	$controller->app->helpers = array();
		// 	$controller->add_helpers('text');
		// 	
		// 	$this->assertEquals(array(
		// 		'text'=>'../app_mock/vendor/drumon_core/helpers/text_helper.php'
		// 	), $this->readAttribute($controller->app,'helpers'));
		// }
		// 
		// public function test_helpers_with_string_and_custom_path() {
		// 	$app = App::get_instance();
		// 	$request = $this->getMock('RequestHandler',array(),array(array()));
		// 	$view = $this->getMock('View',array('add'),array(array(),false));
		// 	$controller = new Controller($app, $request, $view, 'aa', 'a');
		// 	
		// 	// Reseta o singleton
		// 	$controller->app->helpers = array();
		// 	$controller->add_helpers('myhelper','/aqui');
		// 	
		// 	$this->assertEquals(array(
		// 		'myhelper'=>'/aqui/myhelper_helper.php'
		// 	), $this->readAttribute($controller->app,'helpers'));
		// }
		
	}
?>