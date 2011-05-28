<?php

	class RedirectController extends AppController {
		
		public function simple_redirect() {
			$this->redirect('/');
		}
		
		public function named_redirect_internal() {
			$this->redirect_to_about();
		}
		
		public function named_redirect_internal_with_params() {
			$this->redirect_to_test_page('danillos');
		}
		
		public function named_redirect_external() {
			$this->redirect_to_danillos_blog();
		}
		
		public function test_page() {
			$this->render_text($this->params['name']);
		}
	}
	

?>