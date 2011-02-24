<?php

	class Namespace_HomeController extends AppController {
		var $layout = null;
		
		function index() {
			$this->render_text('namespace');
		}
	}
?>