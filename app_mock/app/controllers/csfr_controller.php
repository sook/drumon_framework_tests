<?php

	class CsfrController extends AppController {
		
		var $layout = null;
		
		function form() {
			if($this->request->method == 'post'){
				$this->render_text($this->params['comment']);
			}
		}
		
		function form2() {
			if($this->request->method == 'post'){
				$this->render_text($this->params['comment']);
			}
		}	
	}
?>