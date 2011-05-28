<?php
	
	require_once CORE_PATH. '/class/helper.php';
	require_once CORE_PATH. '/helpers/image_helper.php';
	
	class ImageHelperTest extends PHPUnit_Framework_TestCase {
		
		
		public function setUp() {
			$this->request = $this->getMock('RequestHandler',array(),array(array()));
			$this->image = new ImageHelper($this->request,'pt-BR');
		}
		
		
		// Method: resize
		public function test_resize_300_300() {
			$result = $this->image->resize('photo.png',300,300);
			$this->assertEquals('http://local.dev/public/images/thumb.php?src=photo.png&w=300&h=300', $result);
		}
		
		public function test_resize_300_300_with_options() {
			$result = $this->image->resize('photo.png',300,300,array('q'=>80));
			$this->assertEquals('http://local.dev/public/images/thumb.php?src=photo.png&w=300&h=300&q=80', $result);
		}
		
		
		// Method: gravatar
		public function test_gravatar() {
			$md5 = md5('danillos@gmail.com');
			$result = $this->image->gravatar('danillos@gmail.com');
			$this->assertEquals('http://www.gravatar.com/avatar/'.$md5, $result);
		}
		
		
		// Method: fake
		public function test_fake() {
			$result = $this->image->fake('200','200');
			$this->assertEquals('<img src="http://placehold.it/200x200/">', $result);
		}
		
		public function test_fake_with_text() {
			$result = $this->image->fake('200','200','Hello');
			$this->assertEquals('<img src="http://placehold.it/200x200/&text=Hello">', $result);
		}
	}

?>