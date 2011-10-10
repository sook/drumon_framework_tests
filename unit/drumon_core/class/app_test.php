<?php

	require_once CORE_PATH. '/class/app.php';
	require_once CORE_PATH. '/class/request.php';


	class AppTest extends PHPUnit_Framework_TestCase {


		// Method: get_instance
		public function test_get_instance() {
			$app = App::get_instance();
			$this->assertTrue( $app instanceof App);
		}

		public function test_drumon_singleton() {
			$instance1 = App::get_instance();
			$instance2 = App::get_instance();

			$this->assertEquals($instance1, $instance2, 'For a singleton partner this two instaces should be equals.');
		}

		/**
		 * @expectedException BadMethodCallException
		 */
		public function test_drumon_clone() {
			$app = App::get_instance();
			$app = clone($app);
		}


		// Method: create_request_token
		public function test_create_request_token_shoud_have_two_parts() {
			$app = App::get_instance();
			$app->config['app_secret'] = APP_SECRET;
			$token = $app->create_request_token();
			$parts = explode('-',$token);
			$this->assertEquals(2,count($parts));
		}

		public function test_create_request_token_should_be_valid() {
			$app = App::get_instance();
			$app->config['app_secret'] = APP_SECRET;
			$token = $app->create_request_token();
			$parts = explode('-',$token);
			list($token, $hash) = $parts;
			$this->assertEquals($hash,sha1(APP_SECRET.APP_DOMAIN.'-'.$token));
		}


		// Method: block_request
		public function test_block_request_without_token() {
			// Simula post mais fácil
			$request = $this->getMock('Request',array(),array(array(), APP_PATH));
			$request->method = 'post';
			$request->params = array();

			$app = App::get_instance();
			$app->config['app_secret'] = APP_SECRET;

			$blocked = $app->block_request($request);
			$this->assertTrue($blocked);
		}

		public function test_block_request_with_token() {
			$request = $this->getMock('Request',array(),array(array(), APP_PATH));
			$request->method = 'post';

			$app = App::get_instance();
			$app->config['app_secret'] = APP_SECRET;

			$request->params = array('_token' => $app->create_request_token());

			$blocked = $app->block_request($request);
			$this->assertFalse($blocked);
		}

		public function test_block_request_with_method_get() {
			 $request = $this->getMock('Request',array(),array(array(),APP_PATH));
			 $request->method = 'get';

			 $blocked = App::block_request($request);
			 $this->assertFalse($blocked);
		}

		// Method: add_plugins
		public function test_add_plugins() {
			$app = App::get_instance();
			//$request = $this->getMock('Request',array(),array(array(),APP_PATH));
			//$view = $this->getMock('View',array('add'),array(array(),false));

			$app->add_plugins(array('text','html'));

			$this->assertEquals(array(
				'text',
				'html'
			), $this->readAttribute($app,'plugins'));
		}

		// // Method: add_helpers
		public function test_helpers_with_array() {
			$app = App::get_instance();
			$request = $this->getMock('Request',array(),array(array(),APP_PATH));
			$view = $this->getMock('View',array('add'),array(array(),false));

			$app->add_helpers(array('text','html'));

			$this->assertEquals(array(
				'text'=>'../app_mock/vendor/drumon_core/helpers/text_helper.php',
				'html'=>'../app_mock/vendor/drumon_core/helpers/html_helper.php'
			), $this->readAttribute($app,'helpers'));
		}

		public function test_helpers_with_string() {
			$app = App::get_instance();
			$request = $this->getMock('Request',array(),array(array(),APP_PATH));
			$view = $this->getMock('View',array('add'),array(array(),false));

			// Reseta o singleton
			$app->helpers = array();
			$app->add_helpers('text');

			$this->assertEquals(array(
				'text'=>'../app_mock/vendor/drumon_core/helpers/text_helper.php'
			), $this->readAttribute($app,'helpers'));
		}

		public function test_helpers_with_string_and_custom_path() {
			$app = App::get_instance();
			$request = $this->getMock('Request',array(),array(array(),APP_PATH));
			$view = $this->getMock('View',array('add'),array(array(),false));

			// Reseta o singleton
			$app->helpers = array();
			$app->add_helpers('myhelper','/aqui');

			$this->assertEquals(array(
				'myhelper'=>'/aqui/myhelper_helper.php'
			), $this->readAttribute($app,'helpers'));
		}

		// Method: remove_last_slash
		public function test_remove_last_slash() {
			$result = App::remove_last_slash('teste/');
			$this->assertEquals('teste', $result);
		}

		public function test_to_select() {
			$list = array(
				array('name'=>'dan','id'=>1),
				array('name'=>'dan2','id'=>2)
			);
			$result = App::to_select($list,'id','name');
			$this->assertEquals(array('1'=>'dan','2'=>'dan2'), $result);
		}


		// Method: to_underscore
		public function test_to_underscore_without_space() {
			$result = App::to_underscore('ClassName');
			$this->assertEquals('class_name',$result);
		}

		public function test_to_underscore_with_space() {
			$result = App::to_underscore('Class Name');
			$this->assertEquals('class_name',$result);
		}


		// Method: to_camelcase
		public function test_to_camelcase() {
			$result = App::to_camelcase('ninja_dev');
			$this->assertEquals('NinjaDev',$result);
		}


		// Method: array_clean
		public function test_array_clean_with_empty_string() {
			$data = array('a','b','','d');
			$data_clean = App::array_clean($data);
			$this->assertEquals(3,count($data_clean));
		}

		public function test_array_clean_with_null() {
			$data = array('a','b',null,'d');
			$data_clean = App::array_clean($data);
			$this->assertEquals(3,count($data_clean));
		}


		// Method: add / fire
		public function test_event_with_param() {
			$app = App::get_instance();
			$app->add_event('init', array('AppTest','action'));

			$value = 'Hello';
			$app->fire_event('init', array(&$value));

			$this->assertEquals('Hello World',$value);
		}

		public function test_two_events_with_param() {
			$app = App::get_instance();
			$app->add_event('init2', array('AppTest','action'));
			$app->add_event('init2', array('AppTest','action2'));

			$value = 'Hello';
			$app->fire_event('init2', array(&$value));

			$this->assertEquals('Hello World Drumon',$value);
		}

		public function action(&$text) {
			 $text .= ' World';
		}

		public function action2(&$text) {
			 $text .= ' Drumon';
		}



		// Method: set_config
		public function test_set_config() {
			$app = App::set_config('hello','World');

			$this->assertEquals('World',App::get_config('hello'));
		}

	}
?>