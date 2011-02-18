<?php
	
	require_once CORE_PATH. '/class/template.php';

	class TemplateTest extends PHPUnit_Framework_TestCase {
		
		
		public function setUp() {
			$this->template = new Template(array(), false);
		}
		
		
		// Method: render_file
		public function test_render_file() {
			$result = $this->template->render_file(TEST_ROOT.'/drumon_core/class/assets/template_test1.php');
			
			$this->assertEquals('Hello',$result);
		}
		
		public function test_render_file_and_var() {
			$this->template->add('world','World');
			$result = $this->template->render_file(TEST_ROOT.'/drumon_core/class/assets/template_test2.php');
			
			$this->assertEquals('Hello World',$result);
		}
		
		public function test_render_file_with_gzip() {
			$this->template = new Template(array(), true);
			$result = $this->template->render_file(TEST_ROOT.'/drumon_core/class/assets/template_test1.php');
			
			$this->assertEquals('Hello',$result);
		}
		
		
		// Method: render
		public function test_render() {
			$template = $this->getMock('Template',array('render_file'),array(array(),false));
			$template->expects($this->once())->method('render_file')->with(ROOT.'/app/views/me.php');
			
			$template->render('me');
		}
		
		public function test_render_with_absolute_path() {
			$template = $this->getMock('Template',array('render_file'),array(array(),false));
			$template->expects($this->once())->method('render_file')->with(ROOT.'/me.php');
			
			$template->render('/me');
		}
		
		
		// Method: partial
		public function test_partial() {
			$template = $this->getMock('Template',array('render_file'),array(array(),false));
			$template->expects($this->once())->method('render_file')->with(ROOT.'/app/views/partials/me.php');
			
			$template->partial('me');
		}
		
				
		
		// Method: get
		public function test_get_variable() {
			$this->template->add('hello','world');
			
			$this->assertEquals('world', $this->template->get('hello'));
		}
		
		// Method: add
		public function test_add_one_variable() {
			$this->template->add('hello','world');
			
			$this->assertEquals(1, count($this->template->get_all()));
		}
		
		public function test_add_two_variable() {
			$this->template->add('hello','world');
			$this->template->add('hello2','world');
			
			$this->assertEquals(2, count($this->template->get_all()));
		}
		
		
		// Method: remove
		public function test_remove_variable() {
			
			$this->template->add('hello','world');
			$this->template->remove('hello');
			
			$this->assertEquals(0,count($this->template->get_all()));
		}
		
		
		// Method: remove_all
		public function test_remove_all_variable() {
			
			$this->template->add('hello','world');
			$this->template->add('hello2','world');
			$this->template->remove_all();
			
			$this->assertEquals(0,count($this->template->get_all()));
		}
		
		
	}
?>