<?php
	class AppController extends Controller {
		
		var $helpers = array('html','date','text','url','image');
		var $before_action = array('load_user');
		
		protected function load_user() {
			$this->user = 'admin';
		}
		
		protected function authenticate() {
			if ($this->user === 'admin') {
				echo 'Welcome Admin';
			}
		}
		
	}
?>
