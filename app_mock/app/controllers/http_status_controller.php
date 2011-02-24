<?php

	class HttpStatusController extends AppController {
		
		function render_erro_404() {
			$this->render_erro('404');
		}
		
		function status_403() {
			$this->render_text('Ops', 403);
		}
		
	}
	
?>