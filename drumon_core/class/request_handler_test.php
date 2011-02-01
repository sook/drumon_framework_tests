<?php

	require_once CORE_PATH. '/class/request_handler.php';

	
	class RequestHandlerTest extends PHPUnit_Framework_TestCase {

		// Method: valid
		public function test_valid() {
			// Simula post
			$_SERVER['REQUEST_METHOD'] = 'post';
			$_SERVER['REQUEST_URI'] = '/comment';
			$route['post']['/comment'] = array('Comment','create');
			
			$request = $this->getMock('RequestHandler',array('get_route'),array(array($route)));
			
			$request->expects($this->once())->method('get_route')
				->will($this->returnValue($route['post']['/comment']));

			$this->assertTrue($request->valid());
		}
		
		public function test_invalid() {
			// Simula post
			$_SERVER['REQUEST_METHOD'] = 'post';
			$_SERVER['REQUEST_URI'] = '/comment';
			$route['post']['/comment'] = array('Comment','create');
			
			$request = $this->getMock('RequestHandler',array('get_route'),array(array($route)));
			
			$request->expects($this->once())->method('get_route')
				->will($this->returnValue(false));

			$this->assertFalse($request->valid());
		}
		
		public function test_valid_with_redirect() {
			// Simula post
			$_SERVER['REQUEST_METHOD'] = 'post';
			$_SERVER['REQUEST_URI'] = '/comment';
			$route['post']['/comment'] = array('redirect' => 'create');
			
			$request = $this->getMock('RequestHandler',array('get_route','redirect'),array(array($route)));
			
			$request->expects($this->once())->method('get_route')
				->will($this->returnValue($route['post']['/comment']));
			
			$request->expects($this->once())->method('redirect');
			$this->assertTrue($request->valid());
		}
		
		
		// Method: redirect
		public function test_redirect() {
			// oO como testo isso?
			
			//header('Content-type: text/plain');
			//header("Location: http://www.google.com.br", true, 300);
			
			//print_r(headers_list());
		}
		
		
		// Method: strip_slash
		public function test_strip_slash_with_slash() {
			$method = new ReflectionMethod('RequestHandler','strip_slash');
			$method->setAccessible(true);
			$result = $method->invokeArgs(new RequestHandler(null), array('path/'));
			
			$this->assertEquals('path',$result);
		}
		
		public function test_strip_slash_without_slash() {
			$method = new ReflectionMethod('RequestHandler','strip_slash');
			$method->setAccessible(true);
			$result = $method->invokeArgs(new RequestHandler(null), array('path'));
			
			$this->assertEquals('path',$result);
		}
	}
?>