<?php

	require_once CORE_PATH. '/class/request_handler.php';

	
	class RequestHandlerTest extends PHPUnit_Framework_TestCase {
		
		
		public function setUp() {
			$this->route = array();
			$this->route['get']['/posts/'] = array('Posts','index');
			$this->route['get']['/posts/:id/'] = array('Posts','show',':id'=>'[0-9]');
			$this->route['get']['/posts/:id/:slug/'] = array('Posts','show_slug');
			$this->route['get']['/posts/:id-:slug/'] = array('Posts','show_slug2');
			
			$this->route['post']['/comment'] = array('redirect' => 'create');
		}
		
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
		
		
		// Method: get_route
		public function test_get_router_basic() {
			$this->route['get']['/'] = array('Home','index');
			$request = $this->request('get','/');
			
			$this->assertTrue($request->valid());
			$this->assertEquals('Home',$request->controller_name);
			$this->assertEquals('index',$request->action_name);
		}
		
		public function test_get_router_basic2() {
			$this->route['get']['/posts/'] = array('Home','index');
			$request = $this->request('get','/posts/');
			
			$this->assertTrue($request->valid());
			$this->assertEquals('Home',$request->controller_name);
			$this->assertEquals('index',$request->action_name);
		}
		
		public function test_get_router_basic_all_methods_with_get() {
			$this->route['*']['/'] = array('Home','index');
			$request = $this->request('get','/');
			
			$this->assertTrue($request->valid());
			$this->assertEquals('Home',$request->controller_name);
			$this->assertEquals('index',$request->action_name);
		}
		
		public function test_get_router_basic_all_methods_with_post() {
			$this->route['*']['/'] = array('Home','index');
			$request = $this->request('post','/');
			
			$this->assertTrue($request->valid());
			$this->assertEquals('Home',$request->controller_name);
			$this->assertEquals('index',$request->action_name);
		}
		
		public function test_get_router_basic_with_method_put() {
			$this->route['put']['/post/:id'] = array('Posts','update');
			$request = $this->request('put','/post/1');
			
			$this->assertTrue($request->valid());
			$this->assertEquals('Posts',$request->controller_name);
			$this->assertEquals('update',$request->action_name);
		}
		
		public function test_get_router_to_post_uri() {
			$this->route['get']['/posts'] = array('Posts','index');
			$request = $this->request('get','/posts');
			
			$this->assertTrue($request->valid());
			$this->assertEquals('Posts',$request->controller_name);
			$this->assertEquals('index',$request->action_name);
		}
		
		public function test_get_router_with_one_var() {
			$this->route['get']['/posts/:id'] = array('Posts','show');
			$request = $this->request('get','/posts/1');
			
			$this->assertTrue($request->valid());
			$this->assertEquals('1',$request->params['id']);
			$this->assertEquals('Posts',$request->controller_name);
			$this->assertEquals('show',$request->action_name);
		}
		
		public function test_get_router_with_two_var() {
			$this->route['get']['/posts/:id/:slug'] = array('Posts','show_slug');
			$request = $this->request('get','/posts/1/meu-titulo');
			
			$this->assertTrue($request->valid());
			$this->assertEquals('1', $request->params['id']);
			$this->assertEquals('meu-titulo',$request->params['slug']);
			$this->assertEquals('Posts',$request->controller_name);
			$this->assertEquals('show_slug',$request->action_name);
		}
		
		public function test_get_router_with_two_var2() {
			$this->route['get']['/posts/:id-:slug/'] = array('Posts','show_slug2',':id'=>'[0-9]',':slug'=>'[a-z-]');
			$request = $this->request('get','/posts/1-meu-titulo');
			
			$this->assertTrue($request->valid());
			$this->assertEquals('1',$request->params['id']);
			$this->assertEquals('meu-titulo',$request->params['slug']);
			$this->assertEquals('Posts',$request->controller_name);
			$this->assertEquals('show_slug2',$request->action_name);
		}
		
		public function test_get_router_similar_variables() {
			$this->route['get']['/posts2/:id'] = array('Posts','show');
			$this->route['get']['/posts2/:id/:id_comment'] = array('Posts','comment');
			$request = $this->request('get','/posts2/1/2');
			
			$this->assertTrue($request->valid());
			$this->assertEquals('Posts',$request->controller_name);
			$this->assertEquals('comment',$request->action_name);
		}
		
		public function test_get_router_invalid() {
			$request = $this->request('get','/erro');
			$this->assertFalse($request->valid());
		}
		
		// Create a request for tests.
		public function request($method, $uri) {
			$_SERVER['REQUEST_METHOD'] = $method;
			$_SERVER['REQUEST_URI'] = $uri;
			return new RequestHandler($this->route);
		}
		
		
		// Method: xxx_path
		public function test_named_path() {
			$route['get']['/home'] = array('Home','index','as'=>'home');
			$_SERVER['REQUEST_METHOD'] = 'get';
			$_SERVER['REQUEST_URI'] = '/home';
			$request = new RequestHandler($route);
		
			$result = $request->home_path();
			$this->assertEquals('/home',$result);
		}
		
		public function test_named_path_with_param() {
			$route['get']['/home/:id'] = array('Home','index','as'=>'home');
			$_SERVER['REQUEST_METHOD'] = 'get';
			$_SERVER['REQUEST_URI'] = '/home/2';
			$request = new RequestHandler($route);
		
			$result = $request->home_path('2');
			$this->assertEquals('/home/2',$result);
		}
		
		/**
		 * @expectedException PHPUnit_Framework_Error
		 */
		public function test_to_invalid_named_route() {
			$route['get']['/home'] = array('Home','index','as'=>'home');
			$_SERVER['REQUEST_METHOD'] = 'get';
			$_SERVER['REQUEST_URI'] = '/home';
			$request = new RequestHandler($route);
			
			$result = $request->me_path();
		}
		
		// public function test_to_named_route_with_param() {
		// 	$route['get']['/home/:teste'] = array('Home','index','as'=>'home');
		// 	$_SERVER['REQUEST_METHOD'] = 'get';
		// 	$_SERVER['REQUEST_URI'] = '/home/2';
		// 	$request = new RequestHandler($route);
		// 	$url = new UrlHelper($request);
		// 	
		// 	$result = $url->to_home('2');
		// 	$this->assertEquals('http://local.dev/home/2',$result);
		// }
		
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