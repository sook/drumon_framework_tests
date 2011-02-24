<?php

	class ComplexNamespace_HomeController extends AppController {
		var $layout = null;
		
		function index() {
			$this->render_text('complex namespace');
		}
	}
?>